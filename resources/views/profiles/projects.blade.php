@extends('profiles.layout')

@section('title', '| Projects')

@section('profile_content')
	<div class="row">
		<div class="col-md-12">
			<div class="top-space panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-9">
							<h4>Popular Projects</h4>
						</div>
						<div class="col-md-2 pull-right">
							<a href="{{ route('project.index') }}" class="btn btn-primary top-space-10 btn-xs">View All Projects</a>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="row left-padding-55">
						@foreach($projects as $project)
							<div class="col-md-5 panel panel-default left-gap-20">
								<div class="panel-body">
									<a href="{{ route('project.show', $project->id) }}">{{ $project->name }}</a>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection