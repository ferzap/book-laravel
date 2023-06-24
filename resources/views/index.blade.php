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
            <h2 class="me-auto text-muted">List Book</h2>
            <button class="btn btn-primary btn-sm me-2" onclick="location.href='{{ url('/books/create') }}'"><i
                    class="bi bi-plus-circle"></i> Add new book</button>
            <form action="/books/deletes" method="POST" id="deleteAll" class="d-flex">
                @csrf
                <input type="hidden" id="checkboxVal" name="checkbox">
                <button class="btn btn-danger btn-sm" id="btnDeleteAll" type="submit"'"><i class="bi bi-trash3"></i> Delete
                    Selected</button>
            </form>
        </div>
        <nav class="navbar navbar-expand bg-body-tertiary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse py-1 px-1" id="navbarSupportedContent">
                    <form class="d-flex" role="search" action="" method="GET">
                        @csrf
                        <input class="form-control me-2" type="text" name="title" placeholder="Title"
                            value="{{ request('title') }}">
                        <input class="form-control me-2" type="text" name="description" placeholder="Description"
                            value="{{ request('description') }}">
                        <input class="form-control me-2" type="text" name="category" placeholder="Category"
                            value="{{ request('category') }}">
                        <input class="form-control me-2" type="text" name="keywords" placeholder="Keywords"
                            value="{{ request('keywords') }}">
                        <input class="form-control me-2" type="text" name="price" placeholder="Price"
                            value="{{ request('value') }}">
                        <input class="form-control me-2" type="text" name="author" placeholder="Publisher"
                            value="{{ request('publisher') }}">
                        <button class="btn btn-outline-success btn-sm" type="submit"><i
                                class="bi bi-search me-1"></i>Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="table-responsive col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><input class="form-check-input" type="checkbox" id="checkbox-all"></th>
                        <th scope="col" class="col-1">Title</th>
                        <th scope="col" class="col-2">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col">Keywords</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Publisher</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($books->count())
                        @foreach ($books as $book)
                            <tr>
                                <th scope="row"><input class="form-check-input" name="ids[]" type="checkbox"
                                        value="{{ $book->id }}" id="checkbox-{{ $book->id }}"></th>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->description }}</td>
                                <td>{{ $book->category }}</td>
                                <td>{{ $book->keywords }}</td>
                                <td>{{ $book->price_format }}</td>
                                <td>{{ $book->stock }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>
                                    <div class="d-flex">
                                        {{-- <a href="/books/{{ $book->id }}"
                                            class="badge bg-info w-75 text-decoration-none">View</a>
                                        <a href="/books/{{ $book->id }}/edit"
                                            class="badge bg-warning text-decoration-none">Edit</a> --}}
                                        <button class="btn btn-info btn-sm h-50 text-white border-0 me-1" type="button"
                                            onclick="location.href = '{{ url('/books/' . $book->id) }}'"><i
                                                class="bi bi-eye"></i></button>
                                        <button class="btn btn-warning btn-sm h-50 text-white border-0 me-1" type="button"
                                            onclick="location.href = '{{ url('/books/' . $book->id . '/edit') }}'"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <form action="/books/{{ $book->id }}" method="POST" class="d-flex h-50">
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
                            <td colspan="9" class="border-0 pt-3">
                                <h5 class="text-center text-muted">No data found!</h5>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div id="pagination" class="d-flex justify-content-end">
                {{ $books->links() }}
            </div>
        </div>
    </div>

    <script>
        selectAll = document.querySelector('#checkbox-all')
        checkboxes = Array.from(document.getElementsByName('ids[]'))

        selectAll.addEventListener('change', function(e) {
            let that = this
            checkboxes.forEach((element) => {
                if (that.checked) {
                    element.checked = true
                } else {
                    element.checked = false
                }
            })
        })

        delForm = document.querySelector('#deleteAll');
        delForm.addEventListener('submit', function(e) {
            let arrVal = [];
            checkboxes.forEach(element => {
                if (element.checked) {
                    arrVal.push(element.value);
                }
            });

            checkboxVal = document.querySelector('#checkboxVal')
            checkboxVal.value = arrVal;
        })
    </script>
@endsection
