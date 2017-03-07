@extends('main')

@section('title', '| Type Creation')

@section('content')
	<div class="row">
		<div class="col-md-7 col-md-offset-1">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Category Type</th>
						<th>Categories</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($category_types as $category_type)
					<tr>
						<td class="col-md-2">{{ $category_type->id }}</td>
						<td class="col-md-4"><a href="{{ route('category_type.show', $category_type->id) }}">{{ $category_type->type }}</a></td>
						<td class="col-md-2"></td>
						<td class="col-md-4 text-center">
							<a href="{{ route('category_type.edit', $category_type->id) }}" class="btn btn-primary btn-xs" >Edit</a>
							<button data-toggle="modal" data-target="#delete_confirm" class="btn btn-danger btn-xs confirm" data-token="{{ csrf_token() }}" data-link="{{ route('category_type.destroy', $category_type->id) }}" >Delete</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-3">
			<div class="create well">
				<h4>New Category Type</h4>
			{!! Form::open(['route' => 'category_type.store', 'method' =>'POST']) !!}
				{{ Form::label('type', 'Category Type: ') }}
				{{ Form::text('type',  null, ['class' => 'form-control']) }}

				{{ Form::submit('Create New Type', ['class' => 'btn btn-primary btn-block btn-top-space confirm'])}}
			{!! Form::close() !!}
			</div>
		</div>

<!-- Modal -->
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-center">Delete Category Type</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <h4>Are you sure?</h4>
        <p>If you delete this category type, then all the categories associated with this will also be delete</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger btn-block submit" data-dismiss="modal">Yes</button>
      </div>
    </div>
  </div>
</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
	$(document).ready(function(){
		var current_confirm;
		$(".confirm").click(function(btn){
			current_confirm = $(this);
		});

		$(".submit").click(function(btn){
			btn.preventDefault();
			var token = current_confirm.data('token');
			var route = current_confirm.data('link');
			$.ajax({
				type: "post",
				url: route,
				data: {_method : 'delete', _token : token},
				success: function(data){
					current_confirm.closest('tr').remove();
				}
			});
		});

	});
	</script>
@endsection
