<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NewsOffer;

class NewsOffersController extends Controller
{
    public function index($type){
    	$newsoffers = NewsOffer::where('type', $type)->paginate(20);
		return view('admin.news-offers.index')
            ->with([
            	'newsoffers' => $newsoffers,
            	'title' => 'List of '.$type,
            	'addLink' => 'admin.newsoffers.showCreate',
             	'type' => $type
             ]);
    }

	public function showCreate($type) {
		 return view('admin.news-offers.create')
	                    ->with([
	                    	'title' => 'Create '.$type, 
	                    	'addLink' => 'admin.newsoffers.lists', 
	                    	'type' => $type
	                    ]);
	} 

	public function create(Request $request, $type) {
         $newsoffer = new NewsOffer;
     	 $newsoffer->detail = $request->detail;
     	 $newsoffer->type = $type;
     	 $newsoffer->status = 1;
         
         if($newsoffer->save()) {
            return redirect()->route('admin.newsoffers.lists', $type)->with('flash_message', $type.' has been saved successfully!');
         }
	}

	public function edit($type, $id) {
		$newsoffer = NewsOffer::where(['id' => $id, 'type' => $type])->first();
		 return !empty($newsoffer) ? view('admin.news-offers.edit') 
	                    ->with([
	                    	'newsoffer' => $newsoffer,
	                    	'title' => 'Edit '.$type, 
	                    	'viewLink' => 'admin.newsoffers.lists', 
	                    	'addLink' => 'admin.newsoffers.showCreate', 
	                    	'type' => $type
	                    ]) : redirect()->back()->with('error_flash_message', 'Something Wrong!');
	}	


	public function update(Request $request, $type, $id) {
	     $newsoffer = NewsOffer::find($id);

	     $newsoffer->detail = $request->detail;

     	 $newsoffer->save();

		 return redirect()->route('admin.newsoffers.lists', $type)->with('flash_message', $type.' has been updated successfully!');
	}

	 public function delete($type, $id) {
         $newsoffer = NewsOffer::find($id);
         if(!empty($newsoffer)) {
            $newsoffer->delete();            
            return redirect(route('admin.newsoffers.lists', $type))->with('flash_message', $type.' has been deleted successfully');
         }
         return redirect()->back()->with('flash_message', 'Something Woring!');
    }


    public function changeStatus($type, $id) {
         $newsoffer = NewsOffer::find($id);
         if(!empty($newsoffer)) {
            $newsoffer->status = $newsoffer->status == 1 ? 0 : 1;
            $newsoffer->save();
            
            $msg = $newsoffer->status == 1 ? '<b>'.$type.'</b> is Activated' : '<b>'.$type.'</b> is Deactivated.';
            return redirect(route('admin.newsoffers.lists', $type))->with('flash_message', $msg);
         }
         return redirect()->back()->with('flash_message', 'Something Woring!');
    }	
}
