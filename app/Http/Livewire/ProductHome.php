<?php

namespace App\Http\Livewire;

use App\Models\ProductEntry;
use App\Models\Product;
use Livewire\Component;

class ProductHome extends Component
{
    protected $listeners = ['showCategory' => 'render'];
    public $category_value;

    public function render(Product $product)
    {
        $data_product = $product->orderBy('id', 'desc')->limit(10)->get();
        $rating = $product;
        $category = ProductEntry::with('category')->groupBy('category_id')->get();

        return view('livewire.product-home', compact(['data_product', 'rating', 'category']));
    }

    // public function category($category)
    // {
    //     $this->category_value = $category;
    //     // dd($this->category_value);
    // }
}
