@extends('Layouts.main')

@section('title', '- Home')

@section('content')

    <div class="row justify-content-center m-3">
        <div class="col-sm-4">
            <a href="{{ route('task.create') }}" class="btn btn-block btn-primary">Create new To Do</a>
        </div>
    </div>

    @if($tasks->count() == 0)
        <p class="lead text-center">There are no To Dos, lets create one.</p>
    @else
        @foreach($tasks as $task)
            <div class="row">
                <div class="col-sm-12 mt-4 p-3 border shadow">
                    <h3>
                        {{ $task->name }}
                        <small class="text-secondary">{{ $task->created_at }}</small>
                    </h3>
                    
                    <p>{{ $task->description }}</p>
                    <h4>Due: <small>{{ $task->due_date }}</small></h4>
                    
                    {!! Form::open(['route' => ['task.destroy', $task->id], 'method' => 'DELETE']) !!}
                        <a href="{{ route('task.edit', $task->id) }}" class="btn btn-sm btn-primary">Edit<i class="ml-2 far fa-edit"></i></a>
                        <button type="submit" class="btn btn-sm btn-danger">Delete<i class="ml-2 fas fa-trash-alt"></i></button>
                    {!! Form::close() !!}

                </div>
            </div>
            
        @endforeach
    @endif

    <div class="row justify-content-center">
        <div class="col-sm-6 text-center">
            {{ $tasks->links() }}
        </div>
    </div>

@endsection()