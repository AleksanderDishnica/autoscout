@include('partials.header')

	Search results

    @if (session('car_found'))
        <div class="alert alert-info" role="alert">
            {!! session('car_found') !!}
        </div>
    @elseif(session('car_not_found'))
        <div class="alert alert-danger" role="alert">
            {!! session('car_found') !!}
        </div>
    @endif

    @if(isset($cars))
        <div class="cars">
            <div class="row">
                @foreach($cars as $car)
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
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="cars">
            <div class="row">
                No car was found
            </div>
        </div>
    @endif

@include('partials.footer')