@extends('main')

@section('title', '| Type Creation')

@section('content')
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<ol class="breadcrumb">
			  <li><a href="{{ route('category.index') }}">Categories</a></li>
			  <li class="active">Edit</li>
			</ol>
			<div class="create well">
				<h4>Edit Category</h4>
			{!! Form::model($category,['route' => ['category.update', $category->id], 'method' =>'PUT']) !!}
				{{ Form::label('category', 'Category: ') }}
				{{ Form::text('category',  null, ['class' => 'form-control']) }}

				{{ Form::label('category_type_id', 'Category Type: ') }}
				{{ Form::select('category_type_id', $category_types, null, ['class' => 'form-control type-select'])}}

				{{ Form::submit('Save Category type', ['class' => 'btn btn-success btn-block btn-top-space'])}}
			{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
  $(".type-select").select2({
  	placeholder: "Choose Category",
  	allowClear: true
  });
});
</script>
@endsection