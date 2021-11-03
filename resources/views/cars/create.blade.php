@include('partials.header')

	<form method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data">
		@csrf
		<h2>Enter car specifications</h2>
		<div class="mb-3">
			<input type="text" class="form-control" name="brand" id="brand" placeholder="Brand" required>
		</div>
		<div class="mb-3">
			<input type="text" class="form-control" name="model" id="model" placeholder="Model" required>
		</div>
		<div class="mb-3">
			<input type="text" class="form-control" name="engine_size" id="engine_size" placeholder="Engine Size" required>
		</div>
		<div class="mb-3">
			<input type="number" class="form-control" name="price" id="price" placeholder="Price" required>
		</div>
		<div class="mb-3">
			<label for="tags">Write each tag separated from one another with comma ,</label>
			<input type="text" class="form-control" id="tags" name="tags" placeholder="Tags example: 2 doors, red roof, automatic" required>
		</div>
		<div class="mb-3">
			<label for="registration_date">Registration date:</label>
			<input type="date" class="form-control" id="registration_date" name="registration_date" required>
		</div>
		<div class="form-floating">
			<select class="form-select" id="condition" name="condition" aria-label="condition" required>
				<option value="new" selected>New</option>
				<option value="used">Used</option>
			</select>
			<label for="condition">Condition:</label>
		</div><br>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@include('partials.footer')