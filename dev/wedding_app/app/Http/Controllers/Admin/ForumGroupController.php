<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DiscussionGroup;

class ForumGroupController extends Controller
{
    public function index(){
		return view('admin.forum-groups.index')
        ->with('title', 'Forum Groups')
        ->with('addLink', 'create_forum_group');
	}

	public function create()
	{
		return view('admin.forum-groups.add') 
            ->with('title','Forum Groups')
            ->with('addLink','list_forum_groups');
	}

	public function store(Request $request)
	{
		$this->validate($request,[
            'label' => 'required|max:50',
            'description' => 'required|max:250',
            'thumbnail' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'cover_img' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048']
	                 
		]);
         
        if ($request->hasFile('thumbnail')) {
	        $image = $request->file('thumbnail');
	        $filename = 'a'.time().'.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/uploads');
	        $image->move($destinationPath, $filename);
    	}

    	if ($request->hasFile('cover_img')) {
	        $image = $request->file('cover_img');
	        $filename1 = time().'.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/uploads');
	        $image->move($destinationPath, $filename1);
    	}

    	DiscussionGroup::create([
    		'label' => $request['label'],
    		'description' => $request['description'],
    		'thumbnail' => $filename,
    		'cover_img' => $filename1,
    		'status' => 1
    	]);

        return redirect()->route('list_forum_groups')->with('flash_message','Group has been saved successfully!');
        
	}

	public function edit($slug)
	{
		$groups = DiscussionGroup::where('slug', $slug)->first();
		 return !empty($groups) ?  view('admin.forum-groups.edit') 
	                    ->with('title','Edit Forum Group')
	                    ->with('groups',$groups)
	                    ->with('addLink','list_forum_groups') : redirect()->back()->with('error_flash_message','Something Wrong!');
	}

	public function update(Request $request,$slug)
	{
	    $group = DiscussionGroup::where('slug', $slug)->first();
		$this->validate($request,[
            'label' => 'required|max:50',
            'description' => 'required|max:250' 
		]);

    	$filename = $group->thumbnail;
    	$filename1 = $group->cover_img;

    	if ($request->hasFile('thumbnail')) {
	        $image = $request->file('thumbnail');
	        $filename = time().'.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/uploads');
	        $img_path = public_path().'/uploads/'.$group->thumbnail;
	        if (file_exists($img_path)) {
		        unlink($img_path);
		    }
	        $image->move($destinationPath, $filename);
    	}

    	if ($request->hasFile('cover_img')) {
	        $image = $request->file('cover_img');
	        $filename1 = time().'.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/uploads');
	        $img_path = public_path().'/uploads/'.$group->cover_img;
	        if (file_exists($img_path)) {
		        unlink($img_path);
		    }
	        $image->move($destinationPath, $filename1);
    	}

    	$group->update([
    		'label' => $request['label'],
    		'description' => $request['description'],
    		'thumbnail' => $filename,
    		'cover_img' => $filename1,
    		'status' => $group->status
    	]);

		return redirect()->route('list_forum_groups')->with('flash_message','Group has been updated successfully!');

	}

	public function ajax_getforum_groups()
	{

		$groups = DiscussionGroup::select(['label', 'slug', 'status'])
		         ->get();
		

		return datatables()->of($groups)
		->addColumn('action', function ($t) {
		return  $this->Actions($t);
		})
		->editColumn('status',function($t){
		return $t->status == 1 ? 'Active' : 'In-Active';
		})

		->make(true);
	}

	public function Actions($data)
    {
            $text  ='<div class="btn-group">';
            $text .='<button type="button" class="btn btn-primary">Action</button>';
            $text .='<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
            $text .='<span class="caret"></span>';
            $text .='<span class="sr-only">Toggle Dropdown</span>';
            $text .='</button>';
            $text .='<div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; transform: translate3d(67px, -165px, 0px); top: 0px; left: 0px; will-change: transform;">';

            $text .='<a href="'.route('edit_forum_group',$data->slug).'" class="dropdown-item">Edit</a>';
            $text .='<div class="dropdown-divider"></div>';
            $status=$data->status == 0 ? 'Active' : 'In-Active';
            $text .='<a href="'.route('forum_group_status',$data->slug).'" class="dropdown-item">'.$status.'</a>';
            $text .='</div>';

            return $text;
    }

    public function group_status($slug)
    {
         $group= DiscussionGroup::where('slug',$slug)->first();
         if(!empty($group)){
            $group->status = $group->status == 1 ? 0 : 1;
            $group->save();
                     $msg= $group->status == 1 ? '<b>'.$group->label.'</b> is Activated' : '<b>'.$group->label.'</b> is Deactivated';
                    return redirect(route('list_forum_groups'))->with('flash_message',$msg);
         }
         return redirect()->back()->with('flash_message','Something not Working!');
    }
}
