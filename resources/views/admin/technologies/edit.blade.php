@extends('layouts.admin')

@section('content')
    <div class="py-3">
        <h4>Edit technology: {{ $technology->name }}</h4>
        <form method="POST" action="{{ route('admin.technologies.update', $technology->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4 row">
                <label for="name_technology" class="col-md-2 col-form-label text-md-right">Technology name</label>
                <div class="col-md-10">
                    <input id="name_technology" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name', $technology->name) }}" required autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mb-4 row">
                <label for="icon_technology" class="col-md-2 col-form-label text-md-right">Icon class</label>
                <div class="col-md-10">
                    <input id="icon_technology" type="text" class="form-control @error('icon') is-invalid @enderror"
                        name="icon" value="{{ old('icon', $technology->icon) }}" required autofocus>
                    @error('icon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mb-4 row">
                <label for="image_technology" class="col-md-2 col-form-label text-md-right">Image</label>
                <div class="col-md-10">
                    <input id="image_technology" type="file" class="form-control @error('image') is-invalid @enderror"
                        name="image">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-dark">Submit</button>
        </form>
    </div>
@endsection
