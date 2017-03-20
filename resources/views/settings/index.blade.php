@extends('main')

@section('title', '| Settings')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default top-space">
				<div class="panel-heading">
					<h4>Settings</h4>	
				</div>
				<div class="panel-body">
					@if(isset($data['details']))
					{!! Form::model($data['details'], ['route' => ['setting.update'], 'method' => 'put', 'files' => true]) !!}
					@else
					{!! Form::open(['route' => ['setting.store'], 'method' => 'post', 'files' => true]) !!}
					@endif
						{{ Form::label('image', 'Upload Logo: ')}}
						{{ Form::file('image') }}

						{{ Form::label('bio', 'A Brief description of who you are and what yo do: ') }}
						{{ Form::textarea('bio', null, ['class' => 'form-control', 'rows' => '5']) }}
						
						{{ Form::label('url', 'Url of your official site: ') }}
						{{ Form::text('url', null, ['class' => 'form-control']) }}		
						
						{{ Form::label('location_id', 'Location of your Head Quaters: ') }}
						{{ Form::select('location_id', $data['loc_arr'] ,null, ['class' => 'form-control locations']) }}

						{{ Form::label('sector_id', 'Business Sector: ') }}
						{{ Form::select('sector_id', $data['sector_arr'], null, ['class' => 'form-control sectors']) }}

						{{ Form::label('service_description', 'Description of Services/Products provided: ') }}
						{{ Form::textarea('service_description', null, ['class' => 'form-control provides', 'rows' => '5']) }}	

						{{ Form::label('tag_id[]', 'Service/Product related tags: ') }}
						{{ Form::select('tag_id[]', $data['tag_arr'], null, ['class' => 'form-control tags', 'multiple' => 'multiple']) }}		

						{{ Form::label('interest_id[]', 'Interests: ') }}
						{{ Form::select('interest_id[]', $data['tag_arr'], null, ['class' => 'form-control interests', 'multiple' => 'multiple']) }}				

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
			@if(isset($data['details']))
			$(".locations").val({{ json_encode($data['details']->location) }}).trigger("change");
			$(".sectors").val({{ json_encode($data['details']->sector) }}).trigger("change");
			@endif
			$(".interests").select2();
			$(".tags").select2();
			$(".tags").val({{ json_encode($data['chosen_tags']) }}).trigger("change");
			$(".interests").val({{ json_encode($data['chosen_interests']) }}).trigger("change");
		});
	</script>
@endsection