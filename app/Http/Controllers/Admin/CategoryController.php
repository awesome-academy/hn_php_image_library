<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryPutRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $categories = $this->repository->getSearch($request['search']);

        return view('admin.categories.category_index', ['categories' => $categories]);
    }

    public function create()
    {
        $parents = $this->repository->getAllCategory();

        return view('admin.categories.category_create', [
            'parents' => $parents,
        ]);
    }

    public function store(CategoryRequest $request)
    {
        $request['parent_id'] = null;
        $this->repository->create($request);

        return redirect()->route('categories.index')
            ->with('success', __('create_success', ['name' => __('category')]));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.category_create', [
            'category' => $category,
        ]);
    }

    public function update(CategoryPutRequest $request, Category $category)
    {
        $request['parent_id'] = null;
        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', __('update_success', ['name' => __('category')]));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        $category->subcategories()->delete();

        return redirect()->route('categories.index')
            ->with('success', __('delete_success', ['name' => __('category')]));
    }
}
