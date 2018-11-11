@extends('layouts.main')

@section('title', '- Edit')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <h1>Edit your To Do</h1>

            {!! Form::model($task, ['route' => ['task.update', $task->id], 'method' => 'PUT']) !!}
                @component('Components.taskForm')
                @endcomponent
            {!! Form::close() !!}
            
        </div>
    </div>

@endsection