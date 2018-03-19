@extends('layouts.app')

@section('content')
<div class="addContainer">
	<nav class="nav nav-pills nav-justified">
	  <a class="nav-item nav-link active" href="/add">
	  	<i class="addMenu">Add Manually</i>
		</a>
	  <a class="nav-item nav-link" href="#">
	  	<i class="addMenu">Upload CSV</i>
	  </a>
	</nav>
	<div class="addMemberForm">
		<form>
			<div class="form-group">
		    <label for="exampleInputPassword1">Nama</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Nama Lengkap">
	  	</div>
		  <div class="form-group form-row">
		  	<div class="col">
		  		<label>Email Address</label>
		    	<input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Masukkan email student">
		  	</div>
		  	<div class="col">
		  		<label>NIM</label>
		    	<input type="text" maxlength="8" class="form-control" placeholder="Nomor Induk Mahasiswa">
		  	</div>
		  </div>
		  <div class="form-group">
		    <label>Phone Number</label>
		    <input type="text" class="form-control" placeholder="Nomor Telepon">
	  	</div>
	  	<div class="bottomButton">
  			<button type="submit" class="btn btn-primary submitButton">Submit</button>
  			<a class="btn btn-primary cancelButton" href="/members">
          Cancel
        </a>
	  	</div>
		</form>
	</div>
</div>
@endsection