<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\DefaultBudget;
use App\CategoryVariation;
use App\Category;

class EventController extends Controller
{
	public function index(){
		return view('admin.event-types.index')
		                ->with('title', 'Event Types')
		                ->with('addLink', 'create_event_type');
	}

	/*__________________________________________________________________________________________
	|
	|  Next Function starts
	|___________________________________________________________________________________________
	*/

	public function create()
	{
		 return view('admin.event-types.add') 
	                    ->with('title','Event Types')
	                    ->with('addLink','list_events');
	} 

	/*__________________________________________________________________________________________
	|
	|  Next Function starts
	|___________________________________________________________________________________________
	*/

	public function store(Request $request)
	{
		 $this->validate($request,[
	                 'name' => 'required|max:50|unique:events',
	                 'description' => 'required',
	                 'type' =>'required',
	                 
		 ],[
	        'name.unique' => 'This event type is already exists.'
		 ]);
       
         $storeEvents = new Event($request->all());
         if(($storeEvents->save())){

            return redirect()->route('list_events')->with('flash_message','Event Type has been saved successfully!');
         }
	}


	/*__________________________________________________________________________________________
	|
	|  Next Function starts
	|___________________________________________________________________________________________
	*/

	public function edit($slug)
	{

		$events = Event::where('slug', $slug)->first();
		 return !empty($events) ?  view('admin.event-types.edit') 
	                    ->with('title','Edit Event Type')
	                    ->with('events',$events)
	                    ->with('addLink','list_events') : redirect()->back()->with('error_flash_message','Something Wrong!');
	}	



	/*__________________________________________________________________________________________
	|
	|  Next Function starts
	|___________________________________________________________________________________________
	*/

	public function update(Request $request,$slug)
	{
	     $event= Event::where('slug',$slug)->first();
		 $this->validate($request,[
	                 'name' => 'required|max:50|unique:events,name,'.$event->id,
	                 'description' => 'required'
	                 
		 ],[
	        'name.unique' => 'This event type is already exists.'
		 ]);

		 $event->update($request->all());
		 $event->save();

		 return redirect()->route('list_events')->with('flash_message','Event Type has been updated successfully!');

	}


	/*__________________________________________________________________________________________
	|
	|  Next Function starts
	|___________________________________________________________________________________________
	*/
    

    public function event_status($slug)
    {
         $event= Event::where('slug',$slug)->first();

         if(!empty($event)){
            $event->status = $event->status == 1 ? 0 : 1;
            $event->save();
                     $msg= $event->status == 1 ? '<b>'.$event->name.'</b> is Activated' : '<b>'.$event->name.'</b> is Deactivated';
                    return redirect(route('list_events'))->with('flash_message',$msg);
         }
         return redirect()->back()->with('flash_message','Something Woring!');
    }


	/*__________________________________________________________________________________________
	|
	|  Next Function starts
	|___________________________________________________________________________________________
	*/	


	public function ajax_getEvent()
	{
	 
		$events = Event::select(['name','description', 'status', 'slug'])
		              ->get();

		return datatables()->of($events)
		->addColumn('action', function ($t) {
		return  $this->Actions($t);
		})
		->editColumn('status',function($t){
		return $t->status == 1 ? 'Active' : 'In-Active';
		})
		->editColumn('description',function($t){
		return str_limit($t->description, 50);
		})

		->make(true);
	}


	/*__________________________________________________________________________________________
	|
	|  Next Function starts
	|___________________________________________________________________________________________
	*/
    

    public function Actions($data)
    {
            $text  ='<div class="btn-group">';
            $text .='<button type="button" class="btn btn-primary">Action</button>';
            $text .='<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
            $text .='<span class="caret"></span>';
            $text .='<span class="sr-only">Toggle Dropdown</span>';
            $text .='</button>';
            $text .='<div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; transform: translate3d(67px, -165px, 0px); top: 0px; left: 0px; will-change: transform;">';

            $text .='<a href="'.route('edit_event',$data->slug).'" class="dropdown-item">Edit</a>';
            $text .='<div class="dropdown-divider"></div>';
            $status=$data->status == 0 ? 'Active' : 'In-Active';
            $text .='<a href="'.route('event_status',$data->slug).'" class="dropdown-item">'.$status.'</a>';
            $text .='<div class="dropdown-divider"></div>';
            $text .='<a href="'.route('event_budget_catagories', $data->slug).'" class="dropdown-item">Budget Management</a>';

            $text .='</div>';
            $text .='</div>';

            return $text;
    }

    public function event_budget_catagories($slug){
    	$event_type = Event::where('slug', $slug)->first();
    	$category_ids = CategoryVariation::where('variant_id', $event_type->id)->where('type','event')->pluck('category_id')->toArray();

    	$cate = Category::with('subCategory')->whereIn('id',$category_ids)->where('status', 1)->where('parent', 0)->get();

    	return view('admin.event-types.categories')->with(['cate' => $cate, 'slug' => $slug]);
    }		

    public function budgetUpdate(Request $request, $slug)
	{	
		$this->validate($request,[
              'cat.*' => 'max:6' 
       	]);

		$event = Event::where('slug', $slug)->first();
		foreach($request['cat'] as $k=>$v){

			$defaultbudget = DefaultBudget::where('event_type_id', $event->id)->where('catagory_id', $k)->first();

			if(!empty($defaultbudget)){	
				if(isset($v)){
					$defaultbudget->percentage = $v;
				}else{
					$defaultbudget->percentage = 0;
				}
				$defaultbudget->save();
			}else{
				$newbudget = new DefaultBudget;
				$newbudget->event_type_id = $event->id;
				$newbudget->catagory_id = $k;
				if(isset($v)){
					$newbudget->percentage = $v;
				}else{
					$newbudget->percentage = 0;
				}
				$newbudget->save();
			}
		}
		 return redirect()->route('event_budget_catagories', $slug)->with('flash_message','Default Budget has been updated successfully!');
	}
}
