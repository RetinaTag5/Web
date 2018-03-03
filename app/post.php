<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    //
	protected $table = 'posts';
	protected $primaryKey = 'postid';
	protected $fillable=array('userid','content');
	
	public function comments()
	{
		return $this->hasMany('App\Comment', 'postid');
	}
	
	public function likethumbs()
	{
		return $this->hasMany('App\likethumb', 'postid');
	}
	
	public function countlikethumbs()
	{
		return count(likethumbs());
	}
}
