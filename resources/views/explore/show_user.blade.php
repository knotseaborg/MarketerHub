@extends('main')

@section('title', '| Explore Company')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-2">
			<div class="row">
				<div class="col-md-8">
					<div class="panel panel-default top-space">
						<div class="panel-heading">
							<h4>Company Details</h4>	
						</div>
						<div class="panel-body company-details">
							<p>
								<p><b>About us</b>:</p><div class="panel panel-default">@if(isset($details->bio)){{ $details->bio }}@else No Info @endif</div>
							</p>
							<p>
								<p><b>Vanity Url</b>:</p><div class="panel panel-default">@if(isset($details->url)){{ $details->url }}@else No info @endif</div>
							</p>
							<p>
								<p><b>Location of HeadQuarters</b>:</p><div class="panel panel-default">@if(isset($location))
								{{ $location }}@else No Info @endif</div>
							</p>
							<p>
								<p><b>Business Sector</b>:</p><div class="panel panel-default">@if(isset($sector)) 
								{{ $sector }}@else No Info @endif</div>
							</p>			
							<p>
								<p><b>Services/Products provided</b>:</p><div class="panel panel-default">@if(isset($details->service_description))
								{{ $details->service_description }}@else No Info @endif</div>
							</p>
							<p>
								<p>
									<b>Services/Product related Tags</b>:
								</p>
								<div class="panel panel-default">
									@if($user->provides->count() == 0)
										No Tags
									@endif
									@foreach($user->provides as $provide_tag)
										<span class="label label-default">{{ $provide_tag->tag }}</span>
									@endforeach
								</div>
							</p>
							<p>
								<p>
									<b>Interests</b>:
								</p>
								<div class="panel panel-default">
									@if($user->requires->count() == 0)
										No Tags
									@endif
									@foreach($user->requires as $require_tag)
										<span class="label label-default">{{ $require_tag->tag }}</span>
									@endforeach
								</div>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="company-details panel panel-default text-center top-space">
						@if(isset($details->image))
						<img src="{{URL::asset('images/'.$details->image)}}" id="logo-img"/>
						@else
						<h4>No Image</h4>
						@endif
						<h3>{{$user->name}}</h3>
						<div class="small-grey-text">MarketerHub@gmail.com</div>
						<p>Rating using graphics</p>
						<a href="{{ route('invite.create') }}?user_id={{$user->id}}" class="btn btn-sm btn-success">Send Invitation</a>
						<a href="{{ route('explore.project_index') }}?user_id={{$user->id}}" class="btn btn-sm btn-primary">View Projects</a>
					</div>	
				</div>
			</div>
		</div>
	</div>
@endsection