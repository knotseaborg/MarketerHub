@extends('main')

@section('content')
	<div class="row">
		<div class="col-md-10 panel col-md-offset-1">
			<div class="row">
				<div class="col-md-3">
					<div class="company-details well">
						<img src="https://cdn.pixabay.com/photo/2015/04/17/09/36/domestic-cat-726989_960_720.jpg" id="logo-img"/>
						<h3>Marketer Hub</h3>
						<div class="small-grey-text">MarketerHub@gmail.com</div>
						<p>Hi! These are the company details. Why don't you check them out?</p>
					</div>
				</div>
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-12">
							<ul class="nav nav-tabs">
								<li role="presentation"  class="{{Request::url() == url('profile/dashboard') ? 'active' : ''}}">
							  		<a href="#">Dashboard</a></li>
							  	<li role="presentation" class="{{Request::url() == url('profile/projects') ? 'active' : ''}}">
							  		<a href="{{ url('profile/projects') }}">Projects</a></li>
							  	<li role="presentation" class="{{Request::url() == url('profile/invitations') ? 'active' : ''}}"/>
							  		<a href="#">Invitations</a></li>
							  	<li role="presentation" class="{{Request::url() == url('profile/following') ? 'active' : ''}}">
							  		<a href="#">Following</a></li>
							  	<li role="presentation" class="{{Request::url() == url('profile/followers') ? 'active' : ''}}">
							  		<a href="#">Followers</a></li>
							  	<li role="presentation" class="{{Request::url() == url('profile/settings') ? 'active' : ''}}">
							  		<a href="#">Settings</a></li>
							</ul>
						</div>
					</div>
					@yield('profile_content')
				</div>
			</div>
		</div>
	</div>
	<!--<div class="row">
		<div class="col-md-12 panel banner text-center">
			<h2>Dashboard</h2>
			<img src="https://cdn.pixabay.com/photo/2015/04/17/09/36/domestic-cat-726989_960_720.jpg" id="logo-img"/>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2 text-center">
			<div class="row block">
				<div class="col-md-6">
					<a href="#" class="red">Projects</a>
				</div>
				<div class="col-md-6">
					<a href="#" class="blue">Invitations</a>
				</div>
			</div>
			<div class="row  block">
				<div class="col-md-6">
					<a href="#" class="blue">
					Blog</a>					
				</div>
				<div class="col-md-6">
					<a href="#" class="blue">
					Market X</a>			
				</div>
			</div>
			<div class="row  block">
				<div class="col-md-6">
					<a href="#" class="blue">
					Messenger</a>				
				</div>
				<div class="col-md-6">
					<a href="#" class="blue">
					Settings</a>			
				</div>
			</div>
		</div>
		<div class="col-md-4">
			
		</div>
	</div>-->
@endsection