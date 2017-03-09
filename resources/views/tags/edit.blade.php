@extends('main')

@section('title', '| Edit Tag')

@section('content')
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h3>Edit Tag</h3>
			{!! Form::model($tag, ['route' => ['tag.update', $tag->id], 'method' => 'PUT']) !!}
				{{ Form::text('tag', null, ['class' => 'form-control']) }}
				{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block btn-top-space']) }}
			{!! Form::close() !!}
		</div>
	</div>
@endsection