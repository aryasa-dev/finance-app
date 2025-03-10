<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return Inertia::render('Categories/Index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    public function store(Request $request)
    {
        $category = new Category($request->all());
        $category->save();
        return redirect()->route('categories.index');
    }
    
    public function edit(Category $category)
    {
        return Inertia::render('Categories/Create', [
            'category' => $category,
            'isUpdating' => true
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->all());

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
