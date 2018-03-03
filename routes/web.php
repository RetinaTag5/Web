<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomePageController@index')->name('home');

Route::get('/login', function(){
	return view('auth/login');
})->name('login');
Route::get('/notfriend/{id}', function($id){
	if(Auth()->id() == $id)
		return redirect()->route('home');
	return view('notfriend')->with('notfriend',$id);
})->name('notfriend');
Route::post('/UserPageLikethumb','SearchController@UserPageLikethumb')->name('UserPageLikethumb')->middleware(['auth']);
//Route::post('/UserPage','SearchController@UserPage')->name('UserPage')->middleware(['friend', 'auth']);
Route::match(['get', 'post'], '/UserPage/{id}', function($id){
	if(Auth()->id() == $id)
		return redirect()->route('home');
	$friendornot = App\friendship::where([['user_r', '=', Auth()->id()], ['user_c','=', $id], ['relation','=','1']])->get();	
	if(count($friendornot)==0)
		return redirect('/notfriend/'.$id);
	if( Request::isMethod('post') && $_POST['userId'])
	{
		$userid = $_POST['userId'];
		$posts = DB::table('posts')->where('userid','=', $userid)->get();
		
		$users = DB::table('users')->where('id','=',$userid)->get();
		return View('userhome')->with(['posts'=> $posts, "users" => $users]);
	}
	else
	{
		$userid = $id;
		$posts = DB::table('posts')->where('userid','=', $userid)->get();
		
		$users = DB::table('users')->where('id','=',$userid)->get();
		return View('userhome')->with(['posts'=> $posts, "users" => $users]);

	}
})->middleware(['auth']);


Route::post('/SearchUser','SearchController@DoSearch')->name('SearchUser')->middleware('auth');
Route::post('/AddFriend','SearchController@AddFriend')->name('AddFriend')->middleware('auth');

Route::post('/AddnoFriend','SearchController@AddnoFriend')->name('AddnoFriend')->middleware('auth');

Route::post('/declinefriend', 'SearchController@declinefriend')->name('declinefriend')->middleware('auth');
Route::post('/acceptfriend', 'SearchController@acceptfriend')->name('acceptfriend')->middleware('auth');
Route::match(['get', 'post'], '/useredit', function(){
	$users_store_table = 'users';
	$id = auth()->id();
	if( Request::isMethod('post') && $_POST['name'] && $_POST['birthday'] && $_POST['hometown'])
	{
		$hometown = '台灣';

		switch($_POST['hometown']){
		case 'tw': $hometown = '台灣'; break;
		case 'jp': $hometown = '日本'; break;
		case 'kr': $hometown = '韓國'; break;
		case 'eu': $hometown = '歐洲'; break;
		case 'usa': $hometown = '美國'; break;
		case 'oth': $hometown = '其他國家'; break;
		}
		DB::table($users_store_table)->where('id', $id)
		->update(['name' =>  $_POST['name'], 'hometown'=>$hometown, 'birthday' => $_POST['birthday']]);
	}

	$userinfo = DB::table($users_store_table)->where('id', $id)->get();
		
	return View('auth/useredit')->with('userinfo', $userinfo);
})->name('/useredit')->middleware('auth');

Route::resource('likethumb', 'LikeThumbController');
Route::resource('post', 'PostController');
Route::resource('comment', 'CommentController');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');