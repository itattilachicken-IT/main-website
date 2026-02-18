<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price_per_kg', 'image', 'slug'
    ];

    
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }


    
   public function getImageUrlAttribute(): string
{
    // Return image URL if exists, otherwise default
    if (!empty($this->image) && file_exists(public_path($this->image))) {
        return asset($this->image); // e.g., /product-images/chicken_feet.png
    }

    return asset('product-images/default.jpg'); // fallback image
}


    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $slug = Str::slug($product->name);

                // Ensure uniqueness
                $originalSlug = $slug;
                $counter = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter++;
                }

                $product->slug = $slug;
            }
        });
    }
}
