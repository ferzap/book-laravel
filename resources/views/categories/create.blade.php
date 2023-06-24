@extends('main')

@section('container')
    <div class="container mx-auto small table-responsive-md">
        <div class="col-md-8">
            <h2 class="text-muted mb-3">Add Book</h2>
            <form action="/categories" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        placeholder="name" value="{{ old('name') }}" required autofocus>
                    <label for="name">Name</label>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-outline-secondary me-2" type="button"
                        onclick="location.href = '{{ url('/categories') }}'">Back</button>
                    <button class="btn btn-outline-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
