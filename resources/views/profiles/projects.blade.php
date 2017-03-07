@extends('profiles.layout')

@section('title', '| Projects')

@section('profile_content')
	<div class="
			row">
		<div class="col-md-12">
			<a href="{{ route('project.index') }}" class="btn btn-primary btn-top-space btn-xs">View All Projects</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="top-space panel panel-default">
				<div class="panel-heading">Popular Projects</div>
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