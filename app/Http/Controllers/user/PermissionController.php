<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role ;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('user.Permissions.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $permissionGroups = PermissionGroup::with('permissions')->get();
        return view('user.Permissions.create', compact('permissionGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'permission_ids' => 'required|array',
        ]);

        // Check if the role already exists for the 'web' guard
        $existingRole = Role::where('name', $request->name)
                            ->where('guard_name', 'web')
                            ->first();

        if ($existingRole) {
            return redirect()->back()->with('swal_error', 'Role already exists.');

        }

        // Create the new role
        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = 'web';
        $role->save();

        // Sync permissions
        $permissionIds = array_map('intval', $request->permission_ids);
        $role->syncPermissions($permissionIds);

        return redirect()->route('Permission.index')->with('swal_success', 'Role created successfully.');

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
        $role = Role::findOrFail($id);
        $permissionGroups = PermissionGroup::with('permissions')->get();
        return view('user.Permissions.edit', compact('role', 'permissionGroups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        $permissionIds = array_map('intval', $request->permission_ids);
        $role->syncPermissions($permissionIds);
        return redirect()->route('Permission.index')->with('swal_success', 'Role created');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('Permission.index')->with('swal_success', 'Role deleted successfully.');
    }
}
