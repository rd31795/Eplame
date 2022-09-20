<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DisputeReason;
class DisputeReasonController extends Controller
{
    public function index() {
    	return view('admin.dispute-reason.index')->with(['title' => 'Dispute Reason', 'addLink' => 'admin.dispute-reason.create']);
    	
    }
     public function ajax_getDisputeReason() {
		$dispute = DisputeReason::select(['reasons', 'slug', 'status'])->get();
		
		return datatables()->of($dispute)
		->addColumn('action', function ($t) {
			return  $this->Actions($t);
		})->editColumn('status', function($t){
			return $t->status == 1 ? 'Active' : 'In-Active';
		})->editColumn('title',function($t){
        return str_limit($t->title, 50);
        })->make(true);
	}

    public function showCreate() {
    	return view('admin.dispute-reason.create')->with(['title' => 'Create Dispute Reasons', 'addLink' => 'admin.dispute-reason.create']);
    }
    public function showEdit($slug) {
    	$dispute = DisputeReason::FindBySlugOrFail($slug);
    	return view('admin.dispute-reason.edit')
    	->with(['dispute' => $dispute, 'title' => 'Edit Dispute Reasons', 'addLink' => 'admin.dispute-reason.index']);
    }
     public function create(Request $request) {
    	$validatedData = $request->validate([
            'reason' => ['required', 'string', 'max:30']
        ]);

    	DisputeReason::create([
    		'reasons' => $request['reason'],
    	]);
    	return redirect()->route('admin.dispute-reason.index')->with('flash_message', 'Dispute Reason has been created successfully!');
    }
     public function Actions($data) {
            $text  ='<div class="btn-group">';
            $text .='<button type="button" class="btn btn-primary">Action</button>';
            $text .='<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
            $text .='<span class="caret"></span>';
            $text .='<span class="sr-only">Toggle Dropdown</span>';
            $text .='</button>';
            $text .='<div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; transform: translate3d(67px, -165px, 0px); top: 0px; left: 0px; will-change: transform;">';


            $text .='<a href="'.route('admin.dispute-reason.showEdit', $data->slug).'" class="dropdown-item">Edit</a>';
            $text .='<div class="dropdown-divider"></div>';
            $status=$data->status == 0 ? 'Active' : 'In-Active';
            $text .='<a href="'.route('admin.dispute-reason.status', $data->slug).'" class="dropdown-item">'.$status.'</a>';


            $text .='</div>';
            $text .='</div>';

            return $text;
    }
    public function update(Request $request, $slug) {
    	$validatedData = $request->validate([
            'reason' => ['required', 'string', 'max:20']
        ]);

    	$dispute = DisputeReason::FindBySlugOrFail($slug);
    	$dispute->update([
    		'reasons' => $request['reason']
    	]);
    	return redirect()->route('admin.dispute-reason.index')->with('flash_message', 'Dispute Reason has been updated successfully!');
    }
     public function menuStatus($slug) {
     $dispute = DisputeReason::FindBySlugOrFail($slug);

     if(!empty($dispute)){
        $dispute->status = $dispute->status == 1 ? 0 : 1;
        $dispute->save();
        $msg= $dispute->status == 1 ? '<b>'.$dispute->reasons.'</b> is Activated' : '<b>'.$dispute->reasons.'</b> is Deactivated';
       return redirect(route('admin.dispute-reason.index'))->with('flash_message', $msg);
     }
     return redirect()->back()->with('flash_message', 'Something Went Woring!');
    }

}
