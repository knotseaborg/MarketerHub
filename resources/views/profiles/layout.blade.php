@extends('main')

@section('content')
	<div class="row">
		<div class="col-md-10 panel col-md-offset-1">
			<div class="row">
				<div class="col-md-3">
					<div class="company-details well text-center">
						<img src="https://cdn.pixabay.com/photo/2015/04/17/09/36/domestic-cat-726989_960_720.jpg" id="logo-img"/>
						<h3>{{Auth::user()->name}}</h3>
						<div class="small-grey-text">MarketerHub@gmail.com</div>
						<p>@if(isset($details)){{ $details->bio }}@else Tell the world about yourself. @endif</p>
						<p>Rating using graphics</p>
					</div>
				</div>
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-12">
							<ul class="nav nav-tabs">
								<li role="presentation"  class="{{Request::url() == url('profile/dashboard') ? 'active' : ''}}">
							  		<a href="{{ url('profile/dashboard') }}">Dashboard</a></li>
							  	<li role="presentation" class="{{Request::url() == url('starred-projects') ? 'active' : ''}}">
							  		<a href="{{ url('starred-projects') }}">Projects</a></li>
							  	<li role="presentation" class="{{Request::url() == url('profile/invitations') ? 'active' : ''}}"/>
							  		<a href="#">Invitations</a></li>
							  	<li role="presentation" class="{{Request::url() == url('profile/following') ? 'active' : ''}}">
							  		<a href="#">Following</a></li>
							  	<li role="presentation" class="{{Request::url() == url('profile/followers') ? 'active' : ''}}">
							  		<a href="#">Followers</a></li>
							  	<li role="presentation" class="{{Request::url() == url('setting') ? 'active' : ''}}">
							  		<a href="{{url('setting')}}">Settings</a></li>
							</ul>
						</div>
					</div>
					@yield('profile_content')
				</div>
			</div>
		</div>
	</div>
@endsection