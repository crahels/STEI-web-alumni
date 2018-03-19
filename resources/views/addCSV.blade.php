@extends('layouts.app')

@section('content')
<div class="addContainer">
	<nav class="nav nav-pills nav-justified">
	  <a class="nav-item nav-link active manualAdd" href="/add">
	  	<i class="addMenu">Add Manually</i>
		</a>
	  <a class="nav-item nav-link CSVAdd" href="/addCSV">
	  	<i class="addMenu">Upload CSV</i>
	  </a>
	</nav>
	<div class="addCSVForm">
		<label class="btn btn-default">
    		Browse CSV... <input type="file" hidden>
		</label>
	</div>
</div>
@endsection