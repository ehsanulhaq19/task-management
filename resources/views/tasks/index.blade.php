
@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div class="d-flex">
            <h1 class="mr-3">Tasks List</h1>
            @if (count($projects))
                <div class="form-group mt-1">
                    <select class="form-control" name="project_id" id="project-filter">
                        @foreach ($projects as $project)
                            <option {{$selectedProject && $selectedProject->id == $project->id ? "selected" : ""}} value="{{$project->id}}">{{$project->name}}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary height-fit-content">Create New Task</a>
    </div>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Project</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="drag-container">
            @foreach($tasks as $task)
                <tr class="draggable-item task-item" id="{{$task->id}}">
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->project->name }}</td>
                    <td>
                        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (count($tasks))
        <div class="pagination">{{ $tasks && $tasks->appends(['projectId' => $selectedProject ? $selectedProject->id : null])->links() }} </div>
    @endif
@endsection