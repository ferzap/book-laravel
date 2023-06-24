<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('categories.index', [
            'categories' => Category::filter(request(['name']))->orderBy('id')->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData =  $request->validate([
            'name' => 'required|max:255',
        ]);

        Category::Create($validateData);

        return redirect('/categories')->with('success', 'New category has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $rules =  [
            'name' => 'required|max:255',
        ];

        $validateData = $request->validate($rules);

        $category->update($validateData);

        return redirect('/categories')->with('success', 'Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category->destroy($category->id);

        return redirect('/categories')->with('success', 'Category has been deleted!');
    }

    public function destroyMultiple(Request $request)
    {
        if($request->checkbox){
            $ids = explode(',', $request->checkbox);
            $total = count($ids);
            // dd($total);
            if($total > 0){
                Category::whereIn('id', $ids)->delete();
                return redirect('/categories')->with('success', "$total categories has been deleted!");
            } else {
                return redirect('/categories')->with('error', 'Select at least 1 data');
            }
        } else {
            return redirect('/categories')->with('error', 'Select at least 1 data');
        }

    }
}
