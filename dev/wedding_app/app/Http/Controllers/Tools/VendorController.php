<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserEvent;
use App\Models\EventOrder;
use App\Event;
use App\CategoryVariation;
use App\Category;
use Auth;
use Redirect;
use App\Traits\GeneralSettingTrait;

class VendorController extends Controller
{
	use GeneralSettingTrait;

  	public function index($slug){

  		$user_event = UserEvent::FindBySlugOrFail($slug);
  		$category_ids = CategoryVariation::where('variant_id', $user_event->event_type)->where('type','event')->pluck('category_id')->toArray();
    	$cate = Category::with('subCategory')->whereIn('id',$category_ids)->where('status', 1)->where('parent', 0)->get();
    	$EventOrder = EventOrder::where('type','order')
                                ->where('user_id',Auth::user()->id)
                                ->where('event_id',$user_event->id)
                                ->get();
       
    	$slug = 'vendor-tool';
  		return view('tools.vendor.index', $this->getArrayValue($slug))->with(['cate' => $cate, 'user_event'=> $user_event, 'orders' => $EventOrder]);
  	}
}
