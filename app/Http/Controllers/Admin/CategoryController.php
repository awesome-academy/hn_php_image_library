<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('name', 'LIKE', '%'.$request['search'].'%')
            ->orderBy('id', 'DESC')
            ->paginate(config('project.pagecount'));

        return view('categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->all());

        return redirect()->route('categories.index')
            ->with('success', __('created successfully', ['name' => __('Category')]));
    }

    public function show(Category $category)
    {
        return view('categories.index', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.create', ['category' => $category]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', __('updated successfully', ['name' => __('Category')]));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', __('deleted successfully', ['name' => __('Category')]));
    }
}
