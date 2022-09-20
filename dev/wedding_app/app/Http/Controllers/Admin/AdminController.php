<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
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

class AdminController extends Controller
{
  use MainTraits; 
    use GeneralSettingTrait;
    use EmailNotificationTrait;
    
    public $folder = 'images/shop/maintenance/';
#----------------------------------------------------------------------
# Admin Login
#----------------------------------------------------------------------

	public function index()
	{
    
        if(Auth::check()){
              $url = url(route('request.messages')).'?type=logged';
              return redirect($url);
        }
		return view('admin.login');
	}


#----------------------------------------------------------------------
# Admin Check
#----------------------------------------------------------------------


    public function maintenance(){
        $maintenance=DB::table('maintenance')->find(1);
        if($maintenance->maintenance_mode)
        {
           \Artisan::call('up');
        }else{
           \Artisan::call('down');
        }
         DB::table('maintenance')->whereId(1)->update([
              "maintenance_mode"=>$maintenance->maintenance_mode?0:1
        ]);
        return redirect()->back();
    }

    public function updateMaintenance(request $request){
      $image="";
      $check=DB::table('maintenance')->find(1);
       if($request->file('maintenance_image')){
               $image=uploadFileWithAjax($this->folder,$request->file('maintenance_image'));
            }else{
               $image=$check->image;
            }
        $update=DB::table('maintenance')->whereId(1)->update([
          'page_title'=>$request->page_title,
          'description'=>$request->description,
          'image'=>$image
        ]);
          return redirect('/admin/maintenance-page')->with('success','Maintenance Page is updated successfully');
   }


   public function maintenanceSetting(){
     $maintenance=DB::table('maintenance')->whereId(1)->first();
     return view('admin.mainteance.maintenance')
     ->with('title','Maintenance Page Settings')
     ->with('maintenance',$maintenance);
   }


    public function check(Request $request)
    {
    	$this->validate($request,[
                  'email' => 'required|email',
                  'password' => 'required'
    	]);
      
		 if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'role' => 'admin']))
        {
              //return Auth::user();
              return redirect()->intended('admin');

        }elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password,'role' => 'subadmin']))
        {
              //return Auth::user();
              return redirect()->intended('admin');

        }else{
        	return redirect()->route('admin_login')->with('messages','Invalid Email | Password');
        }
	 
    }



#----------------------------------------------------------------------
# Admin Login
#----------------------------------------------------------------------


    public function logout()
    {
    	   Auth::logout();

    	   return redirect()->route('admin_login');
    }



#----------------------------------------------------------------------
# Admin Login
#----------------------------------------------------------------------

public function dashboard(Request $request)
{
     $val = (!empty($request->type)) && $request->type == 2 ? 'e-shop' : 'event';
         
     \Session::put('currentLink',$val);

	return view('admin.dashboard');
}

#----------------------------------------------------------------------
# Admin profile settings
#----------------------------------------------------------------------

	public function profile()
	{
		return view('admin.profile',[
              'title' => 'Settings'

		]);
	}



public function change(Request $request, $id = null)
    { 
        
        $valid = [
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:6', 'max:20', 'confirmed']
        ];

        $valid2 = ['password' => ['required', 'string', 'min:6', 'confirmed']];

        $validation = $id == null ? $valid : $valid2;

        $customMessages = [
            'password.max' => 'The password can not be greater than 20 characters',
        ];

        $this->validate($request, $validation, $customMessages);
        
        $user_id = Auth::User()->id;

        $u = $id != null ? User::where('id',$id)->where('role','super')->first() : User::find($user_id);


        if($id == null){

        

                if (\Hash::check($request->old_password , $u->password))
                 { 
                             $u->password= \Hash::make($request->password);
                             $u->save();
                             return redirect()->back()->with('flash_message',"your password has been changed");
                      
                           
                 }else{
                                 
                                  
                        return redirect()->back()->with('old_password',"invalid old password");
                 }

        }else{

                    $u->password= \Hash::make($request->password);
                     $u->save();
                     return redirect()->back()->with('flash_message',"your password has been changed");

        }
    

         

    }

public function changeProfileImage(Request $request) { 


    $this->validate($request,[
         'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048']
    ]);
    $path = 'images/admin/';
     $u = User::find(Auth::user()->id);
     $u->profile_image = $request->hasFile('image') ? uploadFileWithAjax($path,$request->file('image')) : '';

     $u->save();
    
     return redirect()->back()->with('flash_message', "Your Profile image has been changed"); 
}

// subadmin 
public function subadmin_index() {
        return view('admin.subadmin.index')->with(['title' => 'SubAdmin Management', 'addLink' => 'admin.subadmin.create']);
        
    }

public function showCreate() {
    $menus = Menu::where('status', 1)->get();
     $groups = Group::where('status', 1)->get();
        return view('admin.subadmin.create')->with(['title' => 'Create SubAdmin', 'addLink' => 'admin.subadmin.create','menus' => $menus,'groups' => $groups]);
    }

     public function ajax_getSubadmin() {
        $subadmin = User::where('role', 'subadmin')
                     ->get();
        
        return datatables()->of($subadmin)
        ->addColumn('action', function ($t) {
            return  $this->Actions($t);
        })->editColumn('status', function($t){
            return $t->status == 1 ? 'Active' : 'In-Active';
        })->editColumn('name',function($t){
        return str_limit($t->name, 50);
        })->make(true);
    }
     public function create(Request $request) { 

        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:20'],
            'last_name' => ['required', 'string', 'max:20'],
            'email'=>['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'=>['required', 'string', 'min:6'],
            'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048']
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = 'images/admin/profile/';
            $path = $destinationPath.$filename;
           $image->move($destinationPath, $filename);
        }
        $data = $request->all();
       
        // if(empty($data['read_permission'])){
        //     $data['read_permission'] = 0;
        //   }
        //   if(empty($data['write_permission'])){
        //     $data['write_permission'] = 0;
        //   }
         $group_id = $data['group_name'];
        
        $user= new User;
        $user->name=$data['first_name'].' '.$data['last_name'];
        $user->first_name=$data['first_name'];
        $user->last_name= $data['last_name'];
        $user->email=$data['email'];
        $user->password=Hash::make($data['password']);
        $user->role='subadmin';
        $user->profile_image=$path;
        $user->save();
        if($group_id == 100)
        {
          $menus = Menu::where('status', 1)->get();
          foreach ($menus as $menu) {
            $per = new AccessPermission;
            $per->user_id = $user->id;
            $per->menu_id = $menu->id;
            if($request->input($menu->slug.'_read_permission') == 1){
                $per->read_permission = 1;
            }else{  
                $per->read_permission = 0;
            }
            if($request->input($menu->slug.'_write_permission') == 1){
                $per->write_permission = 1;
            }else{  
                $per->write_permission = 0;
            }
            $per->save();
          } 
        }else{
          $group= new GroupAccessPermission;
          $group->group_id = $group_id;
          $group->user_id = $user->id;
          $group->save();
        }
               
        $this->SubAdminRegistrationTrait($user);
        return redirect()->route('admin.subadmin.list')->with('flash_message', 'Subadmin has been saved successfully');


     }
      public function update(Request $request, $id) { 
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:20'],
            'last_name' => ['required', 'string', 'max:20']
        ]);

        $data = $request->all();
        $group_id = $data['group_name'];
        $user= User::find($request->id);
        $user->name=$data['first_name'].' '.$data['last_name'];
        $user->first_name=$data['first_name'];
        $user->last_name= $data['last_name'];
        $user->role='subadmin';
        $user->save();
        if($group_id == 100)
        {
          $menus = Menu::where('status', 1)->get();
          foreach ($menus as $menu) {
            $per = AccessPermission::where('user_id', $id)->where('menu_id', $menu->id)->first();
            if(!empty($per)){
              if($request->input($menu->slug.'_read_permission') == 1){
                  $per->read_permission = 1;
              }else{  
                  $per->read_permission = 0;
              }
              if($request->input($menu->slug.'_write_permission') == 1){
                  $per->write_permission = 1;
              }else{  
                  $per->write_permission = 0;
              }
            }else{
              $per = new AccessPermission;
              $per->user_id = $id;
              $per->menu_id = $menu->id;
              if($request->input($menu->slug.'_read_permission') == 1){
                  $per->read_permission = 1;
              }else{  
                  $per->read_permission = 0;
              }
              if($request->input($menu->slug.'_write_permission') == 1){
                  $per->write_permission = 1;
              }else{  
                  $per->write_permission = 0;
              }
            }
            $per->save();
          }

        }else{
            $group = GroupAccessPermission::where('user_id', $id)->first();
            if(!empty($group)){
            $group->group_id = $group_id;
            
          }else{
            $group = new GroupAccessPermission;
            $group->group_id = $group_id;
            $group->user_id = $id;
          }
          $group->save();
        }
               
        
        return redirect()->route('admin.subadmin.list')->with('flash_message', 'Subadmin has been Updated successfully');


     }
      public function Actions($data) {
            $text  ='<div class="btn-group">';
            $text .='<button type="button" class="btn btn-primary">Action</button>';
            $text .='<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
            $text .='<span class="caret"></span>';
            $text .='<span class="sr-only">Toggle Dropdown</span>';
            $text .='</button>';
            $text .='<div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; transform: translate3d(67px, -165px, 0px); top: 0px; left: 0px; will-change: transform;">';


            $text .='<a href="'.route('admin.subadmin.showEdit', $data->id).'" class="dropdown-item">Edit</a>';
            $text .='<div class="dropdown-divider"></div>';
            $status=$data->status == 0 ? 'Active' : 'In-Active';
            $text .='<a href="'.route('admin.subadmin.status', $data->id).'" class="dropdown-item">'.$status.'</a>';


            $text .='</div>';
            $text .='</div>';

            return $text;
    }
     public function showEdit($id) {
         $user = User::find($id);
         $group_id = GroupAccessPermission::where('user_id',$id)->first();
         $groups = Group::where('status', 1)->get();
       // $checkdata = AccessPermission::where('user_id',$id)->get();
        $menus = Menu::where('status', 1)->get();
        return view('admin.subadmin.edit')
        ->with(['user' => $user,'menus'=>$menus,'groups'=>$groups, 'group_id'=>$group_id,'title' => 'Edit Subadmin', 'addLink' => 'admin.subadmin.list']);
    }
     public function subadminStatus($id) {
     $user = User::find($id);

     if(!empty($user)){
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
        $msg= $user->status == 1 ? 'SubAdmin <b>'.$user->name.'</b> is Activated' : '<b>SubAdmin '.$user->name.'</b> is Deactivated';
       return redirect(route('admin.subadmin.list'))->with('flash_message', $msg);
     }
     return redirect()->back()->with('flash_message', 'Something Went Woring!');
    }
}