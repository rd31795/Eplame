<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\VendorVacation;
use App\VendorCategory;
use App\Models\EventOrder;
use App\UserEvent;
class VacationController extends Controller
{	

   public function index()
   {

        $vacation = VendorVacation::where('vendor_id',Auth::user()->id)->get();
        
       return view('vendors.vacation.index')
              ->with('vacation',$vacation)
              ->with('addLink', 'vendors.vacation.add')
              ->with('title','Vendor Vacation');
   }
   public function addvacation() {
  
      return view('vendors.vacation.add')->with('title','Add Vacation');
    }
    public function editVacation($id){

      $vacation = VendorVacation::where('id',$id)->first();
        
       return view('vendors.vacation.edit')
              ->with('vacation',$vacation)
              ->with('title','Vendor Vacation');
    }

    public function deleteVacation($id){

      $vacation = VendorVacation::where('id', $id)->firstorfail()->delete();
      return redirect()->route('vendorVacation')->with('flash_message', 'Vacation has been deleted successfully!');
    }

    public function ajaxValidation(Request $request)
    {
      $start_date = $request->start_date;
      $end_date = $request->end_date;
      $check_data = VendorVacation::where(function ($query) use ($start_date, $end_date) {
                $query->where(function ($q) use ($start_date, $end_date) {
                    $q->where('vacation_from', '>=', $start_date)
                       ->where('vacation_from', '<', $end_date);
                })->orWhere(function ($q) use ($start_date, $end_date) {
                    $q->where('vacation_from', '<=', $start_date)
                       ->where('vacation_to', '>', $end_date);
                })->orWhere(function ($q) use ($start_date, $end_date) {
                    $q->where('vacation_to', '>', $start_date)
                       ->where('vacation_to', '<=', $end_date);
                })->orWhere(function ($q) use ($start_date, $end_date) {
                    $q->where('vacation_from', '>=', $start_date)
                       ->where('vacation_to', '<=', $end_date);
                });
            })->count();
      if(empty($check_data))
      {
        $vendors = VendorCategory::where('user_id',Auth::user()->id)->get();
        foreach($vendors as $vendor)
        {
          $id = $vendor->id;
          $events = EventOrder::where('vendor_id',$id)->where('type','order')->get();
          foreach($events as $event)
          {
              $event_id = $event->event_id;
             
            
             $user_event  = UserEvent::where('id',$event_id)
            ->where(function ($query) use ($start_date, $end_date) {
                $query->where(function ($q) use ($start_date, $end_date) {
                    $q->where('start_date', '>=', $start_date)
                       ->where('start_date', '<', $end_date);
                })->orWhere(function ($q) use ($start_date, $end_date) {
                    $q->where('start_date', '<=', $start_date)
                       ->where('end_date', '>', $end_date);
                })->orWhere(function ($q) use ($start_date, $end_date) {
                    $q->where('end_date', '>', $start_date)
                       ->where('end_date', '<=', $end_date);
                })->orWhere(function ($q) use ($start_date, $end_date) {
                    $q->where('start_date', '>=', $start_date)
                       ->where('end_date', '<=', $end_date);
                });
            })->count();
          
              if(!empty($user_event))
              {
                
                return redirect()->route('vendorVacation')->with('error_message', 'The event has booked on these dates');
              }
           }
          
        }
                  
                  $d = new VendorVacation;
                  $d->vendor_id = Auth::user()->id;
                  $d->vacation_from = $request->start_date;
                  $d->vacation_to = $request->end_date;
                  $d->save();
      }else{
        return redirect()->route('vendorVacation')->with('error_message', 'You have added vacation on these dates!');
      }          
         
      return redirect()->route('vendorVacation')->with('flash_message', 'Vacation has been created successfully!');
    }

     public function updateVacation(Request $request,$vendorid)
    {
      $start_date = $request->start_date;
      $end_date = $request->end_date;

      $vendors = VendorCategory::where('user_id',Auth::user()->id)->get();
      foreach($vendors as $vendor)
      {
        $id = $vendor->id;
        $events = EventOrder::where('vendor_id',$id)->where('type','order')->get();
        foreach($events as $event)
        {
            $event_id = $event->event_id;
           
          
           $user_event  = UserEvent::where('id',$event_id)
          ->where(function ($query) use ($start_date, $end_date) {
              $query->where(function ($q) use ($start_date, $end_date) {
                  $q->where('start_date', '>=', $start_date)
                     ->where('start_date', '<', $end_date);
              })->orWhere(function ($q) use ($start_date, $end_date) {
                  $q->where('start_date', '<=', $start_date)
                     ->where('end_date', '>', $end_date);
              })->orWhere(function ($q) use ($start_date, $end_date) {
                  $q->where('end_date', '>', $start_date)
                     ->where('end_date', '<=', $end_date);
              })->orWhere(function ($q) use ($start_date, $end_date) {
                  $q->where('start_date', '>=', $start_date)
                     ->where('end_date', '<=', $end_date);
              });
          })->count();
        
            if(!empty($user_event))
            {
              
              return redirect()->route('vendorVacation')->with('error_message', 'The event has booked on these dates');
            }
         }
        
      }
            $vendor = VendorVacation::where('id',$vendorid)->first();
            $vendor->vacation_from = $request->start_date;
            $vendor->vacation_to =  $request->end_date ;
            $vendor->save();
                

         
      return redirect()->route('vendorVacation')->with('flash_message', 'Vacation has been updated successfully!');
    }

}
