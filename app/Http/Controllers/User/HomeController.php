<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        $products = ProductModel::getAllProductHome();
        $categories = CategoryModel::getAllCategoryHome();

        return view('pages/user/home', array(
            'products' => $products,
            'categories' => $categories
        ));
    }
}
