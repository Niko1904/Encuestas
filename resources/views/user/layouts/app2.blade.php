<!DOCTYPE html>
<!--
	Transit by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html lang="es">
<head>
    @include('user/layouts/head')
</head>

	<body id="body">

		<!-- preloader -->
		<div id="preloader">
            <div class="loder-box">
            	<div class="battery"></div>
            </div>
		</div>
		<!-- end preloader -->
		
		@include('user/layouts/header')
        @section('content')
            @show

  		@include('user/layouts/footer')
  		@stack('js')

	</body>
</html>