<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Group;
use App\Menu;
use App\AccessPermission;
class GroupsController extends Controller
{
     public function index() {
    	return view('admin.group.index')->with(['title' => 'SubAdmin Group Management', 'addLink' => 'admin.group.create']);
    	
    }
     public function ajax_getsubadmingroup() {
		$groups = Group::select(['title', 'slug', 'status'])->get();
		
		return datatables()->of($groups)
		->addColumn('action', function ($t) {
			return  $this->Actions($t);
		})->editColumn('status', function($t){
			return $t->status == 1 ? 'Active' : 'In-Active';
		})->editColumn('title',function($t){
        return str_limit($t->title, 50);
        })->make(true);
	}
	
     public function showCreate() {
     	$menus = Menu::where('status', 1)->get();
     return view('admin.group.create')->with(['title' => 'Create Group', 'addLink' => 'admin.group.create','menus' => $menus]);
    }
    public function create(Request $request) {
    	$validatedData = $request->validate([
            'title' => ['required', 'string', 'max:30']
        ]);
        $group= new Group;
        $group->title=$request->title;
        $group->save();

    	$menus = Menu::where('status', 1)->get();
        foreach ($menus as $menu) {
            $per = new AccessPermission;
            $per->group_id = $group->id;
            $per->menu_id = $menu->id;
            if($request->input($menu->slug.'_read_permission') == 1){
                $per->read_permission = 1;
            }else{  
                $per->read_permission = 0;
            }
            if($request->input($menu->slug.'_write_permission') == 1){
                $per->write_permission = 1;
            }else{  
                $per->write_permission = 0;
            }
            $per->save();
          }
    	return redirect()->route('admin.group.list')->with('flash_message', 'Subadmin Group has been created successfully!');
    
	}
     public function showEdit($slug) {
    	$group = Group::FindBySlugOrFail($slug);
    	 $menus = Menu::where('status', 1)->get();
    	return view('admin.group.edit')
    	->with(['group' => $group,'menus'=>$menus, 'title' => 'Edit Group', 'addLink' => 'admin.group.list']);
    }
     public function update(Request $request, $slug) {
    	$validatedData = $request->validate([
            'title' => ['required', 'string', 'max:20']
        ]);

    	$group = Group::FindBySlugOrFail($slug);
    	$group->title= $request->title;
    	$group->save();
    	$menus = Menu::where('status', 1)->get();
        foreach ($menus as $menu) {
            $per = AccessPermission::where('group_id', $group->id)->where('menu_id', $menu->id)->first();
            if(!empty($per)){
              if($request->input($menu->slug.'_read_permission') == 1){
                  $per->read_permission = 1;
              }else{  
                  $per->read_permission = 0;
              }
              if($request->input($menu->slug.'_write_permission') == 1){
                  $per->write_permission = 1;
              }else{  
                  $per->write_permission = 0;
              }
            }else{
              $per = new AccessPermission;
              $per->group_id = $id;
              $per->menu_id = $menu->id;
              if($request->input($menu->slug.'_read_permission') == 1){
                  $per->read_permission = 1;
              }else{  
                  $per->read_permission = 0;
              }
              if($request->input($menu->slug.'_write_permission') == 1){
                  $per->write_permission = 1;
              }else{  
                  $per->write_permission = 0;
              }
            }
            $per->save();
        }  
    	return redirect()->route('admin.group.list')->with('flash_message', 'Group has been updated successfully!');
    }
     public function groupStatus($id) {
     $group = Group::find($id);

     if(!empty($group)){
        $group->status = $group->status == 1 ? 0 : 1;
        $group->save();
        $msg= $group->status == 1 ? '<b>'.$group->title.'</b> is Activated' : '<b>'.$group->title.'</b> is Deactivated';
       return redirect(route('admin.group.list'))->with('flash_message', $msg);
     }
     return redirect()->back()->with('flash_message', 'Something Went Woring!');
    }
     public function Actions($data) {
            $text  ='<div class="btn-group">';
            $text .='<button type="button" class="btn btn-primary">Action</button>';
            $text .='<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
            $text .='<span class="caret"></span>';
            $text .='<span class="sr-only">Toggle Dropdown</span>';
            $text .='</button>';
            $text .='<div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; transform: translate3d(67px, -165px, 0px); top: 0px; left: 0px; will-change: transform;">';


            $text .='<a href="'.route('admin.group.showEdit', $data->slug).'" class="dropdown-item">Edit</a>';
            $text .='<div class="dropdown-divider"></div>';
            $status=$data->status == 0 ? 'Active' : 'In-Active';
            $text .='<a href="'.route('admin.group.status', $data->slug).'" class="dropdown-item">'.$status.'</a>';


            $text .='</div>';
            $text .='</div>';

            return $text;
    }
}
