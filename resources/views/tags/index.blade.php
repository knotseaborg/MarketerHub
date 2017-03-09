@extends('main')

@section('title', '| All Tags')

@section('content')
	<div class="row">
		<div class="col-md-7 col-md-offset-1">
			<ol class="breadcrumb">
				<li class="active"><a href="{{ route('tag.index') }}">Tags</a></li>
			</ol>
			<h3>All Tags</h3>
			<Table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Tag</th>
						<th>#Projects</th>
						<th></th>
					</tr>
				</thead>
				@foreach($tags as $tag)
				<tr>
					<td class="col-md-2">
						{{ $tag->id }}
					</td>
					<td class="col-md-4">
						{{ $tag->tag }}
					</td>
					<td class="col-md-4">
						{{ $tag->projects()->count() }}
					</td>
					<td class="col-md-2">
						<button data-toggle="modal" data-tag_id="{{$tag->id}}" data-tag_tag="{{$tag->tag}}" data-url="{{ route('tag.update',$tag->id) }}" data-target="#edit-modal" class="btn btn-primary btn-xs edit">Edit</button>
						<button data-toggle="modal" data-target="#delete-modal" data-url="{{ route('tag.destroy', $tag->id) }}" class="btn btn-danger btn-xs delete" >Delete</button>
					</td>
				</tr>
				@endforeach
			</Table>	
		</div>
		<div class="col-md-3">
			<div class="well">
				<h4 class="text-center">Create New Tag</h4><hr>
				{!! Form::open(['route' => 'tag.store', 'method' => 'post']) !!}
					{{ Form::text('tag', null, ['class' => 'form-control']) }}
					{{ Form::submit('Create New Tag', ['class' => 'form-control btn btn-success btn-block btn-top-space']) }}
				{!! Form::close() !!}
			</div>
		</div>
	</div>

<!-- Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" class="edit-form">
	      <div class="modal-body">
	      	<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<h3>Edit Tag</h3>
						<input type="hidden" name="_method" value="put" class="form-control">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="text" name="tag" class="form-control">
				</div>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary edit-confirm">Save changes</button>
	      </div>
      </form>
    </div>
  </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<p id="message">Confirm Delete</p>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="delete-confirm">Yes</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
	<script>
		$(document).ready(function(){
			var route = "";
			$(".edit").click(function(btn){
				var tag = $(this).data("tag_tag");
				 route = $(this).data("url");
				btn.preventDefault();
				$(".edit-form").find("input:text").val(tag);
				$(".edit-form").attr("action",route);
			});
			var remove_item = "";
			$(".delete").click(function(){
				route = $(this).data("url");
				remove_item = $(this).closest("tr");
			});
			$("#delete-confirm").click(function(){
				$.ajax({
					type: "post",
					url: route,
					data: {_method: "delete", _token:"{{ csrf_token() }}" },
					success: function(){
						remove_item.remove();
					}
				});
			});
		});
	</script>
@endsection