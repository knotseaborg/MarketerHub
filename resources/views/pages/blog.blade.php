@extends('main')

@section('title', '| Contact')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {!! Form::open() !!}
                {{ Form::label('name', 'Name: ') }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
                {{ Form::label('email', 'Email: ') }}
                {{ Form::text('email', null, ['class' => 'form-control']) }}
                {{ Form::label('message', 'Message: ') }}
                {{ Form::textarea('message', null, ['class' => 'form-control']) }}
                {{ Form::submit('Send Mail', ['class' => 'btn btn-success btn-block btn-top-space']) }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
