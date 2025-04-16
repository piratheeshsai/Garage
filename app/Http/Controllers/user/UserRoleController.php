<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        $allUsers = User::all();


        return view('user.UserRole.index',compact('users', 'roles', 'allUsers'));
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


        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'nullable|exists:roles,id',
        ]);

        $user = User::findOrFail($request->user_id);

        // Remove any existing roles first
        $user->syncRoles([]);

        // Assign the new role if one was selected
        if ($request->role_id) {
            $role = Role::findById($request->role_id);
            $user->assignRole($role);
        }

        return redirect()->route('Role.index')->with('success', 'Role assigned successfully');
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
    public function updateUserRole(Request $request, string $id)
    {
        //
        $request->validate([
            'role_id' => 'nullable|exists:roles,id',
        ]);

        $user = User::findOrFail($id);

        // Remove any existing roles
        $user->syncRoles([]);

        // Assign the new role if one was selected
        if ($request->role_id) {
            $role = Role::findById($request->role_id);
            $user->assignRole($role);
        }

        return redirect()->route('Role.index')->with('success', 'User role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $user = User::findOrFail($id);
        $user->syncRoles([]); // Remove all roles

        return redirect()->route('Role.index')->with('success', 'User role removed successfully');
    }
}
