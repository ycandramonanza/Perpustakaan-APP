<?php

namespace App\Http\Repositories\ManageUsers;

use App\Http\Controllers\ManageUsersController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ManageUsersRepository extends ManageUsersController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllUsers()
    {
        $users = User::where('role', 'non-admin')->get();
        return $users;
    }

    public function storeUser($request)
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

    public function updateUser($request, $user)
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

    public function deleteUser($user)
    {
        $user->delete();
        return;
    }

    public function updateStatus($status, $user)
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
