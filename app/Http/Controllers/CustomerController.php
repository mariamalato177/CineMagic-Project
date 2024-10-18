<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;



class CustomerController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Customer::class, 'customer');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : View
    {

        $filterByCustomer = $request->query('searchName');
        $usersQuery = User::where('type', 'C') && Customer::where('user_id', 'id');


        if ($filterByCustomer !== null) {
            $usersQuery->where(function ($query) use ($filterByCustomer) {
                $query->where('name', 'like', '%' . $filterByCustomer . '%');
            });
        }
        $customers = $usersQuery
        ->paginate(10)
        ->withQueryString();


        return view('customers.index')->with([
            'users' => $customers,
            'filterByName' => $filterByCustomer,
        ]);


        $customers = User::whereIn('type', ['C'])->get();
        return view('customers.index', ['customers' => $customers]);
    }

    public function create(): View
    {
        $newCustomer = new Customer();
        return view('users.create')->with('customer', $newCustomer);
    }
    /**
     * Display the specified resource.
     */
    public function show(Customer $customer) : View
    {
        return view('customers.show', ['customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    {
        $validatedData = $request->validated();
        $user = DB::transaction(function () use ($validatedData, $user, $request) {
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->type = $validatedData['type'];
            $user->save();
            if ($request->hasFile('photo_filename')) {
                if ($user->photo_url &&
                    Storage::fileExists('public/photos/' . $user->photo_filename)) {
                        Storage::delete('public/photos/' . $user->photo_filename);
                }
                $path = $request->photo_filename->store('public/photos');
                $user->photo_filename = basename($path);
                $user->save();
            }
            return $user;
        });
        $url = route('profile.show', ['user' => $user]);
        $htmlMessage = "User <a href='$url'><u>{$user->name}</u></a> has been updated successfully!";
        return redirect()->route('profile.index')
            ->with('alert-type', 'success')
            ->with('alert-msg', $htmlMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            $user = $customer->user;
                DB::transaction(function () use ($customer, $user) {
                    $customer->delete();
                    $user->delete();
                });
                if ($user->photo_url) {
                    Storage::delete('public/photos/' . $user->photo_url);
                }
                $htmlMessage = "Customer #{$customer->id}
                        <strong>\"{$user->name}\"</strong> was successfully deleted!";
                return redirect()
                    ->route('customers.index')
                    ->with('alert-msg', $htmlMessage)
                    ->with('alert-type', 'success');

        } catch (\Exception $error) {
            $url = route('customers.show', ['customer' => $customer]);
            $htmlMessage = "Error: Couldn't delete Customer <a href='$url'>#{$user->id}</a>
                        <strong>\"{$user->name}\"</strong>!";
            return back()
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'danger');
        }

    }

    public function block($id){
        $user = User::find($id);
        $user->blocked = 1;
        $user->save();
        return redirect()->route('customers.index');
    }

    public function unblock($id){
        $user = User::find($id);
        $user->blocked = 0;
        $user->save();
        return redirect()->route('customers.index');
    }


}
