@extends('master.app')
@section('master-page')
<!-- breadcrumb start -->
<div class="breadcrumb-main ">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb-contain">
                    <div>
                        <h2>cart</h2>
                        <ul>
                            <li><a href="javascript:void(0)">home</a></li>
                            <li><i class="fa fa-angle-double-right"></i></li>
                            <li><a href="javascript:void(0)">cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->


<!--section start-->
<section class="cart-section section-big-py-space b-g-light">
    <div class="custom-container">
        <div class="row">
            <div class="col-sm-12">
                <table class="table cart-table table-responsive-xs">
                    <thead>
                        <tr class="table-head">
                            <th scope="col">image</th>
                            <th scope="col">product name</th>
                            <th scope="col">price</th>
                            <th scope="col">quantity</th>
                            <th scope="col">action</th>
                            <th scope="col">total</th>
                        </tr>
                    </thead>
@php $total = 0 @endphp
@foreach((array) session('cart') as $id => $details)
@php $total += $details['price'] * $details['quantity'] @endphp
@endforeach

@if(session('cart'))
@foreach(session('cart') as $id => $details)
                    <tbody>
                        <tr>
                            <td>
                                <a href="javascript:void(0)"><img
                                        src="{{ asset('vendor/themes') }}/images/layout-3/product/1.jpg" alt="cart"
                                        class=" "></a>
                            </td>
                            <td><a href="javascript:void(0)">{{ $details['name'] }}</a>
                                <div class="mobile-cart-content">
                                    <div class="col-xs-3">
                                        <div class="qty-box">
                                            <div class="input-group">
                                                <input type="text" name="quantity" class="form-control input-number"
                                                    value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <h2 class="td-color">${{ $details['price'] }}</h2>
                                    </div>
                                    <div class="col-xs-3">
                                        <h2 class="td-color"><a href="javascript:void(0)" class="icon"><i
                                                    class="ti-close"></i></a></h2>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h2>$63.00</h2>
                            </td>
                            <td>
                                <div class="qty-box">
                                    <div class="input-group">
                                        <input type="number" name="quantity" class="form-control input-number"
                                            value="1">
                                    </div>
                                </div>
                            </td>
                            <td><a href="javascript:void(0)" class="icon"><i class="ti-close"></i></a></td>
                            <td>
                                <h2 class="td-color">$4539.00</h2>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                    @endif
                 
                </table>
                <table class="table cart-table table-responsive-md">
                    <tfoot>
                        <tr>
                            <td>total price :</td>
                            <td>
                                <h2>$ {{ $total }}</h2>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row cart-buttons">
            <div class="col-12"><a href="javascript:void(0)" class="btn btn-normal">continue shopping</a> <a
                    href="javascript:void(0)" class="btn btn-normal ms-3">check out</a></div>
        </div>
    </div>
</section>
<!--section end-->

<!-- Add to cart bar -->
<div id="cart_side" class="add_to_cart right">
    <a href="javascript:void(0)" class="overlay" onclick="closeCart()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>my cart</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeCart()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <div class="cart_media">
            <ul class="cart_product">
                <li>
                    <div class="media">
                        <a href="product-page(left-sidebar).html">
                            <img alt="megastore1" class="me-3"
                                src="{{ asset('vendor/themes') }}/images/layout-2/product/1.jpg">
                        </a>
                        <div class="media-body">
                            <a href="product-page(left-sidebar).html">
                                <h4>redmi not 3</h4>
                            </a>
                            <h6>
                                $80.00 <span>$120.00</span>
                            </h6>
                            <div class="addit-box">
                                <div class="qty-box">
                                    <div class="input-group">
                                        <button class="qty-minus"></button>
                                        <input class="qty-adj form-control" type="number" value="1" />
                                        <button class="qty-plus"></button>
                                    </div>
                                </div>
                                <div class="pro-add">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-product">
                                        <i data-feather="edit"></i>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <i data-feather="trash-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="media">
                        <a href="product-page(left-sidebar).html">
                            <img alt="megastore1" class="me-3"
                                src="{{ asset('vendor/themes') }}/images/layout-2/product/2.jpg">
                        </a>
                        <div class="media-body">
                            <a href="product-page(left-sidebar).html">
                                <h4>Double Door Refrigerator</h4>
                            </a>
                            <h6>
                                $80.00 <span>$120.00</span>
                            </h6>
                            <div class="addit-box">
                                <div class="qty-box">
                                    <div class="input-group">
                                        <button class="qty-minus"></button>
                                        <input class="qty-adj form-control" type="number" value="1" />
                                        <button class="qty-plus"></button>
                                    </div>
                                </div>
                                <div class="pro-add">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-product">
                                        <i data-feather="edit"></i>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <i data-feather="trash-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="media">
                        <a href="product-page(left-sidebar).html">
                            <img alt="megastore1" class="me-3"
                                src="{{ asset('vendor/themes') }}/images/layout-2/product/3.jpg">
                        </a>
                        <div class="media-body">
                            <a href="product-page(left-sidebar).html">
                                <h4>woman hande bag</h4>
                            </a>
                            <h6>
                                $80.00 <span>$120.00</span>
                            </h6>
                            <div class="addit-box">
                                <div class="qty-box">
                                    <div class="input-group">
                                        <button class="qty-minus"></button>
                                        <input class="qty-adj form-control" type="number" value="1" />
                                        <button class="qty-plus"></button>
                                    </div>
                                </div>
                                <div class="pro-add">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-product">
                                        <i data-feather="edit"></i>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <i data-feather="trash-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="cart_total">
                <li>
                    subtotal : <span>$1050.00</span>
                </li>
                <li>
                    shpping <span>free</span>
                </li>
                <li>
                    taxes <span>$0.00</span>
                </li>
                <li>
                    <div class="total">
                        total<span>$ {{ $total }}</span>
                    </div>
                </li>
                <li>
                    <div class="buttons">
                        <a href="cart.html" class="btn btn-solid btn-sm">view cart</a>
                        <a href="checkout.html" class="btn btn-solid btn-sm ">checkout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Add to cart bar end-->
@endsection
