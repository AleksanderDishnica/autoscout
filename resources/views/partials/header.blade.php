<!doctype html>
	<html>
		<head>
			<title>{{ config('app.name') }}</title>

			<!-- Bootstrap -->
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

			<!-- Bootstrap icons -->
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

			<!-- MDB -->
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css">
		</head>
		<body>
			<div class="container">
				<div class="row">
					<header>
						<div style="width:100%;text-align:center;">
							<a href="{{ route('home') }}" class="align-center" style="text-align:center;display:inline-table;position:relative;">
								<img src="{{asset('/')}}img/logo.png" alt="{{ config('app.name') }}" style="height:100px;display:block;text-align:center;">
							</a>
						</div>
						<nav class="row">
							<div class="col-lg-3 col-sm-12">
								<a class="btn btn-primary col-xs-12 col-sm-12 col-md-12 col-lg-4" href="{{ route('home') }}">Home</a>
								<a class="btn btn-primary col-xs-12 col-sm-12 col-md-12 col-lg-4" href="{{ route('cars.index') }}">Cars</a>
							</div>
							<div class="col-lg-6 col-sm-12">
								<div class="search col-12 mb-3">
								    <form method="GET" action="{{ route('search.index') }}">
								        <div class="row">
								            <div class="col-1"></div>
								            <input class="col-5" type="text" name="search" placeholder="Search car" style="height:38px!important;">
								            <select class="col-4" name="search_type">
								                <option value="model" default>Search by model</option>
								                <option value="engine_size">Search by engine size</option>
								                <option value="price">Search by price in $</option>
								            </select>
								            <button class="btn btn-primary col-1"><i class="bi bi-search"></i></button>
								        </div>
								    </form>
								</div>
							</div>
							<div class="col-lg-3 col-sm-12">
								@if(Auth::check() && Auth::user()->role == 'admin')
									<a class="btn btn-danger float-end col-xs-12 col-sm-12 col-md-12 col-lg-4"
										href="javascript:void(0)"
										onclick="document.getElementById('form').submit()">Logout</a>
									<a class="btn btn-primary float-end" href="{{ route('admin.index') }}">Admin Panel</a>
									<a class="btn btn-warning float-end" href="{{ route('basket.index') }}"><i class="bi bi-basket-fill"></i></a>
									<form class="invisible" id="form" action="{{ route('logout') }}" method="POST">@csrf</form>
								@elseif(Auth::check() && Auth::user()->role != 'admin')
									<a class="btn btn-danger float-end col-xs-12 col-sm-12 col-md-12 col-lg-4"
										href="javascript:void(0)"
										onclick="document.getElementById('form').submit()">Logout</a>
									<a class="btn btn-warning float-end col-xs-12 col-sm-12 col-md-12 col-lg-4" href="{{ route('basket.index') }}"><i class="bi bi-basket-fill"></i></a>
									<form id="form" action="{{route('logout')}}" method="POST">@csrf</form>
								@else
									<a class="btn btn-warning float-end col-xs-12 col-sm-12 col-md-12 col-lg-4" href="{{ route('basket.index') }}"><i class="bi bi-basket-fill"></i></a>
									<a class="btn btn-success float-end col-xs-12 col-sm-12 col-md-12 col-lg-4" href="{{ route('login') }}">Login</a>
									<a class="btn btn-success float-end col-xs-12 col-sm-12 col-md-12 col-lg-4" href="{{ route('register') }}">Register</a>
								@endif
							</div>
						</nav>
					</header>