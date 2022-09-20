<?php

namespace App\Models\Tools;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tools\MyCheckListTask;

class CheckList extends Model
{
    


    public function event()
    {
    	return $this->belongsTo('App\Event','event_id','id');
    }


     public function userEvent()
    {
        return $this->belongsTo('App\UserEvent','event_id','id');
    }

    #==================================================================================================
    #HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH
    #==================================================================================================

    public function tasks()
    {
    	return $this->belongsTo('App\Models\Tools\DefaultTask','task_id','id');
    }


    public function taskListing()
    {
        return $this->hasMany('App\Models\Tools\MyCheckListTask','category_id','id');
    }

    public function taskListingWithFilters($request)
    {
        return MyCheckListTask::where('category_id',$this->id)
                               ->where(function($t) use($request){

                                      if($request['by_status'] != 0){
                                          // $status =  $request['by_status'] == 1 ? 1 : 0;
                                          $t->whereIn('status',$request['by_status']);
                                      }

                                      if($request['by_date'] != 0){
                                            $date = date('Y-m-d');
                                            if($request['by_date']!=[1,2]){
                                               if(in_array(1, $request['by_date'])){
                                               $t->whereDate('task_date','<',$date);
                                               }
                                               if(in_array(2, $request['by_date'])){
                                               $t->whereDate('task_date','>=',$date);
                                               }
                                            }
                                            // if($request['by_date'] == 3){
                                            //    $date = date('Y-m-d',strtotime($t->userEvent->end_date));
                                            //    $t->whereDate('task_date','>=',$date);
                                            // }
                                      }
                               });
    }

     

}
