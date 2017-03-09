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
					@if(isset($details))
					{!! Form::model($details, ['route' => ['setting.update'], 'method' => 'put']) !!}
					@else
					{!! Form::open(['route' => ['setting.store'], 'method' => 'post']) !!}
					@endif
						{{ Form::label('bio', 'A Brief description of who you are and what yo do: ') }}
						{{ Form::textarea('bio', null, ['class' => 'form-control', 'rows' => '5']) }}
						
						{{ Form::label('url', 'Url of your official site: ') }}
						{{ Form::text('url', null, ['class' => 'form-control']) }}		
						
						{{ Form::label('location_id', 'Location of your Head Quaters: ') }}
						{{ Form::select('location_id', $locations ,null, ['class' => 'form-control locations']) }}

						{{ Form::label('sector_id', 'Business Sector: ') }}
						{{ Form::select('sector_id', $sectors, null, ['class' => 'form-control sectors']) }}

						{{ Form::label('service_description', 'Description of Services/Products provided: ') }}
						{{ Form::textarea('service_description', null, ['class' => 'form-control provides', 'rows' => '5']) }}	

						{{ Form::label('tag_id[]', 'Service/Product related tags: ') }}
						{{ Form::select('tag_id[]', $tags, null, ['class' => 'form-control tags', 'multiple' => 'multiple']) }}		

						{{ Form::label('interest_id[]', 'Interests: ') }}
						{{ Form::select('interest_id[]', $tags, null, ['class' => 'form-control interests', 'multiple' => 'multiple']) }}				

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
			$(".sectors").select2();
			$(".interests").select2();
			$(".tags").select2();
		});
	</script>
@endsection