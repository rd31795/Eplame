<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
class MenuController extends Controller
{
    public function index() {
    	return view('admin.menu.index')->with(['title' => 'Menu Management', 'addLink' => 'admin.menu.create']);
    	
    }
     public function ajax_getMenu() {
		$menus = Menu::select(['title', 'slug', 'status'])->get();
		
		return datatables()->of($menus)
		->addColumn('action', function ($t) {
			return  $this->Actions($t);
		})->editColumn('status', function($t){
			return $t->status == 1 ? 'Active' : 'In-Active';
		})->editColumn('title',function($t){
        return str_limit($t->title, 50);
        })->make(true);
	}

    public function showCreate() {
    	return view('admin.menu.create')->with(['title' => 'Create Menu', 'addLink' => 'admin.menu.create']);
    }
    public function showEdit($slug) {
    	$menu = Menu::FindBySlugOrFail($slug);
    	return view('admin.menu.edit')
    	->with(['menu' => $menu, 'title' => 'Edit Menu', 'addLink' => 'admin.menu.list']);
    }
     public function create(Request $request) {
    	$validatedData = $request->validate([
            'title' => ['required', 'string', 'max:30']
        ]);

    	Menu::create([
    		'title' => $request['title'],
    	]);
    	return redirect()->route('admin.menu.list')->with('flash_message', 'Menu has been created successfully!');
    }
     public function Actions($data) {
            $text  ='<div class="btn-group">';
            $text .='<button type="button" class="btn btn-primary">Action</button>';
            $text .='<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
            $text .='<span class="caret"></span>';
            $text .='<span class="sr-only">Toggle Dropdown</span>';
            $text .='</button>';
            $text .='<div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; transform: translate3d(67px, -165px, 0px); top: 0px; left: 0px; will-change: transform;">';


            $text .='<a href="'.route('admin.menu.showEdit', $data->slug).'" class="dropdown-item">Edit</a>';
            $text .='<div class="dropdown-divider"></div>';
            $status=$data->status == 0 ? 'Active' : 'In-Active';
            $text .='<a href="'.route('admin.menu.status', $data->slug).'" class="dropdown-item">'.$status.'</a>';


            $text .='</div>';
            $text .='</div>';

            return $text;
    }
    public function update(Request $request, $slug) {
    	$validatedData = $request->validate([
            'title' => ['required', 'string', 'max:20']
        ]);

    	$menu = Menu::FindBySlugOrFail($slug);
    	$menu->update([
    		'title' => $request['title']
    	]);
    	return redirect()->route('admin.menu.list')->with('flash_message', 'Menu has been updated successfully!');
    }
     public function menuStatus($slug) {
     $menu = Menu::FindBySlugOrFail($slug);

     if(!empty($menu)){
        $menu->status = $menu->status == 1 ? 0 : 1;
        $menu->save();
        $msg= $menu->status == 1 ? '<b>'.$menu->title.'</b> is Activated' : '<b>'.$menu->title.'</b> is Deactivated';
       return redirect(route('admin.menu.list'))->with('flash_message', $msg);
     }
     return redirect()->back()->with('flash_message', 'Something Went Woring!');
    }



}
