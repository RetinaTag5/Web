@extends('layouts.page')

@section('leftcol')
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
@endsection

@section('middlecol')
<!-- Middle Column -->
@if (count($posts) === 0)
   <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <br/>
		<strong>&nbsp &nbsp  Opps &nbsp !!! &nbsp 尚未有發文! &nbsp
		...<a href="{{ route('post.create') }}" >請編輯文章</a>
	    </strong>
		<br/> 
		<br/> 
	</div> 
     
@else
	 @foreach($posts as $post)
     <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
		<span class="w3-right ">
		</span>
		<span class="w3-right w3-opacity">&emsp;</span>

		<span class="w3-right w3-opacity">{{Date($post->created_at)}}</span>
		@if( Auth::user()->id === $post->userid)	
			<img src="https://goo.gl/uFMReW"
			class="w3-circle" style="height:50px;width:50px" alt="Avatar">&nbsp &nbsp{{Auth::user()->name}}</img>     
			
		@else
			@foreach($users as $user)
			<img src="https://goo.gl/SG6WHR"
			class="w3-circle" style="height:50px;width:50px" alt="Avatar">&nbsp &nbsp{{$user->name}}</img>     
		    @endforeach
		@endif
		<hr class="w3-clear">
		<p>
		{{$post->content}}
		</p>
<!-- Post Button -->		
		<!--document.getElementById('like-pic-{{$post->postid}}').style.color='yellow'-->
		@php
			$likethumb = new App\likethumb;
			$likeornot = $likethumb->likeornot($post->postid);
		@endphp
		<button  title="{{$likeornot}}" type="button" onclick="event.preventDefault();
					document.getElementById('thumb-{{$post->postid}}').submit();" 
		class="w3-button w3-theme-d2 w3-margin-bottom d">{{App\post::find($post->postid)->likethumbs->count()}} <i id="like-pic-{{$post->postid}}" class="fa fa-thumbs-up fa-fw w3-margin-right"></i>{{$likeornot}} </button> 
        <form id="thumb-{{$post->postid}}" action="{{route('likethumb.store')}}" method="post" style="display:none;">
			<input type="hidden" name="postId" value="{{$post->postid}}" />
			<input type="hidden" name="like" value="{{$likeornot}}"/>
			@csrf
		</form>
		<button title="載入留言" type="button" onclick="myFunction('loadcomments{{$post->postid}}')" class="w3-button w3-theme-d2 w3-margin-bottom"></i>Comment</button>
		<button  title="編輯文章" onclick="event.preventDefault();
							 document.getElementById('edit-form-{{$post->postid}}').submit();" 
							 class="w3-button w3-theme-d2 w3-margin-bottom " type="button" aria-haspopup="true" aria-expanded="false">
			
				Edit
		</button>
		<button title="刪除文章" onclick="event.preventDefault();
							 document.getElementById('delete-form-{{$post->postid}}').submit();"
							 class="w3-button w3-theme-d2 w3-margin-bottom " type="button" aria-haspopup="true" aria-expanded="false">
			
				Del
		</button>
			<form id="edit-form-{{$post->postid}}" action="{{ route('post.edit', $post->postid) }}" method="get" style="display: none;">
				@csrf
			</form>
			

			<form id="delete-form-{{$post->postid}}" action="{{ route('post.destroy', $post->postid) }}" method="post" style="display: none;">
				{{method_field('DELETE')}}
				@csrf
			</form>
		</hr>			
		<div class="input-group" style="width:100%">
			<form class="input-group" style="width:100%" id="comment-form-{{$post->postid}}" action="{{ route('comment.store') }}" method="post">
			@csrf
				<input type="hidden" name="postId" value="{{$post->postid}}"/>
				<input id="content" type="text" class="form-control w3-border form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" placeholder="Add some new comments" name="content" value="{{ old('content') }}" required autofocus />
				
				@if ($errors->has('content'))
					<span class="invalid-feedback">
						<strong>{{ $errors->first('content') }}</strong>
					</span>
				@endif

				<div class="input-group-btn">
					<button onclick="event.preventDefault();
					document.getElementById('comment-form-{{$post->postid}}').submit()" class="btn btn-default" type="submit" title="submit"><i class="glyphicon glyphicon-enter">送出</i></button>
				</div>
			</form>	
		</div>
		</br>
		<div id="loadcomments{{$post->postid}}" class="w3-hide w3-container" >
		    <div class="=w3-container" style="height:auto;overflow:auto;">	
			@php
				$friendinfo = new App\friendship;
			@endphp
			@if(count(App\post::find($post->postid)->comments) === 0)
				<p><strong> 尚未有任何留言 </strong></p>
				<hr class="w3-clear">
			@else
				@foreach(App\post::find($post->postid)->comments as $comment)
				<p>
				@php
				 $comment_user = $friendinfo->getfriendname($comment->loginid)->id;
				 if($comment_user == auth()->id())
					$path = "https://goo.gl/uFMReW";
				else
					$path = "https://goo.gl/SG6WHR";
				@endphp
				<a onclick="event.preventDefault();
				document.getElementById('a-{{$comment_user}}').submit();"class=" w3-button w3-theme-l1 " >
				<img src="{{$path}}"
					class="w3-circle" style="height:20px;width:20px" alt="Avatar">
				{{$friendinfo->getfriendname($comment->loginid)->name}}</a> </p>
				<p> {{$comment->content}}</p>
				<form id="a-{{$comment_user}}" method="POST" action="/UserPage/{{$comment_user}}" style="display:none;">
					@csrf
					<input type="hidden" name="userId" value="{{$comment_user}}"/>
				</form>
				
				<hr class="w3-clear">
			@endforeach
			@endif

			</div>
<!-- Post Button End-->	

        </div>
	  </div> 
     @endforeach
@endif
    

<!-- End Middle Column -->
@endsection

@section('rightcol')

@endsection

