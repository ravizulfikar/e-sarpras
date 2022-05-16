<div id="container-detail">
	<div class="form-group mb-3">
		<label class="col-form-label">Detail Trouble</label>
		<textarea class="form-control" name="detail[trouble]" id="detail.trouble" rows="3" placeholder="Enter your detail">{{ RenderJson($data->detail, "trouble") }}</textarea>
	</div>

	<div class="form-group mb-3">
		<label class="col-form-label">Solution Trouble</label>
		<textarea class="form-control" name="detail[solution]" id="detail.solution" rows="3" placeholder="Enter your Solution">{{ RenderJson($data->detail, "solution") }}</textarea>
	</div>
</div>