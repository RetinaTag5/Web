@extends('layouts.page')

@section('leftcol')
<div class="w3-col m3">
  <!-- Profile -->
  <div class="w3-container w3-content">
  </div>
<!-- End Left Column -->
</div>
@endsection

@section('middlecol')
<!-- Middle Column -->
  <div class="w3-row-padding">
	<div class="w3-col m12">
	  <div class="w3-card w3-round w3-white">
		<div class="w3-container w3-padding">
			<div class="card-header">Login</div>
			<div class="card-body">
				<form method="POST" action="{{ route('login') }}">
					@csrf

					<div class="form-group row">
						<label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>

						<div class="col-md-6">
							<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

							@if ($errors->has('email'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<div class="form-group row">
						<label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

						<div class="col-md-6">
							<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

							@if ($errors->has('password'))
								<span class="invalid-feedback">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-6 offset-md-4">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
								</label>
							</div>
						</div>
					</div>

					<div class="form-group row mb-0">
						<div class="col-md-8 offset-md-4">
							<button type="submit" class="btn btn-primary">
								Login
							</button>

							<a class="btn btn-link" href="{{ route('password.request') }}">
								Forgot Your Password?
							</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	  </div>
	</div>
  </div>


<!-- End Middle Column -->
@endsection

@section('rightcol')
<!-- Right Column -->
  <div class="w3-container w3-content">
  </div>
<!-- End Right Column -->
</div>
@endsection