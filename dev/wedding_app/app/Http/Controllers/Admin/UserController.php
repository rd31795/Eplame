<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index(Request $request) {
    	return view('admin.user-vendor.users.index')->with('title', 'Users');	
    }

   	public function ajax_getUsers(Request $request)
   	{
   		$users = User::select(['name', 'email'])->where('role', 'user')->get();
		return datatables()->of($users)->make(true);
   	}
}
