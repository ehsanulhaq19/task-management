@extends('layouts.app')

@section('content')
    <h1>Task Details</h1>
    <div>
        <strong>Name:</strong> {{ $task->name }}
    </div>
    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary mt-3">Edit Item</a>
    <form action="{{ route('tasks.destroy', $task->id) }}" method="post" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure you want to delete this task?')">Delete Task</button>
    </form>
@endsection