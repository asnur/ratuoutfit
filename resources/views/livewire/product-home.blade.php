

<div>
    {{ $category_value }}
    <section class="section-pt-space">
        <div class="tab-product-main">
            <div class="tab-prodcut-contain">
                <ul class="tabs tab-title">
                    <li style="color: #ea86b6;
                    text-transform: uppercase;
                    font-weight: 700;
                    font-size: calc(14px + (18 - 14) * ((100vw - 320px) / (1920 - 320))); cursor:pointer;">New Product</li>
                </ul>
            </div>
        </div>
    </section>
    {{-- <h1>{{ d$category_value_fix }}</h1> --}}
    <section class="product section-pb-space mb--5">
        <div class="custom-container">
            <div class="row">
                <div class="col pr-0">
                    <div class="product-slide-6 no-arrow">
                        @foreach ($data_product as $dp)
                        <div>
                            <div class="product-box">
                                <div class="product-imgbox">
                                    <div class="product-front">
                                        <a href="{{ route('detail', $dp->slug) }}">
                                            <img src="{{ asset('vendor/themes') }}/images/product/{{ $dp->cover }}"
                                                class="img-fluid  " alt="product"
                                                style="height: 350px; object-fit:cover; object-possition: center;">
                                        </a>
                                    </div>
                                    <div class="product-back">
                                        <a href="{{ route('detail', $dp->slug) }}">
                                            <img src="{{ asset('vendor/themes') }}/images/product/{{ $dp->cover }}"
                                                class="img-fluid  " alt="product"
                                                style="height: 350px; object-fit:cover; object-possition: center;">
                                        </a>
                                    </div>
                                    <div class="product-icon icon-inline">
                                        <button onclick="openCart()" class="tooltip-top" data-tippy-content="Add to cart">
                                            <i data-feather="shopping-cart"></i>
                                        </button>
                                        <a href="javascript:void(0)" class="add-to-wish tooltip-top"
                                            data-tippy-content="Add to Wishlist">
                                            <i data-feather="heart"></i>
                                        </a>
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#quick-view"
                                            class="tooltip-top" data-tippy-content="Quick View">
                                            <i data-feather="eye"></i>
                                        </a>
                                        <a href="compare.html" class="tooltip-top" data-tippy-content="Compare">
                                            <i data-feather="refresh-cw"></i>
                                        </a>
                                    </div>
                                    <div class="new-label1">
                                        <div>new</div>
                                    </div>
                                    <div class="on-sale1">
                                        on sale
                                    </div>
                                </div>
                                <div class="product-detail detail-inline ">
                                    <div class="detail-title">
                                        <div class="detail-left">
                                            <div class="rating-star">
                                                @if($rating->rating($dp->id) > 0)
                                                <?php 
                                                    for($i=0; $i<floor($rating->rating($dp->id)); $i++){ 
                                                ?>
                                                <i class="fa fa-star"></i>
                                                <?php
                                                    }
                                                    for($i=0; $i<= 5-floor($rating->rating($dp->id)); $i++){
                                                ?>
                                                <i class="fa fa-star" style="color: gray"></i>
                                                <?php } ?>
                                                @else
                                                <?php
                                                    for($i=0; $i<=5;$i++){
                                                ?>
                                                <i class="fa fa-star" style="color: gray"></i>
                                                <?php } ?>
                                                @endif
                                            </div>
                                            <a href="product-page(left-sidebar).html">
                                                <h6 class="price-title">
    
                                                    {{ $dp->name }}
                                                </h6>
                                            </a>
                                        </div>
                                        <div class="detail-right">
                                            <div class="check-price">
                                                Rp.{{ number_format($dp->price) }}
                                            </div>
                                            <div class="price">
                                                <div class="price">
                                                    Rp.{{ number_format($dp->price - ($dp->price * ($dp->sale / 100))) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
