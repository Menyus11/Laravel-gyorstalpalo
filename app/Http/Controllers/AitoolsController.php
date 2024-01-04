<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aitool;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class AitoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aitools = Aitool::with('tags')->get();
        return view('aitools.index', compact('aitools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('aitools.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hasFreePlan = $request->has('hasFreePlan');
        if ($hasFreePlan) {
            $request->merge(['hasFreePlan' => true]);
        }

        $request->validate([

            'name' => 'required|string|min:3|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|min:20',
            'link' => 'required|url',
            'hasFreePlan' => 'boolean',
            'price' => 'nullable|numeric',
        ]);

        $aitool = Aitool::create($request->all());
        $aitool->tags()->attach($request->tags);

        return redirect()->route('aitools.index')->with('success', 'Az AI eszköz sikeresen hozzáadva!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $aitool = Aitool::with('tags')->find($id);
        return view('aitools.show', compact('aitool'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aitool = Aitool::find($id);
        $categories = Category::all();
        return view('aitools.edit', compact('aitool', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hasFreePlan = $request->has('hasFreePlan');
        if ($hasFreePlan) {
            $request->merge(['hasFreePlan' => true]);
        }

         $validated =  $request->validate([

            'name' => 'required|string|min:3|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|min:20',
            'link' => 'required|url',
            'hasFreePlan' => 'boolean', 
            'price' => 'nullable|numeric',
        ]);

        $aitool = Aitool::find($id);
/*         $aitool->name = $request->name;
        $aitool->category_id = $request->category_id;
        $aitool->description = $request->description;
        $aitool->link = $request->link;
        $aitool->hasFreePlan = $request->hasFreePlan;
        $aitool->price = $request->price;  */
        $aitool->update($validated );

        return redirect()->route('aitools.index')->with('success', 'Az AI eszköz sikeresen frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aitool = Aitool::find($id);
        $aitool->delete();

        return redirect()->route('aitools.index')->with('success', 'Az AI eszköz sikeresen törölve!');
    }
}
