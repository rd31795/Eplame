<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Models\EventOrder;
use App\Models\Order;
use App\UserEvent;
use App\UserEventBudget;
use App\DefaultBudget;
use App\CategoryVariation;
use App\Category;
use Auth;
use PDF;
use Redirect;
use App\Traits\GeneralSettingTrait;

class BudgetController extends Controller
{

    use GeneralSettingTrait;

    public $filePath = 'tools.budget.';

    public function index($slug){
    	$user_event = UserEvent::FindBySlugOrFail($slug);
    	$budget = $user_event->event_budget;
    	$check  = UserEventBudget::where('user_event_id', $user_event->id)->where('user_id', Auth::user()->id)->first();

    	if(empty($check)){
    		$user_event->estimated_budget = $user_event->event_budget;
    		$user_event->save();
	    	$category_ids = CategoryVariation::where('variant_id', $user_event->event_type)->where('type','event')->pluck('category_id')->toArray();
    		$cate = Category::with('subCategory')->whereIn('id',$category_ids)->where('status', 1)->where('parent', 0)->get();
    		if(!empty($cate)){
    			foreach($cate as $cat){
    				$percentage = DefaultBudget::where('catagory_id', $cat->id)->where('event_type_id', $user_event->event_type)->first();
    				if(!empty($percentage)){
    					$value = round(($budget*$percentage->percentage)/100);
    				}else{
						$value = 0;
    				}
    				$record = new UserEventBudget;
    				$record->user_id = Auth::user()->id;
    				$record->user_event_id = $user_event->id;

    				$record->parent_catagory_id = $cat->parent;

    				$record->catagory_id = $cat->id;
    				$record->catagory_label = $cat->label;
    				$record->estimated_budget = $value;
    				$record->save();

    				if(!empty($cat->subCategory)){
    					$newbudget = $value;
	    				foreach($cat->subCategory as $subCat){
	    					$percentage = DefaultBudget::where('catagory_id', $subCat->id)->where('event_type_id', $user_event->event_type)->first();
	    					if(!empty($percentage)){
		    					$value = round(($newbudget*$percentage->percentage)/100);
		    				}else{
		    					$value = 0;
		    				}
		    				$record = new UserEventBudget;
		    				$record->user_id = Auth::user()->id;
		    				$record->user_event_id = $user_event->id;

		    				$record->parent_catagory_id = $subCat->parent;

		    				$record->catagory_id = $subCat->id;
		    				$record->catagory_label = $subCat->label;
		    				$record->estimated_budget = $value;
		    				$record->save();
	    				}
	    			}
    			}
    		}
	    }
	 $cate = UserEventBudget::with('subcategory')->where('user_event_id', $user_event->id)->where('parent_catagory_id', 0)->get();
	 $categories = Category::where(['status'=> 1, 'parent'=> 0])->orderBy('label','ASC')->get();
	 $final = UserEventBudget::where('user_event_id', $user_event->id)->where('parent_catagory_id', 0)->sum('final_budget');
	 $paid = UserEventBudget::where('user_event_id', $user_event->id)->where('parent_catagory_id', 0)->sum('paid_money');
		$slug = 'budget-tool';
    	
    	return view('tools.budget.index', $this->getArrayValue($slug))->with(['cate' => $cate, 'user_event'=> $user_event, 'final' => $final, 'paid' => $paid, 'categories'=> $categories]);
    }

    public function ajax_editprice(Request $request){
    	$user_event = UserEvent::Find($request->user_event_id);
    	$user_event->estimated_budget = $request->base_price;
    	$user_event_id = $request->user_event_id;
    	$base_price = $request->base_price;
    	if($request->base_price > 0){
    		$cate = UserEventBudget::where('user_event_id', $user_event_id)->where('parent_catagory_id', 0)->where('user_id', Auth::user()->id)->get();
    		if(!empty($cate[0]->id)){
    			foreach($cate as $cat){
					$percentage = DefaultBudget::where('catagory_id', $cat->catagory_id)->where('event_type_id', $user_event->event_type)->first();
    				if(!empty($percentage)){
    					$cat_value = round(($base_price*$percentage->percentage)/100);
    				}else{
						$cat_value = 0;
    				}
    				if($cat->catagory_id > 0){
    					$subcate = UserEventBudget::where('user_event_id', $user_event_id)->where('parent_catagory_id', $cat->catagory_id)->where('user_id', Auth::user()->id)->get();
    				}else{
    					$subcate = UserEventBudget::where('user_event_id', $user_event_id)->where('parent_catagory_id', $cat->id)->where('user_id', Auth::user()->id)->get();
    				}
    				if(!empty($subcate[0]->id)){
	    				$budget = 0;
	    				foreach($subcate as $subcat){
	    					$percentage = DefaultBudget::where('catagory_id', $subcat->catagory_id)->where('event_type_id', $user_event->event_type)->first();
		    				if(!empty($percentage)){
		    					$subcat_value = round(($cat_value*$percentage->percentage)/100);
		    				}else{
								$subcat_value = 0;
		    				}
		    				if($subcat->final_budget == 0){
		    					$subcat->estimated_budget = $subcat_value;
	    						$subcat->save();
		    				}
		    			$budget = ($budget + $subcat->estimated_budget);
	    				}
	    			}
	    			
	    		$cat->estimated_budget = $cat_value;
	    		$cat->save();
    			}
    		}
    		$user_event->save();
    	}
    	if($user_event->estimated_budget > 0){
    		return $user_event->estimated_budget;
    	}
    	return $user_event->event_budget;
    }

    public function updateBudget($user_event, $user_event_id, $base_price){
    	
    }

    public function indexPayment($slug){
		$user_event = UserEvent::FindBySlugOrFail($slug);
		$event_orders = EventOrder::where('event_id', $user_event->id)->where('user_id', Auth::user()->id)->where('payment_status', 1)->pluck('order_id')->toArray();
		if(!empty($event_orders)){
			$status = 1;
		}else{
			$status = 0;
		}
		return view('tools.budget.payment')->with(['status' => $status, 'event_orders' => $event_orders, 'slug' => $user_event->slug, 'user_event'=> $user_event]);
    }

    public function getBudgetCategory(Request $request){
    	$cat  = UserEventBudget::find($request->category_id);
    	if($cat->catagory_id > 0){
    		$subcats  = UserEventBudget::where('user_event_id', $request->event_id)->where('parent_catagory_id', $cat->catagory_id)->get();
    		$catid = $cat->catagory_id;
    	}else{
    		$subcats  = UserEventBudget::where('user_event_id', $request->event_id)->where('parent_catagory_id', $cat->id)->where('catagory_id' , 0)->get();
    		$catid = $cat->id;
    	}
    	if(!empty($subcats[0]->id)){
    		$total_estimate = 0;
    		$total_final = 0;
    		$total_paid = 0;

    		$text = '
                    <div class="cstm-payment-card text-center mt-3 border-lr-none">
                    	<figure class="cal-icon mb-3">
                        	<i class="fas fa-home"></i>
                    	</figure>
                    	<h4 class="mb-3">'.$cat->catagory_label.'</h4>
                    	<h6 class="estimated-budget-amount">Estimated budget: <span class="amount mr-3">$ '.$cat->estimated_budget.' </span> Final Cost: <span class="amount mr-3">$ '.$cat->final_budget.' </span></h6>
                    	<div class="btn-wrap mt-2">
                        <a class="cstm-btn solid-btn remove-cat" href="javascript:void(0)" data-id="'.$cat->id.'" data-parent="'.$cat->parent_catagory_id.'">Remove</a>
                	</div>
                	</div>
                    <div class="table-responsive">
                        <table class="budget-category-detail" width="100%">
        					<tbody>
        						<tr class="budget-category-detail-header">
						            <td class="budget-spending-item-cell" width="35%">Expense</td>
						            <td class="budget-spending-item-cell" width="23%" align="right">Estimated budget</td>
						            <td class="budget-spending-item-cell" width="18%" align="right">Final Cost</td>
						            <td class="budget-spending-item-cell" width="14%" align="right">Paid</td>
						            <td class="budget-spending-item-cell" width="10%" align="right"></td>
        						</tr>
                    			<tr class="app-budget-parent-spending-row">
                					<td colspan="5">
                    					<table width="100%">
                        					<tbody>';
                        					foreach($subcats as $subcat){
                        						if($subcat->parent_catagory_id > 0){
                        							$parent_catagory_id = $subcat->parent_catagory_id;
                        						}else{
                        							$parent_catagory_id = $cat->id;
                        						} 
                        						$total_estimate = $total_estimate+$subcat->estimated_budget;
                        						$total_final = $total_final+$subcat->final_budget;
                        						$total_paid = $total_paid+$subcat->paid_money;
                        						$text .='<tr class="budget-spending-item app-spending-row" data-category-id="60" data-parent-id="126">
                            					<td class="budget-spending-item-cell" width="35%">
                                					<div class="input-group-line subtitle">
                                    					<input class="app-new-spending updateFunction" data-field="NOMBRE" type="text" name="spendingName" value="'.$subcat->catagory_label.'" data-msgerror="Expense name should have at least three characters." data-name="catagory_label" data-id="'.$subcat->id.'" data-parent="'.$parent_catagory_id.'">
                                					</div>
                            					</td>
                            					<td class="budget-spending-item-cell budget-category-detail-cost" width="23%" align="right">
                                					<div class="budget-spending-payment">
                                                        <span class="currency">$</span>
                                    					<input class="app-new-spending updateFunction" type="text" data-field="COSTE_ESTIMADO" name="estimated" data-name="estimated_budget" data-id="'.$subcat->id.'" data-parent="'.$parent_catagory_id.'" data-msgerror="The price must be greater than 0 rupees" value="'.$subcat->estimated_budget.'">
                                                    </div>
                            					</td>
                            					<td class="budget-spending-item-cell budget-category-detail-cost" width="18%" align="right">
                                					<div class="budget-spending-payment">
                                                        <span class="currency">$</span>
                                    					<input class="app-new-spending updateFunction" type="text" data-field="COSTE_ESTIMADO" name="final_budget" data-name="final_budget" data-id="'.$subcat->id.'" data-parent="'.$parent_catagory_id.'" data-msgerror="The price must be greater than 0 rupees" value="'.$subcat->final_budget.'">
                                                    </div>
                            					</td>
                            					<td class="budget-spending-item-cell" width="14%" align="right">
                                					<span class="app-spending-payment-total pointer budget-spending-payment app-payment-layer" data-payments-id="60" data-totalpaid="0">
                                                    	<span class="currency">$</span>
                                                        	<input class="app-new-spending updateFunction" type="text" data-field="COSTE_ESTIMADO" name="final_budget" data-name="paid_money" data-id="'.$subcat->id.'" data-parent="'.$parent_catagory_id.'" data-msgerror="The price must be greater than 0 rupees" value="'.$subcat->paid_money.'">
                                                    </span>
                            					</td>
                            					<td class="budget-spending-item-cell app-note-row" width="10%" align="right">
                                					<i class="icon icon-comment-black mr5 app-budget-show-note app-add-note pointer dnone" data-category-id="60"></i>
	                                				<div class="dropdown">
						                                <button class="dropdown-toggle table-dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						                                    <i class="fas fa-ellipsis-h"></i>
						                                </button>
	                                                    <div class="dropdown-menu addremove-actions" aria-labelledby="dropdownMenuButton">
	                                                        <a id="add_note_btn" class="dropdown-item" href="javascript:void(0);" data-toggle="modal"  data-noteval="'.$subcat->note.'" data-subid="'.$subcat->id.'" data-target="#add-note-model">Add a Note</a>
	                                						<a class="dropdown-item remove-sub" href="javascript:void(0)" data-id="'.$subcat->id.'" data-parent="'.$parent_catagory_id.'">Remove</a>
	                             	 					</div>
	                             	 					
													</div>
                            					</td>
                        					</tr>';
                        				}
                        					$text .= '
                        					<tr class="new-expenditure">
	                        					<td colspan="5" class="p10 pt15 pb15 budget-spending-item-cell">
									               <a data-parent="'.$catid.' href="javascript:void(0)" class="task-btn new-expense">
	                                                    New Expense<span><i class="fas fa-plus"></i></span>
	                                                </a>
									            </td>
									        </tr>
                        					<tr>
					                            <td colspan="5" class="app-show-payments-details" data-payments-details-id="60"></td>
					                        </tr>
                    					</tbody>
                    				</table>
                				</td>
            				</tr>
				            <tr class="budget-category-detail-footer bg">
				            <td class="budget-spending-item-cell">
				                <span class="strong">Total:</span>
				            </td>
				            <td class="budget-spending-item-cell budget-category-detail-cost" align="right">
				                <span class="strong app-estimated-category-total">
				                    $   <span class="app-budget-estimated-cost">'.$total_estimate.'</span>
				                                    </span>
				            </td>
				            <td class="budget-spending-item-cell budget-category-detail-cost" align="right">
				                <span class="strong app-final-category-total color-green">
				                    $                    <span class="app-budget-final-cost">'.$total_final.'</span>
				                                    </span>
				            </td>
				            <td class="budget-spending-item-cell" align="right">
				                <span class="strong mr5 app-available-category-total-payment">
				                    $                    <span class="app-available-category-total-payment-value">'.$total_paid.'</span>
				                                    </span>
				            </td>
					        <td class="budget-spending-item-cell"></td>
					    </tr>        
					</tbody>
				</table>
			</div>
            </div>';
    	}else{
    		$text = '
                        <div class="cstm-payment-card text-center mt-3 border-lr-none">
	                    	<figure class="cal-icon mb-3">
	                        	<i class="fas fa-home"></i>
	                    	</figure>
	                    	<h4 class="mb-3">'.$cat->catagory_label.'</h4>
	                    	<h6 class="estimated-budget-amount">Estimated budget: <span class="amount mr-3">$ '.$cat->estimated_budget.' </span> Final Cost: <span class="amount mr-3">$ '.$cat->final_budget.' </span></h6>
	                    	<div class="btn-wrap mt-2">
	                        <a class="cstm-btn solid-btn remove-cat" href="javascript:void(0)" data-id="'.$cat->id.'" data-parent="'.$cat->parent_catagory_id.'">Remove</a>
                    	</div>
                	</div>
                    <div class="table-responsive">
                        <table class="budget-category-detail" width="100%">
        					<tbody>
        						<tr class="budget-category-detail-header">
						            <td class="budget-spending-item-cell" width="35%">Expense</td>
						            <td class="budget-spending-item-cell" width="23%" align="right">Estimated budget</td>
						            <td class="budget-spending-item-cell" width="18%" align="right">Final Cost</td>
						            <td class="budget-spending-item-cell" width="14%" align="right">Paid</td>
						            <td class="budget-spending-item-cell" width="10%" align="right"></td>
        						</tr>
                    			<tr class="app-budget-parent-spending-row">
                					<td colspan="5">
                    					<table width="100%">
                        					<tbody>
                        					
                        					<tr class="new-expenditure">
	                        					<td colspan="5" class="p10 pt15 pb15 budget-spending-item-cell">
									               <a data-parent="'.$catid.'" href="javascript:void(0)" class="task-btn new-expense">
	                                                    New Expense<span><i class="fas fa-plus"></i></span>
	                                                </a>
									            </td>
									        </tr>
                        					<tr>
					                            <td colspan="5" class="app-show-payments-details" data-payments-details-id="60"></td>
					                        </tr>
                    					</tbody>
                    				</table>
                				</td>
            				</tr>
				            <tr class="budget-category-detail-footer bg">
				            <td class="budget-spending-item-cell">
				                <span class="strong">Total:</span>
				            </td>
				            <td class="budget-spending-item-cell budget-category-detail-cost" align="right">
				                <span class="strong app-estimated-category-total">
				                    $   <span class="app-budget-estimated-cost">0</span>
				                                    </span>
				            </td>
				            <td class="budget-spending-item-cell budget-category-detail-cost" align="right">
				                <span class="strong app-final-category-total color-green">
				                    $                    <span class="app-budget-final-cost">0</span>
				                                    </span>
				            </td>
				            <td class="budget-spending-item-cell" align="right">
				                <span class="strong mr5 app-available-category-total-payment">
				                    $                    <span class="app-available-category-total-payment-value">0</span>
				                                    </span>
				            </td>
					        <td class="budget-spending-item-cell"></td>
					    </tr>        
					</tbody>
				</table>
			</div>';
    	}
    	return $text;
    }


public function updateFunction(Request $request)
{ 	
	$name = $request->name;
	$rec  = UserEventBudget::find($request->id);
		$current_estimated_budget = $rec->estimated_budget; 
		$current_final_budget = $rec->final_budget; 
		$current_paid_money = $rec->paid_money; 
		$rec->$name = $request->value;

		$record = UserEventBudget::where('catagory_id', $request->parent)->where('parent_catagory_id', 0)->where('user_event_id', $request->event_id)->first();
		if(empty($record)){
			$record = UserEventBudget::find($request->parent);
		}
		if($name == 'final_budget'){
			$final_budget = ($record->final_budget - $current_final_budget) + $request->value;
			$record->final_budget = $final_budget;
			$record->save();
		}
		if($name == 'estimated_budget'){
			$estimated_budget = ($record->estimated_budget - $current_estimated_budget) + $request->value;
			$record->estimated_budget = $estimated_budget;
			$event = UserEvent::find($request->event_id);
			if($event->estimated_budget > 0){
				$event->estimated_budget = ($event->estimated_budget - $current_estimated_budget) + $request->value;
				$event->save();
			}
			$record->save();
		}
		if($name == 'paid_money'){
			$paid_money = ($record->paid_money - $current_paid_money) + $request->value;
			$record->paid_money = $paid_money;
			$record->save();
		}
		$rec->save();
}

public function budgetCategory(Request $request){
	$cate = UserEventBudget::where('user_event_id', $request->event_id)->where('parent_catagory_id', 0)->get();

	$text = '<ul>';
    	foreach($cate as $cats){
    		if($cats->final_budget == 0){
                $budget = $cats->estimated_budget;
    		}
            else{
                $budget = $cats->final_budget;
            }
            if((!empty($request->selected)) && ($request->selected == $cats->id)){
            	$t = 'selected';
            }else{
            	$t = '';
            }
	        $text .='<li>
	            <a href="javascript:void(0);" class="getcat '.$t.'" data-id="'.$cats->id.'" >
	                '.$cats->catagory_label.' <span>$'.$budget.'</span>
	            </a>
	        </li>';
        }
    $text .='</ul>';

    return $text;
}

public function ajax_addnote(Request $request){
	$rec  = UserEventBudget::find($request->cat_id);
	$rec->note = $request->note;
	$rec->save();
}

public function removeFunction(Request $request){
	$rec  = UserEventBudget::find($request->id);
	$estimated_budget = $rec->estimated_budget;
	$final_budget = $rec->final_budget;
	$paid_money = $rec->paid_money;
	if($rec->parent_catagory_id > 0){
		$parent = UserEventBudget::where('user_event_id', $request->event_id)->where('parent_catagory_id', 0)->where('catagory_id', $request->parent)->first();
		if(empty($parent)){
			$parent = UserEventBudget::find($request->parent);
		}
		$parent->estimated_budget = $parent->estimated_budget - $estimated_budget;
		$parent->final_budget = $parent->final_budget - $final_budget;
		$parent->paid_money = $parent->paid_money - $paid_money;
		$parent->save();
		$user_event = UserEvent::find($request->event_id);
		if($user_event->estimated_budget > 0){
			$user_event->estimated_budget = $user_event->estimated_budget - $estimated_budget;
		}
		$user_event->save();
	}else{
		if($rec->catagory_id >0){
			$subcats = UserEventBudget::where('user_event_id', $request->event_id)->where('parent_catagory_id', $rec->catagory_id)->get();
		}else{
			$subcats = UserEventBudget::where('user_event_id', $request->event_id)->where('parent_catagory_id', $rec->id)->get();
		}
		foreach($subcats as $subcat){
			$subcat->delete();
		}
		$user_event = UserEvent::find($request->event_id);
		if($user_event->estimated_budget > 0){
			$user_event->estimated_budget = $user_event->estimated_budget - $estimated_budget;
		}
		$user_event->save();
	}
	$rec->delete();
}

	public function ajax_newcat(Request $request){
		$rec = new UserEventBudget;
		if(!empty($request->cat_label)){
			$rec->catagory_label =  $request->cat_label;
		}else{
			$rec->catagory_label =  'New Item';
		}
		if(!empty($request->parent)){
			$rec->parent_catagory_id =  $request->parent;
		}else{
			$rec->parent_catagory_id =  0;
		}
		$rec->user_event_id =  $request->event_id;
		$rec->user_id =  Auth::user()->id;
		$rec->save();
	}

	public function graphData(Request $request){
		$cate = UserEventBudget::where('user_event_id', $request->event_id)->where('parent_catagory_id', 0)->where('user_id', Auth::user()->id)->get();
		$arr = array();
		foreach ($cate as $cat){
			$label = $cat->catagory_label;
			$estimated_budget = $cat->estimated_budget;
			$final_budget = $cat->final_budget;
			$string = [$label,$estimated_budget,$final_budget];
			$arr[]=  $string;
		} 
		return $arr;
	}

	public function printFunction(Request $request, $slug)
	{
		$user_event = UserEvent::FindBySlugOrFail($slug);
	        $budgetEntries = UserEventBudget::where('user_event_id',$user_event->id)
	        ->where('user_id', Auth::user()->id)->where('parent_catagory_id', '!=',0)
	        ->get();
	    return $vv = view($this->filePath.'includes.print')
	  	      ->with('budgetEntries',$budgetEntries)
	  	      ->with('event',$user_event);
	}

	public function getPDFBudget(Request $request,$slug)
	{
	    $user_event = UserEvent::FindBySlugOrFail($slug);
        $budgetEntries = UserEventBudget::where('user_event_id',$user_event->id)
        ->where('user_id', Auth::user()->id)->where('parent_catagory_id', '!=',0)
        ->get();

        $vv = view($this->filePath.'includes.pdf')
      	      ->with('budgetEntries',$budgetEntries)
      	      ->with('event',$user_event);

		$pdf = PDF::loadView($this->filePath.'includes.pdf', [
		'budgetEntries' => $budgetEntries,
		'event' => $user_event
		]);
		return $pdf->download('budget.pdf');
	      
	}
}
