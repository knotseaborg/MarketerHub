@extends('main')

@section('title', '| Invitation Manager')

@section('content')
	<div class="row top-space">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-6">
							<h4>Invitation Manager. <small>@if(URL::current() == route('invite.received'))Received @else Sent @endif</small></h4>	
						</div>
						<div class="col-md-6">
							<ul class="nav nav-tabs pull-right">  
							    <li role="presentation" class="dropdown">
							        <a class="dropdown-toggle tbn blue" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							      	Options <span class="caret"></span>
							    	</a>
							    	<ul class="dropdown-menu">
							    		<li><a href="{{ route('invite.received') }}">Received</a></li>
							    		<li><a href="{{ route('invite.sent') }}">Sent</a></li>
							    		<li><a href="{{ route('invite.create') }}">Compose</a></li>
							    		<li><a href=#>Drafts(to be added)</a></li>
							    		<li><a href="#">Spam(to be added)</a></li>
							    	</ul>
							  	</li>
							</ul>
						</div>
					</div>
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
								@if($invite->receiver_id == Auth::id() && $invite->checked == 0)
								{!! Form::open(['route' => ['invite.checked', $invite->id], 'method' => 'put']) !!}
									{{ Form::submit('View', ['class' => 'btn btn-default btn-xs btn-block']) }}
								{!! Form::close() !!}
								@elseif($invite->receiver_id == Auth::id())
								<a href="{{ route('invite.show_receiver', $invite->id) }}" class="btn btn-default btn-xs btn-block">View</a>
								@else
								<a href="{{ route('invite.show_sender', $invite->id) }}" class="btn btn-default btn-xs btn-block">View</a>
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