@extends('main')

@section('title', '| Type Creation')

@section('content')
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<ol class="breadcrumb">
			  <li><a href="{{ route('category_type.index') }}">Category Types</a></li>
			  <li class="active">Edit</li>
			</ol>
			<div class="create well">
				<h4>Edit Category Type</h4>
			{!! Form::model($category_type,['route' => ['category_type.update', $category_type->id], 'method' =>'PUT']) !!}
				{{ Form::label('type', 'Category Type: ') }}
				{{ Form::text('type',  null, ['class' => 'form-control']) }}

				{{ Form::submit('Save Category type', ['class' => 'btn btn-success btn-block btn-top-space'])}}
			{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection