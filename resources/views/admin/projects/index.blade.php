@extends('layouts.admin')

@section('content')
    <div class="container p-3">
        <div class="mb-3">
            <a href="{{ route('admin.projects.create') }}">
                <i class="fa-solid fa-plus"></i>
                add new project
            </a>
        </div>
        <div class="row">
            @foreach ($projects as $project)
                <div class="col-4 mb-3">
                    <div class="card" style="width: 18rem;">
                        @if (Str::startsWith($project->thumb_path, 'http'))
                            <img class="card-img-top" src="{{ $project->thumb_path }}">
                        @else
                            <img class="card-img-top" src="{{ asset('storage/' . $project->thumb_path) }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->name }}</h5>
                            <p class="card-text">{{ $project->description }}</p>
                            <a href="{{ $project->site_url }}" class="">Go to site</a>
                            <p class="card-text">Type: {{ $project->type->name }}</p>
                            <p class="card-text">Technologies:</p>
                            @foreach ($project->technologies as $technology)
                                <i class="{{ $technology->icon }}"></i>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <a class="text-decoration-none text-dark btn p-0"
                                href="{{ route('admin.projects.show', $project) }}">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a class="text-decoration-none text-warning btn px-2 py-0"
                                href="{{ route('admin.projects.edit', $project) }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button type="button" class="btn btn-link p-0 text-danger" data-bs-toggle="modal"
                                data-bs-target="#modal-{{ $project->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <div class="modal fade" id="modal-{{ $project->id }}" tabindex="-1" data-bs-backdrop="static"
                                data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $project->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitle-{{ $project->id }}">
                                                Delete current project
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
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
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection
