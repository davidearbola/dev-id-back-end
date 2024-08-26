@extends('layouts.admin')

@section('content')
    <div class="row py-3">
        <div class="col-4">
            @if (Str::startsWith($technology->image, 'http'))
                <img class="w-100" src="{{ $technology->image }}">
            @else
                <img class="w-100" src="{{ asset('storage/' . $technology->image) }}">
            @endif
        </div>
        <div class="col-8">
            <h5 class="card-title">{{ $technology->name }} <i class="{{ $technology->icon }}"></i></h5>
        </div>
    </div>
    <div class="mt-2 d-flex">
        <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-warning me-2">Edit</a>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $technology->id }}">
            Delete
        </button>
        <div class="modal fade" id="modal-{{ $technology->id }}" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{ $technology->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle-{{ $technology->id }}">
                            Delete current technology
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Deleting technology name: {{ $technology->name }}
                        ⚡Danger, you cannot undo this operation
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <form action="{{ route('admin.technologies.destroy', $technology) }}" method="post">
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
