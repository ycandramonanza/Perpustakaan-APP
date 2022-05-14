<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Repositories\ManageUsers\ManageUsersRepository;

class ManageUsersController extends Controller
{
    protected $manageUser;
    public function __construct()
    {
        $this->middleware('auth');
        $this->manageUser= new ManageUsersRepository();
    }

    public function index() 
    {
        $users = $this->manageUser->getAllUsers();
        return view('manage-users.index', compact('users'));
    }

    public function create(User $id)
    {
        if($id->id == null){
            return view('manage-users.create');
        }else{
            return view('manage-users.create', compact('id'));
        }   
    }

    public function store(Request $request)
    {
        $this->manageUser->storeUser($request);
        return redirect()->route('manage-users.index');
    }

    public function update(Request $request, User $id)
    {
        $this->manageUser->updateUser($request, $id);
        return redirect()->route('manage-users.index');
    }

    public function destroy(User $id) 
    {
        $this->manageUser->deleteUser($id);
        return redirect()->route('manage-users.index');
    }

    public function statusEnable(User $id) 
    {
        $status = 'Enable';
        $this->manageUser->updateStatus($status, $id);
        return redirect()->route('manage-users.index');
    }

    public function statusDisable(User $id) 
    {
        $status = 'Disable';
        $this->manageUser->updateStatus($status, $id);
        return redirect()->route('manage-users.index');
    }
}
