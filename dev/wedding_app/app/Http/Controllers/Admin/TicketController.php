<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\TicketType;
use App\User;
use App\Menu;
use App\AccessPermission;
use App\Group;
use App\GroupAccessPermission;
use DB;
use Config;
use Illuminate\Support\Facades\Hash;
use App\Tools\CheckList\MainTraits;
use App\Traits\GeneralSettingTrait;
use App\Traits\EmailTraits\EmailNotificationTrait;

class TicketController extends Controller
{
  public function index(){
     return view('admin.tickets.index');
  }

  public function create(){
    return view('admin.tickets.create')
    ->with('title','Create Ticket Type')
    ->with('addLink','list_ticket_type');
  }

  public function ticketTypeAjax(){
    $ticket = TicketType::select(['id','title','status'])->orderBy('created_at','DESC')
                  ->get();

    return datatables()->of($ticket)
    ->addIndexColumn()
    ->addColumn('action', function ($t) {
    return  $this->Actions($t);
    })
    ->addColumn('status', function ($t) {
    return  $t->status==1?'Active':'In-Active';
    })
    ->make(true);
  }

  public function delete(request $request){
         $check=TicketType::whereId($request->id)->delete();
         if($check){
          return redirect()->back()->with('success','Ticket Type is deleted');
         }
  }

  public function edit(request $request){
    $data=TicketType::find($request->id);
      return view('admin.tickets.edit')
    ->with('title','Create Ticket Type')
    ->with('addLink','list_ticket_type')
    ->with('data',$data);
  }
  
  public function status(request $request){
     $status=TicketType::find($request->id);
     $status->status=$status->status==0?1:0;
     if($status->save()){
       return redirect()->back()->with('success','Ticket Type status changed');
     }
  } 

  public function store(request $request){
     $insert=new TicketType;
    if($request->id){
     $insert=TicketType::find($request->id);
    }
     $insert->title=$request->type;
     $insert->assigned_templates=json_encode($request->ticket_templates);
     $insert->created_by=Auth::id();
     $insert->save();
     return redirect(route('list_ticket_type'))->with('success','Ticket Type is created successfully');
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
          $url = url(route('edit_ticket_type','id='.$data->id));
          $text .='<a href="'.$url.'" class="dropdown-item">Edit</a>';
          $text .='<div class="dropdown-divider"></div>';
          $url = url(route('delete_ticket_type','id='.$data->id));
          $confirm="return confirm('Are you sure?')";
          $text .='<a href="'.$url.'" onclick="'.$confirm.'" class="dropdown-item" >Delete</a>';
          $text .='<div class="dropdown-divider"></div>';
          $url = url(route('status_ticket_type','id='.$data->id));
          $status=$data->status==1?'In-Active':'Active';
          $text .='<a href="'.$url.'"  class="dropdown-item" >'.$status.'</a>';
            //$status=$data->status == 0 ? 'Active' : 'In-Active';
            //$text .='<a href="'.route('event_status',$data->slug).'" class="dropdown-item">'.$status.'</a>';

            $text .='</div>';
            $text .='</div>';

            return $text;
    }
}