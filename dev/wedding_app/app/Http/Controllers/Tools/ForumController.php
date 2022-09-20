<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Discussion;
use App\DiscussionGroup;
use App\DiscussionFile;
use App\Comment;
use Auth;
use Activity;
use App\View;
use App\DiscussionGroupMember;
use App\User;
use App\Friend;
use App\UserEvent;
use App\EventRegistration;
use App\UserEventGroup;
use App\UserEventMenu;
use App\UserEventGuest;
use App\RegistrationType;
use App\Traits\EmailTraits\EmailNotificationTrait;

class ForumController extends Controller
{

	use EmailNotificationTrait;

	public function index(){

		$activities = Activity::users(10)->get();
    	$groups = DiscussionGroup::where('status', 1)->get();
    	$discussions = Discussion::whereHas('discussionUserId',function($q)
            {
                $q->where('user_active',1);
            })
            ->with('discussionUserId');
    	$recent_discussions = Discussion::whereHas('discussionUserId',function($q)
            {
                $q->where('user_active',1);
            })
            ->with('discussionUserId')->orderBy('updated_at', 'Desc')->paginate(10);
    	$top_discussions = Discussion::whereHas('discussionUserId',function($q)
            {
                $q->where('user_active',1);
            })
            ->with('discussionUserId')->orderBy('updated_at', 'Desc')->paginate(5);
    	$top_photos = DiscussionFile::whereHas('discussionFileUserId',function($q)
            {
                $q->where('user_active',1);
            })
            ->with('discussionFileUserId')->where('type', 'photo')->orderBy('updated_at', 'Desc')->paginate(6);
    	$top_videos = DiscussionFile::whereHas('discussionFileUserId',function($q)
            {
                $q->where('user_active',1);
            })
            ->with('discussionFileUserId')->where('type', 'video')->orderBy('updated_at', 'Desc')->paginate(6);

    	$discfile_users = DiscussionFile::select('user_id')->get();
    	 $disc_users = Discussion::select('user_id')->get();
    	$cmnt_users = Comment::select('user_id')->get();
      

    	$array = array();

    	if(!empty($discfile_users[0]->user_id)){
    		foreach($discfile_users as $user){
    			array_push($array, $user->user_id);
    		}
    	}

    	if(!empty($disc_users[0]->user_id)){
    		foreach($disc_users as $user){
    			array_push($array, $user->user_id);
    		}
    	}

    	if(!empty($cmnt_users[0]->user_id)){
    		foreach($cmnt_users as $user){
    			array_push($array, $user->user_id);
    		}
    	}
    	$array_with_count = array_count_values($array);
    	arsort($array_with_count);
    	array_slice($array_with_count, 5);


    	return view('tools.forum.index')->with(['groups' => $groups, 'discussions' => $discussions, 'recent_discussions' => $recent_discussions, 'activities'=> $activities, 'top_discussions'=> $top_discussions, 'top_photos'=> $top_photos, 'top_videos'=> $top_videos, 'array_with_count' => $array_with_count]);
    }

    public function createDiscussion(){
    	$groups = DiscussionGroup::where('status', 1)->get();
    	return view('tools.forum.createdisscussion')->with(['groups' => $groups]);
    }

    public function storeDiscussion(Request $request){
    	$groups = DiscussionGroup::where('status', 1)->get();
    	$discussion = new Discussion;
    	$discussion->user_id = Auth::user()->id;
    	$discussion->group_id = $request->group;
    	$discussion->title = $request->title;
    	$discussion->description = $request->description;
    	$discussion->save();
    	return redirect()->route('forum.user.wall', Auth::user()->id);
    }

    public function createPhoto(){
    	$groups = DiscussionGroup::where('status', 1)->get();
    	return view('tools.forum.createphoto')->with(['groups' => $groups]);
    }

    public function createVideo(){
    	$groups = DiscussionGroup::where('status', 1)->get();
    	return view('tools.forum.createvideo')->with(['groups' => $groups]);
    }

    public function storePhoto(Request $request){
    	$groups = DiscussionGroup::where('status', 1)->get();

    	if ($request->hasFile('photo')) {
	        $image = $request->file('photo');
	        $filename = time().'.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/uploads');
	        $image->move($destinationPath, $filename);
    	}

    	$discussion = new DiscussionFile;
    	$discussion->user_id = Auth::user()->id;
    	$discussion->group_id = $request->group;
    	$discussion->title = $request->title;
    	$discussion->description = $request->description;
    	$discussion->path = $filename;
    	$discussion->type = 'photo';
    	$discussion->save();
    	return redirect()->route('forum.user.wall', Auth::user()->id);
    }

    public function storeVideo(Request $request){
    	$groups = DiscussionGroup::where('status', 1)->get();

    	$discussion = new DiscussionFile;
    	$discussion->user_id = Auth::user()->id;
    	$discussion->group_id = $request->group;
    	$discussion->title = $request->title;
    	$discussion->description = $request->description;
    	$discussion->path = $request->video_url;
    	$discussion->type = 'video';
    	$discussion->save();
    	return redirect()->route('forum.user.wall', Auth::user()->id);
    }

    public function discussionDetail($slug, Request $request){
    	$discussion = Discussion::FindBySlugOrFail($slug);
    	$ip = $request->ip();

    	if(Auth::user()){
    		$view = View::where(function ($query) use($ip) {
    		$query->where('user_id', Auth::user()->id)
          	->orWhere('ip_address', $ip);})
          	->where('discussion_id', $discussion->id)->first();

    		if(empty($view)){
	  			$new = new View;
	  			$new->user_id = Auth::user()->id;
	  			$new->discussion_id = $discussion->id;
	  			$new->ip_address = $request->ip();
    			$new->save();
	  		}
    	}else{
    		$view = View::where('ip_address', $request->ip())->where('discussion_id', $discussion->id)->first();
    		if(empty($view)){
	    		$new = new View;
	  			$new->discussion_id = $discussion->id;
	  			$new->ip_address = $request->ip();
    			$new->save();
	  		}
    	}
    	$groups = DiscussionGroup::where('status', 1)->get();
    	$comments = Comment::where('discussion_id', $discussion->id)->orderBy('updated_at', 'Desc')->get();
    	return view('tools.forum.discussionDetail')->with(['groups' => $groups, 'discussion'=> $discussion, 'comments'=> $comments]);
    }

    public function groupDetail($slug){
    	$status = 0;
    	$activities = Activity::users(10)->get();
    	$group = DiscussionGroup::FindBySlugOrFail($slug);
    	$discussions = Discussion::where('group_id', $group->id)->paginate(10);
    	$groups = DiscussionGroup::where('status', 1)->get();
    	$recent_photos = DiscussionFile::where('group_id', $group->id)->where('type','photo')->paginate(3);
    	$recent_videos = DiscussionFile::where('group_id', $group->id)->where('type','video')->paginate(3);
    	$recent_members = DiscussionGroupMember::where('group_id', $group->id)->orderBy('id', 'Desc')->paginate(5);
    	if(Auth::user()){
    		$joining =  DiscussionGroupMember::where('user_id', Auth::user()->id)->where('group_id', $group->id)->first();
    		if(!empty($joining)){
    			$status = 1;
    		}
    	}
    	return view('tools.forum.groupDetail')->with(['groups' => $groups, 'group' => $group, 'activities'=> $activities, 'discussions'=> $discussions, 'recent_photos'=> $recent_photos, 'recent_videos' => $recent_videos, 'recent_members'=> $recent_members, 'status' => $status, 'slug'=> $slug]);
    }

    public function groupMembers($slug){
    	$status = 0;
    	$group = DiscussionGroup::FindBySlugOrFail($slug);
    	$groups = DiscussionGroup::where('status', 1)->get();
    	$recent_members = DiscussionGroupMember::where('group_id', $group->id)->orderBy('id', 'Desc')->paginate(5);
    	$group_members = DiscussionGroupMember::where('group_id', $group->id)->orderBy('id', 'Desc')->paginate(20);
    	if(Auth::user()){
    		$joining =  DiscussionGroupMember::where('user_id', Auth::user()->id)->where('group_id', $group->id)->first();
    		if(!empty($joining)){
    			$status = 1;
    		}
    	}
    	return view('tools.forum.groupMembers')->with(['groups' => $groups, 'group' => $group, 'group_members' => $group_members, 'recent_members'=> $recent_members, 'status' => $status]);
    }

    public function storeComment(Request $request){
    	$comment = new Comment;
    	$comment->user_id = Auth::user()->id;
    	$comment->discussion_id = $request->discussion_id;
    	if(!empty($request->parent_comment_id)){
    		$comment->parent_comment_id = $request->parent_comment_id;
    	}
    	$comment->description = $request->description;
    	$comment->save();

    	$discussion = Discussion::find($request->discussion_id);
    	return redirect()->route('forum.discussion.detail', $discussion->slug);
    }

    public function updateComment(Request $request, $id){
    	$comment = Comment::find($id);
    	$comment->user_id = Auth::user()->id;
    	$comment->discussion_id = $request->discussion_id;
    	if(!empty($request->parent_comment_id)){
    		$comment->parent_comment_id = $request->parent_comment_id;
    	}
    	$comment->description = $request->description;
    	$comment->save();

    	$discussion = Discussion::find($request->discussion_id);
    	return redirect()->route('forum.discussion.detail', $discussion->slug);
    }

    public function editComment($id){
    	$comment = Comment::find($id);
    	$groups = DiscussionGroup::where('status', 1)->get();
    	return view('tools.forum.editComment')->with(['comment' => $comment, 'groups'=> $groups]);
    }

    public function discussions(Request $request){
    	if($request->has('sort') && $request->sort == 'recent_comments'){
    		$discussions = Discussion::select('discussions.*')->
    		leftjoin('comments', 'discussions.id', '=', 'comments.discussion_id')
		    ->groupBy('discussions.id')
		    ->orderBy('comments.updated_at', 'Desc')
		    ->paginate(15);
    	}elseif($request->has('sort') && $request->sort == 'most_popular'){
    		$discussions = Discussion::select('discussions.*', \DB::Raw('count(comments.id) as comments_count'))
		    ->leftJoin('comments', 'comments.discussion_id', 'discussions.id')
		    ->groupBy('discussions.id')
		    ->orderBy('comments_count', 'DESC')
		    ->paginate(15);
    	}elseif($request->has('sort') && $request->sort == 'most_views'){
    		$discussions = Discussion::select('discussions.*', \DB::Raw('count(views.id) as views_count'))
		    ->leftJoin('views', 'views.discussion_id', 'discussions.id')
		    ->groupBy('discussions.id')
		    ->orderBy('views_count', 'DESC')
		    ->paginate(15);
    	}else{	
    		$discussions = Discussion::whereHas('discussionUserId',function($q)
            {
                $q->where('user_active',1);
            })
            ->with('discussionUserId')->orderBy('updated_at', 'Desc')->paginate(15);
    	}
    	$groups = DiscussionGroup::where('status', 1)->get();
    	return view('tools.forum.discussions')->with(['groups'=> $groups,'discussions' => $discussions]);
    }

    public function groupJoin($slug){
    	$group = DiscussionGroup::FindBySlugOrFail($slug);
    	$member = new DiscussionGroupMember;
    	$member->user_id = Auth::user()->id;
    	$member->group_id = $group->id;
    	$member->save();
    	return redirect()->back();
    }

    public function groupleave($slug){
    	$group = DiscussionGroup::FindBySlugOrFail($slug);
    	$member = DiscussionGroupMember::where('group_id', $group->id)->where('user_id', Auth::user()->id)->first();
    	$member->delete();
    	return redirect()->back();
    }

    public function usersWall($id){
    	$groups = DiscussionGroup::where('status', 1)->get();
    	$user = User::find($id);
        $status  = User::where('id',$id)->first();
         if($status->user_active == 0)
         {
              abort(404);
         }
    	$user_groups = DiscussionGroupMember::where('user_id', $id)->get();
    	$recent_discussions = Discussion::whereHas('discussionUserId',function($q)
            {
                $q->where('user_active',1);
            })
            ->with('discussionUserId')->where('user_id', $id)->orderBy('updated_at', 'Desc')->paginate(10);
    	$top_photos = DiscussionFile::whereHas('discussionFileUserId',function($q)
            {
                $q->where('user_active',1);
            })
            ->with('discussionFileUserId')->where('user_id', $id)->where('type', 'photo')->orderBy('updated_at', 'Desc')->paginate(6);
    	$top_videos = DiscussionFile::whereHas('discussionFileUserId',function($q)
            {
                $q->where('user_active',1);
            })
            ->with('discussionFileUserId')->where('user_id', $id)->where('type', 'video')->orderBy('updated_at', 'Desc')->paginate(6);
    	return view('tools.forum.userWall')->with(['groups'=> $groups, 'user_groups'=> $user_groups, 'top_photos' => $top_photos, 'top_videos'=> $top_videos, 'recent_discussions' => $recent_discussions, 'user' => $user]);
    }

    public function usersDiscussions($id){
    	$user = User::find($id);
    	$groups = DiscussionGroup::where('status', 1)->get();
    	$discussions = Discussion::where('user_id', $id)->orderBy('updated_at', 'Desc')->paginate(15);
    	$user_groups = DiscussionGroupMember::where('user_id', $id)->get();
    	return view('tools.forum.userDiscussions')->with(['groups'=> $groups, 'discussions' => $discussions, 'user_groups'=> $user_groups, 'user'=> $user]);
    }

    public function usersPhotos($id){
        $user = User::find($id);
        $groups = DiscussionGroup::where('status', 1)->get();
        $photos = DiscussionFile::where('user_id', $id)->where('type', 'photo')->orderBy('updated_at', 'Desc')->paginate(20);
        $user_groups = DiscussionGroupMember::where('user_id', $id)->get();
        return view('tools.forum.userPhotos')->with(['groups'=> $groups, 'photos' => $photos, 'user_groups'=> $user_groups, 'user'=> $user]);
    }

    public function usersVideos($id){
        $user = User::find($id);
        $groups = DiscussionGroup::where('status', 1)->get();
        $videos = DiscussionFile::where('user_id', $id)->where('type', 'video')->orderBy('updated_at', 'Desc')->paginate(15);
        $user_groups = DiscussionGroupMember::where('user_id', $id)->get();
        return view('tools.forum.userVideos')->with(['groups'=> $groups, 'videos' => $videos, 'user_groups'=> $user_groups, 'user'=> $user]);
    }

    public function users(){
        $users = User::where('role', 'user')->where('status', 1)->where('user_active',1)->paginate(20);
        $groups = DiscussionGroup::where('status', 1)->get();
        return view('tools.forum.users')->with(['groups'=> $groups, 'users'=> $users]);
    }

    public function groupDiscussions($slug){
        $group = DiscussionGroup::FindBySlugOrFail($slug);
        $groups = DiscussionGroup::where('status', 1)->get();
        $discussions = Discussion::where('group_id', $group->id)->orderBy('updated_at', 'Desc')->paginate(20);
        $recent_members = DiscussionGroupMember::where('group_id', $group->id)->orderBy('id', 'Desc')->paginate(5);
        $status = 0;
        if(Auth::user()){
            $joining =  DiscussionGroupMember::where('user_id', Auth::user()->id)->where('group_id', $group->id)->first();
            if(!empty($joining)){
                $status = 1;
            }
        }
        return view('tools.forum.groupDiscussions')->with(['groups'=> $groups, 'group'=> $group, 'discussions' => $discussions, 'recent_members'=> $recent_members, 'status' => $status]);
    }

    public function groupPhotos($slug){
        $group = DiscussionGroup::FindBySlugOrFail($slug);
        $groups = DiscussionGroup::where('status', 1)->get();
        $photos = DiscussionFile::where('group_id', $group->id)->where('type', 'photo')->orderBy('updated_at', 'Desc')->paginate(20);
        $recent_members = DiscussionGroupMember::where('group_id', $group->id)->orderBy('id', 'Desc')->paginate(5);
        $status = 0;
        if(Auth::user()){
            $joining =  DiscussionGroupMember::where('user_id', Auth::user()->id)->where('group_id', $group->id)->first();
            if(!empty($joining)){
                $status = 1;
            }
        }
        return view('tools.forum.groupPhotos')->with(['groups'=> $groups, 'group'=> $group, 'photos' => $photos, 'recent_members'=> $recent_members, 'status' => $status]);
    }

    public function groupVideos($slug){
        $group = DiscussionGroup::FindBySlugOrFail($slug);
        $groups = DiscussionGroup::where('status', 1)->get();
        $videos = DiscussionFile::where('group_id', $group->id)->where('type', 'video')->orderBy('updated_at', 'Desc')->paginate(20);
        $recent_members = DiscussionGroupMember::where('group_id', $group->id)->orderBy('id', 'Desc')->paginate(5);
        $status = 0;
        if(Auth::user()){
            $joining =  DiscussionGroupMember::where('user_id', Auth::user()->id)->where('group_id', $group->id)->first();
            if(!empty($joining)){
                $status = 1;
            }
        }
        return view('tools.forum.groupVideos')->with(['groups'=> $groups, 'group'=> $group, 'videos' => $videos, 'recent_members'=> $recent_members, 'status' => $status]);
    }

    public function sendRequest(Request $request){
        $sender_id = Auth::user()->id;
        if(!empty($request->reciever_id)){
            $query = new Friend;
            $query->sender_id = $sender_id;
            $query->reciever_id = $request->reciever_id;
            $query->status = 2;
            $query->save();
        }
    }

    public function acceptFriend(Request $request){
        $reciever_id = Auth::user()->id;
        if(!empty($request->sender_id)){
            $result = Friend::where('reciever_id', $reciever_id)->where('sender_id', $request->sender_id)->where('status', 2)->first();
            $result->status = 1;
            $result->save();
        }
    }

    public function cancelRequest(Request $request){
        $sender_id = Auth::user()->id;
        if(!empty($request->reciever_id)){
            $result = Friend::where('reciever_id', $request->reciever_id)->where('sender_id', $sender_id)->where('status', 2)->first();
            $result->delete();
        }
    }

    public function removeFriend(Request $request){
        $other_user_id = $request->other_user_id;
        $request = Friend::where('sender_id', Auth::user()->id)->where('reciever_id', $other_user_id)->first();
        if(empty($request)){
            $request = Friend::where('sender_id', $other_user_id)->where('reciever_id', Auth::user()->id)->first();
        }
        if(!empty($request)){
            $request->delete();
        }
    }

    public function usersFriends($id){
        $user = User::find($id);
        $pending_friends = array();
        $groups = DiscussionGroup::where('status', 1)->get();
        $friends = Friend::where('status', 1)->where(function ($query) use ($user) {$query->where('sender_id', $user->id)->
            orWhere('reciever_id', $user->id); })
            ->paginate(20);
        if(Auth::user()){
            $pending_friends = Friend::where('status', 2)->where('reciever_id', Auth::user()->id)
            ->paginate(10);
        }
        $user_groups = DiscussionGroupMember::where('user_id', $user->id)->get();
        return view('tools.forum.userFriends')->with(['groups'=> $groups, 'friends' => $friends, 'user_groups'=> $user_groups, 'user'=> $user, 'pending_friends'=> $pending_friends]);
    }

    public function usersEvents($id){
        $user = User::find($id);
        $pending_friends = array();
        $groups = DiscussionGroup::where('status', 1)->get();
        $friends = Friend::where('status', 1)->where(function ($query) use ($user) {$query->where('sender_id', $user->id)->
            orWhere('reciever_id', $user->id); })
            ->paginate(20);
        if(Auth::user()){
            $pending_friends = Friend::where('status', 2)->where('reciever_id', Auth::user()->id)
            ->paginate(10);
        }


        $events = UserEvent::where(['user_id' => $user->id])
         ->whereDate('end_date','<',date('Y-m-d')) 
         ->OrderBy('start_date','DESC');

         

        $user_groups = DiscussionGroupMember::where('user_id', $user->id)->get();
        return view('tools.forum.userEvents')
        ->with(['groups'=> $groups, 
                'friends' => $friends, 
                'user_groups'=> $user_groups, 
                'user'=> $user, 
                'events'=> $events, 
                'pending_friends'=> $pending_friends]);
    }




    public function usersEventDetail($id,$slug){
        $user = User::find($id);
        $pending_friends = array();
        $groups = DiscussionGroup::where('status', 1)->get();
        $friends = Friend::where('status', 1)->where(function ($query) use ($user) {$query->where('sender_id', $user->id)->
            orWhere('reciever_id', $user->id); })
            ->paginate(20);
        if(Auth::user()){
            $pending_friends = Friend::where('status', 2)->where('reciever_id', Auth::user()->id)
            ->paginate(10);
        }


        $events = UserEvent::where(['user_id' => $user->id])
         //->whereDate('end_date','<',date('Y-m-d')) 
         ->OrderBy('start_date','DESC');

        $event = UserEvent::where('slug',$slug)
                          ->where('user_id',$user->id);
        if($event->count() == 0){
            abort(404);
        }

        $user_groups = DiscussionGroupMember::where('user_id', $user->id)->get();
         return view('tools.forum.userEventDetail')
              ->with([
                      'groups'=> $groups, 
                      'friends' => $friends, 
                      'user_groups'=> $user_groups, 
                      'user'=> $user, 
                      'user_event'=> $event->first(), 
                      'pending_friends'=> $pending_friends
                    ]);
    }
    public function usersEventRegistrationForm($id,$slug){
        $event = UserEvent::where('slug',$slug)->first();
        $user_event_groups = UserEventGroup::where('user_event_id', $id)->get();
        $user_event_menus = UserEventMenu::where('user_event_id', $id)->get();
        $register_type = RegistrationType::where('event_id', $id)->orderBy('price','ASC')->get();
        $status= "";
        $today = date('Y-m-d');
        if(empty($event->reg_date))
        {
             $date = $event->end_date;
        }
        else{
            $date = $event->reg_date;
        }
        if($date < $today){
             return view('tools.forum.registrationclose');
            
        }
        else{
            return view('tools.forum.registrationForm')->with([
                      'user_event'=> $event,
                      'eventStatus' => $status,
                      'user_event_groups' => $user_event_groups, 
                      'user_event_menus' => $user_event_menus,
                      'register_type'  =>$register_type
                    ]);
       
        }
       
    }
    public function createEventRegistrationForm(Request $request)
    {
    	// return response()->json(['status' => 0,'errors' => $request->all()]);
            $v = \Validator::make($request->all(),[
            	 'event_id' =>'required',
		         'first_name' => 'required',
		         'last_name' => 'required',
		         'email' => 'required',
		         'mobile' => 'required',
                 
            ]);
         if($v->fails()){
       			return response()->json(['status' => 0,'errors' => $v->errors()]);
   		}else{
   			 $e = new EventRegistration;
   			 $e->event_id = $request->event_id;
   			 $e->name = $request->first_name.' '.$request->last_name;
   			 $e->email = $request->email;
   			 $e->mobile = $request->mobile;
             $e->age = $request->age;
             $e->gender = $request->gender;
             $e->user_event_group_id = $request->group;
             $e->user_event_menu_id = $request->menu;
   			 $e->save();
   			 // $user_data = UserEvent::find($request->event_id);
   			 //$this->UserRegistrationEventTrait($request->first_name,$request->email,$request->event_id);
   			return response()->json(['status' => 1]);
   		}
    }

}
