<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%'.$request['search'].'%')
            ->with('category')
            ->orderBy('id', 'DESC')
            ->paginate(config('project.pagecount'));

        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('products.create', ['categories' => $categories]);
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', __('created successfully', ['name' => __('Product')]));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.create', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', __('updated successfully', ['name' => __('Product')]));
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', __('deleted successfully', ['name' => __('Product')]));
    }
}
