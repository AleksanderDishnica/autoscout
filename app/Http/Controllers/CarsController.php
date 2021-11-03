<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Tag;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public $cars;

    // Assign the variables
    public function __construct()
    {
        $this->cars = Car::orderByDesc('created_at')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::orderByDesc('created_at')->where('visible','=',true)->get();
        return view('cars.index', ['cars'=>$cars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $car = new Car();
        $car->model = $request->model;
        $car->brand = $request->brand;
        $car->registration_date = $request->registration_date;
        $car->price = $request->price;
        $car->engine_size = $request->engine_size;
        $car->condition = $request->condition;
        $car->save();

        if($request->tags){
            $tags = explode(',', $request->tags);

            foreach($tags as $key=>$tag){
                $tags_model = new Tag();
                $tags_model->name = trim($tag);
                $tags_model->car_id = $car->id;
                $tags_model->save();
            }
        }

        return view('admin.index', ['cars'=>Car::orderByDesc('created_at')->get()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $car = Car::findOrFail($request->car_id);
        $car_model = $car->model;
        $car_brand = $car->brand;
        $car->delete();

        return redirect()->route('admin.index', [
            'cars' => $this->cars,
        ])->with('car_deleted', '<strong>'.$car_brand.' '.$car_model.'</strong> was deleted.');
    }

    /**
     * Hide car.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function hide(Request $request)
    {
        $car = Car::findOrFail($request->car_id);
        $car_brand = $car->brand;
        $car_model = $car->model;

        if($car->visible == true){
            $car->visible = false;
            $car->save();

            return redirect()->route('admin.index', [
                'cars'=>$this->cars,
            ])->with('car_hidden', '<strong>'.$car_brand.' '.$car_model.'</strong> was hidden.');
        }else{
            $car->visible = true;
            $car->save();

            return redirect()->route('admin.index', [
                'cars'=>$this->cars,
            ])->with('car_visible', '<strong>'.$car_brand.' '.$car_model.'</strong> was made visible again.');
        }

    }

    /**
     * Make the car popular.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function popularize(Request $request)
    {
        $car = Car::findOrFail($request->car_id);
        $car_model = $car->model;
        $car_brand = $car->brand;

        if($car->popular == true){
            $car->popular = false;
            $car->save();

            return redirect()->route('admin.index', [
                'cars'=>$this->cars
            ])->with('car_depopularized', '<strong>'.$car_brand.' '.$car_model.'</strong> was removed from popular.');
        }else{
            $car->popular = true;
            $car->save();

            return redirect()->route('admin.index', [
                'cars'=>$this->cars
            ])->with('car_popularized', '<strong>'.$car_brand.' '.$car_model.'</strong> was made popular.');
        }
    }

    /**
     * Search the car.
     *
     * @param  Request $request
     * @return View
     */
    public function search(Request $request){
        if($request->search_type == 'model'){
            $search_result = Car::where('model', $request->search)->get();
        }elseif($request->search_type == 'engine_size'){
            $search_result = Car::where('engine_size', $request->search)->get();
        }elseif($request->search_type == 'price'){
            $search_result = Car::where('price', $request->search)->get();
        }else{
            $search_result = null;
        }

        if($search_result->count()){
            return view('search.index', [
                'cars'=>$search_result,
            ]);
        }else{
            return view('search.index', [
                'cars'=>null,
            ]);
        }
    }
}