@include('partials.header')

    <h3>All car models</h3>

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

                    <div class="tags mt-1">
                        @foreach($car->tags as $key=>$tag)
                            <span class="bg-primary text-light p-1">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@include('partials.footer')