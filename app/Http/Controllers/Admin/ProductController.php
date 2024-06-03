<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index () {
        $products = ProductModel::getAllProduct();
        $categories = CategoryModel::all();

        return view('pages/admin/product', array(
            'products' => $products,
            'categories' => $categories
        ));
    }

    public function store (Request $request) {
        $productImage = $request->file('product_img');
        $productImagePath = $productImage->store('uploads/products', 'public');

        $data = array(
            'product_name' => $request->input('product_name'),
            'product_category_id' => $request->input('product_category_id'),
            'product_description' => $request->input('product_description'),
            'product_price' => $request->input('product_price'),
            'product_stock' => $request->input('product_stock'),
            'product_img' => $productImagePath
        );

        ProductModel::create($data);

        return redirect()->route('admin.product')->with('success', 'Successfully create product data.');
    }

    public function delete (string $product_id) {
        ProductModel::deleteProduct($product_id);

        return redirect()->route('admin.product')->with('success', 'Successfully delete product data.');
    }
}
