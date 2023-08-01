
@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <h1>Projects List</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary height-fit-content">Create New Project</a>
    </div>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>{{ $project->name }}</td>
                    <td>
                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">{{ $projects->links() }} </div>
@endsection