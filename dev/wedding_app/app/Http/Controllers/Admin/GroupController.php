<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DefaultGroup;
use App\Event;


class GroupController extends Controller
{
    public function index(){
		return view('admin.event-groups.index')
        ->with('title', 'Groups')
        ->with('addLink', 'create_group');
	}

	public function create()
	{
		$events = Event::all();
		return view('admin.event-groups.add') 
            ->with('title','Event Groups')
            ->with('addLink','list_groups')
            ->with(['events' => $events]);
	}

	public function store(Request $request)
	{
		$this->validate($request,[
            'group_label' => 'required|max:50',
            'event_type_id' => 'required'
	                 
		]);
         
        $storeGroups = new DefaultGroup($request->all());
        if(($storeGroups->save())){
            return redirect()->route('list_groups')->with('flash_message','Group has been saved successfully!');
        }
	}

	public function edit($slug)
	{
		$events = Event::all();
		$groups = DefaultGroup::where('slug', $slug)->first();
		 return !empty($groups) ?  view('admin.event-groups.edit') 
	                    ->with('title','Edit Group')
	                    ->with('groups',$groups)
	                    ->with('events',$events)
	                    ->with('addLink','list_groups') : redirect()->back()->with('error_flash_message','Something Wrong!');
	}

	public function update(Request $request,$slug)
	{
	    $group = DefaultGroup::where('slug', $slug)->first();
		$this->validate($request,[
            'group_label' => 'required|max:50',
            'event_type_id' => 'required'      
		]);

		$group->update($request->all());
		$group->save();

		return redirect()->route('list_groups')->with('flash_message','Group has been updated successfully!');

	}

	public function ajax_getGroup()
	{

		$groups = DefaultGroup::select(['group_label', 'slug', 'status', 'event_type_id'])
		         ->get();
		
       
		return datatables()->of($groups)
		->addColumn('action', function ($t) {
		return  $this->Actions($t);
		})
		->editColumn('status',function($t){
		return $t->status == 1 ? 'Active' : 'In-Active';
		})
		->editColumn('event_type_id',function($t){
			$event_name = Event::find($t->event_type_id);
		return $event_name->name;
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

            $text .='<a href="'.route('edit_group',$data->slug).'" class="dropdown-item">Edit</a>';
            $text .='<div class="dropdown-divider"></div>';
            $status=$data->status == 0 ? 'Active' : 'In-Active';
            // $text .='<a href="'.route('group_status',$data->slug).'" class="dropdown-item">'.$status.'</a>';
            $text .='</div>';

            return $text;
    }

    public function group_status($slug)
    {
         $group= DefaultGroup::where('slug',$slug)->first();

         if(!empty($group)){
            $group->status = $group->status == 1 ? 0 : 1;
            $group->save();
                     $msg= $group->status == 1 ? '<b>'.$group->group_label.'</b> is Activated' : '<b>'.$group->group_label.'</b> is Deactivated';
                    return redirect(route('list_groups'))->with('flash_message',$msg);
         }
         return redirect()->back()->with('flash_message','Something not Working!');
    }
}
