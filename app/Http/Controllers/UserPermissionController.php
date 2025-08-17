<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:manage_user_permissions')->only(['index', 'create', 'store']);
        $this->middleware('can:view_user_permissions')->only(['show']);
        $this->middleware('can:edit_user_permissions')->only(['edit', 'update']);
        $this->middleware('can:delete_user_permissions')->only(['destroy']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $permissions = Permission::all();
        $userPermissions = $user->permissions->pluck('id')->toArray();

        return view('dashboard.user.permissions', compact('user', 'permissions', 'userPermissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'permissions' => 'array|required',
        ]);

        $user = User::findOrFail($id);

        // Convert IDs to names (Spatie works with names)
        $permissionNames = Permission::whereIn('id', $request->permissions)
                                     ->pluck('name')
                                     ->toArray();

        $user->syncPermissions($permissionNames);

        return redirect()->route('users.index')
                         ->with('success', 'Permissions updated successfully for user.');
    }

   
}
