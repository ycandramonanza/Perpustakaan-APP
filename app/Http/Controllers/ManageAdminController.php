<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Repositories\ManageAdmin\ManageAdminRepository;

class ManageAdminController extends Controller
{
    protected $manageAdmin;
    public function __construct()
    {
        $this->middleware('auth');
        $this->manageAdmin= new ManageAdminRepository();
    }

    public function index() 
    {
        $users = $this->manageAdmin->getAllUsersAdmin();
        return view('manage-admin.index', compact('users'));
    }

    public function create(User $id)
    {
        if($id->id == null){
            return view('manage-admin.create');
        }else{
            return view('manage-admin.create', compact('id'));
        }   
    }

    public function store(Request $request)
    {
        $this->manageAdmin->storeUserAdmin($request);
        return redirect()->route('manage-admin.index');
    }

    public function update(Request $request, User $id)
    {
        $this->manageAdmin->updateUserAdmin($request, $id);
        return redirect()->route('manage-admin.index');
    }

    public function destroy(User $id) 
    {
        $this->manageAdmin->deleteUserAdmin($id);
        return redirect()->route('manage-admin.index');
    }

    public function statusEnable(User $id) 
    {
        $status = 'Enable';
        $this->manageAdmin->updateStatusAdmin($status, $id);
        return redirect()->route('manage-admin.index');
    }

    public function statusDisable(User $id) 
    {
        $status = 'Disable';
        $this->manageAdmin->updateStatusAdmin($status, $id);
        return redirect()->route('manage-admin.index');
    }
}
