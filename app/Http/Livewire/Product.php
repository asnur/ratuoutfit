<?php

namespace App\Http\Livewire;

use App\Models\Picture;
use App\Models\Product as ModelsProduct;
use App\Models\ProductEntry;
use Illuminate\Http\Client\Request;
use Livewire\Component;
use Cart;
// use Gloudemans\Shoppingcart\Cart;
// use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;

class Product extends Component
{
    public $slug;
    public $size_value;
    public $color_value;
    public $qty;

    protected $rules = [
        'slug' => 'required',
        'size_value' => 'required',
        'color_value' => 'required',
        'qty' => 'required'
    ];

    protected $messages = [
        'size_value.required' => 'Pilih Ukuran!',
        'color_value.required' => 'Pilih Warna!',
        'qty.required' => 'Masukan Jumlah Barang!',
    ];

    public function increment()
    {
        $this->qty++;
        $data_product = ProductEntry::where('product_slug', $this->slug)->where('colour_id', $this->color_value)->where('size_id', $this->size_value)->first();
        if ($this->qty > $data_product->stock) {
            session()->flash('pesan', 'Jumlah yang anda Masukan Melebihi Stock');
        }
    }
    public function decrement()
    {
        $this->qty--;
        $data_product = ProductEntry::where('product_slug', $this->slug)->where('colour_id', $this->color_value)->where('size_id', $this->size_value)->first();
        if ($this->qty <= 0) {
            $this->qty = null;
            session()->flash('pesan', 'Anda Harus Memasukan Jumlah Pesanan');
        }
    }

    public function render()
    {
        $slug = $this->slug;
        $size = ProductEntry::with(['size'])->where('product_slug', $slug)->groupBy('size_id')->get();
        $colour = ProductEntry::with(['colour'])->where('product_slug', $slug)->groupBy('colour_id')->get();
        $category = ProductEntry::with(['category'])->where('product_slug', $slug)->groupBy('category_id')->get();
        $product = ModelsProduct::where('slug', $slug)->first();
        $picture = Picture::where('product_slug', $slug)->get();
        $rating = $product;
        $color_option = ProductEntry::with(['colour'])->where('product_slug', $slug)->where('size_id', $this->size_value)->groupBy('colour_id')->get();


        return view('livewire.product', compact(['size', 'colour', 'category', 'product', 'picture', 'rating', 'color_option']));
    }

    public function cart()
    {
        $this->validate();

        $data_product = ProductEntry::join('products', 'products.slug', '=', 'product_entries.product_slug')->where('product_slug', $this->slug)->where('colour_id', $this->color_value)->where('size_id', $this->size_value)->first();
        if ($this->qty > $data_product->stock) {
            session()->flash('pesan', 'Jumlah yang anda Masukan Melebihi Stock');
        }


        $rowId = "Cart-" . $this->slug . '-' . $this->color_value . '-' . $this->size_value;
        $cart = Cart::getContent();
        $cekItemId = $cart->whereIn('id', $rowId);
        if ($cekItemId->isNotEmpty()) {
            Cart::update($rowId, [
                'quantity' => [
                    'relative' => true,
                    'value' => $this->qty
                ]
            ]);
        } else {
            Cart::add([
                'id' => "Cart-" . $this->slug . '-' . $this->color_value . '-' . $this->size_value,
                'name' => $data_product->name,
                'price' => $data_product->price - ($data_product->price * ($data_product->sale / 100)),
                'quantity' => $this->qty,
                'attributes' => [
                    'size' => $this->color_value,
                    'color' => $this->size_value,
                    'slug' => $data_product->slug
                ]
            ]);
        }


        $this->size_value = null;
        $this->color_value = null;
        $this->qty = null;

        // Cart::clear();
        // dd(Cart::getContent());

        $this->emit('cartAdded');
    }

    public function choose_size()
    {
        $this->color_value = null;
    }


    // public function wishlist()
    // {
    //     $wish_list = app('wishlist');

    //     $this->validate();

    //     $data_product = ProductEntry::join('products', 'products.slug', '=', 'product_entries.product_slug')->where('product_slug', $this->slug)->where('colour_id', $this->color_value)->where('size_id', $this->size_value)->first();
    //     if ($this->qty > $data_product->stock) {
    //         session()->flash('pesan', 'Jumlah yang anda Masukan Melebihi Stock');
    //     }


    //     $rowId = "Cart-" . $this->slug . '-' . $this->color_value . '-' . $this->size_value;
    //     $cart = $wish_list->getContent();
    //     $cekItemId = $cart->whereIn('id', $rowId);
    //     if ($cekItemId->isNotEmpty()) {
    //         $wish_list->update($rowId, [
    //             'quantity' => [
    //                 'relative' => true,
    //                 'value' => $this->qty
    //             ]
    //         ]);
    //     } else {
    //         $wish_list->add([
    //             'id' => "Cart-" . $this->slug . '-' . $this->color_value . '-' . $this->size_value,
    //             'name' => $data_product->name,
    //             'price' => $data_product->price - ($data_product->price * ($data_product->sale / 100)),
    //             'quantity' => $this->qty,
    //             'attributes' => [
    //                 'size' => $this->color_value,
    //                 'color' => $this->size_value,
    //                 'slug' => $data_product->slug
    //             ]
    //         ]);
    //     }


    //     $this->size_value = null;
    //     $this->color_value = null;
    //     $this->qty = null;

    //     // $wish_list->clear();
    //     // dd($wish_list->getContent());

    //     $this->emit('wishlistAdded');
    // }
}
