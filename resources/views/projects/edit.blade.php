@extends('layouts.app')

@section('content')
    <h1>Edit Project</h1>
    <form action="{{ route('projects.update', $project->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $project->name }}">
        </div>
        <button type="submit" class="btn btn-primary">Edit Project</button>
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