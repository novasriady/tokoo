<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    public $incrementing = true; // Tambahkan ini untuk memberi tahu Laravel bahwa kolom ini adalah auto-increment.

    protected $fillable = [
        'category_name',
        'category_img',
        'category_description'
    ];

    protected $casts = [
        'category_id' => 'int' // Ubah ini ke int karena kolom sekarang auto-increment.
    ];

    public static function getAllCategoryHome()
    {
        $categories = self::limit(4)->get();
        return $categories;
    }

    public static function deleteCategory(string $category_id)
    {
        $category = self::find($category_id);

        if ($category) {
            Storage::disk('public')->delete($category->category_img);
            $category->delete();
        }

        return $category;
    }
}

