@extends('front.layouts.master')

@section('content')

@if((count($featuredProducts) > 0))

<div class="well well-small">
    <h4>Featured Products <small class="pull-right">{{ $countFeaturedProducts }} featured products</small></h4>
    <div class="row-fluid">
        <div id="featured" class=" @if($countFeaturedProducts > 4) carousel slide @endif">
            <div class="carousel-inner">
                @foreach($featuredProducts as $key => $featuredProduct)
                    <div class="item">
                        <ul class="thumbnails">
                            @foreach ($featuredProduct as $item)
                                <li class="span3">
                                    <div class="thumbnail">
                                        <i class="tag"></i>
                                        @if(!empty($item['product_main_image']))
                                            <a href="product_details.html"><img src="{{ asset('storage/product_images/small/'.$item['product_main_image']) }}" alt=""></a>
                                        @else
                                            <a href="product_details.html"><img src="{{ asset('images/no_image.jpg') }}" alt=""></a>
                                        @endif

                                        <div class="caption">
                                            <h5>{{ $item['product_name'] }}</h5>
                                            <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">Ghc.{{ $item['product_price'] }}</span></h4>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
            {{-- <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
            <a class="right carousel-control" href="#featured" data-slide="next">›</a> --}}
        </div>
    </div>
</div>

@endif

@if (count($latestProducts) > 0)
<h4>Latest Products </h4>
<ul class="thumbnails">
    @foreach ($latestProducts as $latestProduct)
        <li class="span3">
            <div class="thumbnail">
                @if(!empty($latestProduct->product_main_image))
                    <a href="product_details.html"><img src="{{ asset('storage/product_images/medium/'.$latestProduct->product_main_image) }}" alt="" style="width 150px"></a>
                @else
                    <a href="product_details.html"><img src="{{ asset('images/no_image.jpg') }}" alt="" style="width 150px"></a>
                @endif

                <div class="caption">
                    <h5>{{ $latestProduct->product_name }}</h5>
                    <p>
                        Lorem Ipsum is simply dummy text.
                    </p>

                    <h4 style="text-align:center">
                        <a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a>
                        <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a>
                        <a class="btn btn-primary" href="#">Ghc.{{ $latestProduct->product_price }}</a>
                    </h4>
                </div>
            </div>
        </li>
    @endforeach
</ul>
@endif

@endsection
