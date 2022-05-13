<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;


class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    // protected $fillable = [
    //     'name', 'slug', 'price', 'sale', 'description'
    // ];

    protected $guarded = [
        'created_at', 'updated_at'
    ];

    public function productEntries()
    {
        return $this->hasMany(ProductEntry::class, 'product_slug');
    }

    public function getDetailProduct($slug)
    {
        return DB::table('products')->join('product_entries', 'product_entries.product_slug', '=', 'products.slug')->join('colours', 'product_entries.colour_id', '=', 'colours.id')->where('slug', $slug)->get();
    }

    public function rating($id)
    {
        return DB::table('ratings')->where('product_id', $id)->average('value_rating');
    }

    public function countReview($id)
    {
        return DB::table('ratings')->where('product_id', $id)->count();
    }

    public function new_product($category)
    {
        // return DB::table('products')->join('product_entries', 'products.slug', '=', 'product_entries.product_slug')->join('categories', 'product_entries.category_id', '=', 'categories.id')->where('categories.category_value', $category)->groupBy('product_entries.product_slug')->get();

        return DB::select("SELECT *, products.id AS product_id FROM products JOIN product_entries ON products.slug = product_entries.product_slug JOIN categories ON product_entries.category_id=categories.id WHERE categories.category_value='$category' GROUP BY product_entries.product_slug");
    }
}
