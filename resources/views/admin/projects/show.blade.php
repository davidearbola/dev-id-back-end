@extends('layouts.admin')

@section('content')
    <div class="row py-3">
        <div class="col-4">
            @if (Str::startsWith($project->thumb_path, 'http'))
                <img class="w-100" src="{{ $project->thumb_path }}">
            @else
                <img class="w-100" src="{{ asset('storage/' . $project->thumb_path) }}">
            @endif
        </div>
        <div class="col-8">
            <h5 class="card-title">{{ $project->name }}</h5>
            <p class="card-text">{{ $project->description }}</p>
            <p class="card-text">Type: {{ $project->type->name }} <i class="{{ $project->type->icon }}"></i></p>
            <p class="card-text">Technologies:</p>
            @foreach ($project->technologies as $technology)
                <i class="{{ $technology->icon }}"></i>
            @endforeach
            <p><a href="{{ $project->site_url }}">Go to site</a></p>
        </div>
    </div>

    <div class="mt-2 d-flex">
        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning me-2">Edit</a>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $project->id }}">
            Delete
        </button>
        <div class="modal fade" id="modal-{{ $project->id }}" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $project->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle-{{ $project->id }}">
                            Delete current project
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Deleting project name: {{ $project->name }}
                        ⚡Danger, you cannot undo this operation
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Confirm
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger" type="submit" value="Delete"></input>
        </form> --}}
    </div>
@endsection
