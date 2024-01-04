<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            ['name' => 'required|min:3|max:255'],  
            ['name.min' => 'A kategória nevének minimum 3 karakternek kell lennie!'],
            ['name.max' => 'A kategória neve maximum 255 karakter lehet!']
    );

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'A kategória sikeresen létrehozva!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            ['name' => 'required|min:3|max:255'],  
            ['name.min' => 'A kategória nevének minimum 3 karakternek kell lennie!'],
            ['name.max' => 'A kategória neve maximum 255 karakter lehet!']
    );

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'A kategória sikeresen módosítva!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'A kategória sikeresen törölve!');
    }
}
