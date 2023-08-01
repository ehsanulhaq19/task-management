@extends('layouts.app')

@section('content')
    <h1>Create New Task</h1>
    <form action="{{ route('tasks.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="priority">Project</label>
            <select class="form-control" name="project_id">
                @foreach ($projects as $project)
                    <option value="{{$project->id}}">{{$project->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
@endsection