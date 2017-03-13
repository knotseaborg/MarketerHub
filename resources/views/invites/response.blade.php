@extends('main')

@section('title', '| Compose Invites')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Create Invitation</h3>		
				</div>
				<div class="panel-body">
					{!! Form::open(['route' => 'invite.response', 'method' => 'post']) !!}
						{{ Form::label('subject', 'Subject: ') }}
						{{ Form::text('subject', null, ['class' => 'form-control']) }}

						{{ Form::label('message', 'Your Response: ') }}
						{{ Form::textarea('message', null, ['class' => 'form-control']) }}

						{{ Form::submit('Send Response', ['class' => 'btn btn-success btn-top-space']) }}
					{!! Form::close() !!}	
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function() {
			$(".tags").select2({
				maximumSelectionLength: 7,
				allowClear: true,
				placeholder: "Choose Tags",
			});
			$(".tags").val("").trigger("change");
			$(".users").select2({
				maximumSelectionLength: 7,
				allowClear: true,
				placeholder: "Choose Company",
			});
			$(".users").val("").trigger("change");
		});
	</script>
@endsection