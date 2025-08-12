<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageUsersController extends Controller
{
    public function index()
    {
        
        //$users = User::all(); // Fetch all users
        $users = User::with('roles')->get();
        $roles = Role::all(); // Fetch all roles for the user
        return view('dashboard.user.index', compact('users', 'roles')); // Adjust the view name as needed
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        // Prepare the array you want
        $userData = [
            'name'      => $user->name,
            'email'     => $user->email,
            'status'    => $user->status,
            'phone'     => $user->phone,
            'address'   => $user->address,
            'image'     => $user->image,
            'role_name' => $user->role_name,
        ];

        return view('dashboard.user.show', compact('userData'));
    }


    public function edit($id)
    {
        $user = User::findOrFail($id); // Find the user by ID
        $roles = Role::all(); // Fetch all roles for the user
        return view('dashboard.user.edit', compact('user', 'roles')); // Adjust the view name as needed
    }
       

    public function update(Request $request, $id)
    {
        $roles = Role::all(); // Fetch all roles for validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'role_name' => 'required|exists:roles,name', // Assuming you have a role_name field
        ]);
        $user = User::findOrFail($id);
        $user->update($request->all()); // Update user with request data
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('role_name')); // Assign the role to the user
        return redirect()->route('users.index', compact('roles'))->with('success', 'User updated successfully.');
    }

    public function assignPermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $permissions = $request->input('permissions', []); // Get permissions from the request
        $user->syncPermissions($permissions); // Sync permissions with the user
        return redirect()->route('users.index')->with('success', 'Permissions assigned successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    

}
