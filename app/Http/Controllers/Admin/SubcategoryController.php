<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryPutRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $categories = $this->repository->getSubcategorySearch($request['search']);

        return view('admin.subcategories.subcategory_index', ['categories' => $categories]);
    }

    public function create()
    {
        $parents = $this->repository->getAllCategory();

        return view('admin.subcategories.subcategory_create', [
            'parents' => $parents,
        ]);
    }

    public function store(CategoryRequest $request)
    {
        if ($request['parent_id'] == 0) {
            $request['parent_id'] = null;
        }
        $this->repository->create($request);

        return redirect()->route('subcategories.index')
            ->with('success', __('create_success', ['name' => __('subcategory')]));
    }

    public function edit(Category $subcategory)
    {
        $parents = $this->repository->getAllSubcategory();

        return view('admin.subcategories.subcategory_create', [
            'subcategory' => $subcategory,
            'parents' => $parents,
        ]);
    }

    public function update(CategoryPutRequest $request, Category $subcategory)
    {
        if ($request['parent_id'] == 0) {
            $request['parent_id'] = null;
        }

        $subcategory->update($request->all());

        return redirect()->route('subcategories.index')
            ->with('success', __('update_success', ['name' => __('subcategory')]));
    }

    public function destroy(Category $subcategory)
    {
        $subcategory->delete();

        return redirect()->route('subcategories.index')
            ->with('success', __('delete_success', ['name' => __('subcategory')]));
    }
}
