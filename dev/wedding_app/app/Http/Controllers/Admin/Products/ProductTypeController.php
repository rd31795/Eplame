<?php

namespace App\Http\Controllers\Admin\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products\ProductType;

class ProductTypeController extends Controller {

    protected $path   = 'admin.products.type.';
    public $folder = 'images/shop/product_type/';
	public function __construct() {

	}

#--------------------------------------------------------------------------------------------
# Product Type listing
#--------------------------------------------------------------------------------------------
	public function index() {
      
        return view($this->path.'index',[
	        'title'    => 'Product Types',
	        'addLink'  => route('admin.products.create.types'),
	        'ajaxLink' => url(route('admin.products.typesAjax')),
	    ]);
	}

#--------------------------------------------------------------------------------------------
# Product Type listing
#--------------------------------------------------------------------------------------------
	public function create() {

		return view($this->path.'add',[
	        'title' => 'Product Types',
	        'addLink' => route('admin.products.list.types'),
        ]);

	}

#--------------------------------------------------------------------------------------------
# Product Type Save
#--------------------------------------------------------------------------------------------
	public function save(Request $request) {
		$this->validate($request,[
              'label' => 'required|string|min:1,max:255|unique:product_types'      
		]);
        $product_type_image=$request->hasFile('product_type_image') ? uploadFileWithAjax($this->folder,$request->file('product_type_image')): '';
		$product_type         = new ProductType();
		$product_type->label  = trim($request->label);
        $product_type->image  = $product_type_image;
		$product_type->status = 1;
		$product_type->save();
		$msg                  = "Product type is saved Successfully!";
        return redirect()->back()->with('messages',$msg);
	}

#--------------------------------------------------------------------------------------------
# Product Type Edit
#--------------------------------------------------------------------------------------------
	public function edit($id) {

		$product_type = ProductType::find($id);
		if($product_type) {

			return view($this->path.'edit')->with([
				    'title'        => 'Product Types',
                    'product_type' => $product_type,
                    'addLink'      => route('admin.products.list.types'),
			]);
		}
        
        return abort(404);
	}

#--------------------------------------------------------------------------------------------
# Product Type Update
#--------------------------------------------------------------------------------------------
	public function update(Request $request, $id) {

		$this->validate($request,[
            'label' => 'required|string|min:1|max:255|unique:product_types,label,'.$id
		]);
        $product_type_image="";
		$product_type = ProductType::find($id);
		if($product_type) {
            $product_type->label = trim($request->label);
             if($request->file('product_type_image')){
               // deleteFile($check->background_image);
               $product_type_image=uploadFileWithAjax($this->folder,$request->file('product_type_image'));
            }else{
               $product_type_image=$product_type->image;
            }
            $product_type->image=$product_type_image;
            $product_type->save();
            $msg = "Product type is updated Successfully!";
            return redirect()->route('admin.products.list.types')->with('messages',$msg);
		}
		return abort(404);
	}
#----------------------------------------------------------------------------------------------------------------
# Product Type Active In-Active function
#----------------------------------------------------------------------------------------------------------------
public function status($id){
    $product_type = ProductType::find($id);
    if($product_type) {
	    $product_type->status = $product_type->status == 1 ? 0 : 1;
	    $product_type->save();
	    $msg = "Product Type Status Changed Successfully!";
	    return redirect()->route('admin.products.list.types')->with('messages',$msg);
    }

    return abort(404);
}   	

#--------------------------------------------------------------------------------------------
# Product Type Ajax Search
#--------------------------------------------------------------------------------------------

	public function Ajax() {

		$product_types = ProductType::select(['id','label','status'])->get();
		return datatables()->of($product_types)
		                   ->addColumn('action',function($product_type) {
                              return $this->Actions($product_type);
		                   })
		                   ->editColumn('status',function($product_type) {
		                   	   return $product_type->status == 1 ? 'Active' : 'In-Active';
		                   }) 
		                   ->make(true);

	}


#--------------------------------------------------------------------------------------------
# Product Type Ajax Search --All Action List Here
#--------------------------------------------------------------------------------------------	

	protected function Actions($data) {
        

		$text  ='<div class="btn-group">';
       // $text .='<button type="button" class="btn btn-primary"></button>';
        $text .='<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
        $text .='Action &nbsp;<span class="caret"></span>';
        $text .='<span class="sr-only">Toggle Dropdown</span>';
        $text .='</button>';
        $text .='<div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; transform: translate3d(67px, -165px, 0px); top: 0px; left: 0px; will-change: transform;">';

        $text .='<a href="'.route('admin.products.edit.types',$data->id).'" class="dropdown-item">Edit</a>';
        $text .='<div class="dropdown-divider"></div>';
        $status=$data->status == 0 ? 'Active' : 'In-Active';
        $text .='<a href="'.route('admin.products.status.types',$data->id).'" class="dropdown-item">'.$status.'</a>';

        $text .='</div>';
        $text .='</div>';

        return $text;
	}

}