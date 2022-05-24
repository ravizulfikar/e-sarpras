<div class="default-according" id="accordionicon">
	@foreach($data->ReportDescription as $description)
	<div class="card">
		<div class="card-header bg-primary" id="H{{ $description->id }}">
			<div class="row">
				<div class="col-md-12">
					<h5 class="mb-0">
						<button class="btn btn-link collapsed text-white" data-bs-toggle="collapse" data-bs-target="#C{{ $description->id }}" aria-expanded="false" aria-controls="C{{ $description->id }}">
							<i class="icofont icofont-tasks-alt"></i> {{ date('d M Y',strtotime($description->date)) }}
						</button>
					</h5>
				</div>
			</div>
		</div>
		<div class="collapse" id="C{{ $description->id }}" data-bs-parent="#accordionicon">
			<div class="card-body">
				@php($i = 1) 
				@foreach(json_decode($description->descriptions, true) as $key => $value)
					{{ $i++ }}. {{ $value }}<br/>
				@endforeach
			</div>
		</div>
	</div>
	@endforeach
</div>

