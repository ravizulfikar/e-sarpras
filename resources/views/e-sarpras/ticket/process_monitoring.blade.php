<div class="row">
	<div class="col-md-12">
		{{-- {{ $json = json_decode(json_encode($data->detail, true)) }} --}}
		{{-- {{ dd(JsonObjectToArray($data->detail)) }} --}}
		<div class="card shadow mb-3 bg-white rounded">
			<div class="card-header bg-primary text-white">
				Data Jaringan Diskominfo
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Sumber</label>
							<input type="text" class="form-control" name="detail[jaringan_diskominfo][sumber]" value="{{ JsonObjectToArray($data->detail)["jaringan_diskominfo"]["sumber"] ?? '-' }}">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="">IP Network</label>
							<input type="text" class="form-control" name="detail[jaringan_diskominfo][ip_address]" value='{{ JsonObjectToArray($data->detail)["jaringan_diskominfo"]["ip_address"] ?? '10.40.120.1' }}'>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="">Subnet Mask</label>
							<input type="text" class="form-control" name="detail[jaringan_diskominfo][subnet]" value='{{ JsonObjectToArray($data->detail)["jaringan_diskominfo"]["subnet"] ?? '255.255.255.255' }}'>
						</div>
					</div>
				</div>

				<br>

				<div class="row">
					<div class="col-md-12">
						Status Kecepatan Jaringan Internet
						<br><br>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Speedtest Website</label>
							<input type="text" class="form-control" name="detail[jaringan_diskominfo][speedtest_a][sumber]" value="{{ JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_a"]["sumber"] ?? 'Speedtest.net' }}">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Download</label>
							<input type="text" class="form-control" name="detail[jaringan_diskominfo][speedtest_a][download]" value='{{ JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_a"]["download"] ?? '0.00 Mbps' }}'>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Upload</label>
							<input type="text" class="form-control" name="detail[jaringan_diskominfo][speedtest_a][upload]" value='{{ JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_a"]["upload"] ?? '0.00 Kbps' }}'>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Latency</label>
							<input type="text" class="form-control" name="detail[jaringan_diskominfo][speedtest_a][latency]" value='{{ JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_a"]["latency"] ?? '00 ms' }}'>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" name="detail[jaringan_diskominfo][speedtest_b][sumber]" value="{{ JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_b"]["sumber"] ?? 'testmy.net' }}">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<input type="text" class="form-control" name="detail[jaringan_diskominfo][speedtest_b][download]" value='{{ JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_b"]["download"] ?? '0.00 Mbps' }}'>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<input type="text" class="form-control" name="detail[jaringan_diskominfo][speedtest_b][upload]" value='{{ JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_b"]["upload"] ?? '0.00 Kbps' }}'>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">                  
							<input type="text" class="form-control" name="detail[jaringan_diskominfo][speedtest_b][latency]" value='{{ JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_b"]["latency"] ?? '00 ms' }}'>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" name="detail[jaringan_diskominfo][speedtest_c][sumber]" value="{{ JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_c"]["sumber"] ?? 'speedtest.jakarta.go.id' }}">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<input type="text" class="form-control" name="detail[jaringan_diskominfo][speedtest_c][download]" value='{{ JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_c"]["download"] ?? '0.00 Mbps' }}'>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<input type="text" class="form-control" name="detail[jaringan_diskominfo][speedtest_c][upload]" value='{{ JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_c"]["upload"] ?? '0.00 Kbps' }}'>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<input type="text" class="form-control" name="detail[jaringan_diskominfo][speedtest_c][latency]" value='{{ JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_c"]["latency"] ?? '00 ms' }}'>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card shadow mb-3 bg-white rounded">
			<div class="card-header bg-danger text-white">
				Data Jaringan Lainnya 

				<div class="form-check pull-right">
					<input class="form-check-input" type="checkbox" name="detail[jaringan_lainnya][is_other]" value="1" id="CheckOther" @if( isset(JsonObjectToArray($data->detail)["jaringan_lainnya"]['is_other']) && JsonObjectToArray($data->detail)["jaringan_lainnya"]['is_other'] == '1') checked="checked" @endif>
					<label class="form-check-label" for="CheckOther">
						Check Jika Terdapat Jaringan Lainnya
					</label>
				</div>
			</div>
			<div class="card-body">
				<div id="DivOther">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Sumber</label>
								<input type="text" class="form-control" name="detail[jaringan_lainnya][sumber]" value="{{ JsonObjectToArray($data->detail)["jaringan_lainnya"]['sumber'] ?? 'FirstMedia' }}">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="">IP Network</label>
								<input type="text" class="form-control" name="detail[jaringan_lainnya][ip_address]" value='{{ JsonObjectToArray($data->detail)["jaringan_lainnya"]["ip_address"] ?? '192.168.0.1' }}'>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="">Subnet Mask</label>
								<input type="text" class="form-control" name="detail[jaringan_lainnya][subnet]" value='{{ JsonObjectToArray($data->detail)["jaringan_lainnya"]["subnet"] ?? '255.255.255.0' }}'>
							</div>
						</div>
					</div>

					<br>

					<div class="row">
						<div class="col-md-12">
							Status Kecepatan Jaringan Internet
							<br><br>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Speedtest Website</label>
								<input type="text" class="form-control" name="detail[jaringan_lainnya][speedtest_a][sumber]" value="{{ JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_a"]["sumber"] ?? 'Speedtest.net' }}">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Download</label>
								<input type="text" class="form-control" name="detail[jaringan_lainnya][speedtest_a][download]" value='{{ JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_a"]["download"] ?? '0.00 Mbps' }}'>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Upload</label>
								<input type="text" class="form-control" name="detail[jaringan_lainnya][speedtest_a][upload]" value='{{ JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_a"]["upload"] ?? '0.00 Kbps' }}'>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Latency</label>
								<input type="text" class="form-control" name="detail[jaringan_lainnya][speedtest_a][latency]" value='{{ JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_a"]["latency"] ?? '00 ms' }}'>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" name="detail[jaringan_lainnya][speedtest_b][sumber]" value="{{ JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_b"]["sumber"] ?? 'testmy.net' }}">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<input type="text" class="form-control" name="detail[jaringan_lainnya][speedtest_b][download]" value='{{ JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_b"]["download"] ?? '0.00 Mbps' }}'>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<input type="text" class="form-control" name="detail[jaringan_lainnya][speedtest_b][upload]" value='{{ JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_b"]["upload"] ?? '0.00 Kbps' }}'>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">                  
								<input type="text" class="form-control" name="detail[jaringan_lainnya][speedtest_b][latency]" value='{{ JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_b"]["latency"] ?? '00 ms' }}'>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		
	</div>
</div>


<div class="row">
	<div class="col-md-12">

		<div class="card shadow mb-3 bg-white rounded">
			<div class="card-header bg-warning text-white">
				Data Router dan Tools Jaringan

				<div class="form-check pull-right">
					<input class="form-check-input" type="checkbox" name="detail[jaringan_tools][is_router]" value="1" id="CheckRouter" @if( isset(JsonObjectToArray($data->detail)["jaringan_tools"]['is_router']) && JsonObjectToArray($data->detail)["jaringan_tools"]['is_router'] == '1') checked="checked" @endif>
					<label class="form-check-label" for="CheckRouter">
						Check Jika Terdapat Router Wifi
					</label>
				</div>
			</div>
			<div class="card-body">
				<div id="DivRouter">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Jenis Router Wifi</label>
								<input type="text" class="form-control" name="detail[jaringan_tools][router]" value="{{ JsonObjectToArray($data->detail)["jaringan_tools"]['router'] ?? 'Linksys WRT 1300 AC' }}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Password Router Wifi</label>
								<input type="text" class="form-control" name="detail[jaringan_tools][router_password]" value="{{ JsonObjectToArray($data->detail)["jaringan_tools"]['router_password'] ?? 'ABCD@1234' }}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">S/N</label>
								<input type="text" class="form-control" name="detail[jaringan_tools][router_sn]" value='{{ JsonObjectToArray($data->detail)["jaringan_tools"]["router_sn"] ?? '13243423534' }}'>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Nama Wifi/SSD</label>
								<input type="text" class="form-control" name="detail[jaringan_tools][router_ssid]" value='{{ JsonObjectToArray($data->detail)["jaringan_tools"]["router_ssid"] ?? 'Linksys' }}'>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="">Password Wifi</label>
								<input type="text" class="form-control" name="detail[jaringan_tools][router_ssid_password]" value='{{ JsonObjectToArray($data->detail)["jaringan_tools"]["router_ssid_password"] ?? 'Linksys' }}'>
							</div>
						</div>
					</div>
				</div>

				<hr>

				<div class="row">
					<div class="col-md-4" style="padding-left:35px;">
						<input class="form-check-input" type="checkbox" name="detail[jaringan_tools][is_ne]" value="1" id="CheckNE" @if( isset(JsonObjectToArray($data->detail)["jaringan_tools"]['is_ne']) && JsonObjectToArray($data->detail)["jaringan_tools"]['is_ne'] == '1') checked="checked" @endif style="margin-top:30px;">
						<label class="form-check-label" for="CheckNE" style="margin-top:25px;">
							Terinstal Net Employee ?
						</label>
					</div>
					<div class="col-md-4 DivNE">
						<div class="form-group">
							<label for="">Banyaknya Komputer yang terinstal</label>
							<input type="text" class="form-control" name="detail[jaringan_tools][ne_komputer]" value="{{ JsonObjectToArray($data->detail)["jaringan_tools"]['ne_komputer'] ?? '' }}">
						</div>
					</div>
					<div class="col-md-4 DivNE">
						<div class="form-group">
							<label for="">Dari Total Komputer di PTSP</label>
							<input type="text" class="form-control" name="detail[jaringan_tools][ne_komputer_dari]" value="{{ JsonObjectToArray($data->detail)["jaringan_tools"]['ne_komputer_dari'] ?? '' }}">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4" style="padding-left:35px;">
						<input class="form-check-input" type="checkbox" name="detail[jaringan_tools][is_tv]" value="1" id="CheckTV" @if( isset(JsonObjectToArray($data->detail)["jaringan_tools"]['is_tv']) && JsonObjectToArray($data->detail)["jaringan_tools"]['is_tv'] == '1') checked="checked" @endif style="margin-top:30px;">
						<label class="form-check-label" for="CheckTV" style="margin-top:25px;">
							Terinstal Teamviewer ?
						</label>
					</div>
					<div class="col-md-4 DivTV">
						<div class="form-group">
							<label for="">ID TeamViewer</label>
							<input type="text" class="form-control" name="detail[jaringan_tools][tv_id]" value="{{ JsonObjectToArray($data->detail)["jaringan_tools"]['tv_id'] ?? '' }}">
						</div>
					</div>
					<div class="col-md-4 DivTV">
						<div class="form-group">
							<label for="">Password TeamViewer</label>
							<input type="text" class="form-control" name="detail[jaringan_tools][tv_password]" value="{{ JsonObjectToArray($data->detail)["jaringan_tools"]['tv_password'] ?? '' }}">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4" style="padding-left:35px;">
						<input class="form-check-input" type="checkbox" name="detail[jaringan_tools][is_ad]" value="1" id="CheckAD" @if( isset(JsonObjectToArray($data->detail)["jaringan_tools"]['is_ad']) && JsonObjectToArray($data->detail)["jaringan_tools"]['is_ad'] == '1') checked="checked" @endif style="margin-top:30px;">
						<label class="form-check-label" for="CheckAD" style="margin-top:25px;">
							Terinstal Anydesk ?
						</label>
					</div>
					<div class="col-md-4 DivAD">
						<div class="form-group">
							<label for="">ID Anydesk</label>
							<input type="text" class="form-control" name="detail[jaringan_tools][ad_id]" value="{{ JsonObjectToArray($data->detail)["jaringan_tools"]['ad_id'] ?? '' }}">
						</div>
					</div>
					<div class="col-md-4 DivAD">
						<div class="form-group">
							<label for="">Password Anydesk</label>
							<input type="text" class="form-control" name="detail[jaringan_tools][ad_password]" value="{{ JsonObjectToArray($data->detail)["jaringan_tools"]['ad_password'] ?? '' }}">
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-md-4" style="padding-left:35px;">
						<input class="form-check-input" type="checkbox" name="detail[jaringan_tools][is_av]" value="1" id="CheckAV" @if( isset(JsonObjectToArray($data->detail)["jaringan_tools"]['is_av']) && JsonObjectToArray($data->detail)["jaringan_tools"]['is_av'] == '1') checked="checked" @endif style="margin-top:30px;">
						<label class="form-check-label" for="CheckAV" style="margin-top:25px;">
							Terinstal Antivirus Kasperksy ?
						</label>
					</div>
					<div class="col-md-4 DivAV">
						<div class="form-group">
							<label for="">Banyaknya Komputer yang terinstal</label>
							<input type="text" class="form-control" name="detail[jaringan_tools][av_komputer]" value="{{ JsonObjectToArray($data->detail)["jaringan_tools"]['av_komputer'] ?? '' }}">
						</div>
					</div>
					<div class="col-md-4 DivAV">
						<div class="form-group">
							<label for="">Dari Total Komputer di PTSP</label>
							<input type="text" class="form-control" name="detail[jaringan_tools][av_komputer_dari]" value="{{ JsonObjectToArray($data->detail)["jaringan_tools"]['av_komputer_dari'] ?? '' }}">
						</div>
					</div>
				</div>

			</div>
		</div>
		
	</div>
</div>

<div class="row m-t-10">
	<div class="col-sm-12">
		<div class="form-group">
			<label for="">Catatan</label>
			<textarea name="detail[catatan]" rows="3" class="form-control">
				@if(isset(JsonObjectToArray($data->detail)["catatan"]))
				{{ JsonObjectToArray($data->detail)["catatan"]  }}
				@endif
			</textarea>
		</div>
	</div>
</div>
