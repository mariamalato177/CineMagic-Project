<?php
namespace App\Http\Controllers;

use App\Models\Theater;
use App\Models\Seat;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TheaterFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TheaterController extends Controller
{
    public function index() : View
    {
        return view('theaters.index')
            ->with('theaters', Theater::orderBy('name')->paginate(20));
    }

    public function create() : View
    {
        $newTheater = new Theater();
        return view('theaters.create')
            ->with('theater', $newTheater);
    }

    public function store(TheaterFormRequest $request): RedirectResponse
    {
        $data = $request->all();
        if ($request->hasFile('photo_filename')) {
            $poster = $request->file('photo_filename');
            $filename = $poster->store('images', 'public');
            $data['photo_filename'] = basename($filename);
        }

        $newTheater = Theater::create($data);

        $rows = explode(',', $request->input('rows'));
        $seatsPerRow = $request->input('seats_per_row');
        foreach ($rows as $row) {
            for ($i = 1; $i <= $seatsPerRow; $i++) {
                Seat::create([
                    'theater_id' => $newTheater->id,
                    'row' => trim($row),
                    'seat_number' => $i,
                ]);
            }
        }

        $url = route('theaters.show', ['theater' => $newTheater]);
        $htmlMessage = "Theater <a href='$url'><u>{$newTheater->name}</u></a> has been created successfully!";
        return redirect()->route('theaters.index')
            ->with('alert-type', 'success')
            ->with('alert-msg', $htmlMessage);
    }


    public function show(Theater $theater): View
    {
        $seats = $theater->seats()->get();
        return view('theaters.show')
            ->with(['theater' => $theater, 'seats' => $seats]);
    }

    public function edit(Theater $theater) : View
    {
        return view('theaters.edit')
            ->with('theater', $theater);
    }

    public function update(TheaterFormRequest $request, Theater $theater): RedirectResponse
    {
        $theater->update($request->validated());
        if ($request->hasFile('photo_filename')) {
            // Delete old photo from storage if it exists
            Storage::disk('public')->delete('images/' . $theater->photo_filename);

            $poster = $request->file('photo_filename');
            $filename = $poster->store('images', 'public');
            $theater->photo_filename = basename($filename);
            $theater->save();

        }
        if ($request->filled('rows') && $request->filled('seats_per_row') != 0 && $request->input('seats_per_row') != 0) {
            $rows = explode(',', $request->input('rows'));
            $seatsPerRow = $request->input('seats_per_row');


            $theater->seats()->delete();
            foreach ($rows as $row) {
                for ($i = 1; $i <= $seatsPerRow; $i++) {
                    Seat::create([
                        'theater_id' => $theater->id,
                        'row' => trim($row),
                        'seat_number' => $i,
                    ]);
                }
            }
        }

        $url = route('theaters.show', ['theater' => $theater]);
        $htmlMessage = "Theater <a href='$url'><u>{$theater->name}</u></a> has been updated successfully!";
        return redirect()->route('theaters.index')
            ->with('alert-type', 'success')
            ->with('alert-msg', $htmlMessage);
    }


    public function destroy(Theater $theater): RedirectResponse
    {
        try {
            $url = route('theaters.show', ['theater' => $theater]);
            $totalScreenings = DB::table('screenings')->where('theater_id', $theater->id)->count();

            if ($totalScreenings == 0) {
                $theater->delete();
                $alertType = 'success';
                $alertMsg = "Theater {$theater->name} has been deleted successfully!";
            } else {
                $alertType = 'warning';
                $justification = match (true) {
                    $totalScreenings <= 0 => "",
                    $totalScreenings == 1 => "there is 1 screening in the theater",
                    $totalScreenings > 1 => "there are $totalScreenings screenings in the theater",
                };
                $alertMsg = "Theater {$theater->name} cannot be deleted because $justification.";
            }
        } catch (\Exception $error) {
            $alertType = 'danger';
            $alertMsg = "It was not possible to delete the theater {$theater->name} because there was an error with the operation!";
        }
        return redirect()->route('theaters.index')
            ->with('alert-type', $alertType)
            ->with('alert-msg', $alertMsg);
    }
}
