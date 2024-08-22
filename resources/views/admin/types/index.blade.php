@extends('layouts.admin')

@section('content')
    <div class="container p-3">
        <div class="mb-3">
            <a href="{{ route('admin.types.create') }}">
                <i class="fa-solid fa-plus"></i>
                add new type
            </a>
        </div>
        <div class="row">
            @foreach ($types as $type)
                <div class="col-4 mb-3">
                    <div class="card" style="width: 18rem;">
                        <div class="text-center py-3">
                            <i class="{{ $type->icon }} fs-1"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $type->name }}</h5>
                            <p class="card-text">{{ $type->description }}</p>
                        </div>
                        <div class="card-footer">
                            <a class="text-decoration-none text-dark btn p-0" href="{{ route('admin.types.show', $type) }}">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a class="text-decoration-none text-warning btn px-2 py-0"
                                href="{{ route('admin.types.edit', $type) }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button types="button" class="btn btn-link p-0 text-danger" data-bs-toggle="modal"
                                data-bs-target="#modal-{{ $type->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <div class="modal fade" id="modal-{{ $type->id }}" tabindex="-1" data-bs-backdrop="static"
                                data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $type->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitle-{{ $type->id }}">
                                                Delete current type
                                            </h5>
                                            <button types="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Deleting type name: {{ $type->name }}
                                            ⚡Danger, you cannot undo this operation
                                        </div>
                                        <div class="modal-footer">
                                            <button types="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <form action="{{ route('admin.types.destroy', $type) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button types="submit" class="btn btn-danger">
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
