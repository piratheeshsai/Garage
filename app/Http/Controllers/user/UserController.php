<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::all();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'nic' => 'nullable|string|max:20',
        ]);




        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'Nic' => $validated['nic'] ?? null,
            'password' => Hash::make($validated['nic'] ?? ''),
            'status' => 'active', // Default status
        ]);



        // Flash success message to the session
        return redirect()->route('user.index')->with('swal_success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'nic' => 'nullable|string|max:20',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'Nic' => $validated['nic'] ?? null,
        ]);

        // Flash success message to the session
        return redirect()->route('user.index')->with('swal_success', 'User updated successfully!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $user=User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('swal_success', 'User deleted successfully!');
    }


    public function deactivate(string $id)
    {
        $user = User::findOrFail($id);
        $user->status = 'inactive';
        $user->save();

        return redirect()->route('user.index')->with('swal_success', 'User deactivated successfully.');
    }

    public function activate(string $id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        return redirect()->route('user.index')->with('swal_success', 'User activated successfully.');
    }
}
