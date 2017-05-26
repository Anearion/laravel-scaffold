<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
  public function UsersManagement(){
    $users = $this->getUserList();
    return view('administration.users-management')->with('users', $users);

  }

  public function RolesManagement(){
    return $this->getRoleList();
  }

  public function getUserList(){
    return User::with('roles')->get();
  }

  public function getRoleList(){
    return Role::all();
  }

}
