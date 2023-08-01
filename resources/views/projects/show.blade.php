@extends('layouts.app')

@section('content')
    <h1>Project Details</h1>
    <div>
        <strong>Name:</strong> {{ $project->name }}
    </div>
    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary mt-3">Edit Item</a>
    <form action="{{ route('projects.destroy', $project->id) }}" method="post" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure you want to delete this project?')">Delete Project</button>
    </form>
@endsection