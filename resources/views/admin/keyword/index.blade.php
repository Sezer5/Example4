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
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keywords as $keyword)
                                <tr>
                                    <td>{{ $keyword->id }}</td>
                                    <td>{{ $keyword->name }}</td>
                                    <td>{{ $keyword->slug }}</td>
                                    <td>
                                        <a href="{{ route('admin.keyword.edit', $keyword->slug) }}"
                                            class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                                    </td>
                                    <td>
                                        <a href="#" onclick="deleteItem({{ $keyword->id }})"
                                            class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                        <form id="{{ $keyword->id }}"
                                            action="{{ route('admin.keyword.destroy', $keyword->slug) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </main>
@endsection
