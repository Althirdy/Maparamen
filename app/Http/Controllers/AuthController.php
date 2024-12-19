<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            $user = Auth::user();
            $user->isActive = true;  // Update the isActive column
            $user->save();
            $request->session()->regenerate();
            if (Auth::user()->role == 1) {
                return redirect()->route('Manager.Dashboard');
            } else if (Auth::user()->role == 2) {
                return redirect()->route('Manager.Pos');
            } else if (Auth::user()->role == 3) {
                return redirect()->route('inventory.ingredients');
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

    public function Update_Profile(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required|max:11'
        ]);
        $user = Auth::user();
        $user->phone = $data['phone'];
        $user->save();
        return response()->json(['message' => 'Phone number updated successfully.']);
    }

    public function update_password(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => [
                'required',
                'string',
                'min:8',  // Minimum length of 8
                'max:16', // Maximum length of 16
                'regex:/[A-Z]/', // At least one uppercase letter
                'confirmed', // Check if new password matches the confirmation field
            ],
            'new_password_confirmation' => 'required|string|same:new_password',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); // Unprocessable Entity status code
        }

        // Check if the current password matches the logged-in user's password
        $user = Auth::user();

        if (!Hash::check($request->input('current_password'), $user->password)) {
            // Return error if current password doesn't match
            return response()->json(['error' => 'Current password is incorrect.'], 400);
        }

        // Update the user's password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        // Return a success response
        return response()->json(['message' => 'Password updated successfully.']);
        // return response()->json($request);
    }

    public function inactive_crew(Request $request)
    {
        $id = $request['id'];
        $user = User::find($id);
        $user->status = 2;
        $user->save();

        return response()->json($request);
    }
}
