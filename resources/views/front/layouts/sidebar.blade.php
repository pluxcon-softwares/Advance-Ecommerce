<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="product_summary.html"><img src="{{ asset('images/ico-cart.png') }}" alt="cart">3 Items in your cart</a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        @if (count($sections) > 0)
            @foreach ($sections as $section)
            <li class="subMenu"><a>{{ $section->name }}</a>
                @if (count($section->categories) > 0)
                    @foreach ($section->categories as $category)
                    <ul>
                        <li><a href="{{ url($category->url) }}"><i class="icon-chevron-right"></i><strong>{{ $category->category_name }}</strong></a></li>
                        @if (count($category->subcategories) > 0)
                            @foreach ($category->subcategories as $subcategory)
                                <li><a href="{{ url($subcategory->url) }}"><i class="icon-chevron-right"></i>{{ $subcategory->category_name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                    @endforeach
                @endif

                {{-- <ul>
                    <li><a href="products.html"><i class="icon-chevron-right"></i><strong>T-Shirts</strong></a></li>
                    <li><a href="products.html"><i class="icon-chevron-right"></i>Casual T-Shirts</a></li>
                    <li><a href="products.html"><i class="icon-chevron-right"></i>Formal T-Shirts</a></li>
                </ul>
                <ul>
                    <li><a href="products.html"><i class="icon-chevron-right"></i><strong>Shirts</strong></a></li>
                    <li><a href="products.html"><i class="icon-chevron-right"></i>Casual Shirts</a></li>
                    <li><a href="products.html"><i class="icon-chevron-right"></i>Formal Shirts</a></li>
                </ul> --}}
            </li>
            @endforeach
        @endif
    </ul>
    <br>
    <div class="thumbnail">
        <img src="{{ asset('images/payment_methods.png') }}" title="Payment Methods" alt="Payments Methods">
        <div class="caption">
            <h5>Payment Methods</h5>
        </div>
    </div>
</div>
