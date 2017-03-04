@extends('profiles.layout')

@section('title', '| Projects')

@section('profile_content')
	<div class="row">
		<div class="col-md-12">
			<div class="text-center">
				<a href="{{ route('project.create') }}" class="btn btn-primary btn-top-space">Create New Project</a>
			</div>
			<table class="table top-space">
				<thead>
					<tr>
						<th>Name</th>
						<th>Summary</th>
						<th>Creation</th>
					</tr>
				</thead>
				<tbody>
					<tr class="panel">
						<td><a href="#">Smart India Hackathon</a></td>
						<td>This a govt. inititated project. This is so exciting. we can do a lot of fun stuff here. Includes over 250 glyphs in font format from the Glyphicon Halflings set. Glyphicons Halflings are normally not available for free, but their creator has made them available for Bootstrap free of cost. As a thank you, we only ask that you include a link back to Glyphicons whenever possible.</td>
						<td>date</td>
					</tr>
					<tr class="panel">
						<td><a href="#">Smart India Hackathon</a></td>
						<td>This a govt. inititated project. This is so exciting. we can do a lot of fun stuff here. Includes over 250 glyphs in font format from the Glyphicon Halflings set. Glyphicons Halflings are normally not available for free, but their creator has made them available for Bootstrap free of cost. As a thank you, we only ask that you include a link back to Glyphicons whenever possible.</td>
						<td>date</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
@endsection