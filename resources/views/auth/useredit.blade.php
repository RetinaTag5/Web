@extends('layouts.page')

@section('leftcol')
    <!-- Left Column -->
    <!-- Left Column -->
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
		@php
			$users = DB::table('users')->where('id','=',auth()->id())->get();
		@endphp
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
<div class="w3-col m10">

  <div class="w3-row-padding">
	<div class="w3-col m12">
	  <div class="w3-card w3-round w3-white">
		<div class="w3-container w3-padding">
                <div class="card-header">編輯個人資料</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('/useredit') }}">
                        @csrf
						@foreach($userinfo as $user)
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
									<!-- Birthday-->
			<div class="form-group row">
				<label for="birthday" class="col-md-4 col-form-label text-md-right">生日</label>

				<div class="col-md-6">
				<input id="birthday" type="date" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" name="birthday" value="{{ old('birthday') }}" required>

					@if ($errors->has('birthday'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('birthday') }}</strong>
						</span>
					@endif
				</div>
			</div>
			<!-- Birthday END-->			
			<!-- Hometown-->
			<div class="form-group row">
				<label for="hometown" class="col-md-4 col-form-label text-md-right">國家</label>

				<div class="col-md-6">
				<select name="hometown" id="hometown" class="col-md-4 w3-round  col-form-label text-md-right" >
					  <option selected="selected" value='tw' data-title="Taiwan">台灣</option>
					  <option value='jp' data-title="Japan">日本</option>
					  <option value='kr' data-title="Korea">韓國</option>
					  <option value='usa' data-title="USA">美洲</option>
					  <option value='eu' data-title="Europe">歐洲</option>
					  <option value='oth' data-title="Others">其他</option></select>  
				</div>
			</div>			
			<!-- Hometown END-->	
						@endforeach

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    更改資料
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

		</div>
	  </div>
	</div>
  </div>


<!-- End Middle Column -->
</div>
@endsection
<br/>
@section('rightcol')
<!-- Right Column -->
  <div class="w3-container w3-content">
  </div>
@endsection