<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DefaultGroup;
use App\Event;

class GroupListController extends Controller
{
    public function index(){
		return view('admin.event-groups.index')
		                ->with('title', 'Groups')
		                ->with('addLink', 'create_group');
	}
}
