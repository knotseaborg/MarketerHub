@extends('profiles.layout')

@section('title', '| Settings')

@section('profile_content')
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default top-space">
				<div class="panel-heading">
					<h4>Settings</h4>	
				</div>
				<div class="panel-body">
					@if(isset($settings))
					{!! Form::model($settings, ['route' => ['setting.update'], 'method' => 'put']) !!}
					@else
					{!! Form::open(['route' => ['setting.store'], 'method' => 'post']) !!}
					@endif
						{{ Form::label('bio', 'Bio: ') }}
						{{ Form::textarea('bio', null, ['class' => 'form-control']) }}
						
						{{ Form::label('url', 'Url: ') }}
						{{ Form::text('url', null, ['class' => 'form-control']) }}		
						
						{{ Form::label('location', 'Location: ') }}
						{{ Form::select('location', $locations ,null, ['class' => 'form-control locations']) }}	

						{{ Form::label('institution', 'Institution: ') }}
						{{ Form::text('institution', null, ['class' => 'form-control']) }}	

						{{Form::submit('Save Changes', ['class' => 'btn btn-success btn-top-space'])}}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script>
		$(document).ready(function(){
			$(".locations").select2();
		});
	</script>
@endsection