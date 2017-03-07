@extends('main')

@section('title', '| Type Creation')

@section('content')
	<div class="row">
		<div class="col-md-7 col-md-offset-1">
			<ol class="breadcrumb">
			  <li class="active">Categories</li>
			</ol>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Category</th>
						<th>Category Type</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $category)
					<tr>
						<td class="col-md-2">{{ $category->id }}</td>
						<td class="col-md-4"><a href="{{ route('category.show', $category->id) }}">{{ $category->category }}</a></td>
						<td class="col-md-2">{{ $category->category_type->type }}</td>
						<td class="col-md-4 text-center">
							<a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary btn-xs" >Edit</a>
							<button data-toggle="modal" data-target="#delete_confirm" class="btn btn-danger btn-xs confirm" data-link="{{ route('category.destroy', $category->id) }}">Delete</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-3">
			<div class="create well">
				<h4>New Category</h4>
			{!! Form::open(['route' => 'category.store', 'method' =>'POST']) !!}
				{{ Form::label('category', 'Category: ') }}
				{{ Form::text('category',  null, ['class' => 'form-control']) }}
				{{ Form::label('category_type_id', 'Category Type: ') }}
				{{ Form::select('category_type_id', $category_types, null,['class' => 'form-control type-select', 'placeholder' =>'Choose Category'])}}
							
				{{ Form::submit('Create New Category', ['class' => 'btn btn-primary btn-block btn-top-space'])}}
			{!! Form::close() !!}
			</div>
		</div>

				<!-- Button trigger modal -->
		

		<!-- Modal -->
		<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h3 class="modal-title text-center">Delete Category</h3>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body text-center">

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">No</button>
		        <button type="button" class="btn btn-danger btn-block submit" data-dismiss="modal" data-token="{{ csrf_token() }}">Yes</button>
		      </div>
		    </div>
		  </div>
		</div>

	</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
	var current_confirm;

	$(".type-select").select2({
		placeholder: "Choose Category",
	    allowClear: true
	 });

	$(".confirm").click(function(btn){
		current_confirm = $(this);
		btn.preventDefault();
		$(".modal-body").html("<h3>Are you ready to face the consequences?</h3>");
		//$("submit").data('link') = $(this).data('link') ;
	});

	$(".submit").click(function(btn){
		btn.preventDefault();
		var token = $(this).data('token');
		var route = current_confirm.data('link');
		$("#delete_confirm").show;
		$.ajax({
			type: "post",
			url: route,
			data: {_method: 'delete', _token :token},
			success: function(data){
				current_confirm.closest('tr').remove();
			},
			complete: function(){
			}
		});
	});
});
</script>
@endsection