@extends('main')

@section('container')
    <div class="container mx-auto small table-responsive-md">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="d-flex pb-3">
            <h2 class="me-auto text-muted">List Categories</h2>
            <button class="btn btn-primary btn-sm me-2" onclick="location.href='{{ url('/categories/create') }}'"><i
                    class="bi bi-plus-circle"></i> Add new category</button>
            <form action="/categories/deletes" method="POST" id="deleteAll" class="d-flex">
                @csrf
                <input type="hidden" id="checkboxVal" name="checkbox">
                <button class="btn btn-danger btn-sm" id="btnDeleteAll" type="submit"'"><i class="bi bi-trash3"></i> Delete
                    Selected</button>
            </form>
        </div>
        <nav class="navbar navbar-expand bg-body-tertiary col-md-6">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="d-flex" role="search" action="" method="GET">
                        @csrf
                        <input class="form-control me-2" type="text" name="name" placeholder="Category Name"
                            value="{{ request('name') }}">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="table-responsive col-md-6">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><input class="form-check-input" type="checkbox" id="checkbox-all"></th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($categories->count())
                        @foreach ($categories as $category)
                            <tr>
                                <th scope="row"><input class="form-check-input" name="ids[]" type="checkbox"
                                        value="{{ $category->id }}" id="checkbox-{{ $category->id }}"</th>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <div class="d-flex">
                                        {{-- <a href="/categories/{{ $book->id }}"
                                            class="badge bg-info w-75 text-decoration-none">View</a>
                                        <a href="/categories/{{ $book->id }}/edit"
                                            class="badge bg-warning text-decoration-none">Edit</a> --}}
                                        <button class="btn btn-warning btn-sm h-50 text-white border-0 me-1" type="button"
                                            onclick="location.href = '{{ url('/categories/' . $category->id . '/edit') }}'"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <form action="/categories/{{ $category->id }}" method="POST" class="d-flex h-50">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm border-0"
                                                onclick="return confirm('Are you sure?')"><i
                                                    class="bi bi-trash3"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="border-0 pt-3">
                                <h5 class="text-center text-muted">No data found!</h5>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div id="pagination" class="d-flex justify-content-end">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
