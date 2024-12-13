<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\CrewRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CrewController extends Controller
{
    public function index()
    {

        $users = User::where('status', true)
            ->where('role', '!=', 1)
            ->select('id', 'name', 'phone', 'role', 'crew_id')
            ->get();

        return Inertia::render('Manager/Crew_Management', ['users' => $users]);
    }

    public function store(CrewRequest $request)
    {
        $rolePrefix = $request->role == 2 ? 'C' : ($request->role == 3 ? 'K' : '');
        $uniqueId = strtoupper(uniqid());
        $crewId = $rolePrefix . substr($uniqueId, -5);



        $crew = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'role' => $request->role,
            'crew_id' => $crewId, // Assign the generated crew ID
            'password' => bcrypt($request->password), // Hash the password
        ]);


        return redirect()->route('Manager.Crew_manager')->with('success', 'Crew member added successfully.');
    }

    public function destroy(Request $request)
    {

        $request->validate([
            'crew_id' => 'required|exists:users,crew_id',
        ]);
        $user = User::where('crew_id', $request->crew_id)->first();

        if ($user) {
            $user->update(['status' => false]);
        }

        return redirect()->route('Manager.Crew_manager')->with('success', 'Crew Member Removed');
    }
}
