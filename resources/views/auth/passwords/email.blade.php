@extends('layouts.page')
<meta http-equiv="refresh" content="3;url={{route('home')}}" />
@section('leftcol')
<div class="w3-col m3">
  <!-- Profile -->
  <div class="w3-container w3-content">
  </div>
<!-- End Left Column -->
</div>
@endsection

@section('middlecol')
<div class="container">
	<!--add-->	
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reset Password</div>
@if(false)
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
@else
				<br/>
				<p><strong>&nbsp &nbsp  Opps &nbsp !!! &nbsp 現在尚未支援此功能! &nbsp
				...<a href="{{route('home')}}">&nbsp 回上一頁</a></strong><p>
				<br/>  
				 
@endif
			</div>
        </div>
    </div>

</div>
@endsection

@section('rightcol')
<!-- Right Column -->
  <div class="w3-container w3-content">
  </div>
<!-- End Right Column -->
</div>
@endsection