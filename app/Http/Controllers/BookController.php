<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books = Book::latest()->filter(request(['title','description','category','keywords','price', 'author']))->paginate(10)->withQueryString();
        foreach ($books as $book) {
            $book->description = Str::limit(strip_tags($book->description), 100);
            // $category = implode(',',$book->category);
            $book->category = Category::whereIn('id', json_decode($book->category_id))->pluck('name')->toArray();
            $book->category = implode(', ', $book->category);
            $book->keywords = implode(', ', json_decode($book->keywords));
            $book->price_format = "Rp " . number_format($book->price, 2, ",", ".");
        }
        return view('index', [
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData =  $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'category' => 'required',
            'keywords' => 'required',
            'price' => 'integer|min:0',
            'stock' => 'integer|min:0',
            'publisher' => 'required'
        ]);
        
        $keywords = json_decode($request['keywords']);
        $arr_keywords = [];
        foreach ($keywords as $key => $value) {
            $arr_keywords[] = $value->value;
        }
        $validateData['category_id'] = json_encode($request['category']);
        $validateData['keywords'] = json_encode($arr_keywords);
        // dd($validateData);

        Book::Create($validateData);

        return redirect('/books')->with('success', 'New book has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
        $book->category = Category::whereIn('id', json_decode($book->category_id))->get();
        $book->keywords = implode(', ', json_decode($book->keywords));
        $book->price_format = "Rp " . number_format($book->price, 2, ",", ".");
        return view('show', [
            'book' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $book->category_id = json_decode($book->category_id);
        $book->keywords = implode(', ', json_decode($book->keywords));
        $book->price_format = number_format($book->price, 0, ",", ".");
        return view('edit', [
            'book' => $book,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'category' => 'required',
            'keywords' => 'required',
            'price' => 'integer|min:0',
            'stock' => 'integer|min:0',
            'publisher' => 'required'
        ];

        $validateData = $request->validate($rules);

        $keywords = json_decode($request['keywords']);
        $arr_keywords = [];
        foreach ($keywords as $key => $value) {
            $arr_keywords[] = $value->value;
        }
        $validateData['category_id'] = json_encode($request['category']);
        $validateData['keywords'] = json_encode($arr_keywords);
        // dd($validateData);

        $book->update($validateData);

        return redirect('/books')->with('success', 'Book has been updated!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
        $book->destroy($book->id);

        return redirect('/books')->with('success', 'Book has been deleted!');
    }

    public function destroyMultiple(Request $request)
    {
        //
        if($request->checkbox){
            $ids = explode(',', $request->checkbox);
            $total = count($ids);
            // dd($total);
            if($total > 0){
                Book::whereIn('id', $ids)->delete();
                return redirect('/books')->with('success', "$total books has been deleted!");
            } else {
                return redirect('/books')->with('error', 'Select at least 1 data');
            }
        } else {
            return redirect('/books')->with('error', 'Select at least 1 data');
        }
    }
}
