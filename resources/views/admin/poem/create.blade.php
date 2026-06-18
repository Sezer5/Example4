@extends('admin.layouts.adminlayout')
@section('title')
    Poems
@endsection
@section('container')
    <main class="p-4">
        <div class="container-fluid">
            <h2 class="mb-4 fw-bold" style="color: var(--dark-color);">Poems</h2>

            <div class="col-md-12 mb-4">
                <div class="card p-3 d-flex align-items-start">
                    <a href="{{ route('admin.poem.create') }}">
                        <button class="btn btn-success"><i class="bi bi-plus"></i> Add poems</button>
                    </a>
                </div>
            </div>

            <div class="card p-4">
                <div class="col-md-4">
                    <form action="{{ route('admin.poem.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                id="title" aria-describedby="helpId" placeholder="Enter title please*"
                                value="{{ old('title') }}" />
                            @error('title')
                                <span class="invalid-feedback">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Keywords</label>
                            <select multiple class="form-select form-select-sm" name="keyword_id[]" id="keyword_id">
                                <option selected disabled>Select keywords*</option>
                                @foreach ($keywords as $rs)
                                    <option value="{{ $rs->id }}" @selected(in_array($rs->id, old('keyword_id', [])))>{{ $rs->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for=""
                                class="form-label @error('thumbnail') is-invalid @enderror">Thumbnail</label>
                            <input type="file" class="form-control" name="thumbnail" id="thumbnail"
                                aria-describedby="fileHelpId" />
                            @error('thumbnail')
                                <span class="invalid-feedback">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </main>
@endsection
