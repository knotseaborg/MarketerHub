@extends('main')

@section('title', '| Search Result')

@section('content')
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
@endsection