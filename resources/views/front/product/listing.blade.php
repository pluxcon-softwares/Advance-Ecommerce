@extends('front.layouts.master')

@section('content')

<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
        <li class="active">{!! $categoryDetails['breadcrumbs'] !!}</li>
    </ul>
    <h3> {{ $categoryDetails['categoryDetails']['category_name'] }} <small class="pull-right"> {{ count($products) }} products are available </small></h3>
    <hr class="soft">
    @if(!empty($categoryDetails['categoryDetails']['description']))
        <p>
            Nowadays the lingerie industry is one of the most successful business spheres.We always stay in touch with the latest fashion tendencies - that is why our goods are so popular and we have a great number of faithful customers all over the country.
        </p>
        <hr class="soft">
    @endif

    <form class="form-horizontal span6" id="filter_products">
        <div class="control-group">
            <label class="control-label alignL">Sort By </label>
            <select name="sort" id="sort_products">
                <option value="">select</option>
                <option value="latest_products">Latest Products</option>
                <option value="product_name_a_z">Product Name A - Z</option>
                <option value="product_name_z_a">Product Name Z - A</option>
                <option value="lowest_price_first">Lowest Price First</option>
                <option value="highest_price_first">Highest Price First</option>
            </select>
        </div>
    </form>

    <div id="myTab" class="pull-right">
        <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
        <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
    </div>

    <br class="clr">

    <div class="tab-content">
        <div class="tab-pane" id="listView">
            @foreach ($products as $listViewProduct)
                <div class="row">
                    <div class="span2">
                        @if (!empty($listViewProduct['product_main_image']))
                            <img src="{{ asset('storage/product_images/small/'.$listViewProduct['product_main_image']) }}" alt="">
                        @else
                        <img src="{{ asset('images/no_image.jpg') }}" alt="no_image">
                        @endif
                    </div>
                    <div class="span4">
                        <h3>New | Available</h3>
                        <hr class="soft">
                        <h5>{{ $listViewProduct['product_name'] }} </h5>
                        <p>
                            <strong>Brand:</strong> {{ $listViewProduct['brand']['name'] }}
                        </p>
                        <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                        <br class="clr">
                    </div>
                    <div class="span3 alignR">
                        <form class="form-horizontal qtyFrm">
                            <h3> Ghc{{ $listViewProduct['product_price'] }}</h3>
                            <label class="checkbox">
                                <input type="checkbox">  Adds product to compair
                            </label><br>

                            <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                            <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>

                        </form>
                    </div>
                </div>
                <hr class="soft">
            @endforeach
        </div>
        <div class="tab-pane  active" id="blockView">
            <ul class="thumbnails">
                @foreach ($products as $product)

                <li class="span3">
                    <div class="thumbnail">
                        @if(!empty($product['product_main_image']))
                        <a href="product_details.html">
                            <img src="{{ asset('storage/product_images/small/'.$product['product_main_image']) }}" alt="{{ $product['product_main_image'] }}" style="width: 200px;"></a>
                        @else
                            <img src="{{ asset('images/no_image.jpg') }}" alt="no_image" style="width: 200px;"></a>
                        @endif
                        <div class="caption">
                            <h5>{{ $product['product_name'] }}</h5>
                            <p>
                                <strong>Brand:</strong> {{ $product['brand']['name'] }}
                            </p>
                            <h4 style="text-align:center">
                                <a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a>
                                <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a>
                                <a class="btn btn-primary" href="#">Ghc. {{ $product['product_price'] }} </a>
                            </h4>
                        </div>
                    </div>
                </li>

                @endforeach
            </ul>
            <hr class="soft">
        </div>
    </div>
    <a href="compair.html" class="btn btn-large pull-right">Compair Product</a>

    <div class="pagination">
        {{ $products->appends(['sort' => $_GET['sort']])->links() }}
    </div>
    <br class="clr">
</div>

@endsection


@section('extra_script')
    <script src="{{ asset('js/front/product.js') }}"></script>
@endsection
