<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HomePageController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function index()
	{
		$post_store_table = 'posts';
		$id = auth()->id();
		$posts = DB::table($post_store_table)->where('userid', $id)->get();
		
		$user_store_table = 'users';
		$users = DB::table($user_store_table)->where('id', $id)->get();
		
		
		return View('home')->with(['posts' => $posts, 'users' => $users]);
 
	}
}
