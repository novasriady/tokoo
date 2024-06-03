<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index () {
        return view('pages/user/product/index');
    }

    public function show (string $product_id) {
        $product = ProductModel::getProductById($product_id);

        return view('pages/user/product/details', array(
            'product' => $product
        ));
    }
}
