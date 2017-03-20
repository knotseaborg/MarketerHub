@extends('main')

@section('title', '| Search Category')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h4>Search for Companies</h4>
			{!! Form::open(['route' => '']) !!}
				{{ Form::label('sector_id', 'Sector: ') }}
				{{ Form::select('sector_id', $var, null, ['class' => 'select2']) }}
				{{ Form::label('location_id', 'Location: ') }}
				{{ Form::select('location_id', $var, null, ['class' => 'select2']) }}
				{{ Form::submit('search', ['class' => 'btn btn-success']) }}
				{{ Form:: }}
			{!! Form::close() !!}		
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1 search-data">
			
		</div>
	</div>
@endsection