<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{

  public function usersManagement(){
    $users = $this->getUserList();
    $roles = $this->getRoleList();

    return view('administration.users-management')->with('users', $users)->with('roles', $roles);

  }

  public function saveUser(Request $request){
    $data = $request->all();
    $user = new User();
    $user->name = $data['name'];
    $user->email = $data['email'];
    $user->password = bcrypt($data['password']);
    $user->save();

    $user->attachRole(Role::find($data['role']));

    return $this->usersManagement();
  }

  public function editUser(Request $request){
    $data = $request->all();
    $user = User::find($data['edit_user_id']);
    $user->name = $data['edit_name'];
    $user->email = $data['edit_email'];
    if(sizeof($data['edit_password'])>0)
      $user->password = bcrypt($data['edit_password']);
    $user->save();
    $user->attachRole(Role::find($data['edit_role']));

    return $this->usersManagement();
  }

  public function deleteUser(Request $request){
    $data = $request->all();
    $user = User::find($data['user_id']);

    User::whereId($user->id)->delete();

    return redirect('/admin/users');
  }



  /******************* Role Management ***************************/

  public function rolesManagement(){
    $roles = Role::all();
    return view('administration.roles-management')->with('roles', $roles);
  }

  public function saveRole(Request $request){
    $data = $request->all();
    $role = new Role();
    $role->name = $data['name'];
    $role->display_name = $data['display_name'];
    $role->description = $data['description'];
    $role->save();

    return $this->rolesManagement();
  }

  public function editRole(Request $request){
    $data = $request->all();

    $role = Role::where('name', '=', $data['old_name'])->first();
    $role->name = $data['edit_name'];
    $role->display_name = $data['edit_display_name'];
    $role->description = $data['edit_description'];
    $role->save();

    return $this->rolesManagement();
  }

  public function deleteRole(Request $request){
    $data = $request->all();
    $role = Role::where('name', '=', $data['name'])->first();

    Role::whereId($role->id)->delete();

    return redirect('/admin/roles');
  }

  public function getUserList(){
    return User::with('roles')->get();
  }

  public function getRoleList(){

    $res = Role::all();
    $roles = array();
    foreach ($res as $ro){
      $roles[$ro['id']] = $ro['name'];
    }

    return $roles;
  }

}
