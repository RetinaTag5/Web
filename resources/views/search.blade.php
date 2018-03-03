@extends('layouts.page')

@section('leftcol')
    <!-- Left Column -->
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
		@php
		  $logins = DB::table('users')->where('id','=', auth()->id())->get();
		@endphp
		@foreach($logins as $login)
         <h4 class="w3-center">我的個人資料</h4>
         <p class="w3-center">
			<img src="https://goo.gl/uFMReW"
			class="w3-circle" style="height:106px;width:106px" alt="Avatar"></img></p>
         </p>
         <hr>
         <p><i class="fa fa-circle fa-fw w3-margin-right w3-text-theme"></i> {{$login->name}}</p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> {{$login->hometown}}</p>
         <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> {{$login->birthday}}</p>
        @endforeach
		</div>
      </div>
      <br>
      
      <!-- Accordion -->
	  @php
	  $friend = new App\friendship;
	  $myfriends = $friend->myfriend(auth()->id());
	  @endphp
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> 我的朋友 </button>
          <div id="Demo1" class="w3-hide w3-container">
            
			@if(count($myfriends) === 0)
				<br/><p> 尚未有任何朋友 </p>
			@else
				<br>
			
				@foreach($myfriends as $f)
					@php
					  $getfriend = $friend->getfriendname($f->user_c);
					@endphp
				 <p>
				 <a onclick="event.preventDefault();
	document.getElementById('link-{{$getfriend->id}}').submit();" class=" w3-button" style="width:100%">
				 <img src="https://goo.gl/SG6WHR"
					class="w3-circle" style="height:30px;width:30px" alt="Avatar">
					
				 {{$getfriend->name}}</a>
				 
				 <form id="link-{{$getfriend->id}}" method="POST" action="/UserPage/{{$getfriend->id}}" style="display:none;">
					@csrf
					<input type="hidden" name="userId" value="{{$getfriend->id}}"/>
				</form>	
				 </img>
         
				 </p>
				@endforeach
			@endif
          </div>
          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> 交友請求 </button>   
		  <div id="Demo2" class="w3-hide w3-container">
		  @php
		  $myfriends = $friend->needreply(auth()->id());
		  @endphp
            @if(count($myfriends) === 0)
				<br/><p> 目前無交友請求</p>
			@else
				<br>
			
				@foreach($myfriends as $f)
					@php
					  $getfriend = $friend->getfriendname($f->user_r);
					@endphp

				<p>
				<div ="demo-{{$getfriend->id}}">	
				<a onclick="event.preventDefault();
		document.getElementById('link-{{$getfriend->id}}').submit();" class=" w3-button" style="width:100%">
					 <img src="https://goo.gl/SG6WHR"
						class="w3-circle" style="height:30px;width:30px" alt="Avatar">
						
					 {{$getfriend->name}}</a>
					 
					 <form id="link-{{$getfriend->id}}" method="POST" action="/UserPage/{{$getfriend->id}}" style="display:none;">
						@csrf
						<input type="hidden" name="userId" value="{{$getfriend->id}}"/>
					</form>	
					 </img>
					 <form id="accept-{{$getfriend->id}}" method="POST" action="{{route('acceptfriend')}}" style="display: none;">
						<input type="hidden" name="id" value="{{$getfriend->id}}">
						@csrf
					</form>
					<form id="reject-{{$getfriend->id}}" method="POST" action="{{route('declinefriend')}}" style="display: none;">
						<input type="hidden" name="id" value="{{$getfriend->id}}">
						@csrf
					</form>
					<p class="w3-center"><button 
					onclick="event.preventDefault();
							document.getElementById('accept-{{$getfriend->id}}').submit();"
					id="accept-{{$getfriend->id}}" class="w3-center  w3-button w3-theme-d2" >接受</button>
					
					<button
					onclick="event.preventDefault();
							document.getElementById('reject-{{$getfriend->id}}').submit();"					 
					 id="reject-{{$getfriend->id}}" class="w3-center w3-button w3-theme-d2">拒絕</button>
					 </p>
					<hr>
				</div>
				@endforeach
			@endif
          </div>
		  </div>
          <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> 等待回覆</button>
          <div id="Demo3" class="w3-hide w3-container">
         <div class="w3-row-padding">
         
          @php
		  $myfriends = $friend->myrequest(auth()->id());
		  @endphp
            @if(count($myfriends) === 0)
				<br>
			    <p> 尚未向其他使用者申請加入好友</p>
			@else
				<br>
			
				@foreach($myfriends as $f)
					@php
					  $getfriend = $friend->getfriendname($f->user_c);
					@endphp
				 <p>
				 <a onclick="event.preventDefault();
	document.getElementById('wait-{{$getfriend->id}}').submit();" class=" w3-button" style="width:100%">
				 <img src="https://goo.gl/SG6WHR"
					class="w3-circle" style="height:30px;width:30px" alt="Avatar">
					
				 {{$getfriend->name}}</a>
				 
				 <form id="wait-{{$getfriend->id}}" method="POST" action="/UserPage/{{$getfriend->id}}" style="display:none;">
					@csrf
					<input type="hidden" name="userId" value="{{$getfriend->id}}"/>
				</form>	
				 </img>
         
				 </p>
				@endforeach
			@endif
		 </div>
          </div>
        </div>      
    
        <br>
         
@endsection

@section('middlecol')
<!-- Middle Column -->
 <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
    <span class="w3-left w3-opacity"> 搜尋 : "{{$search}}" &nbsp 的結果</span>
	<br/>
@if (count($users) === 0)

	<hr class="w3-clear">
	<p class="w3-left w3-opacity"><strong>Opps&nbsp !&nbsp 未找到符合&nbsp "{{$search}}"&nbsp 的使用者</strong></p>
    <br/>
	<br/>
@else
	<hr class="w3-clear">
	@foreach($users as $user)
		@if($user->id === auth()->id())
			@continue
		@endif
	<div>
	<span class="w3-right ">

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
		case 2: $relation  = "接受";$nextvalue = 1; break;
		case 3: $relation  = "等待回覆";$nextvalue = 2; break;			
	}
	@endphp

	<form id="fried-{{$user->id}}" method="POST" action="{{route('AddFriend')}}" style="display:none;">
	@csrf
		<input type="hidden" name="search" value="{{$search}}"/>
		<input type="hidden" name="userId" value="{{$user->id}}"/>
		<input type="hidden" name="relation" value="{{$nextvalue}}"/>
	</form>
	<button onclick="event.preventDefault();
	document.getElementById('fried-{{$user->id}}').submit();" class="w3-button w3-block w3-theme-l4">{{$relation}}</button>				
<!-- Add Friend End-->
	</span>

<!-- Link -->
	<form id="link-{{$user->id}}" method="POST" action="/UserPage/{{$user->id}}" style="display:none;">
	@csrf
		<input type="hidden" name="userId" value="{{$user->id}}"/>
	</form>
	<button onclick="event.preventDefault();
	document.getElementById('link-{{$user->id}}').submit();" class="w3-button ">&nbsp&nbsp{{$user->name}}</button>				
<!-- Link End-->
	<span class="w3-right w3-opacity"> {{$user->email}}&nbsp &nbsp </span>
    </div>
	<hr>
	@endforeach	
	
	
@endif
</div> 
    

<!-- End Middle Column -->
@endsection

@section('rightcol')

@endsection