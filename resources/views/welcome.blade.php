@include('partials.header')

<div id="carouselExampleSlidesOnly" class="carousel slide h-25" data-bs-ride="carousel" style="overflow:hidden;">
    <div class="carousel-inner" style="height:inherit;display:flex;align-items:center;">
        <div class="carousel-item active">
            <img src="{{asset('/')}}img/banner1.jpg" class="d-block w-100" alt="AutoScout">
        </div>
        <div class="carousel-item">
            <img src="{{asset('/')}}img/banner2.jpg" class="d-block w-100" alt="AutoScout">
        </div>
        <div class="carousel-item">
            <img src="{{asset('/')}}img/banner3.jpg" class="d-block w-100" alt="AutoScout">
        </div>
    </div>
</div>
<div class="col-12">

<div class="col-12 text-center mt-3">
    <h6 class="col-lg-2 col-md-6 col-sm-12 p-1 mb-0 bg-warning text-light">Popular cars</h6>
</div>
@foreach($cars as $key=>$car)
    <div class="border border-2">
        <div class="row p-3">
            <div class="col-3">
                @if($key % 3 == 0)
                    <img src="{{asset('/')}}img/cars/car1.jpg" class="float-start" alt="autoscout" width="100%" style="display:inline;">
                @elseif($key % 3 == 1)
                    <img src="{{asset('/')}}img/cars/car2.jpg" class="float-start" alt="autoscout" width="100%" style="display:inline;">
                @else
                    <img src="{{asset('/')}}img/cars/car3.jpg" class="float-start" alt="autoscout" width="100%" style="display:inline;">
                @endif
            </div>
            <div class="col-9">
                @if($car->popular == 1)
                    <div style="position: relative;"><h4 class="m-0"><i class="bi bi-star-fill text-warning" 
                        style="position: absolute; top: 0px;right: 0px;"></i></h4></div>
                @endif

                Brand: <b>{{ $car->brand }}</b><br>
                Model: <b>{{ $car->model }}</b><br>
                Registration date: <b>{{ $car->registration_date }}</b><br>
                Engine size: <b>{{ $car->engine_size }}</b><br>
                Price: <b>${{ $car->price }}</b><br>

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

                <div class="row">
                    <form class="form1" action="{{ route('basket.store') }}" method="POST">
                        @csrf
                        <a class="btn btn-info btn-sm float-end"
                            style="width:50px;"
                            ref="javascript:void(0)"
                            onclick="document.getElementsByClassName('form1')[{{ $key }}].submit()">
                            <h6 class="mb-0"><i class="bi bi-cart-plus"></i></h6>
                        </a>
                        <input type="number" name="amount" value="1" min="1" max="5" style="width:50px;" class="float-end">
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>

<a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg mt-3">Browse all cars</a>

@include('partials.footer')