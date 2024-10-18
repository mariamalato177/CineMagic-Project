<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

use App\Models\Customer;
use App\Models\User;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    {
        $user = auth()->user();
        $user->fill($request->except(['password']));

        if ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $filename = $file->store('photos', 'public');

            if ($user->photo_filename) {
                Storage::disk('public')->delete('photos/' . $user->photo_filename);
            }

            $user->photo_filename = basename($filename);
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        if ($user->type == 'C') {
            $customer = Customer::where('id', $user->id)->first();

            $customer->fill($request->except(['password', 'photo_file']));

            if ($request->filled('payment_ref')) {
                $customer->payment_ref = $request->input('payment_ref');
            }

            if ($request->filled('payment_type')) {
                $customer->payment_type = $request->input('payment_type');
            }

            $customer->update();
        }


        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function destroyPhoto(): RedirectResponse
    {
        $user = auth()->user();
        if ($user->photo_filename) {
        if (Storage::fileExists('public/photos/' . $user->photo_filename)) {
        Storage::delete('public/photos/' . $user->photo_filename);
        }
        $user->photo_filename = null;
        $user->update();
        return redirect()->back()
        ->with('alert-type', 'success')
        ->with('alert-msg', "Photo of user {$user->name} has been deleted.");
        }
        return redirect()->back();
    }
}
