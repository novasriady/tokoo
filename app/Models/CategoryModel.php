<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';

    protected $fillable = array(
        'category_name',
        'category_img',
        'category_description'
    );

    protected $casts = array(
        'category_id' => 'string'
    );

    public static function getAllCategoryHome () {
        $categories = self::limit(4)->get();

        return $categories;
    }

    public static function deleteCategory (string $category_id) {
        $category = self::find($category_id);

        if ($category) {
            Storage::disk('public')->delete($category->category_img);
            $category->delete();
        }

        return $category;
    }

    public static function boot () {
        parent::boot();

        static::creating(function ($category) {
            $category->category_id = Str::uuid();
        });
    }
}
