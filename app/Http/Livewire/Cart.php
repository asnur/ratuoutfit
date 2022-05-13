<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart as CartItem;

class Cart extends Component
{

    protected $listeners = [
        'cartAdded' => 'render',
        'wishlistAdded' => 'render'
    ];

    public function render()
    {
        $items = CartItem::getContent();
        $wishlist = app('wishlist');
        // $item_wishlist = $wishlist->getContent();
        // dd($wishlist);

        if ($items->isEmpty()) {
            $cartData = [];
        } else {
            foreach ($items as $item) {
                $cart[] = [
                    'rowId' => $item->id,
                    'name' => $item->name,
                    'quantity' => $item->quantity,
                    'price' => $item->getPriceSum(),
                    'attribute' => [
                        'size' => $item->attributes->size,
                        'color' => $item->attributes->color,
                        'slug' => $item->attributes->slug
                    ]
                ];
            }

            $cartData = collect($cart);
        }

        $total_item = count($cartData);
        $subTotal = CartItem::getSubTotal();
        $total = CartItem::getTotal();
        // dd($cartData);
        return view('livewire.cart', compact(['total_item', 'subTotal', 'total']));
    }
}
