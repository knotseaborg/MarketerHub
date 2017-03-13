@extends('profiles.layout')

@section('profile_content')
	<div class="row top-space">
		<div class="col-md-12 ">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-8">
							<h4>Invitations Received</h4h>
						</div>
						<div class="col-md-4">
							<a href="{{ route('invite.index') }}" class="btn btn-primary btn-xs pull-right top-space-10">Manage Invitations</a>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div class="row">
						@foreach($invites as $invite)
						<div class=" col-md-6 text-center">
							<div class=" panel panel-default ">
								{!! Form::open(['route' => ['invite.checked', $invite->id], 'method' =>'put']) !!}
								<h4>{{ Form::submit($invite->user_sender->name, ['class' => 'btn btn-default']) }}</h4>
								{!! Form::close() !!}
							<p class="small-grey-text">{{ date('j M Y, g:ia', strtotime($invite->created_at)) }}</p>
							<p>
								@foreach($invite->tags as $tag)
									<label class="label label-default">{{ $tag->tag }}</label>
								@endforeach
							</p>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection