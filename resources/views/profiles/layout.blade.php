@extends('main')

@section('content')
	<div class="row">
		<div class="col-md-10 panel col-md-offset-1">
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-default text-center top-space">
						<div class="panel-heading">
							
						</div>
						<div class="panel-body">
							@if(isset($details->image))
						<p>
						<img src="{{ URL::asset('images/'.$details->image) }}" id="logo-img"/>
						</p>						
						@else
						<h4>No Image</h4>
						@endif
						<span class="h3">{{Auth::user()->name}}</span>
						<p class="small-grey-text">{{ Auth::user()->email }}</p>
						<p>@if(isset($details)){{ $details->bio }}@else Tell the world about yourself. @endif</p>
						<p>Rating using graphics</p>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="row">
						<!--
						<div class="col-md-12">
							<ul class="nav nav-tabs">
								<li role="presentation"  class="{{Request::url() == url('profile/dashboard') ? 'active' : ''}}">
							  		<a href="{{ url('profile/dashboard') }}">Dashboard</a></li>
							  	<li role="presentation" class="{{Request::url() == url('starred-projects') ? 'active' : ''}}">
							  		<a href="{{ url('starred-projects') }}">Projects</a></li>
							  	<li role="presentation" class="{{Request::url() == route('invite.notify') ? 'active' : ''}}"/>
							  		<a href="{{ route('invite.notify')}}">Invitations</a></li>
							  	<li role="presentation" class="{{Request::url() == url('profile/following') ? 'active' : ''}}">
							  		<a href="#">Following</a></li>
							  	<li role="presentation" class="{{Request::url() == url('profile/followers') ? 'active' : ''}}">
							  		<a href="#">Followers</a></li>
							  	<li role="presentation" class="{{Request::url() == url('setting') ? 'active' : ''}}">
							  		<a href="{{url('setting')}}">Settings</a></li>
							</ul>
						</div>
						-->
					</div>
					@yield('profile_content')
				</div>
			</div>
		</div>
	</div>
@endsection