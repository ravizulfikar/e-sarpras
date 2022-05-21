
<div class="row">
	<div class="col-sm-12">
		Detail
	</div>
</div>

<div class="row mb-3">
	<div class="col-sm-12">
		<h5>{{ RenderJson($data->detail, 'trouble') }}</h5>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		Solution
	</div>
</div>

<div class="row mb-3">
	<div class="col-sm-12">
		<h5>{{ RenderJson($data->detail, 'solution', '-') }}</h5>
	</div>
</div>