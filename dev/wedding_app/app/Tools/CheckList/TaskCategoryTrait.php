<?php
namespace App\Tools\CheckList;
use Illuminate\Http\Request;
use Auth;
use App\Models\Tools\CheckList;
use App\Models\Tools\MyCheckListTask;
use App\Models\Tools\DefaultTask;

trait TaskCategoryTrait {



#===================================================================================================
#  save Categories
#===================================================================================================

  public function saveCategories($user_event)
  {
    $status = 0;

    if($user_event->taskCategories == null || $user_event->taskCategories->count() == 0){
    	       if($user_event->eventType->count() > 0):
                    
                    $userEventCategory = $user_event->eventType->taskCategory->count() > 0 ? $user_event->eventType->taskCategory : $user_event->eventType->taskCategoryGeneral()->get();

                       foreach($userEventCategory as $cate):
                           $cc =CheckList::where('event_id',$user_event->id)->where('task_id',$cate->id);
      						         $c =$cc->count() > 0 ? $cc->first() : new CheckList;
      						         $c->task_id = $cate->id;
                           $c->event_id = $user_event->id;
      						         $c->user_id = Auth::user()->id;
      						         $c->save();  

						         foreach ($cate->taskList as $t) {
						         	 $this->addTaskOfCurrentEvent($user_event,$c->id,$t);
						         }
                       endforeach;

               endif;
               $status = 1;
    }
    return $status;
    
  }


#===================================================================================================
#  save Categories
#===================================================================================================


public function addTaskOfCurrentEvent($user_event,$category_id,$tasks)
{
	$task = MyCheckListTask::where('event_id',$user_event->id)
	                       ->where('category_id',$category_id)
	                       ->where('task_id',$tasks->id);

    $parent_task_day_difference = 0;

    if($tasks->parent > 0){
      $parent = DefaultTask::find($tasks->parent);
      $parent_task_day_difference = $parent->days_difference;
    }

    if($tasks->days_difference > 0){
      $task_date = date("Y-m-d", strtotime("-".$tasks->days_difference." days", strtotime($user_event->start_date)));
    }else if($parent_task_day_difference > 0){
      $task_date = date("Y-m-d", strtotime("-".$parent_task_day_difference." days", strtotime($user_event->start_date)));
    }else{
      $task_date = date("Y-m-d", strtotime($user_event->start_date));
    }

    $t = $task->count() > 0 ? $task->first() : new MyCheckListTask;
    $t->event_id = $user_event->id;
    $t->parent = $tasks->parent;
    $t->task = $tasks->task;
    $t->description = $tasks->description;
    $t->task_id = $tasks->id;
    $t->category_id = $category_id;
    $t->task_date = $task_date;
    $t->save();
}



#===================================================================================================


}