@extends('main')

@section('title', '| Index')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<ol class="breadcrumb">
			  <li><a href="{{ url('profile/projects') }}">Profile</a></li>
			  <li class="active">All Projects</li>
			</ol>
			<a href="{{ route('project.create') }}" class="btn btn-primary btn-xs">Create New Project</a>
			<div class="panel panel-default top-space">
				<div class="panel-heading">All Projects</div>
				<div class="panel-body">
					@foreach($projects as $project)
						<div class="row">
							<div class="col-md-3"><a href="{{ route('project.show', $project->id) }}">{{ $project->name }}</a>
								<p class="small-grey-text">Published at {{ date('j M Y',strtotime($project->created_at)) }}</p>
							</div>
							<div class="col-md-7">{{ substr($project->summary,0 ,270) }}{{ strlen($project->summary) > 270 ? '...' : '' }}</div>
							<div class="col-md-2">Other stuffs</div>
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