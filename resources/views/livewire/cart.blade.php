<li class="mobile-cart item-count" onclick="openCart()">
    <a href="javascript:void(0)">
        <div class="cart-block">
            <div class="cart-icon">
                <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                    xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path
                            d="m497 401.667c-415.684 0-397.149.077-397.175-.139-4.556-36.483-4.373-34.149-4.076-34.193 199.47-1.037-277.492.065 368.071.065 26.896 0 47.18-20.377 47.18-47.4v-203.25c0-19.7-16.025-35.755-35.725-35.79l-124.179-.214v-31.746c0-17.645-14.355-32-32-32h-29.972c-17.64 0-31.99 14.351-31.99 31.99v31.594l-133.21-.232-9.985-54.992c-2.667-14.694-15.443-25.36-30.378-25.36h-68.561c-8.284 0-15 6.716-15 15s6.716 15 15 15c72.595 0 69.219-.399 69.422.719 16.275 89.632 5.917 26.988 49.58 306.416l-38.389.2c-18.027.069-32.06 15.893-29.81 33.899l4.252 34.016c1.883 15.06 14.748 26.417 29.925 26.417h26.62c-18.8 36.504 7.827 80.333 49.067 80.333 41.221 0 67.876-43.813 49.067-80.333h142.866c-18.801 36.504 7.827 80.333 49.067 80.333 41.22 0 67.875-43.811 49.066-80.333h31.267c8.284 0 15-6.716 15-15s-6.716-15-15-15zm-209.865-352.677c0-1.097.893-1.99 1.99-1.99h29.972c1.103 0 2 .897 2 2v111c0 8.284 6.716 15 15 15h22.276l-46.75 46.779c-4.149 4.151-10.866 4.151-15.015 0l-46.751-46.779h22.277c8.284 0 15-6.716 15-15v-111.01zm-30 61.594v34.416h-25.039c-20.126 0-30.252 24.394-16.014 38.644l59.308 59.342c15.874 15.883 41.576 15.885 57.452 0l59.307-59.342c14.229-14.237 4.13-38.644-16.013-38.644h-25.039v-34.254l124.127.214c3.186.005 5.776 2.603 5.776 5.79v203.25c0 10.407-6.904 17.4-17.18 17.4h-299.412l-35.477-227.039zm-56.302 346.249c0 13.877-11.29 25.167-25.167 25.167s-25.166-11.29-25.166-25.167 11.29-25.167 25.167-25.167 25.166 11.291 25.166 25.167zm241 0c0 13.877-11.289 25.167-25.166 25.167s-25.167-11.29-25.167-25.167 11.29-25.167 25.167-25.167 25.166 11.291 25.166 25.167z" />
                    </g>
                </svg>
            </div>
            <div class="cart-item">
                <h5>shopping</h5>
                <h5>cart</h5>
            </div>
        </div>
    </a>
    <div class="item-count-contain">
        {{ $total_item }}
    </div>
</li>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>



<div id="cart_side" class="add_to_cart top ">
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
                                <h4></h4>
                            </a>
                            <h6>
                                Rp. 
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
                    subtotal : <span>Rp. {{ number_format($subTotal) }}</span>
                </li>
                <li>
                    <div class="total">
                        total<span>Rp. {{ number_format($total) }}</span>
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