@extends('layouts.admin')

@section('content')
    <div class="row py-3">
        <div class="col-4">
            <h5><i class="{{ $type->icon }} fs-1"></i></h5>
        </div>
        <div class="col-8">
            <h5 class="card-title">{{ $type->name }}</h5>
            <p class="card-text">{{ $type->description }}</p>
        </div>
    </div>
    <div class="mt-2 d-flex">
        <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-warning me-2">Edit</a>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $type->id }}">
            Delete
        </button>
        <div class="modal fade" id="modal-{{ $type->id }}" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $type->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle-{{ $type->id }}">
                            Delete current type
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Deleting type name: {{ $type->name }}
                        ⚡Danger, you cannot undo this operation
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <form action="{{ route('admin.types.destroy', $type) }}" method="post">
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
@endsection
