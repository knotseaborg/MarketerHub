@extends('main')

@section('title', '| Create')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3 ">
			<ol class="breadcrumb">
			  <li><a href="{{ route('project.index') }}">Projects</a></li>
			  <li class="active">New Project</li>
			</ol>
			<h2>New Project</h2>
			<hr>
			{!! Form::open(['route' => 'project.store']) !!}
				{{ Form::label('name', 'Name: ') }}
				{{ Form::text('name',  null, ['class' => 'form-control']) }}

				{{ Form::label('category_id', 'Category: ') }}
				{{ Form::select('category_id', $categories, null, ['class' => 'form-control categories']) }}

				{{ Form::label('tag_id[]', 'Tags: ') }}
				{{ Form::select('tag_id[]', $tags, null, ['class' => 'form-control tags', 'multiple' => 'multiple']) }}


				{{ Form::label('summary', 'Summary: ') }}
				{{ Form::textarea('summary',  null, ['class' => 'form-control', 'rows' => '5']) }}

				{{ Form::label('content', 'Content: ') }}
				{{ Form::textarea('content',  null, ['class' => 'form-control', 'rows' => '5']) }}

				{{ Form::submit('Create project', ['class' => 'btn btn-success btn-block btn-top-space']) }}							
			{!! Form::close() !!}
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$(".categories").select2({
			  placeholder: "Choose a Category",
			  allowClear: true,
			  maximumSelectionLength: 7
			});
			$(".tags").select2({
			  placeholder: "Choose Tags",
			  allowClear: true,
			  maximumSelectionLength: 7
			});

		});
	</script>
@endsection