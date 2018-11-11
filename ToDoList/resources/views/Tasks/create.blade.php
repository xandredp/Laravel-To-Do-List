@extends('layouts.main')

@section('title', '- Create')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <h1>Create a To Do</h1>

            {!! Form::open(['route' => 'task.store', 'method' => 'POST']) !!}
                @component('Components.taskForm')
                @endcomponent
            {!! Form::close() !!}
            
        </div>
    </div>

@endsection