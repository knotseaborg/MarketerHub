@extends('main')

@section('title', '| Invitation Manager')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h4>Invitation Manager</h4>
				</div>
				<div class="panel-body">
					@foreach($invites as $invite)
						<div class="row">
							<div class="col-md-2 text-center">
								@if(URL::current() == url('invite/received'))
								<p><strong>From:</strong>{{ ' '.$invite->user_sender->name }}</span></p>
								@else
									<p><strong>To:</strong>{{ ' '.$invite->user_receiver->name }}</span></p>
								@endif
								<p class="small-grey-text">Created at: {{ date('j M Y, g:ia', strtotime($invite->created_at)) }}</p>
							</div>
							<div class="col-md-5">
								<p><strong>Subject:</strong>{{ ' '.$invite->subject }}</p>
							</div>
							<div class="col-md-3">
								<p class="status">
									<strong>Status:</strong>
									@if($invite->checked == 0)
									<label class="label label-warning ">Not yet Seen</label>
									@elseif($invite->accepted == 1)
									<label class="label label-success ">Accepted</label>
									@elseif($invite->rejected == 1)
									<label class="label label-danger">Rejected</label>
									@elseif($invite->checked == 1)
									<label class="label label-primary">Seen</label>
									@endif
								</p>
								<p><strong>Tags: </strong>
									@foreach($invite->tags as $tag)
										<label class="label label-default">{{ $tag->tag }}</label>
									@endforeach
								</p>
							</div>
							<div class="col-md-2 text-center">
								@if($invite->receiver == Auth::id() && $invite->checked == 0)
								{!! Form::open(['route' => ['invite.checked', $invite->id], 'method' => 'put']) !!}
									{{ Form::submit('View', ['class' => 'btn btn-default btn-xs btn-block']) }}
								{!! Form::close() !!}
								@else
								<a href="{{ route('invite.show', $invite->id) }}" class="btn btn-default btn-xs btn-block">View</a>
								@endif
							</div>
						</div>
						@if(!$loop->last)
						<hr>
						@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection