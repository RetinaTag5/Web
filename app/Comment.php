<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
	protected $connection ='mysql';
	protected $table = 'comments';
	protected $primaryKey = 'commentId';
	protected $fillable = array(
		'postId', 'loginid', 'content'
	);
	public $timestamps = false;
	
	public function post()
	{
		return $this->belongsTo('App\post', 'commentId');
	}
}
