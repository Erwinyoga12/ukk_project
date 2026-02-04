<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'price', 'stock', 'image'
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name) . '-' . Str::random(6);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // helper untuk menampilkan path gambar
    public function imageUrl()
    {
        if (!$this->image) {
            return asset('images/no-image.png'); // fallback
        }
        return asset('storage/' . $this->image);
    }
}
