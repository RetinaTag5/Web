<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\likethumb;
use Illuminate\Support\Facades\Auth;
use DB;
use App\post;
use Route;
class LikeThumbController extends Controller
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
		return redirect()->route('home');
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
		$users = DB::table('users')->where('id','=',$userid->userid);
		return redirect('/UserPage/'.$userid->userid);

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
		return redirect()->route('home');
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
		return redirect()->route('home');
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
		return redirect()->route('home');
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
		return redirect()->route('home');
    }
}
