@extends('main')

@section('title', '| Type Creation')

@section('content')
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<ol class="breadcrumb">
			  <li><a href="{{ route('category.index') }}">Categories</a></li>
			  <li class="active">Delete</li>
			</ol>
			<div class="create well">
				<h3 class="text-center">Are you sure ?</h3>
			{!! Form::open(['route' => ['category.destroy', $category->id], 'method' =>'DELETE']) !!}
				<h4><label>Category:</label>  {{ $category->category }}</h4>
				<h4><label>Type:</label>  {{ $category->category_type->type }}</h4>
				{{ Form::submit('Confirm Delete', ['class' => 'btn btn-danger btn-block btn-top-space'])}}
			{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection