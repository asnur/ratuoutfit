<div class="product-right ">
    <div class="pro-group">
        <h2>{{ $product->name }}</h2>
        <ul class="pro-price">
            <li>Rp.
                {{ number_format($product->price - ($product->price*($product->sale/100))) }}
            </li>
            <li><span>Dari
                    Rp.{{ number_format($product->price) }}</span>
            </li>
            <li>{{ $product->sale }}% off</li>
        </ul>
        <div class="revieu-box">
            <ul>
                @if($rating->rating($product->id) > 0)
                
                @for($i=0; $i<floor($rating->rating($product->id)); $i++) 
            
                <li>
                    <i class="fa fa-star"></i>
                </li>
                @endfor
                @for($i=0; $i< 5-floor($rating->rating($product->id)); $i++)
            
                <li>
                    <i class="fa fa-star-o"></i>
                </li>
                @endfor
                @else
               
                @for($i=0; $i<5;$i++)
           
                <li>
                    <i class="fa fa-star-o"></i>
                </li>
                @endfor
                @endif
            </ul>
            <a><span>({{ $rating->countReview($product->id) }} reviews)</span></a>
        </div>
    </div>
    
    <div id="selectSize"
        class="pro-group addeffect-section product-description border-product">
        <h6 class="product-title size-text">select size<span>
                <a href="#" data-bs-toggle="modal" data-bs-target="#sizemodal">size
                    chart</a></span></h6>
        <div class="error">
            @error('size_value') 
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        {{ $size_value }}
        <ul>
            <li>
                {{-- <a href="javascript:void(0)">{{  }}</a> --}}
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    @foreach ($size as $s)
                        <input type="radio" wire:model="size_value" wire:click="choose_size" class="btn-check" id="{{ $s->size->size_value }}" autocomplete="off" value="{{ $s->size->id }}" aria-disabled="true" tabindex="-1">
                        <label class="btn btn-outline-primary" for="{{ $s->size->size_value }}">{{ $s->size->size_value }}</label>
                    @endforeach
                </div>
            </li>
        </ul>
        {{-- <div class="size-box">
            
        </div> --}}
        {{-- {{ $color_value }} --}}
        <h6 class="product-title mt-3">color</h6>
        <div class="error">
            @error('color_value') 
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
{{ $color_value }}

        <div class="color-selector inline">
            <ul>
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        @if($color_option->count() == 0)
                            @foreach ($colour as $c)
                                <input type="radio" wire:model="color_value" class="btn-check p-3" id="{{ $c->colour->color_value }}" autocomplete="off" value="{{ $c->colour->id }}" disabled>
                                <label class="btn btn-outline-primary p-3" style="background:{{ $c->colour->color_value }}" for="{{ $c->colour->color_value }}"></label>
                            @endforeach
                        @else
                            @foreach($color_option as $cp)
                            <input type="radio" wire:model="color_value" class="btn-check p-3" id="{{ $cp->colour->color_value }}" autocomplete="off" value="{{ $cp->colour->id }}">
                            <label class="btn btn-outline-primary p-3" style="background:{{ $cp->colour->color_value }}" for="{{ $cp->colour->color_value }}"></label>
                            @endforeach
                        @endif
                    </div>
            </ul>
        </div>
        <h6 class="product-title">quantity</h6>
        <div class="error">
            @error('qty') 
                <span class="error text-danger">{{ $message }}</span>
            @enderror
            @if(session()->has('pesan'))
                <span class="error text-danger">{{ session('pesan') }}</span>
            @endif
        </div>
        <div class="qty-box">
            <div class="input-group">
                <button class="qty-minus" wire:click="decrement" {{ (!isset($color_value, $size_value)) ? 'disabled' : '' }}></button>
                <input class="qty-adj form-control" type="number"  wire:model="qty" />
                <button class="qty-plus" wire:click="increment" {{ (!isset($color_value, $size_value)) ? 'disabled' : '' }}></button>
            </div>
        </div>
        <div class="product-buttons mt-3">
            <button type="submit" wire:click="cart" id="cartEffect"
                class="btn cart-btn btn-normal tooltip-top"
                data-tippy-content="Add to cart">
                <i class="fa fa-shopping-cart"></i>
                add to cart
            </button>
            <button wire:click="wishlist" class="btn btn-normal add-to-wish tooltip-top"
                data-tippy-content="Add to wishlist">
                <i class="fa fa-heart" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</div>