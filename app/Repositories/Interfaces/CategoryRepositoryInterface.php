<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function create($request);

    public function getSubcategoryByParent($category_id);

    public function getAllSubcategory();

    public function getAllCategory();

    public function getImageBySubcategory($slug);

    public function getSearch($query);

    public function getSubcategorySearch($query);

    public function getAllCategoryWithout($id);
}
