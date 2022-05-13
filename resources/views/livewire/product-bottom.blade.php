<div class="bottom-cart-sticky ">
    <div class="container">
        <div class="cart-content">
            <div class="product-image">
                <img src="{{ asset('vendor/themes') }}/images/product/{{ $product->cover }}" class="img-fluid" alt="">
                <div class="content d-lg-block d-none">
                    <h5>{{ $product->name }}</h5>
                    <h6>Rp.{{ number_format($product->price - ($product->price*($product->sale/100))) }}<del>Rp.{{ number_format($product->price) }}</del><span>{{ $product->sale }}% off</span></h6>
                </div>
            </div>
            <div class="selection-section">
                <div class="form-group mb-0">
                    <select class="form-control" wire:model="size_value">
                        <option selected="">Pilih Ukuran</option>
                        @foreach ($size as $s)
                            <option value="{{ $s->size->id }}">{{ $s->size->size_value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-0">
                    <select class="form-control" wire:model="color_value" {{ (!isset($size_value)) ? 'disabled' : '' }}>
                        <option selected="">Pilih Warna</option>
                        @foreach ($color_option as $c)
                            <option value="{{ $c->colour->id }}">{{ $c->colour->color_value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="add-btn">
                <button wire:click="cart" {{ (!isset($size_value, $color_value)) ? 'disabled' : '' }} class="btn btn-solid btn-sm"><i class="fa fa-cart-plus"></i> Keranjang</button>
            </div>
        </div>
    </div>
</div>