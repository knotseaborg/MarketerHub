@extends('main')

@section('title', '| Index')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default top-space">
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6">
							<h4>{{ $user->name }}. <small>All Projects</small></h4>			
						</div>
					</div>
				</div>
				<div class="panel-body">
					@foreach($projects as $project)
						<div class="row">
							<div class="col-md-2"><a href="{{ route('explore.project_show', $project->id)}}">
								<p>{{ $project->name }}</p>
								</a>
								<p class="small-grey-text">Published at {{ date('j M Y',strtotime($project->created_at)) }}</p>
							</div>
							<div class="col-md-8">{{ substr($project->summary,0 ,270) }}{{ strlen($project->summary) > 270 ? '...' : '' }}</div>
							<div class="col-md-2">
								@foreach($project->tags as $tag)
									<label class="label label-default">{{$tag->tag}}</label>
								@endforeach
							</div>
						</div>
						@if(!$loop->last)
							<hr>
						@endif
					@endforeach
				</div>
			</div>
		</div>
		{{ $projects->links() }}
	</div>
@endsection