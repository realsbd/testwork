<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Validate the form data
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'selectedCountry' => 'required|max:255',
        // 'country' => 'required|max:255',
        'phone' => 'required|max:255',
    ]);
    
    // Process the form data
    $name = $validatedData['name'];
    $email = $validatedData['email'];
    $selectedCountry = $validatedData['selectedCountry'];
    $country = $validatedData['selectedCountry']['name'];
    $phone = $validatedData['selectedCountry']['idd'].$validatedData['phone'];
    
    // dd($phone);
    // Store the form data in the database


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        DB::table('phone_book')->insert(
            ['user_id' => $user->id, 'phone' => $phone]
        );
        DB::table('user_countries')->insert(
            ['user_id' => $user->id, 'country' => $country]
        );

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
