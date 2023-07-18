@extends('frontend.master_dashboard')
@section('main')
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a> <span></span> {{ $product['subcategory']['subcategory_name'] }} <span></span>{{ $product->product_name }}
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="row">
        <div class="col-xl-10 col-lg-12 m-auto">
            <div class="product-detail accordion-detail">
                <div class="row mb-50 mt-30">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                            <!-- MAIN SLIDES -->
                            <div class="product-image-slider">
                                @foreach($multiImage as $img)
                                <figure class="border-radius-10">
                                    <img src="{{ asset($img->photo_name) }} " alt="product image" />
                                </figure>
                                @endforeach
                            </div>
                            <!-- THUMBNAILS -->
                            <div class="slider-nav-thumbnails">
                                @foreach($multiImage as $img)
                                <div><img src="{{ asset($img->photo_name) }}" alt="product image" /></div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">
                            @if($product->product_qty > 0)
                            <span class="stock-status in-stock">In Stock </span>
                            @else
                            <span class="stock-status out-stock">Stock Out </span>
                            @endif

                            <h2 class="title-detail" id="dpname">{{$product->product_name}}</h2>
                            <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                </div>
                            </div>

                            <div class="clearfix product-price-cover">
                                @php
                                $amount = $product->selling_price - $product->discount_price;
                                $discount = ($amount/$product->selling_price) * 100;
                                @endphp
                                @if($product->discount_price == NULL)
                                <div class="product-price primary-color float-left">
                                    <span class="current-price text-brand">${{ $product->selling_price }}</span>

                                </div>
                                @else
                                <div class="product-price primary-color float-left">
                                    <span class="current-price text-brand">${{ $product->discount_price }}</span>
                                    <span>
                                        <span class="save-price font-md color3 ml-15">{{ round($discount) }}% Off</span>
                                        <span class="old-price font-md ml-15">${{ $product->selling_price }}</span>
                                    </span>
                                </div>
                                @endif
                            </div>

                            <div class="short-desc mb-30">
                                <p class="font-lg">{{$product->short_descp}}</p>
                            </div>

                            @if($product->product_size == NULL)

                            @else

                            <div class="attr-detail attr-size mb-30">
                                <strong class="mr-10" style="width:50px;">Size : </strong>
                                <select class="form-control unicase-form-control" id="dsize">
                                    <option selected="" disabled="">--Choose Size--</option>
                                    @foreach($product_size as $size)
                                    <option value="{{ $size }}">{{ ucwords($size)  }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @endif

                            @if($product->product_color == NULL)

                            @else

                            <div class="attr-detail attr-size mb-30">
                                <strong class="mr-10" style="width:50px;">Color : </strong>
                                <select class="form-control unicase-form-control" id="dcolor">
                                    <option selected="" disabled="">--Choose Color--</option>
                                    @foreach($product_color as $color)
                                    <option value="{{ $color }}">{{ ucwords($color)  }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @endif



                            <div class="detail-extralink mb-50">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <input type="text" name="quantity" id="dqty" class="qty-val" value="1" min="1">
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">

                                    <input type="hidden" id="dproduct_id" value="{{ $product->id}}">
                                    <button type="submit" class="button button-add-to-cart" onclick="addToCartDetails()">
                                        <i class="fi-rs-shopping-cart"></i>Add to cart
                                    </button>


                                    <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                </div>`
                            </div>


                            <div class="font-xs">
                                <ul class="mr-50 float-start">
                                    <li class="mb-5">Brand: <span class="text-brand">{{ $product['brand']['brand_name'] }}</span></li>
                                    <li class="mb-5">Category:<span class="text-brand"> {{ $product['category']['category_name'] }}</span></li>
                                    <li>SubCategory: <span class="text-brand">{{ $product['subcategory']['subcategory_name'] }}</span></li>
                                </ul>
                                <ul class="float-start">
                                    <li class="mb-5">Product Code: <a href="#">{{ $product->product_code }}</a></li>
                                    <li class="mb-5">Tags:<a href="#" rel="tag"> {{ $product->product_tags }}</a></li>
                                    <li>Stock:<span class="in-stock text-brand ml-5">({{ $product->product_qty }}) Items In Stock</span></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>

                {{-- 
                <div class="row mt-60">
                    <div class="col-12">
                        <h2 class="section-title style-1 mb-30">Related products</h2>
                    </div>
                    <div class="col-12">
                        <div class="row related-products">

                            @foreach($relatedProduct as $product)
                            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap hover-up">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" tabindex="0">
                                                <img class="default-img" src="{{ asset( $product->product_thambnail ) }}" alt="" />

                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html" tabindex="0"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                        </div>

                                        @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount/$product->selling_price) * 100;

                                        @endphp
                                        <div class="product-badges product-badges-position product-badges-mrg">




                                            @if($product->discount_price == NULL)
                                            <span class="new">New</span>
                                            @else
                                            <span class="hot"> {{ round($discount) }} %</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <h2><a href="shop-product-right.html" tabindex="0">{{ $product->product_name }}</a></h2>
                                        <div class="rating-result" title="90%">
                                            <span> </span>
                                        </div>

                                        @if($product->discount_price == NULL)
                                        <div class="product-price">
                                            <span>${{ $product->selling_price }}</span>

                                        </div>
                                        @else
                                        <div class="product-price">
                                            <span>${{ $product->discount_price }}</span>
                                            <span class="old-price">${{ $product->selling_price }}</span>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div> --}}


            </div>
        </div>
    </div>
</div>
@endsection
