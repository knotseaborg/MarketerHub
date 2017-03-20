@extends('profiles.layout')

@section('title', '| Dashboard')

@section('profile_content')
	<div class="row">
		<div class="col-md-8">
			
		</div>
		<div class="col-md-4">
			<div class="panel panel-default top-space">
				<div class="panel-heading">
					<span class="h4">Recent Projects</span>
				</div>
				<div class="panel-body">
					@if($projects->count() == 0)
						<p>No Projects</p>
					@endif
					@foreach($projects as $project)
					<p><a href="{{ route('project.show', $project->id)}}">{{$project->name}}</a>.<span class="small-grey-text">{{ date('j M Y, g:ia', strtotime($project->created_at)) }}</span></p>
					@endforeach
				</div>
			</div>
			<div class="panel panel-default top-space">
				<div class="panel-heading">
					<span class="h4">New Invitation</span>
				</div>
				<div class="panel-body">
					@if($invites->count() == 0)
						<p>No new Invitation</p>
					@endif
					@foreach($invites as $invite)
						<p><a href="{{ route('invite.show_receiver', $invite->id)}}" data-route="{{ route('invite.checked', $invite->id) }}" class="invite-link">{{$invite->user_sender->name}}</a>.<span class="small-grey-text">{{ date('j M Y, g:ia', strtotime($invite->created_at)) }}</span></p>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script>
		$(document).ready(function(){
			$(".invite-link").click(function(btn){
				btn.preventDefault();
				var route = $(this).data("route");
				var link = $(this).attr("href");
				$.ajax({
					url: route,
					type: "post",
					data: {_method: "put", _token: "{{ csrf_token() }}" },
					complete: function(){
						window.location = link;
					},
				});
			});
		});
	</script>
@endsection