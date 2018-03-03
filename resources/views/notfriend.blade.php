@extends('layouts.page')

@section('leftcol')
    <!-- Left Column -->
	    <!-- Left Column -->
		<br/>
		<br/><a href="{{ route('home') }}" class="w3-button w3-block w3-theme-l1 w3-left-alignw3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>回我的主頁</a>   
		 <br/>
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
		@php
			$users = DB::table('users')->where('id','=',$notfriend)->get();
		@endphp
		@foreach($users as $user)
         <h4 class="w3-center">{{$user->name}}的個人資料</h4>
         <p class="w3-center">
			<img src="https://goo.gl/SG6WHR"
			class="w3-circle" style="height:106px;width:106px" alt="Avatar"></img></p>
         </p>
         <hr>
         <p><i class="fa fa-circle fa-fw w3-margin-right w3-text-theme"></i> {{$user->name}}</p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> {{$user->hometown}}</p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> {{$user->birthday}}</p>
        @endforeach
		</div>
      </div>
      <br>
      
      
    <!-- End Left Column -->   
@endsection

@section('middlecol')
<!-- Middle Column -->
<div class="w3-col m12">

  <div class="w3-row-padding">
	<div class="w3-col m12" >
	  <div class="w3-card w3-round w3-white">
		<div class="w3-container w3-padding" style="height: 500px">
		@php
			$users = DB::table('users')->where('id','=',$notfriend)->get();
		@endphp
		 @foreach($users as $user)
		 <br/><br/>
		 <p class="w3-center"><strong>&nbsp&nbsp抱歉，您尚未與&nbsp{{$user->name}}&nbsp成為朋友</strong></p>
         <p class="w3-center">
			<img src="https://goo.gl/SG6WHR"
			class="w3-circle" style="height:106px;width:106px" alt="Avatar"></img></p>
         </p>
         <hr>
<!-- Add Friend -->
	@php
	$relation  = "加朋友";
	$nextvalue = 1;
	$friendship = new App\friendship;
	
	$result = $friendship->friendship(auth()->id(),$user->id);
	switch($result)
	{
		case 0: $relation  = "加朋友"; $nextvalue = 3; break;
		case 1: $relation  = "朋友"; $nextvalue = 9; break;
		case 2: $relation  = "您需要接受  {$user->name}  的朋友邀請";$nextvalue = 1; break;
		case 3: $relation  = "等待回覆";$nextvalue = 2; break;			
	}
	@endphp

	<form id="fried-{{$user->id}}" method="POST" action="{{route('AddnoFriend')}}" style="display:none;">
	@csrf
	    <input type="hidden" name="userId" value="{{$user->id}}"/>
		<input type="hidden" name="relation" value="{{$nextvalue}}"/>
	</form>
	<button onclick="event.preventDefault();
	document.getElementById('fried-{{$user->id}}').submit();" class="w3-button w3-block w3-theme-l4">目前狀態為: {{$relation}}</button>				
<!-- Add Friend End-->
	</span>
		 @endforeach
		</div>
	  </div>
	</div>
  </div>


<!-- End Middle Column -->
</div>
@endsection

@section('rightcol')

@endsection