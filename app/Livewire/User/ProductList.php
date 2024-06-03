<?php

namespace App\Livewire\User;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ProductList extends Component
{
    public Collection $products;
    public array $filters = array();

    public function mount () {
        $this->products = ProductModel::getAllProductWithFilters($this->filters);
    }

    public function updateProductList () {
        $filters = array(
            'category_name' => $this->filters['category_name'] ?? '',
            'price_range' => array_map('trim', explode('-', $this->filters['price_range'] ?? ''))
        );

        $this->products = ProductModel::getAllProductWithFilters($filters);
    }

    public function render()
    {
        $categories = CategoryModel::all();

        return view('livewire.user.product-list', array(
            'categories' => $categories
        ));
    }
}
