<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CmsMenu;
use App\Models\Admin\CmsPage;
class CmsMenuController extends Controller
{
     public function index()
    {
        $cmsmenu = CmsMenu::select(['id','page_type','cms_id','custom_name','custom_url', 'status'])->get();
        
        return view('admin.cms-menu.index')
        ->with('addLink','admin.cms-menu.create')
        ->with('title','CMS Menu')
        ->with('cmsmenu', $cmsmenu);
    }
    public function showCreate() {

    	$cmspages = CmsPage::where('status',1)->get();
    	return view('admin.cms-menu.create')
    	->with(['title' => 'Create Cms Menu', 
    		'addLink' => 'admin.cms-menu.create',
    	     'cmspages'=> $cmspages]);
    }
     public function create(Request $request) {
    	
        $d = new CmsMenu;
         $d->page_type = trim($request->page_type);
          $d->cms_id = trim($request->cmspage);
          $d->custom_name = trim($request->custom_name);
          $d->custom_url = trim($request->custom_url);
          $d->save();
    	
    	return redirect()->route('admin.cms-menu.list')->with('flash_message', 'CMS Menu has been created successfully!');
    }
     public function delete($id)
    {
        $c= CmsMenu::find($id);
        $c->status = $c->status == 1 ? 0 : 1;
        $c->save();

        $msg= $c->status == 1 ? 'Page is Activated' : 'Page is Deactivated';
        return redirect(route('admin.cms-menu.list'))->with('flash_message',$msg);
    }
     public function edit(Request $request,$id)
    {

    	$cmsmenu = CmsMenu::where('id', $id)->first();
    	$cmspages = CmsPage::where('status',1)->get();

    	return view('admin.cms-menu.edit')
    	->with(['title' => 'Create Cms Menu', 
    		'addLink' => 'admin.cms-menu.create',
    		'cmsmenu' => $cmsmenu,
    	     'cmspages'=> $cmspages]);
    }
     public function update(Request $request,$id)
    {

          $d = CmsMenu::where('id',$id)->first();
          $d->page_type = trim($request->page_type);
          $d->cms_id = trim($request->cmspage);
          $d->custom_name = trim($request->custom_name);
          $d->custom_url = trim($request->custom_url);
          $d->save();

        return redirect(route('admin.cms-menu.list'))->with('flash_message','CMS Menu has been updated!');

    }


}
