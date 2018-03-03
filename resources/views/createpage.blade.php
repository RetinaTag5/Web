@extends('layouts.page')

@section('leftcol')
    <!-- Left Column -->
    <!-- Left Column -->
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
		@foreach($users as $user)
         <h4 class="w3-center">我的個人資料</h4>
         <p class="w3-center">
			<img src="https://goo.gl/uFMReW"
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
         
<!-- End Left Column -->   
    
    <!-- End Left Column -->   
@endsection

@section('middlecol')
<!-- Middle Column -->    
     <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding" style="height:355px">
			  <form method="POST" action="{{ route('post.store') }}">
				@csrf
			  <h6 class="w3-opacity">&nbsp在想些甚麼?</h6>
              <hr>
			  <textarea id="content" type="text" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" contenteditable="true" style="width:100%;height:200px" name="content" value="{{ old('content') }}" required autofocus></textarea>

					@if ($errors->has('content'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('content') }}</strong>
						</span>
					@endif
			  <br/>
			  <button type="submit" class="w3-button w3-theme"><i class="fa fa-pencil"></i>  Post</button> 
			  </form>
			</div>
          </div>
        </div>
      </div>
          
<!-- End Middle Column -->
@endsection

@section('rightcol')

@endsection