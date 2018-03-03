<!DOCTYPE html>
<html>
<head>
	<title>FakeBlog</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="js/jquery/jquery-1.8.2.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

	<style>
		html,body,h1,h2,h3,h4,h5 
	</style>
</head>	
<body class="w3-theme-l5">

<!-- TOP -->
<div class="w3-top">
@guest
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openGuestNav()"><i class="fa fa-bars"></i></a>
  <a href="{{ route('home') }}" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>FakeBlog</a>
  <a href="{{ route('register') }}" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">Register</a>
  <a href="{{ route('login') }}" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">Login</a>
</div>
@else
<div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="{{ route('home') }}" class="w3-bar-item w3-button w3-padding-large w3-theme-d4" title="首頁" ><i class="fa fa-home w3-margin-right"></i>FakeBlog</a>
  <div class="w3-dropdown-hover w3-hide-small">
	<button class="w3-button w3-padding-large" title="新增文章"> + </button>     
	<div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
	  <a href="{{ route('post.create') }}" class="w3-bar-item w3-button">新增文章</a>
	</div>
  </div>
  <div class="w3-dropdown-hover w3-hide-small">
	<button class="w3-button w3-padding-large" title="編輯個人資料"><i class="fa fa-user"></i></button>     
	<div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
	  <a href="{{ route('/useredit') }}" class="w3-bar-item w3-button">編輯個人資料</a>
	</div>
  </div>

  
  <div class=" w3-bar-item w3-dropdown-hover w3-hide-small w3-button  w3-padding-large w3-hover-white w3-large w3-theme-d2" >
	<div class="input-group" style="width:300px">
		<form class="input-group" style="width:300px" id="search-form" action="{{route('SearchUser')}}" method="post">
		@csrf
		
		<input type="text" class="form-control" placeholder="Search" name="name" required />
		<div class="input-group-btn">
			<button onclick="event.preventDefault();
			document.getElementById('search-form').submit()" class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		</div>
		
		</form>
		
	</div>
  </div>  
  <a href="{{ route('logout') }}" class="w3-dropdown-hover w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" 
		onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="登出">登出</a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	@csrf
  </form>
</div>
  

@endguest    
 
</div>

<!-- GuestNav -->
<div id="GuestNav" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="{{ route('home') }}" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-home w3-margin-right"></i>FakeBook</a>
  <a href="{{ route('register') }}" class="w3-bar-item w3-button w3-padding-large" title="My Account">Register</a>
  <a href="{{ route('login') }}" class="w3-bar-item w3-button w3-padding-large" title="My Account">Login</a>
</div>
<!-- GuestNav End -->
<!-- Auth Nav -->
<div id="AuthNav" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="{{ route('home') }}" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-home w3-margin-right"></i>FakeBook</a>

  <div class="w3-bar-item w3-button">
	<a href="{{ route('post.create') }}" class="w3-bar-item w3-button">+ &nbsp新增文章</a>
  </div>
  <div class="w3-bar-item w3-button">
	<a href="{{ route('/useredit') }}" class="w3-bar-item w3-button"><i class="fa fa-user"> 編輯個人資料</i></a>
  </div>
 
  <div class="w3-bar-item w3-button w3-col m7"" >
	<div class="input-group" style="width:200px">
		<form class="input-group" style="width:200px" id="search-form" action="{{route('SearchUser')}}" method="post">
		@csrf
		<input type="text" class="form-control" placeholder="Search" name="name">
		<div class="input-group-btn">
			<button onclick="event.preventDefault();
			document.getElementById('search-form').submit()" class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		</div>
		</form>
	</div>
  </div> 
  <div class="w3-bar-item w3-button">
  <a href="{{ route('logout') }}" class="w3-bar-item w3-button" 
		onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="登出"> <i class="fa fa-circle">&nbsp 登出</i><a>
  </div>
</div>
<!-- Auth Nav End -->
<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
		@yield('leftcol')
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
		@yield('middlecol')
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
		 <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
        <p>廣告</p>
		<hr>
		<a href="https://twitter.com/">
		<img src="https://goo.gl/rYphiq"
			style="height:106px;width:106px" alt="Avatar"></img></p>
         </a>
		 
      </div>
      </br>
            <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
        <p>廣告</p>
		<hr>
		<a href="https://www.youtube.com/">
		<img src="https://goo.gl/RLbdwS"
			class="w3-circle" style="height:106px;width:106px" alt="Avatar"></img></p>
         </a>
		 
      </div>
	  </br>
      <div class="w3-card w3-round w3-white w3-padding-32 w3-center">
        <p><i class="fa fa-bug w3-xxlarge"></i></p>
      </div>
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5></h5>
</footer>

<footer class="w3-container w3-theme-d5">
  <p>  
</footer>
 
<script>
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else { 
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openGuestNav() {
    var x = document.getElementById("GuestNav");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
function openNav() {
    var x = document.getElementById("AuthNav");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}

</script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html> 
