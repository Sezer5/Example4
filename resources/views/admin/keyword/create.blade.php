@extends('admin.layouts.adminlayout')
@section('title')
    Keywords
@endsection
@section('container')
    <main class="p-4">
        <div class="container-fluid">
            <h2 class="mb-4 fw-bold" style="color: var(--dark-color);">Keywords</h2>

            <div class="col-md-12 mb-4">
                <div class="card p-3 d-flex align-items-start">
                    <a href="{{ route('admin.keyword.create') }}">
                        <button class="btn btn-success"><i class="bi bi-plus"></i> Add Keyword</button>
                    </a>
                </div>
            </div>

            <div class="card p-4">
                <div class="col-md-4">
                    <form action="{{ route('admin.keyword.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" aria-describedby="helpId" placeholder="Enter name please*" />
                            @error('name')
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
