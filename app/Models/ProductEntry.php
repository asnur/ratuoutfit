<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductEntry extends Model
{
    use HasFactory;

    protected $table = 'product_entries';
    protected $fillable = ['product_slug', 'colour_id', 'size_id', 'stock'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'slug');
    }

    public function colour()
    {
        return $this->belongsTo(Colour::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
