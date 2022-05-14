<?php

namespace App\Http\Repositories\ManageAdmin;

use App\Http\Controllers\ManageAdminController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ManageAdminRepository extends ManageAdminController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllUsersAdmin()
    {
        $users = User::where('role', 'admin')->get();
        return $users;
    }

    public function storeUserAdmin($request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['in:admin,non-admin'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
   
        User::create([
            'name' =>  $validated ['name'],
            'email' =>  $validated ['email'],
            'role' =>  $validated ['role'],
            'account_status' => $validated['role'] == 'admin' ? 'active' : 'inactive',
            'password' => Hash::make( $validated ['password']),
        ]);
       
        return;
    }

    public function updateUserAdmin($request, $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user->update([
            'name' =>  $validated ['name'],
            'email' =>  $validated ['email'],
        ]);
        
        return;
    }

    public function deleteUserAdmin($user)
    {
        $user->delete();
        return;
    }

    public function updateStatusAdmin($status, $user)
    {
        if($status == 'Enable') {
            $user->account_status = 'active';
        } else {
            $user->account_status = 'inactive';
        }
        $user->save();
        return;
    }
}
