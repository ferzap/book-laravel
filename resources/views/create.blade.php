@extends('main')

@section('container')
    <div class="container mx-auto small table-responsive-md">
        <div class="col-md-8">
            <h2 class="text-muted mb-3">Add Book</h2>
            <form action="/books" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                        placeholder="Title" value="{{ old('title') }}" required autofocus>
                    <label for="title">Title</label>
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Book Description"
                        id="description" name="description" style="height: 100px" required>{{ old('description') }}</textarea>
                    <label for="description">Description</label>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                {{-- category --}}
                <div class="mt-3 mb-4">
                    <div class="mb-3">
                        Category
                    </div>
                    @foreach ($categories as $key => $category)
                        <div class="col-md-3 pb-1 form-check form-check-inline @error('category') is-invalid @enderror">
                            <input class="form-check-input @error('category') is-invalid @enderror" type="checkbox" name="category[]" id="checkbox-{{ $category->id }}"
                                value="{{ $category->id }}"
                                {{ (is_array(old('category')) and in_array($category->id, old('category'))) ? ' checked' : '' }}>
                            <label class="form-check-label" for="checkbox-{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                    @endforeach
                    @error('category')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{-- end category --}}
    
                {{-- keywords --}}
                <div class="form-floating mb-3">
                    <label for="keywords" class="pt-1 d-inline small text-muted">Keywords</label>
                    <input name='keywords' id="keywords" class="form-control mb-3 rounded w-100 h-100 @error('keywords') is-invalid @enderror"
                        value="{{ old('keywords') }}" required>
                    @error('keywords')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{-- end Keywords --}}
    
                <div class="input-group mb-3">
                    <span class="input-group-text">Rp.</span>
                    <div class="form-floating">
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="priceMask" placeholder="Price" value="{{ old('priceMask') }}" required>
                        <label for="price">Price</label>
                    </div>
                    <span class="input-group-text">,00</span>
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="hidden" id="priceVal" name="price" value="{{ old('price') }}">
                </div>
    
                <div class="form-floating mb-3">
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock"
                        id="stock" placeholder="Stock" min="0" value="{{ old('stock') }}" required>
                    <label for="stock">Stock</label>
                    @error('stock')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('publisher') is-invalid @enderror" name="publisher"
                        id="publisher" placeholder="Publisher" value="{{ old('publisher') }}" required>
                    <label for="publisher">Publisher</label>
                    @error('publisher')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                <div class="d-flex justify-content-end">
                    <button class="btn btn-outline-secondary me-2" type="button"
                        onclick="location.href = '{{ url('/books') }}'">Back</button>
                    <button class="btn btn-outline-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // The DOM element you wish to replace with Tagify
        var input = document.querySelector('input[name=keywords]');
        // initialize Tagify on the above input node reference
        new Tagify(input);

        var price = document.querySelector('#price');
        var price_hidden = document.querySelector('#priceVal');
        price.addEventListener('keyup', function(e) {
            price.value = formatRupiah(this.value);
            price_hidden.value = parseInt(price.value.replace('.', ''));
        });
    </script>
@endsection
