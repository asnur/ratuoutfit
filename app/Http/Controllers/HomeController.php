<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Picture;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductEntry;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $product;
    public function __construct()
    {
        // $this->middleware('auth');
        $this->product = new Product();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ProductEntry $productEntry, Product $product)
    {
        $detail_product = $productEntry->with(['product', 'size', 'colour', 'category']);
        $data_product = $product->get();
        $special_product = $product->where('special', '=', 1)->get();
        $rating = $product;
        $category = ProductEntry::with('category')->groupBy('category_id')->get();
        // dd($special_product);
        // $category_hijab = ProductEntry::with('category')->where('category_value', 'hijab')->groupBy('category_id')->get();
        return view('upage.index', compact(['data_product', 'rating', 'category', 'special_product']));
    }

    public function detail($slug)
    {
        $size = ProductEntry::with(['size'])->where('product_slug', $slug)->groupBy('size_id')->get();
        $colour = ProductEntry::with(['colour'])->where('product_slug', $slug)->groupBy('colour_id')->get();
        $category = ProductEntry::with(['category'])->where('product_slug', $slug)->groupBy('category_id')->first();
        $product = Product::where('slug', $slug)->first();
        $picture = Picture::where('product_slug', $slug)->get();
        $rating = $product;
        $list_category = Category::all();
        $new_product = $this->product;
        $relate_product = $this->product->new_product($category->category->category_value);
        return view('upage.detail', compact(['size', 'colour', 'category', 'product', 'picture', 'rating', 'list_category', 'new_product', 'relate_product']));
    }
}
