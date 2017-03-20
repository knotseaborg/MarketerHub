@extends('main')

@section('title', '| Explore Search')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center">
			<div class="text-center">
				<h2>MarketerHub</h2>
				<h4>Explore And Find Companies</h4>
			</div>
			{!! Form::open(['route' => 'explore.show_user', 'method' => 'get']) !!}
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						{{ Form::select('user_id', $users,null, ['class' => 'form-control search']) }}
						<button type="submit" class="btn btn-success top-space"><span class="glyphicon glyphicon-search"></span>  Search</button>	
					</div>	
				</div>
			{!! Form::close() !!}
			<!--
			{!! Form::open(['route' => 'explore.result', 'method' => 'get']) !!}
				<div>
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							{{ Form::text('user_id', null, ['class' => 'form-control search']) }}
						</div>		
					</div>
					<h4>Filter</h4>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group form-inline">
								<div class="form-group form-inline right-space">
								{{ Form::label('sector_id', 'Sector: ') }}
								{{ Form::select('sector_id', $sectors, null, ['class' => 'form-control sectors']) }}
							</div>
							
							<div class="form-group form-inline right-space">
								{{ Form::label('location_id', 'Location: ') }}
								{{ Form::select('location_id', $locations, null, ['class' => 'form-control locations']) }}
							</div>

							<div class="form-group form-inline right-space">
								{{ Form::label('tag_id[]', 'Tags: ') }}
								{{ Form::select('tag_id[]', $tags, null, ['class' => 'form-control tags', 'multiple' => 'multiple']) }}	
							</div>
							</div>
						</div>
					</div>

					<button type="submit" class="btn btn-success top-space"><span class="glyphicon glyphicon-search"></span>  Search</button>
				</div>
			{!! Form::close() !!}
			-->
		</div>
	</div>
	<!--
	<div class="row top-space">
		<div class="col-md-10 col-md-offset-1 search-data">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="h4">Company Registry</span>
				</div>
				<div class="panel-body">
					@foreach($settings as $setting)
						<div class="row">
							<div class="col-md-4">
								Company name:
								@if(isset($setting->user->name))
								{{ $setting->user->name }}
								@else No Info @endif
							</div>
							<div class="col-md-4">
								<p>
									<b>Location: </b>
									@if(isset($setting->location->category))
										{{ $setting->location->category }}
									@else
										No Info
									@endif
								</p>
								
								<p>
									<b>Sector: </b>
									@if(isset($setting->sector->category))
										{{ $setting->sector->category }}
									@else
										No Info
									@endif
								</p>
							</div>
							<div class="col-md-4">
								<p>
									<b>Tags: </b>
									@if(isset($setting->user->requires))
										@foreach($setting->user->requires as $tag)
										<span class="label label-default">{{ $tag->tag }}</span>
										@endforeach
									@else
										No Info
									@endif
									@if(isset($setting->user->provides))
										@foreach($setting->user->provides as $tag)
										<span class="label label-default">{{ $tag->tag }}</span>
										@endforeach
									@else
										No Info
									@endif
								</p>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	-->
	<!--
	<div class="row top-space">
		<div class="col-md-12 text-center">
			<h4><a href="">Categories</a> . <a href="">Tags</a> . <a href="">Startups</a> . <a href="">Corporates</a></h4>
		</div>
	</div>
	-->
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$(".search").select2({
				maxSelectionLength: 7,
				allowClear: true,
				placeholder: "Company name"
			});
			/*
			* Still working on it
			*
			$(".search").val("").trigger("change");
			$(".sectors").select2({
				maxSelectionLength: 7,
				allowClear: true,
				placeholder: "Company name"
			});
			$(".locations").select2({
				maxSelectionLength: 7,
				allowClear: true,
				placeholder: "Company name"
			});
			$(".tags").select2({
				maxSelectionLength: 7,
				allowClear: true,
				placeholder: "Tags"
			});
			*/
		});
	</script>
@endsection