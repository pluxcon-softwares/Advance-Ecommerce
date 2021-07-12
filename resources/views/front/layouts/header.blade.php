<div id="header">
	<div class="container">
		<div id="welcomeLine" class="row">
			<div class="span6">Welcome!<strong> User</strong></div>
			<div class="span6">
				<div class="pull-right">
					<a href="product_summary.html"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ 3 ] Items in your cart </span> </a>
				</div>
			</div>
		</div>
		<!-- Navbar ================================================== -->
		<section id="navbar">
		  <div class="navbar">
		    <div class="navbar-inner">
		      <div class="container">
		        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		        </a>
		        <a class="brand" href="#">Stack Developers</a>
		        <div class="nav-collapse">
		          <ul class="nav">
		            <li class="active"><a href="#">Home</a></li>
		            @if(count($sections) > 0)
                        @foreach ($sections as  $section)
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $section->name }} <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                              @if (count($section->categories) > 0)
                                  @foreach ($section->categories as $category)
                                  <li class="divider"></li>
                                  <li class="nav-header"><a href="#">{{ $category->category_name }}</a></li>
                                    @if (count($category->subcategories) > 0)
                                        @foreach ($category->subcategories as $subcategory)
                                            <li><a href="#">{{ $subcategory->category_name }}</a></li>
                                        @endforeach
                                    @endif
                                  @endforeach
                              @endif
                            </ul>
                          </li>
                        @endforeach
                    @endif
		            <li><a href="#">About</a></li>
		          </ul>
		          <form class="navbar-search pull-left" action="#">
		            <input type="text" class="search-query span2" placeholder="Search">
		          </form>
		          <ul class="nav pull-right">
		            <li><a href="#">Contact</a></li>
		            <li class="divider-vertical"></li>
		            <li><a href="#">Login</a></li>
		          </ul>
		        </div><!-- /.nav-collapse -->
		      </div>
		    </div><!-- /navbar-inner -->
		  </div><!-- /navbar -->
		</section>
	</div>
</div>

@if(session('page') == 'Index')

<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
			<div class="item">
				<div class="container">
					<a href="#"><img style="width:100%" src="{{ asset('images/carousel/1.png') }}" alt="special offers"></a>
					<div class="carousel-caption">
						<h4>First Thumbnail label</h4>
						<p>Banner text</p>
					</div>
				</div>
			</div>
			<div class="item active">
				<div class="container">
					<a href="register.html"><img style="width:100%" src="{{ asset('images/carousel/2.png') }}" alt=""></a>
					<div class="carousel-caption">
						<h4>Second Thumbnail label</h4>
						<p>Banner text</p>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="container">
					<a href="register.html"><img src="{{ asset('images/carousel/3.png') }}" alt=""></a>
					<div class="carousel-caption">
						<h4>Third Thumbnail label</h4>
						<p>Banner text</p>
					</div>

				</div>
			</div>
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
	</div>
</div>

@endif
