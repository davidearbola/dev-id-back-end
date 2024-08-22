@extends('layouts.admin')


@section('content')
    <div class="container p-3">
        <div class="mb-3">
            <a href="{{ route('admin.technologies.create') }}">
                <i class="fa-solid fa-plus"></i>
                add new technology
            </a>
        </div>
        <div class="row">
            @foreach ($technologies as $technology)
                <div class="col-4 mb-3">
                    <div class="card" style="width: 18rem;">
                        <div class="text-center py-3">
                            <i class="{{ $technology->icon }} fs-1"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $technology->name }}</h5>
                        </div>
                        <div class="card-footer">
                            <a class="text-decoration-none text-dark btn p-0"
                                href="{{ route('admin.technologies.show', $technology) }}">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a class="text-decoration-none text-warning btn px-2 py-0"
                                href="{{ route('admin.technologies.edit', $technology) }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button type="button" class="btn btn-link p-0 text-danger" data-bs-toggle="modal"
                                data-bs-target="#modal-{{ $technology->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <div class="modal fade" id="modal-{{ $technology->id }}" tabindex="-1"
                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                aria-labelledby="modalTitle-{{ $technology->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitle-{{ $technology->id }}">
                                                Delete current technology
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Deleting technology name: {{ $technology->name }}
                                            ⚡Danger, you cannot undo this operation
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <form action="{{ route('admin.technologies.destroy', $technology) }}"
                                                method="post">
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
