@extends('admin.layouts.adminlayout')
@section('title')
    Articles
@endsection
@section('container')
    <main class="p-4">
        <div class="container-fluid">
            <h2 class="mb-4 fw-bold" style="color: var(--dark-color);">Articles</h2>

            <div class="col-md-12 mb-4">
                <div class="card p-3 d-flex align-items-start">
                    <a href="{{ route('admin.article.create') }}">
                        <button class="btn btn-success"><i class="bi bi-plus"></i> Add Article</button>
                    </a>
                </div>
            </div>

            <div class="card p-4">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Keywords</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <td>{{ $article->id }}</td>
                                    <td><img src="{{ asset($article->thumbnail) }}" width="50"></td>
                                    <td>{{ $article->title }}</td>
                                    <td>
                                        @foreach ($article->keywords as $keyword)
                                            <span class="badge bg-success">{{ $keyword->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.article.edit', $article->id) }}" class="btn btn-warning"><i
                                                class="bi bi-pencil"></i></a>
                                    </td>
                                    <td>
                                        <a href="#" onclick="deleteItem({{ $article->id }})"
                                            class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                        <form id="{{ $article->id }}"
                                            action="{{ route('admin.article.destroy', $article->id) }}" method="post">
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
