<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\GuestCart;
use App\Models\Car;
use Illuminate\Http\Request;
use Auth;
use Session;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $basket = Basket::where('user_id', Auth::user()->id)->get();
            $cart_cars = [];
            $amount = [];

            foreach($basket as $cart){
                $cart_cars[] = Car::where('id',$cart->car_id)->get();
                $amount[] = $cart->amount;
            }

            return view('basket.index', ['cars'=>array_reverse($cart_cars), 'amount'=>array_reverse($amount)]);
        }else{
            $car_ids = Session::get('car_ids');
            $amounts = Session::get('amount');

            if($car_ids){
                foreach($car_ids as $car_id):
                    $cars[] = Car::where('id', $car_id)->get();
                endforeach;

                return view('basket.index', ['cars'=>array_reverse($cars), 'amount'=>array_reverse($amounts)]);
            }else{
                return view('basket.index');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('basket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $basket = new Basket();
            $basket->user_id = Auth::user()->id;
            $basket->car_id = $request->car_id;
            $basket->amount = $request->amount;
            $basket->save();

            $basket = Basket::where('user_id', Auth::user()->id)->get();
            $cart_cars = [];
            $amount = [];

            foreach($basket as $cart){
                $cart_cars[] = Car::where('id',$cart->car_id)->get();
                $amount[] = $cart->amount;
            }

            return view('basket.index', ['cars'=>array_reverse($cart_cars), 'amount'=>array_reverse($amount)]);
        }else{
            Session::push('car_ids',$request->car_id);
            Session::push('amount',$request->amount);

            $car_ids = Session::get('car_ids');
            $amounts = Session::get('amount');

            foreach($car_ids as $car_id):
                $cars[] = Car::where('id', $car_id)->get();
            endforeach;

            return view('basket.index', ['cars'=>array_reverse($cars), 'amount'=>array_reverse($amounts)]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function show(Basket $basket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function edit(Basket $basket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Basket $basket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(Auth::check()){
            $basket = Basket::where('user_id', Auth::user()->id)->get();
            $cart_cars = [];
            $amount = [];

            foreach($basket as $cart){
                $cart_cars[] = Car::where('id',$cart->car_id)->get();
                $amount[] = $cart->amount;
            }

            $car = Car::findOrFail($request->car_id);
            $car_model = $car->model;
            $car_brand = $car->brand;
            $car->delete();

            return redirect()->route('basket.index', [
                'cars'=>array_reverse($cart_cars),
                'amount'=>array_reverse($amount),
            ])->with('car_deleted', '<strong>'.$car_brand.' '.$car_model.'</strong> was deleted.');
        }else{
            $car_ids = Session::get('car_ids');
            $amounts = Session::get('amount');

            $basket = Basket::findOrFail($request->car_id);
            $basket->delete();

            if($car_ids){
                foreach($car_ids as $car_id):
                    $cars[] = Car::where('id', $car_id)->get();
                endforeach;

                return redirect()->route('basket.index', [
                    'cars'=>array_reverse($cart_cars),
                    'amount'=>array_reverse($amount),
                ])->with('car_deleted', '<strong>'.$car_brand.' '.$car_model.'</strong> was deleted.');
            }else{
                return view('basket.index');
            }
        }
    }

    // Redirect to buying page
    public function buy(){
        return view('buy');
    }
}