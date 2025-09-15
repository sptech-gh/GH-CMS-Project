<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Show the default registration form (no church assignment).
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle a new registration request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'email.unique' => 'This email address is already registered.',
            'password.confirmed' => 'Passwords do not match.',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'member',   // default role
            'church_id' => null,       // 🚫 no church at signup
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Don’t set current_church_id here, since they don’t have one yet
        return redirect()->route('home')
            ->with('success', '🎉 Your account has been created. Please contact your church admin to be assigned.');
    }
}
