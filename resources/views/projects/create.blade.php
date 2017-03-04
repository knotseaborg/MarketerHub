@extends('main')

@section('title', '| Create')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3 ">
			<h2>New Project</h2>
			<hr>
			{!! Form::open(['project.store', 'method' => 'POST']) !!}
				{{ Form::label('name', 'Name: ') }}
				{{ Form::text('name',  null, ['class' => 'form-control']) }}

				{{ Form::label('summary', 'Summary: ') }}
				{{ Form::textarea('summary',  null, ['class' => 'form-control', 'rows' => '5']) }}

				{{ Form::label('notes', 'Notes: ') }}
				{{ Form::textarea('notes',  null, ['class' => 'form-control', 'rows' => '5']) }}

				{{ Form::submit('Create project', ['class' => 'btn btn-success btn-block btn-top-space']) }}							
			{!! Form::close() !!}
		</div>
	</div>
@endsection