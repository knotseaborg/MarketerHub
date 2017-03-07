@extends('main')

@section('title', '| Edit')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3 ">
			<ol class="breadcrumb">
			  <li><a href="{{ url('profile/projects') }}">Projects</a></li>
			  <li><a href="{{ route('project.index') }}">All Projects</a></li>
			  <li class="active">{{ $project->name }}</li>
			</ol>
			<h2>Edit Project</h2>
			<hr>
			{!! Form::model($project, ['route' => ['project.update', $project->id], 'method' => 'PUT']) !!}
				{{ Form::label('name', 'Name: ') }}
				{{ Form::text('name',  null, ['class' => 'form-control']) }}

				{{ Form::label('summary', 'Summary: ') }}
				{{ Form::textarea('summary',  null, ['class' => 'form-control', 'rows' => '5']) }}

				{{ Form::label('content', 'Content: ') }}
				{{ Form::textarea('content',  null, ['class' => 'form-control', 'rows' => '5']) }}
				
				{{ Form::label('category_id', 'Category: ') }}
				{{ Form::select('category_id', $categories , null, ['class' => 'form-control category-select']) }}

				{{ Form::submit('Edit project', ['class' => 'btn btn-success btn-block btn-top-space']) }}							
			{!! Form::close() !!}
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$(".category-select").select2({
				maximumSelectionLength: 7,
				allowClear: true,
				placeholder: "Choose a Category"
			});
		});
	</script>
@endsection