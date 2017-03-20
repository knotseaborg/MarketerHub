@extends('main')

@section('title' | 'Project')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="row">
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-heading"><span class="h4">{{$project->name}}</span></div>
						<div class="panel-body">
							<p>{{$project->content}}</p>
						</div>
					</div>
				</div>
				<div class="col-md-3 well">
					<div>
						<h4 class="text-center">{{ $project->category->category}}</h4>
						<div class="panel panel-default"><div class="panel-body">{{$project->summary}}</div></div>
						<p>Tags: 
							@foreach($project->tags  as $tag)
								<label class="label label-default">{{ $tag->tag }}</label>
							@endforeach
						</p>
						<p>Created at: {{ date('j M Y, g:i a ',strtotime($project->created_at)) }}</p>
						<p>Updated at: {{ date('j M Y, g:i a ',strtotime($project->updated_at)) }}</p>
					</div>
				</div>
			</div>
		</div>
<!-- Modal -->
<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Delete Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you ready the face the consequences?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger confirm" data-dismiss="modal">Yes</button>
      </div>
    </div>
  </div>
</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
	</script>
@endsection