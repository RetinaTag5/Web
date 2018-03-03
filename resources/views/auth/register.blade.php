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
        <div class="card-header">註冊帳戶</div>
		<div class="card-body">
			<form method="POST" action="{{ route('register') }}">
				@csrf
			<!-- Name-->
			<div class="form-group row">
				<label for="name" class="col-md-4 col-form-label text-md-right">名字</label>

				<div class="col-md-6">
					<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

					@if ($errors->has('name'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
					@endif
				</div>
			</div>
			<!-- Name END-->
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
			<!-- Password-->
			<div class="form-group row">
				<label for="email" class="col-md-4 col-form-label text-md-right">電子郵件</label>

				<div class="col-md-6">
					<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

					@if ($errors->has('email'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif
				</div>
			</div>
			<!-- Password END-->
			<!-- Password -->
			<div class="form-group row">
				<label for="password" class="col-md-4 col-form-label text-md-right">密碼</label>

				<div class="col-md-6">
					<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

					@if ($errors->has('password'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
				</div>
			</div>
			<!-- Password END-->
			<!-- Confirm Password -->
			<div class="form-group row">
				<label for="password-confirm" class="col-md-4 col-form-label text-md-right">確認密碼</label>

				<div class="col-md-6">
					<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
				</div>
			</div>
			<!-- Confirm Password END-->
			<!-- Register Button -->
			<div class="form-group row mb-0">
				<div class="col-md-6 offset-md-4">
					<button type="submit" class="btn btn-primary">
						確認
					</button>
				</div>
			</div>
			<!-- Register Button END-->
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
<script>
$(document).ready(function() {
$("#hometown").msDropdown();
})

  $(function() {
    $("#birthday").datepicker({
      showOtherMonths : true,
      hideIfNoPrevNext : true,
    });
  });
</script>
