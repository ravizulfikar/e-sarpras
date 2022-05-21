<div class="row">
	<div class="col-sm-12">
		Detail
	</div>
</div>

<div class="row mb-3">
	<div class="col-sm-12">
		<table class="table table-bordered table-hover table-striped" style="font-size:9pt;">
			<tr>
				<td colspan="2" style="">&nbsp;Sumber</td>
				<td colspan="4" style="">&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_diskominfo"]["sumber"])) ? JsonObjectToArray($data->detail)["jaringan_diskominfo"]["sumber"] : '-'}}</td>
			</tr>
			<tr>
				<td colspan="2" style="">&nbsp;IP Address / Subnet</td>
				<td colspan="4" style="">&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_diskominfo"]["ip_address"])) ? JsonObjectToArray($data->detail)["jaringan_diskominfo"]["ip_address"]  : '-'}} / {{ (isset(JsonObjectToArray($data->detail)["jaringan_diskominfo"]["subnet"])) ? JsonObjectToArray($data->detail)["jaringan_diskominfo"]["subnet"] : '-'}}</td>
			</tr>
			<tr>
				<td colspan="6" style="">&nbsp;Status Kecepatan Jaringan Internet</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;">{{ (isset(JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_a"]["sumber"])) ? JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_a"]["sumber"] : '-'}}</td>
				<td colspan="2" style="text-align:center;">{{ (isset(JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_b"]["sumber"])) ? JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_b"]["sumber"] : '-'}}</td>
				<td colspan="2" style="text-align:center;">{{ (isset(JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_c"]["sumber"])) ? JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_c"]["sumber"] : '-'}}</td>
			</tr>
			<tr>
				<td style="width:16.67%; text-align:center;">Download</td>
				<td style="width:16.67%; text-align:center;">Upload</td>
				<td style="width:16.67%; text-align:center;">Download</td>
				<td style="width:16.67%; text-align:center;">Upload</td>
				<td style="width:16.67%; text-align:center;">Download</td>
				<td style="width:16.67%; text-align:center;">Upload</td> 
			</tr>
			<tr>
				<td style="text-align:center;">{{ (isset(JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_a"]["download"])) ? JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_a"]["download"] : '-'}}</td>
				<td style="text-align:center;">{{ (isset(JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_a"]["upload"])) ? JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_a"]["upload"] : '-'}}</td>
				<td style="text-align:center;">{{ (isset(JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_b"]["download"])) ? JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_b"]["download"] : '-'}}</td>
				<td style="text-align:center;">{{ (isset(JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_b"]["upload"])) ? JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_b"]["upload"] : '-'}}</td>
				<td style="text-align:center;">{{ (isset(JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_c"]["download"])) ? JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_c"]["download"] : '-'}}</td>
				<td style="text-align:center;">{{ (isset(JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_c"]["upload"])) ? JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_c"]["upload"] : '-'}}</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;">Latency {{ (isset(JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_a"]["latency"])) ? JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_a"]["latency"] : '-'}}</td>
				<td colspan="2" style="text-align:center;">Latency {{ (isset(JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_b"]["latency"])) ? JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_b"]["latency"] : '-'}}</td>
				<td colspan="2" style="text-align:center;">Latency {{ (isset(JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_c"]["latency"])) ? JsonObjectToArray($data->detail)["jaringan_diskominfo"]["speedtest_c"]["latency"] : '-'}}</td>
			</tr>
		</table>


		@if(isset(JsonObjectToArray($data->detail)["jaringan_lainnya"]["is_other"]) && JsonObjectToArray($data->detail)["jaringan_lainnya"]["is_other"] == '1')
		<br><br>
		<table class="table table-bordered table-hover table-striped" style="font-size:9pt;">
			<tr>
				<td colspan="2" style="">&nbsp;Sumber</td>
				<td colspan="4" style="">&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_lainnya"]["sumber"])) ? JsonObjectToArray($data->detail)["jaringan_lainnya"]["sumber"] : '-'}}</td>
			</tr>
			<tr>
				<td colspan="2" style="">&nbsp;IP Address / Subnet</td>
				<td colspan="4" style="">&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_lainnya"]["sumber"])) ? JsonObjectToArray($data->detail)["jaringan_lainnya"]["ip_address"] : '-'}} / {{ (isset(JsonObjectToArray($data->detail)["jaringan_lainnya"]["sumber"])) ? JsonObjectToArray($data->detail)["jaringan_lainnya"]["subnet"] : '-'}}</td>
			</tr>
			<tr>
				<td colspan="6" style="">&nbsp;Status Kecepatan Jaringan Internet</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align:center; width:50%;">&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_a"]["sumber"])) ? JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_a"]["sumber"] : '-'}}</td>
				<td colspan="3" style="text-align:center; width:50%;">&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_b"]["sumber"])) ? JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_b"]["sumber"] : '-'}}</td>
			</tr>
			<tr>
				<td colspan="6" style="">
				<table class="table table-bordered table-hover table-striped" style="font-size:9pt;">
					<tr>
					<td style="width:25%; text-align:center;">Download</td>
					<td style="width:25%; text-align:center;">Upload</td>
					<td style="width:25%; text-align:center;">Download</td>
					<td style="width:25%; text-align:center;">Upload</td>
					</tr>
					<tr>
					<td style="text-align:center;">&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_a"]["download"])) ? JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_a"]["download"] : '-'}}</td>
					<td style="text-align:center;">&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_a"]["upload"])) ? JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_a"]["upload"] : '-'}}</td>
					<td style="text-align:center;">&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_b"]["download"])) ? JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_b"]["download"] : '-'}}</td>
					<td style="text-align:center;">&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_b"]["upload"])) ? JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_b"]["upload"] : '-'}}</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td colspan="3" style="text-align:center;">Latency {{ (isset(JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_a"]["latency"])) ? JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_a"]["latency"] : '-'}}</td>
				<td colspan="3" style="text-align:center;">Latency {{ (isset(JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_b"]["latency"])) ? JsonObjectToArray($data->detail)["jaringan_lainnya"]["speedtest_b"]["latency"] : '-'}}</td>
			</tr>
		</table>
		@endif

		@if(isset(JsonObjectToArray($data->detail)["jaringan_tools"]["is_router"]) && JsonObjectToArray($data->detail)["jaringan_tools"]["is_router"] == '1')
		<br><br>
		<table class="table table-bordered table-hover table-striped" style="font-size:9pt;">
			<tr>
				<td style="width:33.34%;">&nbsp;Router</td>
				<td style="width:66.66%;">&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_tools"]["router"])) ? JsonObjectToArray($data->detail)["jaringan_tools"]["router"] : '-'}}</td>
			</tr>
			<tr>
				<td style="">&nbsp;Password Router</td>
				<td style="">&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_tools"]["router_password"])) ? JsonObjectToArray($data->detail)["jaringan_tools"]["router_password"] : '-'}}</td>
			</tr>
			<tr>
				<td style="">&nbsp;SSID</td>
				<td style="">&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_tools"]["router_ssid"])) ? JsonObjectToArray($data->detail)["jaringan_tools"]["router_ssid"] : '-'}}</td>
			</tr>
			<tr>
				<td style="">&nbsp;Password Wifi</td>
				<td style="">&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_tools"]["router_ssid_password"])) ? JsonObjectToArray($data->detail)["jaringan_tools"]["router_ssid_password"] : '-'}}</td>
			</tr>
		</table>
		@endif


		<br><br>
		<table class="table table-bordered table-hover table-striped" style="font-size:9pt;">
			<tr>
				<td colspan="2" style="text-align:center;">Terinstal Net Employe</td>
				<td colspan="2" style="text-align:center;">Terinstal Antivirus Kasperksy</td>
			</tr>
			<tr>
				<td style="width:25%; text-align:center;">Banyaknya Komputer</td>
				<td style="width:25%; text-align:center;">Dari Total Komputer</td>
				<td style="width:25%; text-align:center;">Banyaknya Komputer</td>
				<td style="width:25%; text-align:center;">Dari Total Komputer</td>
			</tr>
			<tr>
				<td style="width:25%; text-align:center;">@if(isset(JsonObjectToArray($data->detail)["jaringan_tools"]["is_ne"]) && JsonObjectToArray($data->detail)["jaringan_tools"]["is_ne"] == '1')&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_tools"]["ne_komputer"])) ? JsonObjectToArray($data->detail)["jaringan_tools"]["ne_komputer"] : '-'}} @else - @endif</td>
				<td style="width:25%; text-align:center;">@if(isset(JsonObjectToArray($data->detail)["jaringan_tools"]["is_ne"]) && JsonObjectToArray($data->detail)["jaringan_tools"]["is_ne"] == '1')&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_tools"]["ne_komputer_dari"])) ? JsonObjectToArray($data->detail)["jaringan_tools"]["ne_komputer_dari"] : '-'}} @else - @endif</td>
				<td style="width:25%; text-align:center;">@if(isset(JsonObjectToArray($data->detail)["jaringan_tools"]["is_av"]) && JsonObjectToArray($data->detail)["jaringan_tools"]["is_av"] == '1')&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_tools"]["av_komputer"])) ? JsonObjectToArray($data->detail)["jaringan_tools"]["av_komputer"] : '-'}} @else - @endif</td>
				<td style="width:25%; text-align:center;">@if(isset(JsonObjectToArray($data->detail)["jaringan_tools"]["is_av"]) && JsonObjectToArray($data->detail)["jaringan_tools"]["is_av"] == '1')&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_tools"]["av_komputer_dari"])) ? JsonObjectToArray($data->detail)["jaringan_tools"]["av_komputer_dari"] : '-'}} @else - @endif</td>
			</tr>
			
			<tr>
				<td colspan="4" style=""></td>
			</tr>
			
			<tr>
				<td colspan="2" style="text-align:center;">TeamViewer</td>
				<td colspan="2" style="text-align:center;">Anydesk</td>
			</tr>
			<tr>
				<td style="width:25%; text-align:center;">ID</td>
				<td style="width:25%; text-align:center;">Passwords</td>
				<td style="width:25%; text-align:center;">ID</td>
				<td style="width:25%; text-align:center;">Passwords</td>
			</tr>
			<tr>
				<td style="width:25%; text-align:center;">@if(isset(JsonObjectToArray($data->detail)["jaringan_tools"]["is_tv"]) && JsonObjectToArray($data->detail)["jaringan_tools"]["is_tv"] == '1')&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_tools"]["tv_id"])) ? JsonObjectToArray($data->detail)["jaringan_tools"]["tv_id"] : '-'}} @else - @endif</td>
				<td style="width:25%; text-align:center;">@if(isset(JsonObjectToArray($data->detail)["jaringan_tools"]["is_tv"]) && JsonObjectToArray($data->detail)["jaringan_tools"]["is_tv"] == '1')&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_tools"]["tv_password"])) ? JsonObjectToArray($data->detail)["jaringan_tools"]["tv_password"] : '-'}} @else - @endif</td>
				<td style="width:25%; text-align:center;">@if(isset(JsonObjectToArray($data->detail)["jaringan_tools"]["is_ad"]) && JsonObjectToArray($data->detail)["jaringan_tools"]["is_ad"] == '1')&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_tools"]["ad_id"])) ? JsonObjectToArray($data->detail)["jaringan_tools"]["ad_id"] : '-'}} @else - @endif</td>
				<td style="width:25%; text-align:center;">@if(isset(JsonObjectToArray($data->detail)["jaringan_tools"]["is_ad"]) && JsonObjectToArray($data->detail)["jaringan_tools"]["is_ad"] == '1')&nbsp;{{ (isset(JsonObjectToArray($data->detail)["jaringan_tools"]["ad_password"])) ? JsonObjectToArray($data->detail)["jaringan_tools"]["ad_password"] : '-'}} @else - @endif</td>
			</tr>
		</table>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		Catatan
	</div>
</div>

<div class="row mb-3">
	<div class="col-sm-12">
		<h5>@if(isset(JsonObjectToArray($data->detail)["catatan"])) {{ JsonObjectToArray($data->detail)["catatan"] }} @else - @endif</h5>
	</div>
</div>