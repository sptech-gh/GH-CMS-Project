<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Church;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class AdminRegisterController extends Controller
{
    public function create()
    {
        return view('auth.admin-register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'church_name' => ['required', 'string', 'max:255', 'unique:churches,name'],
            'location'    => ['required', 'string', 'max:255'],
            'region'      => ['required', 'string', 'max:255'],
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'    => ['required', 'confirmed', 'min:8'],
        ]);

        // ✅ Create church
        $church = Church::create([
            'name'        => $request->church_name,
            'location'    => $request->location,
            'region'      => $request->region,
            'description' => "Registered via admin portal.",
        ]);

        // ✅ Create user (with primary church_id)
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'admin', // global/system role
            'church_id' => $church->id, // primary church
        ]);

        // ✅ Attach user to church via pivot with role
        $church->users()->attach($user->id, ['role' => 'admin']);

        // Fire Laravel registered event
        event(new Registered($user));

        // Login new admin
        Auth::login($user);

        // Set active church in session
        session(['current_church_id' => $church->id]);

        return redirect()
            ->route('dashboard')
            ->with('success', '✅ Church and Admin registered successfully.');
    }
}
