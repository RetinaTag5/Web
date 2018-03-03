<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\friendship;
use App\users;
use DB;
use App\likethumb;
use App\post;

class SearchController extends Controller
{
    //
	public function DoSearch(Request $request)
	{
		$search = $request->input('name');
		$searchusers = users::where('name', 'like', '%'.$search.'%')->get();
		return View('search')->with(['users' => $searchusers, 'search' => $search]);
	}
	
	public function UserPage(Request $request)
	{
		$userid = $request->input('userId');
		$posts = DB::table('posts')->where('userid','=', $userid)->get();
		
		$users = DB::table('users')->where('id','=',$userid)->get();
		return View('userhome')->with(['posts'=> $posts, "users" => $users]);
	}
	
	public function AddFriend(Request $request)
	{
		$user_r = auth()->id();
		$user_c = $request->input('userId');
		
		$relation = -1;
		switch($request->input('relation'))
		{
			case '1': $relation = 1; break;//accept - become friend
			case '2': break;	//wait reply
			case '3': $relation = 0; break;	//no relationship
			case '9': break;	//friend
		}
		if($relation == 1){
			$result = friendship::updateOrCreate(
			['user_r' => $user_r,'user_c' => $user_c],
			['relation' => '1']
			);
			$result = friendship::updateOrCreate(
			['user_r' => $user_c,'user_c' => $user_r],
			['relation' => '1']
			);
		}else if($relation == 0){
			$result = friendship::updateOrCreate(
			['user_r' => $user_r,'user_c' => $user_c],
			['relation' => '0']
			);
		}
		$search = $request->input('search');
		$searchusers = users::where('name', 'like', '%'.$search.'%')->get();
		return View('search')->with(['users' => $searchusers, 'search' => $search]);
		/*case 0: $relation  = "加朋友"; $nextvalue = 3; break;
		case 1: $relation  = "朋友"; $nextvalue = 9; break;
		case 2: $relation  = "接受";$nextvalue = 1; break;
		case 3: $relation  = "等待回覆";$nextvalue = 2; break;	*/
	}
	public function AddnoFriend(Request $request)
	{
		$user_r = auth()->id();
		$user_c = $request->input('userId');
		
		$relation = -1;
		switch($request->input('relation'))
		{
			case '1': $relation = 1; break;//accept - become friend
			case '2': break;	//wait reply
			case '3': $relation = 0; break;	//no relationship
			case '9': break;	//friend
		}
		if($relation == 1){
			$result = friendship::updateOrCreate(
			['user_r' => $user_r,'user_c' => $user_c],
			['relation' => '1']
			);
			$result = friendship::updateOrCreate(
			['user_r' => $user_c,'user_c' => $user_r],
			['relation' => '1']
			);
			
			
			$posts = DB::table('posts')->where('userid','=', $user_c)->get();
		
			$users = DB::table('users')->where('id','=',$user_c)->get();
		
			
			return View('userhome')->with(['posts'=> $posts, "users" => $users]);
		}else if($relation == 0){
			$result = friendship::updateOrCreate(
			['user_r' => $user_r,'user_c' => $user_c],
			['relation' => '0']
			);
		}
		return redirect('/notfriend/'.$user_c);
		/*case 0: $relation  = "加朋友"; $nextvalue = 3; break;
		case 1: $relation  = "朋友"; $nextvalue = 9; break;
		case 2: $relation  = "接受";$nextvalue = 1; break;
		case 3: $relation  = "等待回覆";$nextvalue = 2; break;	*/
	}
	public function declinefriend(Request $request)
	{
		$id = $request->input('id');
		$result = friendship::where(
		['user_r' => $id,'user_c' => auth()->id()]
		);
		$result->delete();
		$result_2 = friendship::updateOrCreate(
		['user_r' => auth()->id(),'user_c' => $id]
		);
		$result_2->delete();
		return redirect()->route('home');
	}
	public function acceptfriend(Request $request)
	{
		$id = $request->input('id');
		$result = friendship::updateOrCreate(
		['user_r' => $id,'user_c' => auth()->id()],
		['relation' => '1']
		);
		$result = friendship::updateOrCreate(
		['user_r' => auth()->id(),'user_c' => $id],
		['relation' => '1']
		);
		return redirect()->route('home');
	}

	public function UserPageLikethumb(Request $request)
	{
		$like = ($request->input('like')==='Like') ? true : false;
			
		$postId = $request->input('postId');
		$loginid = auth()->id();
		
		if($like)
		{
			
			$likethumb = likethumb::updateOrCreate(
			['postId' => $postId, 'loginid' => $loginid],
			['like' => $like]
		);
		}
		else
		{
			$likethumb = likethumb::where(['postId'=> $postId, 'loginid' => $loginid])
						->delete();
		}
		$userid = post::find($postId);
		
		$posts = DB::table('posts')->where('userid','=',$userid->userid)->get();
		$users = DB::table('users')->where('id','=',$userid->userid)->get();
		return View('userhome')->with(['posts'=> $posts, "users" => $users]);
	}
}
