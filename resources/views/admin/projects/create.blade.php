@extends('layouts.admin')

@section('content')
    <div class="py-3">
        <h4>Add Project:</h4>
        <p>Fill in the form all the fields to add a new project to the DB</p>
        <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4 row">
                <label for="name_project" class="col-md-2 col-form-label text-md-right">Project Name</label>
                <div class="col-md-10">
                    <input id="name_project" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mb-4 row">
                <label for="desc_project" class="col-md-2 col-form-label text-md-right">Description</label>
                <div class="col-md-10">
                    <input id="desc_project" type="text" class="form-control @error('description') is-invalid @enderror"
                        name="description" value="{{ old('description') }}" required autofocus>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mb-4 row">
                <label for="url_project" class="col-md-2 col-form-label text-md-right">Site Url</label>
                <div class="col-md-10">
                    <input id="url_project" type="text" class="form-control @error('site_url') is-invalid @enderror"
                        name="site_url" value="{{ old('site_url') }}" required autofocus>
                    @error('site_url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mb-4 row">
                <label for="thumb_project" class="col-md-2 col-form-label text-md-right">Upload image</label>
                <div class="col-md-10">
                    <input id="thumb_project" type="file" class="form-control @error('thumb_path') is-invalid @enderror"
                        name="thumb_path">
                    @error('thumb_path')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mb-4 row">
                <label class="col-md-2 col-form-label text-md-right">Select type</label>
                <div class="col-md-10">
                    <select name="type_id" class="form-select @error('type_id') is-invalid @enderror" required autofocus>
                        <option value="" selected>Choose type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('type_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="mb-4 row">
                <label class="col-md-2 col-form-label text-md-right">Select technologies</label>
                <div class="col-md-10">
                    @foreach ($technologies as $technology)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="technologies[]"
                                value="{{ $technology->id }}" id="technology{{ $technology->id }}">
                            <label class="form-check-label" for="technology{{ $technology->id }}">
                                {{ $technology->name }}
                            </label>
                        </div>
                    @endforeach
                    @error('technologies')
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
