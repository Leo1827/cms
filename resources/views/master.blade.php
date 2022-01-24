<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title') - {{ Config::get('cms.name') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="routeName" content="{{ Route::currentRouteName() }}">
	<meta name="currency" content="{{ Config::get('cms.currency') }}">
	<meta name="auth" content="{{ Auth::check() }}">

	<!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<!-- Add the slick-theme.css if you want default styling -->
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
	<link rel="stylesheet" href="{{ url('/static/css/style.css?v='.time()) }}">
	<link rel="stylesheet" href="/static/css/navbar.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b0d8aefb17.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <!--<script src="{{ url('/static/libs/ckeditor/ckeditor.js')}}"></script>-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script src="{{ url('/static/js/mdslider.js?v='.time()) }}"></script>
    <script src="{{ url('/static/js/site.js?v='.time()) }}"></script>
	<!-- Sweet alert 2 -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<body>

		<nav class="navbar navbar-expand-lg shadow">
			<div class="container">
				<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('/static/images/logo.png') }}"></a>
    				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigationMain" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      				<i class="fas fa-bars" style="font-size: .92em;"></i>
    				</button>
					<!-- Menu de navegacion -->
    				<div class="collapse navbar-collapse " id="navigationMain">
    					<ul class="navbar-nav ml-auto">
    						<li class="nav-item">
    							<a class="nav-link " href="{{ url('/') }}"><i class="fas fa-home"></i><span> Inicio</span></a>
    						</li>
    						<li class="nav-item">
    							<a class="nav-link " href="{{ url('/store') }}"><i class="fas fa-store-alt"></i><span> Tienda</span></a>
    						</li>
    						<li class="nav-item">
    							<a class="nav-link " href="{{ url('/') }}"><i class="fas fa-id-card-alt"></i><span> Quiénes somos</span></a>
    						</li>
    						<li class="nav-item">
    							<a class="nav-link " href="{{ url('/') }}"><i class="fas fa-envelope-open"></i><span> Contacto</span></a>
    						</li>
    						<li class="nav-item">
    							<a class="nav-link " href="{{ url('/car') }}"><i class="fas fa-shopping-cart"></i> <span class="carnumber">0</span></a>
    						</li>
    						@if(Auth::guest())
    						<li class="nav-item link-acc">
    							<a class="nav-link btn rec" href="{{ url('/login') }}"><i class="fas fa-user"></i> Ingresar</a>
    							<a class="nav-link btn rec" href="{{ url('/register') }}"><i class="fas fa-user-circle"></i> Crear cuenta</a>
    						</li>
    						@else
    						<li class="nav-item link-acc link-user dropdown">
    							<a href="{{ url('/') }}" class="nav-link btn dropdown-toggle rec" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    								@if(is_null(Auth::user()->avatar)) 
    								<img src="{{ url('/static/images/default-avatar.png') }}" style="border-radius: 50%; width: 36px;"> 
    								@else
									<img src="{{ url('/uploads_users/'.Auth::id().'/av_'.Auth::user()->avatar) }}" style="border-radius: 50%; width: 36px;">
    								@endif Hola: {{ Auth::user()->name }} 
    							</a>
    							<ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">
    								@if(Auth::user()->role == "1")
    								<li><a class="dropdown-item" href="{{ url('/admin') }}">
    									<i class="fas fa-chalkboard-teacher"></i> Administración</a></li>
    								<li><hr class="dropdown-divider container"></li>
    								@endif
									<li>
										<a class="dropdown-item" href="{{ url('/account/favorites') }}">
    									<i class="far fa-heart"></i> Favoritos</a>
									</li>
    								<li>
										<a class="dropdown-item" href="{{ url('/account/edit') }}">
    									<i class="far fa-address-card"></i> Editar perfil</a>
									</li>
    								<li>
										<a class="dropdown-item" href="{{ url('/logout') }}">
    									<i class="fas fa-sign-out-alt"></i> Salir</a>
									</li>
    							</ul>
    						</li>
    						@endif
    					</ul>
    				</div>
					<!-- Fin de menu de navegacion -->
			</div>	
		</nav>

		@if(Session::has('message'))
		    <div class="container">
		    	<div class="alert alert-{{ Session::get('typealert') }} mtop16" style="display:block; margin-bottom: 16px;">
		    		{{ Session::get('message') }}
		    		@if ($errors->any())
		    		<ul>
		    			@foreach($errors->all() as $error)
		    			<li>{{ $error }}</li>
		    			@endforeach
		    		</ul>
		    		@endif
		    		<script>
		    			$('.alert').slideDown();
		    			setTimeout(function(){ $('.alert').slideUp; }, 10000)
		    		</script>
		    	</div>	
		    </div>
		    @endif

		    <div class="wrapper">
		    	<div class="container">
		    		@yield('content')
		    	</div>
		    </div>

</body>
</html>