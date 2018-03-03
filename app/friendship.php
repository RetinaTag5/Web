<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class friendship extends Model
{
    //
	protected $table = 'friendship';
	protected $primaryKey ="friendshipId";
	public $timestamps = false;
	protected $fillable = [
        'relation', 'user_r', 'user_c'
    ];
	
	public function friendship($authid, $userid){
		$mytable = 'friendship';
		$query = DB::table($mytable)
		->where([
					['user_r','=',$authid],
					['user_c','=',$userid]
				])->get();
		if(count($query)==0)
		{
			$query_2 = DB::table($mytable)
			->where([
				['user_r','=',$userid],
				['user_c','=',$authid],
			])->get();
			if(count($query_2)==0)
			{
				return 0;
			}
			else
			{
				return ($query_2->first()->relation == 0 ? 2 : 1);	//2: accept 1:friend
			}
		}
		else
		{
			return (($query->first()->relation) == 0 ? 3 : 1);	//3:request 1:friend
		}
	}


	public function myfriend($id)
	{
		$mytable = 'friendship';
		$query = DB::table($mytable)
		->where([
					['user_r','=',$id],
					['relation','=','1']
				])->get();

		return $query;

	}
	//等待回覆
	public function myrequest($id)
	{
		$mytable = 'friendship';
		$query = DB::table($mytable)
		->where([
					['user_r','=',$id],
					['relation','=','0']
				])->get();

		return $query;

	}
	//交友請求
	public function needreply($id)
	{
		$mytable = 'friendship';
		$query = DB::table($mytable)
		->where([
					['user_c','=',$id],
					['relation','=','0']
				])->get();

		return $query;

	}
	public function getfriendname($id)
	{
		$mytable = 'users';
		$query = DB::table($mytable)->find($id);
		return $query;
	}

}
