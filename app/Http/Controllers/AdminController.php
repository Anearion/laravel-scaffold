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

  public function rolesManagement(){
    return $this->getRoleList();
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
