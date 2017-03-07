@extends('main')

@section('title', '| Type Creation')

@section('content')
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="create well">
				<h4 class="text-center">Are you sure ?</h4>
			{!! Form::open(['route' => ['category_type.destroy', $category_type->id], 'method' =>'DELETE']) !!}
				<h4><label>Category-Type:</label>  {{ $category_type->type }}</h4>
				<p>if you delete this category type, then all the categories associated with this will also be delete.</p>
				{{ Form::submit('Confirm Delete', ['class' => 'btn btn-danger btn-block btn-top-space'])}}
			{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection