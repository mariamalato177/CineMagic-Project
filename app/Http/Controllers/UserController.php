<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Purchase;


class UserController extends Controller
{
    public function index(Request $request): View
    {
        $filterByName = $request->query('searchName');
        $staffsQuery = User::whereIn('type', ['E', 'A']);

        if ($filterByName !== null) {
            $staffsQuery->where(function ($query) use ($filterByName) {
                $query->where('name', 'like', '%' . $filterByName . '%');
            });
        }
        $staffs = $staffsQuery
        ->orderBy('name')
        ->paginate(10)
        ->withQueryString();


        return view('users.index')->with([
            'staffs' => $staffs,
            'filterByName' => $filterByName,
        ]);


        $staffs = User::whereIn('type', ['E', 'A'])->get();
        return view('users.index', ['staffs' => $staffs]);
    }

    public function list(Request $request): View
    {
        $filterByName = $request->query('searchName');
        $usersQuery = User::whereIn('type', ['C']);
        if ($filterByName !== null) {
            $usersQuery->where(function ($query) use ($filterByName) {
            $query->where('name', 'like', '%' . $filterByName . '%');
            });
        }
        $users = $usersQuery
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();
        return view('users.list')->with([
            'users' => $users,
            'filterByName' => $filterByName,
        ]);
    }

    public function show(User $user): View
    {
        return view('users.show', ['user' => $user]);
    }

    public function edit(User $user): View
    {
        return view('users.edit', ['user' => $user]);
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function destroy(User $user): RedirectResponse
    {

        $user->delete();
        if($user->type == 'C'){
            return redirect()->route('users.list');
        }
        return redirect()->route('users.index');
    }


    public function update(Request $request, $id)
    {
        $staff = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'type' => 'required|in:E,A',
            'blocked' => 'required|boolean',
        ]);


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = $file->store('photos', 'public');
            $validatedData['photo_filename'] = basename($filename);
            if ($staff->photo_filename) {
                Storage::disk('public')->delete('photos/' . $staff->photo_filename);
            }
        }

        $staff->update($validatedData);

        return redirect()->route('users.index')->with('success', 'Staff member updated successfully.');
    }



    public function destroyPhoto(User $user)
    {
        if ($user->photo_filename) {
            Storage::delete($user->photo_filename);
            $user->photo_filename = null;
            $user->save();
        }

        return redirect()->route('profile.edit')->with('status', 'profile-photo-removed');
    }

    public function storeNewUser(Request $request): RedirectResponse
    {
        $data = $request->all();
        if ($request->hasFile('photo_filename')) {
            $poster = $request->file('photo_filename');
            $filename = $poster->store('photos', 'public');
            $data['photo_filename'] = basename($filename);
        }
        User::create($data);
        return redirect()->route('users.index');
    }

    public function store(ProfileUpdateRequest $request, User $user): RedirectResponse
    {
        $validatedData = $request->validated();
        $User = DB::transaction(function () use ($validatedData, $request) {
            $User = new User();
            $User->type = 'C';
            $User->name = $validatedData['name'];
            $User->email = $validatedData['email'];
            $User->nif = $validatedData['nif'];
            $User->password = bcrypt('123');
            $User->save();
            // File store is the last thing to execute!
            // files do not rollback, so the probability of having
            // a pending file (not referenced by any teacher)
            // is reduced by being the last operation
            if ($request->hasFile('photo_filename')) {
                $path = $request->photo_filename->store('public/photos');
                $User->photo_filename = basename($path);
                $User->save();
            }
            return $User;
        });
        return redirect()->route('profile.show', $User)->with('status', 'user-created');
    }

    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->block();

        return redirect()->route('users.list');
    }

    public function unblock($id)
    {
        $user = User::findOrFail($id);
        $user->unblock();

        return redirect()->route('users.list');
    }

}
