<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Testimonial;
use DB;

class TestimonialController extends Controller
{
    public function index(){
		return view('admin.testimonials.index')
        ->with('title', 'Testimonials')
        ->with('addLink', 'create_testimonial');
	}

	public function create()
	{
		return view('admin.testimonials.add') 
            ->with('title','Testimonials')
            ->with('addLink','list_testimonials');
	}

	public function store(Request $request)
	{
		$this->validate($request,[
            'title' => 'required|max:50',
            'summary' => 'required|max:250',
            'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'type' => 'required|in:1,2'
	                 
		]);
         
        if ($request->hasFile('image')) {
	        $image = $request->file('image');
	        $filename = 'a'.time().'.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/uploads');
	        $image->move($destinationPath, $filename);
    	}

    	Testimonial::create([
    		'title' => $request['title'],
    		'summary' => $request['summary'],
    		'image' => $filename,
    		'status' => 1,
    		'type' => $request['type']
    	]);

        return redirect()->route('list_testimonials')->with('flash_message','Testimonial has been saved successfully!');
        
	}

	public function edit($id)
	{
		$testimonial = Testimonial::find($id);
		 return !empty($testimonial) ?  view('admin.testimonials.edit') 
	                    ->with('title','Edit Testimonial')
	                    ->with('testimonial', $testimonial)
	                    ->with('addLink','list_testimonials') : redirect()->back()->with('error_flash_message','Something Wrong!');
	}

	public function update(Request $request, $id)
	{
	    $testimonial = Testimonial::find($id);
		$this->validate($request,[
            'title' => 'required|max:50',
            'summary' => 'required|max:250' ,
            'type' => 'required|in:1,2'
		]);

    	$filename = $testimonial->image;

    	if ($request->hasFile('image')) {
	        $image = $request->file('image');
	        $filename = time().'.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/uploads');
	        $img_path = public_path().'/uploads/'.$testimonial->image;
	        if (file_exists($img_path)) {
		        unlink($img_path);
		    }
	        $image->move($destinationPath, $filename);
    	}

    	$testimonial->update([
    		'title' => $request['title'],
    		'summary' => $request['summary'],
    		'image' => $filename,
    		'status' => $testimonial->status,
    		'type' =>  $request['type']
    	]);

		return redirect()->route('list_testimonials')->with('flash_message','Testimonial has been updated successfully!');

	}

	public function ajax_gettestimonials()
	{

		$testimonials = Testimonial::select(['id', 'title', 'summary','status',DB::raw('(CASE WHEN TYPE = 1 THEN "EVENT" WHEN TYPE = 2 THEN "E-SHOP" END ) as type') ,'updated_at'])
		         ->get();
		

		return datatables()->of($testimonials)
		->addColumn('action', function ($t) {
		return  $this->Actions($t);
		})
		->editColumn('summary',function($t){
		return strlen($t->summary) > 20 ? substr($t->summary, 0, 20).'...' : $t->summary;
		})
		->editColumn('status',function($t){
		return $t->status == 1 ? 'Active' : 'In-Active';
		})
		->editColumn('updated_at',function($t){
		return \Carbon\Carbon::parse($t->updated_at)->format('d-m-Y h:i:s');
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

        $text .='<a href="'.route('edit_testimonial',$data->id).'" class="dropdown-item">Edit</a>';
        $text .='<div class="dropdown-divider"></div>';
        $status=$data->status == 0 ? 'Active' : 'In-Active';
        $text .='<a href="'.route('testimonial_status',$data->id).'" class="dropdown-item">'.$status.'</a>';
        $text .='</div>';

        return $text;
    }

    public function testimonial_status($id)
    {
         $testimonial = Testimonial::find($id);
         if(!empty($testimonial)){
            $testimonial->status = $testimonial->status == 1 ? 0 : 1;
            $testimonial->save();
                     $msg= $testimonial->status == 1 ? '<b>'.$testimonial->title.'</b> is Activated' : '<b>'.$testimonial->title.'</b> is Deactivated';
                    return redirect(route('list_testimonials'))->with('flash_message',$msg);
         }
         return redirect()->back()->with('flash_message','Something not Working!');
    }
}
