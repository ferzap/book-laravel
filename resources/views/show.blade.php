@extends('main')

@section('container')
{{-- @dd($book); --}}
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h2 class="mb-3">{{ $book->title }}</h2>
            <p>Published By. <a class="text-decoration-none" href="/books?publisher={{ $book->publisher }}">{{ $book->publisher}}</a></p>
            <p>
                @foreach ($book->category as $index => $category)
                <a class="text-decoration-none" href="/books?category={{ $category->id}}">{{ $category->name }}</a>{{ (count($book->category) > $index+1) ? ', ' : '' }}
                @endforeach    
            </p>

            <img src="https://source.unsplash.com/1200x400?{{ $book->category[0] }}" class="card-img-top img-fluid" alt="{{ $book->category[0] }}">

            <article class="my-3 fs-5 text-justify">
                {!! $book->description !!}
            </article>

            <p>Keywords : <span class="fst-italic">{{ $book->keywords }}</span></p>
            <p>Stock : {{ $book->stock }}</p>
            <p>Price : {{ $book->price_format }}</p>
    
            <a href="/books">Back to Books</a>
        </div>
    </div>
</div>
@endsection