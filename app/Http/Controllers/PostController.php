<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use Illuminate\Support\Facades\Auth;
use DB;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function index()
    {
        //
		return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$users = DB::table('users')->where('id','=',auth()->id())->get();
		return View('createpage')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		
		$validatedData = $this->validate($request,[
        'content' => 'required|max:150',
		]);
				
		$post_store_table = 'posts';
		$id = auth()->id();
		$content = $request->input('content');
		
		$addpost = new post;
		$addpost->userid = $id;
		$addpost->content = $content;
		$addpost->save();
		
		return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
		return redirect()->route('post.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$post_store_table = 'posts';
		$editpost = DB::table($post_store_table)->where('postid', '=', $id)->get();
		
		$post_user = post::find($id)->userid;
		if(auth()->id() != $post_user )
			return redirect()->route('home');
		$users = DB::table('users')->where('id','=',auth()->id())->get();
		return View('editpage')->with(['editpost' => $editpost, 'users' => $users]);
		
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
		$post_store_table = 'posts';
		$content = $request->input('content');
		DB::table($post_store_table)
		->where('postid', $id)->update(['content' => $content]);
		
		return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		$post_store_table = 'posts';
		DB::table($post_store_table)->where('postid', '=', $id)->delete();
		
		return redirect()->route('home');
    }
}
