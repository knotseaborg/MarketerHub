@extends('main')

@section('title', '| Show Invite')

@section('content')
	<div class="row">
		<div class="col-md-7 col-md-offset-1">
			<!--Invitation Message begins-->
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-12">
							<h4>{{ $invite->subject }}</h4>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<p>{{ $invite->message }}</p>
				</div>
				@if($invite->accepted == 0 && $invite->rejected == 0)
					<div class="panel-footer">
						@if($invite->receiver_id == Auth::id())
							<div class="row">
								<div class="col-md-4 col-md-offset-8">
									<div class="row">
										<div class="col-md-6">
											<a href="" class="btn btn-success
											btn-xs btn-block accept" data-route="{{ route('invite.accepted', $invite->id) }}">Accept</a>
										</div>
										<div class="col-md-6">
											<a href="" class="btn btn-danger btn-xs btn-block reject" data-route="{{ route('invite.rejected', $invite->id)}}">Reject</a>
										</div>
									</div>
								</div>
							</div>
						@else
							<div class="row">
								<div class="col-md-4 col-md-offset-8">
									{!! Form::open(['route' => ['invite.destroy', $invite->id], 'method' => 'delete']) !!}
									{{ Form::submit('Cancel Invitation', ['class' => 'btn btn-danger btn-xs pull-right']) }}
									{!! Form::close() !!}
								</div>
							</div>
						@endif
					</div>
				@endif
			</div>
			<!--Invitation Message ends-->
		</div>
		<!--Invitation Details begins-->
		<div class="col-md-2 well side-panel">
			<div class="panel panel-default"><div class="panel-body text-center"><span class="h4">{{ $invite->user_sender->name }}</span></div></div>
			<p><strong>Sent at:</strong> <span class="small-grey-text">{{ date('j M Y, g:ia', strtotime($invite->created_at)) }}</span></p>
			<p class="status">
				<strong>Status:</strong>
				@if($invite->checked == 0)
				<label class="label label-warning">Not yet Seen</label>
				@elseif($invite->accepted == 1)
				<label class="label label-success">Accepted</label>
				@elseif($invite->rejected == 1)
				<label class="label label-danger">Rejected</label>
				@elseif($invite->checked == 1)
				<label class="label label-primary">Seen</label>
				@endif
			</p>
			<p><strong>Tags:</strong>
				@foreach($invite->tags as $tag)
					<label class="label label-default">{{ $tag->tag }}</label>
				@endforeach
			</p>
			@if($invite->receiver_id == Auth::id())
			{!! Form::open(['route' => ['invite.remove_for_receiver', $invite->id], 'method' => 'put']) !!}
			@else
			{!! Form::open(['route' => ['invite.remove_for_sender', $invite->id], 'method' => 'put']) !!}
			@endif
				{{ Form::submit('Move to Trash', ['class' => 'btn btn-sm btn-danger btn-block btn-top-space']) }}
			{!! Form::close() !!}
		</div>
		<!--Invitation Details begins-->
	</div>
		<!--Comments Begins-->
	<div class="row">
		<div class="col-md-7 col-md-offset-1">
			<h4>Comments. {{$comments->count()}}</h4>
			@if($invite->sender_id == Auth::id())
				{!! Form::open(['route' => ['invite.sender_comment', $invite->id], 'method'=>'post']) !!}
			@else
				{!! Form::open(['route' => ['invite.receiver_comment', $invite->id], 'method' => 'post']) !!}
			@endif
				{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Comment Here']) }}

				{{ Form::submit('Submit Comment', ['class' => 'btn btn-primary btn-xs top-space-10']) }}
			{!! Form::close() !!}
			
			<div class="comments">
				@foreach($comments as $comment)
					<hr>
					<div class="row top-space-10">
						<div class="col-md-12">
							<div>
								<img src="http://www.gravatar.com/avatar/'{{md5(trim($comment->user->email)).'?d=retro' }}" class="author-img"alt="">
								<div class="author-info">
									<div><strong>{{$comment->user->name}}</strong></div>
									<div class="small-grey-text">{{date('j M Y, g:ia', strtotime($comment->created_at))}}</div>
								</div>	
							</div>
							<div class="comment-body">{{ $comment->comment }}</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<!--Comments Ends-->
@endsection

@section('script')
	<script>
		$(document).ready(function(){
			$(".accept").click(function(btn){
				btn.preventDefault();
				var route = $(this).data('route');
				var currentObject = $(this);
				$.ajax({
					type: "post",
					url: route,
					data: {_method: "put", _token: "{{ csrf_token() }}"},
					complete: function(){
						console.log("Success")
						$(currentObject).closest(".panel-footer").remove();
						$(".side-panel").find("p.status").html("<strong>Status: </strong><label class='label label-success'>Accepted</label>");
					},
				});
			});
			$(".reject").click(function(btn){
				btn.preventDefault();
				var route = $(this).data('route');
				var currentObject = $(this);
				$.ajax({
					type: "post",
					url: route,
					data: {_method: "put", _token: "{{ csrf_token() }}"},
					complete: function(){
						$(currentObject).closest(".panel-footer").remove();
						$(".side-panel").find("p.status").html("<strong>Status: </strong><label class='label label-danger'>Rejected</label>");
					},
				});
			});
		});
	</script>
@endsection