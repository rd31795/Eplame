<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Package;
use App\PurchasePackageProduct;
use Auth,DB;
class FeaturedPackagesControllers extends Controller
{
	
    public function index(){
        $title='Featured Product Packages';
        $addLink='admin.home.product.featured-package.add';
        return view('admin.packages.index',compact('title','addLink'));
        
    }

    public function eventIndex(){
        $title='Featured Event Packages';
        $addLink='admin.home.event.featured-package.add';
        $event=true;
        return view('admin.packages.index',compact('title','addLink','event'));

    }


    public function getPackages(){

        $packages = Package::select(['id', 'title', 'summary','price','package_image','status','updated_at'])
                 ->where('type_of_package',1)->get();
        

        return datatables()->of($packages)
        ->addColumn('action', function ($t) {
        return  $this->Actions($t);
        })
        ->editColumn('summary',function($t){
        return  $t->summary;
        })->escapeColumns([])
        ->editColumn('status',function($t){
        return $t->status == 1 ? 'Active' : 'In-Active';
        })
        ->editColumn('updated_at',function($t){
        return \Carbon\Carbon::parse($t->updated_at)->format('d-m-Y h:i:s');
        })

        ->make(true);
    }

    public function getPackagesEvent(){
        $packages = Package::select(['id', 'title', 'summary','price','package_image','status','updated_at'])
                 ->where('type_of_package',2)->get();
        

        return datatables()->of($packages)
        ->addColumn('action', function ($t) {
        return  $this->EventActions($t);
        })
        ->editColumn('summary',function($t){
        return  $t->summary;
        })->escapeColumns([])
        ->editColumn('status',function($t){
        return $t->status == 1 ? 'Active' : 'In-Active';
        })
        ->editColumn('updated_at',function($t){
        return \Carbon\Carbon::parse($t->updated_at)->format('d-m-Y h:i:s');
        })

        ->make(true);
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

        $text .='<a href="'.route('featured_product_edit',$data->id).'" class="dropdown-item">Edit</a>';
        $text .='<div class="dropdown-divider"></div>';
        $status=$data->status == 0 ? 'Active' : 'In-Active';
        $text .='<a href="'.route('featured_product_status',$data->id).'" class="dropdown-item">'.$status.'</a>';
        $text .='</div>';

        return $text;
    }
    public function EventActions($data)
    {
        $text  ='<div class="btn-group">';
        $text .='<button type="button" class="btn btn-primary">Action</button>';
        $text .='<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
        $text .='<span class="caret"></span>';
        $text .='<span class="sr-only">Toggle Dropdown</span>';
        $text .='</button>';
        $text .='<div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; transform: translate3d(67px, -165px, 0px); top: 0px; left: 0px; will-change: transform;">';

        $text .='<a href="'.route('featured_event_edit',$data->id).'" class="dropdown-item">Edit</a>';
        $text .='<div class="dropdown-divider"></div>';
        $status=$data->status == 0 ? 'Active' : 'In-Active';
        $text .='<a href="'.route('featured_event_status',$data->id).'" class="dropdown-item">'.$status.'</a>';
        $text .='</div>';

        return $text;
    }

    public function add(){
        $title='Add Featured Product Packages';
        $addLink='admin.home.product.featured-package';
        return view('admin.packages.add',compact('title','addLink'));
    }


    public function addEvent(){
        $title='Add Featured Event Packages';
        $addLink='admin.home.event.featured-package';
        $event=true;
        return view('admin.packages.add',compact('title','addLink','event'));
    }

    public function store(request $request){
      
      if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'a'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $filename);
        };
        $category_count=$request->category_count;
        if($request->event){
            $category_count=json_encode($request->event_type);
        }

        Package::insert([
            'title' => $request->title,
            'summary' => $request->featured_summary,
            'package_image' => $filename,
            'price' => $request->package_price,
            'package_validity'=>$request->package_validity,
            'package_validity_type'=>$request->package_type,
            'category_count'=>$category_count,
            'type_of_package'=>$request->event?2:1
        ]);
        if($request->event){
            return redirect()->route('admin.home.event.featured-package')->with('flash_message','Package is created successfully');
        }
        return redirect()->route('admin.home.product.featured-package')->with('flash_message','Package is created successfully');
    }
    public function toggleStatus($id){
     $package=Package::find($id);
     $package->status=$package->status?0:1;
     $package->save();
      return redirect()->route('admin.home.product.featured-package')->with('flash_message','Package status is updated successfully');
    }
    public function toggleStatusEvent($id){
     $package=Package::find($id);
     $package->status=$package->status?0:1;
     $package->save();
      return redirect()->route('admin.home.event.featured-package')->with('flash_message','Package status is updated successfully');
    }

    public function edit($id){
      $title='Update Featured Product Packages';
      $addLink='admin.home.product.featured-package';
      $package=Package::find($id);
      return view('admin.packages.edit',compact('title','addLink','package','event'));
    }   

    public function editEvent($id){
       $title='Update Featured Event Packages';
      $addLink='admin.home.event.featured-package';
      $package=Package::find($id);
      $event=true;
      return view('admin.packages.edit',compact('title','addLink','package','event'));
    }

    public function update(request $request , $id){
         $package = Package::find($id);
         $filename = $package->package_image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $img_path = public_path().'/uploads/'.$filename;
            if (file_exists($img_path)) {
                unlink($img_path);
            }
            $image->move($destinationPath, $filename);
        }
        $category_count=$request->category_count;
        if($request->event){
            $category_count=json_encode($request->event_type);
        }
   Package::where('id',$id)->update([
            'title' => $request->title,
            'summary' => $request->featured_summary,
            'package_image' => $filename,
            'price' => $request->package_price,
            'package_validity'=>$request->package_validity,
            'package_validity_type'=>$request->package_type,
            'category_count'=>$category_count
        ]);
        return redirect()->back()->with('flash_message','Package is updated successfully');
    }

    public function BuyPackage(request $request,$id){
   
    $package=Package::where('id',$id)->first(); 
    $package_validity_type=$package->package_validity_type;
    $package_validity=$package->package_validity;
    $start_date=\Carbon\Carbon::now();
    $expiry_date=\Carbon\Carbon::now();
    switch ($package_validity_type) {
        case '1':  
            $expiry_date=$expiry_date->addDays($package_validity);
            break;
        case '2':
            $expiry_date=$expiry_date->addMonths($package_validity);
            break;
        case '3':
            $expiry_date=$expiry_date->addYears($package_validity);
            break;
        default:
            $expiry_date=$expiry_date;
            break;
    }
 
     $OrderID = '#EPSHOP'.strtotime(date('y-m-d h:i:s'));
     $description = 'Vendor pay for package '.$package->title." and package Order Id ".$OrderID;
      $stripe = SripeAccount();
      \Stripe\Stripe::setApiKey($stripe['sk']);
     $charge = \Stripe\Charge::create([
        "amount" => ($package->price * 100),
        "currency" => "usd",
        "source" => $request->stripeToken,
                        //"shipping" => $shipping,
        "description" => $description,
                        //"application_fee" => $application_fee,
    ]);
     $check_package=PurchasePackageProduct::where('user_id',Auth::id())->where('package_type',1)->where('status',1)->first();

    PurchasePackageProduct::insert([
        "package_id"=>$package->id,
        "orderId"=>$OrderID,
        "user_id"=>Auth::id(),
        "start_date"=>$start_date,
        "expiry_date"=>$expiry_date,
        "category_count"=>$package->category_count,
        "payment_info"=>$charge,
        "price"=> $package->price,
        "payment_type"=>'stripe',
        "status"=>$check_package?2:1,
        'package_type'=>1
    ]);
    if(!$check_package){
        return redirect(route('vendor.shop.featured'));
    }
   return back()->with('Flash','Package '.$package->title.' is active now. Congratulation');
    }

    public function BuyPackageEvent(request $request,$id){
    $package=Package::where('id',$id)->first(); 
    $package_validity_type=$package->package_validity_type;
    $package_validity=$package->package_validity;
    $start_date=\Carbon\Carbon::now();
    $expiry_date=\Carbon\Carbon::now();
    switch ($package_validity_type) {
        case '1':  
            $expiry_date=$expiry_date->addDays($package_validity);
            break;
        case '2':
            $expiry_date=$expiry_date->addMonths($package_validity);
            break;
        case '3':
            $expiry_date=$expiry_date->addYears($package_validity);
            break;
        default:
            $expiry_date=$expiry_date;
            break;
    }
 
     $OrderID = '#EPSHOP'.strtotime(date('y-m-d h:i:s'));
     $description = 'Vendor pay for package '.$package->title." and package Order Id ".$OrderID;
      $stripe = SripeAccount();
      \Stripe\Stripe::setApiKey($stripe['sk']);
     $charge = \Stripe\Charge::create([
        "amount" => ($package->price * 100),
        "currency" => "usd",
        "source" => $request->stripeToken,
                        //"shipping" => $shipping,
        "description" => $description,
                        //"application_fee" => $application_fee,
    ]);
     $check_package=PurchasePackageProduct::where('user_id',Auth::id())->where('package_type',2)->where('status',1)->first();

    PurchasePackageProduct::insert([
        "package_id"=>$package->id,
        "orderId"=>$OrderID,
        "user_id"=>Auth::id(),
        "start_date"=>$start_date,
        "expiry_date"=>$expiry_date,
        "category_count"=>$package->category_count,
        "payment_info"=>$charge,
        "price"=> $package->price,
        "payment_type"=>'stripe',
        "status"=>$check_package?2:1,
        "package_type"=>2
    ]);

    $CategoryCount=json_decode($package->category_count);
    foreach($CategoryCount as $value){
       $events_package_ids=DB::table('events_package_ids')->insert([
         "package_events"=>$value,
         "package_id"=>$package->id
       ]);
       
    }
    // if(!$check_package){
    //     return redirect(route('vendor.shop.featured'));
    // }
   return back()->with('Flash','Package '.$package->title.' is active now. Congratulation');
    }

    public function changePlanStatus($id){
        $check=PurchasePackageProduct::where('user_id',Auth::id())->where('package_type',1)->where('status',1)->update([
            "status"=>0
        ]);

       $make_active=PurchasePackageProduct::whereId($id)->update([
            "status"=>1
        ]);
        DB::table('featured_category_user')->where('user_id',Auth::id())->delete();
        return back();
    }
     public function changePlanStatusEvent($id){
        $check=PurchasePackageProduct::where('user_id',Auth::id())->where('package_type',2)->where('status',1)->update([
            "status"=>0
        ]);

       $make_active=PurchasePackageProduct::whereId($id)->update([
            "status"=>1
        ]);
        DB::table('featured_category_user')->where('user_id',Auth::id())->delete();
        return back();
    }

    public function packagesOrder(){
            $title='Featured Packages Order Details';
           $purchasePackage=PurchasePackageProduct::get();
           return view('admin.packages.order.index',compact('title'));

    }

    public function packagesOrderEvent(){
           $title='Featured Packages Order Details';
           $purchasePackage=PurchasePackageProduct::get();
           $event=true;
           return view('admin.packages.order.index',compact('title','event'));
    }


    public function OrderContent(){
          $packages = PurchasePackageProduct::select(['purchase_package_product.orderId', 'purchase_package_product.start_date', 'purchase_package_product.expiry_date','purchase_package_product.price','purchase_package_product.package_id','purchase_package_product.user_id','purchase_package_product.status'])->join('packages','packages.id','=','purchase_package_product.package_id')->where('packages.type_of_package','=',1)
                 ->get();

        return datatables()->of($packages)
        ->editColumn('package_name',function($t){
            $package=Package::where('id',$t->package_id)->first();
            return $package->title;
        })
        ->editColumn('email',function($t){
           $user=DB::table('users')->where('id',$t->user_id)->first();
           return $user->email;
        })
        ->editColumn('status',function($t){
            if($t->status == 1){
                return 'Active';
            }
            if($t->status == 0){
                return 'Validity Finished';
            }
            if($t->status == 2){
                return 'Not Active';
            }
        })

        ->make(true);
    }


    public function OrderContentEvent(){
         $packages = PurchasePackageProduct::select(['purchase_package_product.orderId', 'purchase_package_product.start_date', 'purchase_package_product.expiry_date','purchase_package_product.price','purchase_package_product.package_id','purchase_package_product.user_id','purchase_package_product.status'])->join('packages','packages.id','=','purchase_package_product.package_id')->where('packages.type_of_package','=',2)
                 ->get();


        return datatables()->of($packages)
        ->editColumn('package_name',function($t){
            $package=Package::where('id',$t->package_id)->first();
            return $package->title;
        })
        ->editColumn('email',function($t){
           $user=DB::table('users')->where('id',$t->user_id)->first();
           return $user->email;
        })
        ->editColumn('status',function($t){
            if($t->status == 1){
                return 'Active';
            }
            if($t->status == 0){
                return 'Validity Finished';
            }
            if($t->status == 2){
                return 'Not Active';
            }
        })

        ->make(true);
    }
}
