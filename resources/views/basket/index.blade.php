@include('partials.header')

<h3>Cars in your basket</h3>

@if(Auth::check())
	@if(count($cars) > 0)
		@php
			$total_price = 0;
		@endphp

		@foreach($cars as $key=>$car_cart)
			@foreach($car_cart as $key_cart=>$car)
				@php
					$total_price = $total_price + ($amount[$key] * $car->price);
				@endphp
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
			    
{{-- 					<a class="btn btn-danger btn-sm float-end"
						ref="javascript:void(0)"
						onclick="document.getElementsByClassName('form3')[{{ $key }}].submit()">
						<i class="bi bi-trash-fill"></i>
					</a>

					<form class="invisible form3" action="{{ route('basket.destroy') }}" method="POST">
						@csrf
						{{ method_field('DELETE') }}
						<input type="hidden" name="car_id" value="{{ $car->id }}">
					</form> --}}
			    </div>
			@endforeach
		@endforeach
		
		@php
			session(['total_price'=>$total_price]);
		@endphp
				
		<div class="result col-12">
			<p>Total number of cars: {{ count($cars) }}</p>
			<p>Total price: ${{ $total_price }}</p>
			<a href="{{ route('buy') }}" class="btn btn-danger btn-lg">Buy Now</a>
		</div>
	@else
		<p>You got nothing in the cart.</p>
	@endif
@elseif(!Auth::check())
	@if(isset($cars))
		@php
			$total_price = 0;
		@endphp

		@foreach($cars as $key=>$car_cart)
			@foreach($car_cart as $key_cart=>$car)
				@php
					$total_price = $total_price + ($amount[$key] * $car->price);
				@endphp

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
	                <span>Amount: {{ $amount[$key] }}</span>

{{-- 		            <a class="btn btn-danger btn-sm float-end"
						ref="javascript:void(0)"
						onclick="document.getElementsByClassName('form3')[{{ $key }}].submit()">
						<i class="bi bi-trash-fill"></i>
					</a>

					<form class="invisible form3" action="{{ route('basket.destroy') }}" method="POST">
						@csrf
						{{ method_field('DELETE') }}
						<input type="hidden" name="car_id" value="{{ $car->id }}">
					</form> --}}
	            </div>
			@endforeach
		@endforeach
			
		<div class="result col-12">
			<p>Total number of cars: {{ count($cars) }}</p>
			<p>Total price: ${{ $total_price }}</p>
			<a href="" class="btn btn-danger btn-lg">Buy Now</a>
		</div>

		@php
			session(['total_price'=>$total_price]);
		@endphp
	@else
		<p>You got nothing in the cart.</p>
	@endif
@endif

@include('partials.footer')