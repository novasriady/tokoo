<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index () {
        $categories = CategoryModel::all();

        return view('pages/admin/category', array(
            'categories' => $categories
        ));
    }

    public function store (Request $request) {
        $categoryImage = $request->file('category_img');
        $categoryImagePath = $categoryImage->store('uploads/categories', 'public');

        $data = array(
            'category_name' => $request->input('category_name'),
            'category_description' => $request->input('category_description'),
            'category_img' => $categoryImagePath
        );

        CategoryModel::create($data);

        return redirect()->route('admin.category')->with('success', 'Successfully create category data.');
    }

    public function delete (string $category_id) {
        CategoryModel::deleteCategory($category_id);

        return redirect()->route('admin.category')->with('success', 'Successfully delete category data.');
    }
}
