<html lang="en"><head>
	<meta charset="utf-8">
	<title>Stack Developers online Shopping cart</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Front style -->
	<link id="callCss" rel="stylesheet" href="{{ asset('css/front.min.css') }}" media="screen">
	<link href="{{ asset('css/base.css') }}" rel="stylesheet" media="screen">
	<!-- Front style responsive -->
	<link href="{{ asset('css/front-responsive.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet" type="text/css">
	<!-- Google-code-prettify -->
	<link href="{{ asset('js/google-code-prettify/prettify.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
	<!-- fav and touch icons -->
	<link rel="shortcut icon" href="{{ asset('images/ico/favicon.ico') }}">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('images/ico/apple-touch-icon-144-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/ico/apple-touch-icon-114-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/ico/apple-touch-icon-72-precomposed.png') }}">
	<link rel="apple-touch-icon-precomposed" href="{{ asset('images/ico/apple-touch-icon-57-precomposed.png') }}">
	<style type="text/css" id="enject"></style>
</head>
<body>

    @include('front.layouts.header')
<!-- Header End====================================================================== -->

<div id="mainBody">
	<div class="container">
		<div class="row">
			<!-- Sidebar ================================================== -->
			@include('front.layouts.sidebar')
			<!-- Sidebar end=============================================== -->
			<div class="span9">
				@yield('content')
			</div>
		</div>
	</div>
</div>

<!-- Footer ================================================================== -->
@include('front.layouts.footer')
<!-- Placed at the end of the document so the pages load faster ============================================= -->

<script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/front.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/google-code-prettify/prettify.js') }}"></script>

<script src="{{ asset('js/front.js') }}"></script>
<script src="{{ asset('js/jquery.lightbox-0.5.js') }}"></script>

@yield('extra_script')

{{-- <script src="{{ asset('js/app.js') }}"></script> --}}

</body>
</html>
