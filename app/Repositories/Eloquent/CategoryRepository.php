<?php

namespace App\Repositories\Eloquent;

use App\Helpers\DataHelper;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function create($request)
    {
        return Category::create(array_merge($request->all(), [
            'slug' => DataHelper::getSlug($request['name']),
        ]));
    }

    public function getSearch($query)
    {
        return Category::where('name', 'LIKE', '%' . $query . '%')
            ->where('parent_id', null)
            ->orderBy('id', 'DESC')
            ->paginate(config('project.admin_page_count'));
    }

    public function getSubcategoryByParent($category_id)
    {
        return Category::where('parent_id', $category_id)->get();
    }

    public function getAllSubcategory()
    {
        return Category::where('parent_id', '!=', null)
            ->with('parent')
            ->orderBy('updated_at', 'DESC')
            ->limit(config('project.feature_subcategory_count'))
            ->get();
    }

    public function getImageBySubcategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $subcategories = Category::where('parent_id', $category['id'])
            ->with('images')
            ->get();

        return [
            'category' => $category,
            'subcategories' => $subcategories,
        ];
    }

    public function getAllCategory()
    {
        return Category::where('parent_id', null)->get();
    }

    public function getAllCategoryWithout($id)
    {
        return Category::where('parent_id', null)->where('id', '!=', $id)->get();
    }

    public function getSubcategorySearch($query)
    {
        return Category::where('name', 'LIKE', '%' . $query . '%')
            ->where('parent_id', '!=', null)
            ->with('parent')
            ->orderBy('id', 'DESC')
            ->paginate(config('project.admin_page_count'));
    }
}
