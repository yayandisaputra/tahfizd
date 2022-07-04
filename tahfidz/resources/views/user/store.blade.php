@extends('master')

@section('title', '')

@section('content')
	
	<form method="post" action="{{ route('store-user') }}">

		@csrf

		<div class="form-group">
			<label>Username</label>
			<input type="text" class="form-control" value="" name="username">
			@if ($errors->has('username'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('username') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" value="" name="email">
			@if ($errors->has('username'))
			    <div class="email"><p style="color: red"><span>&#42;</span> {{ $errors->first('email') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<label>Nama</label>
			<input type="text" class="form-control" value="" name="full_name">
			@if ($errors->has('full_name'))
			    <div class="email"><p style="color: red"><span>&#42;</span> {{ $errors->first('full_name') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<label for="sel1">Tipe Akun</label>
			<select class="form-control" name="account_type">
				<option value="{{ User::ACCOUNT_TYPE_ADMIN }}" >Admin</option>
				<option value="{{ User::ACCOUNT_TYPE_TEACHER }}" >Guru</option>
				<option value="{{ User::ACCOUNT_TYPE_SISWA }}" >Siswa</option>
			</select>
		</div>

		<div class="form-group">
			<label>Tempat Lahir</label>
			<input type="text" class="form-control" value="" name="tempat_lahir">
			@if ($errors->has('tempat_lahir'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('tempat_lahir') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<label>Tanggal Lahir</label>
			<input type="date" class="form-control" value="" name="tgl">
			@if ($errors->has('tgl'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('tgl') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<label>Jenis Kelamin</label>
			<div>
				<input type="radio" value="laki-laki" name="jk" checked/> Laki-Laki
				<input type="radio" value="perempuan" name="jk"/> Perempuan
			</div>
		</div>

		<div class="form-group">
			<label>Alamat</label>
			<textarea class="form-control" rows="3" name="address"></textarea>
			@if ($errors->has('address'))
			    <div class="address"><p style="color: red"><span>&#42;</span> {{ $errors->first('address') }}</p></div>
			@endif
		</div>
		<div class="form-group">
			<label>Nomor HP</label>
			<input type="number" class="form-control" name="no_hp">
			@if ($errors->has('no_hp'))
			    <div class="no_hp"><p style="color: red"><span>&#42;</span> {{ $errors->first('no_hp') }}</p></div>
			@endif
		  </div>

		<div class="form-group col-md-6" style="padding-left: 0px">
			<label>Password</label>
			<input type="password" class="form-control" value="" name="password">
			@if ($errors->has('password'))
			    <div class="password"><p style="color: red"><span>&#42;</span> {{ $errors->first('password') }}</p></div>
			@endif
		</div>

		<div class="form-group col-md-6" style="padding-left: 0px">
			<label>Re Password</label>
			<input type="password" class="form-control" value="" name="password_confirmation">
			@if ($errors->has('password'))
			    <div class="password"><p style="color: red"><span>&#42;</span> {{ $errors->first('password') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-info"> TAMBAH </button>
		</div>

	</form>
	
@endsection