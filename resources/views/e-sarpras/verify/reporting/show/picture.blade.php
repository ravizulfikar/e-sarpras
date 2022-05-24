<div class="default-according" id="accordionicon">
	@forelse($data->ReportPicture as $picture)
	<div class="card">
		<div class="card-header bg-primary" id="H{{ $picture->id }}">
			<div class="row">
				<div class="col-md-12">
					<h5 class="mb-0">
						<button class="btn btn-link collapsed text-white" data-bs-toggle="collapse" data-bs-target="#C{{ $picture->id }}" aria-expanded="false" aria-controls="C{{ $picture->id }}">
							<i class="icofont icofont-tasks-alt"></i> {{ date('d M Y',strtotime($picture->date)) }}
						</button>
					</h5>
				</div>
			</div>
		</div>
		<div class="collapse" id="C{{ $picture->id }}" data-bs-parent="#accordionicon">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
						@if($picture->pictures != null)
							@foreach(json_decode($picture->pictures, true) as $key => $value)
								<div class="col-md-3">
									<a href="{{Storage::url('report/pictures/'.$value)}}" data-fancybox="gallery" data-caption="{{ $value }}">
										<img src="{{Storage::url('report/pictures/'.$value)}}" class="img-thumbnail" alt="{{ $value }}" width="304" height="236">
									</a>
								</div>
							@endforeach
						@endif
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	@empty
	<i>Data Not Found</i>
	@endforelse
</div>

