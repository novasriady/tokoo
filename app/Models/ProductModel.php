<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $incrementing = true;

    protected $fillable = [
        'product_category_id',
        'product_name',
        'product_description',
        'product_price',
        'product_stock',
        'product_img',
    ];

    protected $casts = [
        'product_category_id' => 'string',
    ];

    public function category(): HasOne
    {
        return $this->hasOne(CategoryModel::class, 'category_id', 'product_category_id');
    }

    public static function getAllProduct()
    {
        $products = self::with('category')->get();
        return $products;
    }

    public static function getAllProductWithFilters(array $filters)
    {
        $query = self::with('category');

        if (!empty($filters)) {
            if (!empty($filters['category_name'])) {
                $query->whereHas('category', function ($query) use ($filters) {
                    $query->where('category_name', $filters['category_name']);
                });
            }

            if (!empty($filters['price_range']) && count($filters['price_range']) === 2) {
                $query->whereBetween('product_price', $filters['price_range']);
            }
        }

        $products = $query->get();

        return $products;
    }

    public static function getAllProductHome()
    {
        $products = self::limit(4)->get();
        return $products;
    }

    public static function getProductById(string $product_id)
    {
        $product = self::with('category')
            ->where('product_id', $product_id)
            ->first();

        return $product;
    }

    public static function deleteProduct(string $product_id)
    {
        $product = self::find($product_id);

        if ($product) {
            Storage::disk('public')->delete($product->product_img);
            $product->delete();
        }

        return $product;
    }

    public static function updateProductStock(string $product_id, int $quantity)
    {
        $product = self::where('product_id', $product_id)->first();

        if ($product) {
            $product->update([
                'product_stock' => $product->product_stock - $quantity
            ]);
        }

        return $product;
    }
}
