@include('partials.header')

	<div class="admin_panel">
		<h3>Welcome {{ Auth::user()->name }}</h3>

        @if (session('car_popularized'))
            <div class="alert alert-warning" role="alert">
                {!! session('car_popularized') !!}
            </div>
        @elseif(session('car_depopularized'))
            <div class="alert alert-warning" role="alert">
                {!! session('car_depopularized') !!}
            </div>
        @elseif(session('car_hidden'))
            <div class="alert alert-info" role="alert">
                {!! session('car_hidden') !!}
            </div>
        @elseif(session('car_visible'))
            <div class="alert alert-info" role="alert">
                {!! session('car_visible') !!}
            </div>
        @elseif(session('car_deleted'))
            <div class="alert alert-danger" role="alert">
                {!! session('car_deleted') !!}
            </div>
        @endif
	</div>

	<div class="cars">
		<h3>All car models</h3>
		<a class="btn btn-primary" href="{{ route('cars.create') }}">Add cars</a>
		<div class="row">
		    @foreach($cars as $key=>$car)
		        <div class="border border-2 p-3 col-lg-3 col-md-4 col-sm-6">
		            Brand: {{ $car->brand }}<br>
		            Model: {{ $car->model }}<br>
		            Registration date: {{ $car->registration_date }}<br>
		            Engine size: {{ $car->engine_size }}<br>
		            Price: ${{ $car->price }}<br>

		            @if($car->condition == 'new')
		            	Condition: <span class="bg-success text-light p-1">{{ $car->condition }}</span><br>
		            @elseif($car->condition == 'used')
		            	Condition: <span class="bg-danger text-light p-1">{{ $car->condition }}</span><br>
		            @endif

                    <div class="tags mt-1">
                        @foreach($car->tags as $key=>$tag)
                            <span class="bg-primary text-light p-1">{{ $tag->name }}</span>
                        @endforeach
                    </div>

		            @if(Auth::user()->role == 'admin')
		            	<hr>
						<a class="btn btn-danger btn-sm float-end"
							ref="javascript:void(0)"
							onclick="document.getElementsByClassName('form3')[{{ $key }}].submit()">
							<i class="bi bi-trash-fill"></i>
						</a>{{-- 
						--}}<a class="btn btn-info btn-sm float-end"
							ref="javascript:void(0)"
							onclick="document.getElementsByClassName('form1')[{{ $key }}].submit()">
							@if($car->visible == 1)
								<i class="bi bi-eye-fill"></i>
							@else
								<i class="bi bi-eye-slash-fill"></i>
							@endif
						</a>{{-- 
		            	--}}<a class="btn btn-warning btn-sm float-end"
							ref="javascript:void(0)"
							onclick="document.getElementsByClassName('form2')[{{ $key }}].submit()">
							@if($car->popular == 1)
								<i class="bi bi-star-fill"></i>
							@else
								<i class="bi bi-star-half"></i>
							@endif
						</a>
						<form class="invisible form1" action="{{ route('cars.hide') }}" method="POST">
							@csrf
							{{ method_field('PUT') }}
                    		<input type="hidden" name="car_id" value="{{ $car->id }}">
						</form>
						<form class="invisible form2" action="{{ route('cars.popularize') }}" method="POST">
							@csrf
							{{ method_field('PUT') }}
                    		<input type="hidden" name="car_id" value="{{ $car->id }}">
						</form>
						<form class="invisible form3" action="{{ route('cars.destroy') }}" method="POST">
							@csrf
							{{ method_field('DELETE') }}
                    		<input type="hidden" name="car_id" value="{{ $car->id }}">
						</form>
		            @endif
		        </div>
		    @endforeach
		</div>
	</div>

@include('partials.footer')