<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class likethumb extends Model
{
    //
	protected $table ='likethumbs';
	protected $fillable= array('like', 'postId', 'loginid');
	public $timestamps = false;
	public function post()
	{
		return $this->belongsTo('App\post', 'postId');
	}
	
	public function likeornot($postId)
	{
		$loginid = auth()->id();
		$likeornot = likethumb::where(['postId'=> $postId, 'loginid' => $loginid])->get();
		if(count($likeornot) == 0)
			return 'Like';
		else return 'Dislike';
	}
}
