<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessReview;
use App\Models\EventOrder;
use Auth;
use App\Tools\CheckList\MainTraits;
use App\Traits\GeneralSettingTrait;
use App\Traits\EmailTraits\EmailNotificationTrait;

class BusinessReviewsController extends Controller
{

    use MainTraits; 
    use GeneralSettingTrait;
    use EmailNotificationTrait;

    public function store(Request $request){
    	if(!empty($request->order_id) && !empty($request->vendor_category_id) && !empty($request->event_id)){
            $filename = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'a'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads');
                $image->move($destinationPath, $filename);
            }

    		$review = new BusinessReview;
    		$review->title = $request->title; 
    		$review->user_id = Auth::user()->id; 
    		$review->event_id = $request->event_id; 
    		$review->order_id = $request->order_id; 
    		$review->vendor_category_id = $request->vendor_category_id; 
    		$review->rating = $request->rating; 
    		$review->summary = $request->reason;
            if(!empty($filename)){
                $review->images = $filename;
            } 
    		$review->admin_approval = 0;
    		$review->save();

            $status = ['status' => 1,'messages' => 'Review has been submitted Successfully!!'];
    	}else{
            $status = ['status' => 0,'messages' => 'Something went wrong.'];
        }
        return response()->json($status);
    }

    public function thanks(){
    	return view('users.events.thankyou');
    }

    public function index1(){
		return view('admin.reviews.index')
        ->with('title', 'Reviews');
	}

    public function edit($id)
	{
		$review = BusinessReview::find($id);
		 return !empty($review) ?  view('admin.reviews.edit') 
	                    ->with('title','Edit Review')
	                    ->with('review', $review)
	                    ->with('addLink','list_reviews') : redirect()->back()->with('error_flash_message','Something Wrong!');
	}

	public function update(Request $request, $id)
	{
	    $review = BusinessReview::find($id);
		$this->validate($request,[
            'title' => 'required|max:30',
            'summary' => 'required|max:250' 
		]);
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'a'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $filename);
        }else{
            $filename = $review->images;
        }

    	$review->update([
    		'title' => $request['title'],
    		'summary' => $request['summary'],
            'images' => $filename,
    		'rating' => $request['rating'],
    		'user_id' => $review->user_id,
    		'vendor_category_id' => $review->vendor_category_id,
    		'event_id' => $review->event_id,
    		'order_id' => $review->order_id,
    		'admin_approval' => $review->admin_approval
    	]);

		return redirect()->route('list_reviews')->with('flash_message','Review has been updated successfully!');

	}

	public function ajax_getreviews()
	{

		$reviews = BusinessReview::select(['id', 'user_id', 'order_id', 'vendor_category_id', 'title', 'rating', 'admin_approval', 'updated_at'])->get();
		

		return datatables()->of($reviews)
		->addColumn('action', function ($t) {
		return  $this->Actions($t);
		})
		->editColumn('user_id',function($t){
		return $t->businessreviewUserId->name;
		})
		->editColumn('order_id',function($t){
		return $t->order_id;
		})
		->editColumn('vendor_category_id',function($t){
		return $t->businessreviewbusinessId->title;
		})
		->editColumn('admin_approval',function($t){
		return $t->admin_approval == 1 ? 'Active' : 'In-Active';
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

        $text .='<a href="'.route('edit_review',$data->id).'" class="dropdown-item">Edit</a>';
        $text .='<div class="dropdown-divider"></div>';
        $admin_approval=$data->admin_approval == 0 ? 'Active' : 'In-Active';
        $text .='<a href="'.route('review_status',$data->id).'" class="dropdown-item">'.$admin_approval.'</a>';
        $text .='</div>';

        return $text;
    }

    public function review_status($id)
    {
        $review = BusinessReview::find($id);
        if(!empty($review)){
            $review->admin_approval = $review->admin_approval == 1 ? 0 : 1;
            $review->save();
                     $msg= $review->admin_approval == 1 ? '<b>'.$review->title.'</b> is Activated' : '<b>'.$review->title.'</b> is Deactivated';
                    return redirect(route('list_reviews'))->with('flash_message',$msg);
        }
        return redirect()->back()->with('flash_message','Something not Working!');
    }

    public function vendor_list_reviews(){
        if(Auth::user()){
                $services = Auth::user()->services()->pluck('id')->toArray();
                $vendor_id = Auth::user()->id;
                $event_order_ids = EventOrder::whereIn('vendor_id', $services)->pluck('id')->toArray();
                $reviews = BusinessReview::whereIn('order_id', $event_order_ids)->where('admin_approval', 1)->paginate(15);
                $reviews5 = BusinessReview::where('admin_approval', 1)->whereIn('order_id', $event_order_ids)->where('rating', 5)->get();
                $reviews4 = BusinessReview::where('admin_approval', 1)->whereIn('order_id', $event_order_ids)->where('rating', 4)->get();
                $reviews3 = BusinessReview::where('admin_approval', 1)->whereIn('order_id', $event_order_ids)->where('rating', 3)->get();
                $reviews2 = BusinessReview::where('admin_approval', 1)->whereIn('order_id', $event_order_ids)->where('rating', 2)->get();
                $reviews1 = BusinessReview::where('admin_approval', 1)->whereIn('order_id', $event_order_ids)->where('rating', 1)->get();
        }
        return view('vendors.reviews.index')->with(['title'=>'Reviews', 'reviews'=> $reviews, 'reviews1'=> $reviews1, 'reviews2'=> $reviews2, 'reviews3'=> $reviews3, 'reviews4'=> $reviews4, 'reviews5'=> $reviews5]);
    }

    public function pending_reviews(){
        if(Auth::user()){
            $services = Auth::user()->services()->pluck('id')->toArray();
            $vendor_id = Auth::user()->id;
            $event_order_ids = EventOrder::whereIn('vendor_id', $services)->pluck('id')->toArray();
            $reviews = BusinessReview::whereIn('order_id', $event_order_ids)->pluck('order_id')->toArray();
            $arr = array_diff($event_order_ids, $reviews);
            $pending_reviews = EventOrder::whereIn('id', $arr)->paginate(15);
        }
        return view('vendors.reviews.pendingReviews')->with(['title'=>'Pending Reviews', 'pending_reviews'=> $pending_reviews]);
    }

    public function reviewForm($id){
        $order = EventOrder::find($id);
        return view('vendors.reviews.reviewform')->with(['title'=>'Pending Reviews', 'order'=>$order]);
    }

    public function reviewSubmit(Request $request){
        if(!empty($request->order_id)){
            $order = EventOrder::find($request->order_id);
            $vendor_category_id = $order->vendor_id;
            $user_event_id = $order->event_id;

            $filename = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'a'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads');
                $image->move($destinationPath, $filename);
            }

            $review = new BusinessReview;
            $review->title = $request->title; 
            $review->user_id = Auth::user()->id; 
            $review->event_id = $user_event_id; 
            $review->order_id = $request->order_id; 
            $review->vendor_category_id = $vendor_category_id; 
            $review->rating = $request->rating; 
            $review->summary = $request->reason;
            if(!empty($filename)){
                $review->images = $filename;
            } 
            $review->admin_approval = 0;
            $review->save();

            $status = ['status' => 1,'messages' => 'Review has been submitted Successfully!!'];
        }else{
            $status = ['status' => 0,'messages' => 'Something went wrong.'];
        }
        return response()->json($status);
    }

    public function reviewRequest(Request $request){
        if(!empty($request->orderid)){
            $order = EventOrder::find($request->orderid);

            $this->PendingReviewTrait($order);

            $status = ['status' => 1,'messages' => 'Request for review has been submitted Successfully!!'];
        }else{
            $status = ['status' => 0,'messages' => 'Something went wrong.'];
        }
        return response()->json($status);    }
}
