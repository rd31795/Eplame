<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ThankyouTemplate;

class ThankyouTemplatesController extends Controller
{
    public function index() {
    	return view('admin.thank-you-templates.index')->with(['title'=> 'Templates', 'addLink' => 'admin.thank-you-template.showCreate']);
    }

    public function ajaxData() {
		$vanues = ThankyouTemplate::select(['title', 'status', 'id'])->get();
		
		return datatables()->of($vanues)
		->addColumn('action', function ($t) {
			return createAction($t, 'admin.thank-you-template.edit', 'admin.thank-you-template.status');
		})->editColumn('status', function($t){
			return $t->status == 1 ? 'Active' : 'In-Active';
		})->make(true);
	}

	public function showCreate() {
		return view('admin.thank-you-templates.create')->with(['title' => 'Create Template', 'addLink' => 'admin.thank-you-template.list']);
	}

	public function create(Request $request) {
		ThankyouTemplate::create($request->all());
		return redirect(route('admin.thank-you-template.list'))->with('flash_message', 'Template has been created successfully');
	}

	public function changeStatus($id) {
		$template = ThankyouTemplate::find($id);

     if(!empty($template)) {
        $template->status = $template->status == 1 ? 0 : 1;
        $template->save();
        $msg= $template->status == 1 ? '<b>'.$template->title.'</b> is Activated' : '<b>'.$template->title.'</b> is Deactivated';
       return redirect(route('admin.thank-you-template.list'))->with('flash_message', $msg);
     }
     return redirect()->back()->with('flash_message', 'Something Went Woring!');
	}

	public function edit($id) {
		$template = ThankyouTemplate::find($id);
		return view('admin.thank-you-templates.edit')->with(['title'=> 'Template Edit', 'addLink'=> 'admin.thank-you-template.list', 'template' => $template]);
	}

	public function update(Request $request, $id) {
		$template = ThankyouTemplate::find($id)->update($request->all());
		return redirect(route('admin.thank-you-template.list'))->with('flash_message', 'Template has been updated successfully');
	}
}
