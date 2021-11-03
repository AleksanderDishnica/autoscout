@include('partials.header')

<div class="mt-5 px-5">
    <div class="mb-4">
        <h2>Payment receipt</h2><hr>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card p-3">
                <h6 class="text-uppercase">Payment details</h6>
                <div class="inputbox mt-3"> <input type="text" name="name" class="form-control" required="required"> <span>Name on card</span> </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control" required="required"> <i class="fa fa-credit-card"></i> <span>Card Number</span> </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-row">
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control" required="required"> <span>Expiry</span> </div>
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control" required="required"> <span>CVV</span> </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 mb-4">
                    <h6 class="text-uppercase">Billing Address</h6>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control" required="required"> <span>Street Address</span> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control" required="required"> <span>City</span> </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control" required="required"> <span>State/Province</span> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="name" class="form-control" required="required"> <span>Zip code</span> </div>
                        </div>
                    </div>
                </div>
            </div>

            <br><br><br>
        </div>
        <div class="col-md-4">
            <div class="card card-blue p-3 text-white mb-3 bg-primary"><span>Cart total price</span>
                <div class="d-flex flex-row align-items-end mb-3">
                    <h1 class="mb-0 yellow">${{ session('total_price') }}</h1>
                </div> 
                <span>Enjoy your purchase after payment!</span>
                <a href="#" class="yellow decoration">You found me :)</a>
                <div class="hightlight"><span>100% Guaranteed support on your cars.</span></div>
                <div class="row">
            		<div class="mt-4 mb-4 col-12">
            			<button class="btn btn-success btn-lg">Confirm Payment</button>
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')