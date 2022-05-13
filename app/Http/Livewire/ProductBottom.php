<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductEntry;
use Livewire\Component;
use Cart;

class ProductBottom extends Component
{
    public $slug;
    public $color_value;
    public $size_value;

    protected $rules = [
        'slug' => 'required',
        'size_value' => 'required',
        'color_value' => 'required'
    ];

    protected $messages = [
        'size_value.required' => 'Pilih Ukuran!',
        'color_value.required' => 'Pilih Warna!',
        // 'qty.required' => 'Masukan Jumlah Barang!',
    ];

    public function render()
    {
        $slug = $this->slug;
        $size = ProductEntry::with(['size'])->where('product_slug', $slug)->groupBy('size_id')->get();
        $colour = ProductEntry::with(['colour'])->where('product_slug', $slug)->groupBy('colour_id')->get();
        $category = ProductEntry::with(['category'])->where('product_slug', $slug)->groupBy('category_id')->get();
        $product = Product::where('slug', $slug)->first();
        $color_option = ProductEntry::with(['colour'])->where('product_slug', $slug)->where('size_id', $this->size_value)->groupBy('colour_id')->get();

        return view('livewire.product-bottom', compact(['product', 'size', 'color_option']));
    }

    public function cart()
    {
        $this->validate();

        $data_product = ProductEntry::join('products', 'products.slug', '=', 'product_entries.product_slug')->where('product_slug', $this->slug)->where('colour_id', $this->color_value)->where('size_id', $this->size_value)->first();



        $rowId = "Cart-" . $this->slug . '-' . $this->color_value . '-' . $this->size_value;
        $cart = Cart::getContent();
        $cekItemId = $cart->whereIn('id', $rowId);
        if ($cekItemId->isNotEmpty()) {
            Cart::update($rowId, [
                'quantity' => [
                    'relative' => true,
                    'value' => 1
                ]
            ]);
        } else {
            Cart::add([
                'id' => "Cart-" . $this->slug . '-' . $this->color_value . '-' . $this->size_value,
                'name' => $data_product->name,
                'price' => $data_product->price - ($data_product->price * ($data_product->sale / 100)),
                'quantity' => 1,
                'attributes' => [
                    'size' => $this->color_value,
                    'color' => $this->size_value,
                    'slug' => $data_product->slug
                ]
            ]);
        }


        $this->size_value = null;
        $this->color_value = null;
        // $this->qty = null;

        // Cart::clear();
        // dd(Cart::getContent());

        $this->emit('cartAdded');
    }
}
