<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'crew_id' => ['required', 'max:100'],
            'password' => ['required'],
            'role' => ['required'],
        ]);
        $roleMapping = [
            'Branch Manager' => 1,
            'Cashier' => 2,
            'Kitchen' => 3,
        ];

        // Convert the role to its integer value
        $role = $roleMapping[$fields['role']] ?? null;

        if (Auth::attempt(['crew_id' => $fields['crew_id'], 'password' => $fields['password'], 'role' => $role, 'status' => true])) {
            $request->session()->regenerate();
            if (Auth::user()->role == 1) {
                return redirect()->route('Manager.Dashboard');
            } else if (Auth::user()->role == 2) {
                return redirect()->route('Manager.Pos');
            }
        }

        return back()->withErrors([
            'error' => 'Username or Password is invalid'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home.login');
    }
}
