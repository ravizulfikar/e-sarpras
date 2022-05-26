<style type="text/css">
    #trouble {
      padding:10px;
    }
</style>

<img src="{{ public_path('assets/images/kop_surat.png') }}"><br/>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="6%"></td>
    <td width="30%"></td>
    <td width="2%"></td>
    <td width="63%"></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><b>FORM KERJA TENAGA AHLI</b></td>
  </tr>
  <tr>
    <td colspan="4" align="center"></td>
  </tr>

  <tr>
    <td>A.</td>
    <td colspan="3">TEMPAT / LOKASI PENGERJAAN</td>
  </tr>

  <tr>
    <td></td>
    <td>Lokasi</td>
    <td>:</td>
    <td>{!! Location($data->location, 'unit') !!} <br/>
    @if($data->type == 'troubleshooting' || $data->type == 'monitoring') 
      @if(RenderJson($data->location, 'city') == "Dinas")
        Mal Pelayanan Publik, DPMPTSP Provinsi DKI Jakarta
      @else 
        {{ RenderJson($data->location, 'city') }}
      @endif 
    @endif
    </td>
  </tr>

  <tr>
    <td colspan="4"></td>
  </tr>

  <tr>
    <td>B.</td>
    <td colspan="4">TIKET PEKERJAAN</td>
  </tr>

  <tr>
    <td></td>
    <td>Token</td>
    <td>:</td>
    <td>{{$data->token}}</td>
  </tr>

  <tr>
    <td></td>
    <td>Hari/Tanggal</td>
    <td>:</td>
    <td>{{ DayFormat($data->date) }}, {{ DateFormat($data->date) }}</td>
  </tr>

  <tr>
    <td></td>
    <td>Kategori</td>
    <td>:</td>
    <td>{{ ucfirst($data->type) }}</td>
  </tr>

  <tr>
    <td colspan="4"></td>
  </tr>

</table>

<table width="100%" border="0">
  <tr>
    <td width="6%"></td>
    <td width="32%"></td>
    <td width="63%"></td>
  </tr>
</table>

@if($data->type == 'troubleshooting' || $data->type == 'server')
  <table width="100%" border="1" cellpadding="10">
    <tr>
      <td width="7%" height="20px" align="center">No.</td>
      <td width="56%" align="center">Uraian Permasalahan</td>
      <td width="37%" align="center">Solusi Permasalahan</td>
    </tr>
    <tr>
      <td height="500px" align="center">1</td>
      <td style="text-align:justify;">{{ RenderJson($data->detail, 'trouble') }}</td>
      <td style="text-align:justify;">{{ RenderJson($data->detail, 'solution', '-') }}</td>
    </tr>
  </table>
@else
  <table style="width:100%; border-collapse: collapse;" border="1" cellpadding="0" cellspacing="0">
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
  <p></p>
  <table style="width:100%; border-collapse: collapse;" border="1" cellpadding="0" cellspacing="0">
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
      <td colspan="6" style=""><table style="width:100%; border-collapse: collapse; " border="1" cellpadding="0" cellspacing="0">
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
  <p></p>
  <table style="width:100%; border-collapse: collapse;" border="1" cellpadding="0" cellspacing="0">
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

  <p></p>
  <table style="width:100%; border-collapse: collapse;" border="1" cellpadding="0" cellspacing="0">
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

  <br>
  <p><b>CATATAN</b></p>
  {{ (isset(JsonObjectToArray($data->detail)["catatan"])) ? JsonObjectToArray($data->detail)["catatan"] : '-'}}
@endif

<p style="page-break-after:always;"></p>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="6%"></td>
    <td width="32%"></td>
    <td width="63%"></td>
  </tr>
  {{-- <tr><td colspan="3"></td></tr> --}}
  <tr>
    <td>C.</td>
    <td colspan="2">PETUGAS TENAGA AHLI</td>
  </tr>
  @php($i = 1)
  @foreach($userProcess as $user)
    <tr>
      <td style="text-align:center;"></td>
      <td colspan="2">{{ $i++ }}. {{ $user->user->name }}</td>
    </tr>
  @endforeach

</table>

<p></p>

<table width="100%" border="0">
  <tr>
    <td width="6%"></td>
    <td width="32%"></td>
    <td width="63%"></td>
  </tr>
</table>

@if($data->type == 'troubleshooting' || $data->type == 'monitoring')
<table width="100%" border="0">
  <tr>
    <td width="50%" align="center">Menyetujui,</td>
    <td width="51%" align="center">Jakarta, {{ DateFormat($data->date) }}</td>
  </tr>
  <tr>
    <td align="center">
      Koordinator Satpel SarprasTI<br>
      Pusat Data dan Informasi PMPTSP<br>
      DPMPTSP Provinsi DKI Jakarta
    </td>
    <td align="center"><br><br><br>Pemohon</td>
  </tr>
  <tr>
    <td height="85px" style="text-align:center; vertical-align:middle;">
      @if(in_array($data->verification, ['kasatpel', 'kasubbag', 'kabid']))
      <img src="{{ public_path('assets/images/sign_kasatpel.png') }}" height="80px" alt="Sign">
      @endif
    </td>
    <td height="85px" style="text-align:center; vertical-align:middle;">{!! $sign !!}</td>
  </tr>
  <tr>
    <td align="center">DIDIT KARYADI</td>
    <td align="center">{{ $signer->signer }}</td>
  </tr>
  <tr>
    <td align="center">NIP. 198207092010011020</td>
    <td align="center">{{ $signer->type_identity }}. {{ $signer->number_identity }}</td>
  </tr>
  <tr>
    <td align="center"></td>
    <td align="center"></td>
  </tr>
  <tr>
    <td colspan="2" align="center">Mengetahui,</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      Kasubbag Tata Usaha <br>
      Pusat Data dan Informasi PMPTSP<br>
      DPMPTSP Provinsi DKI Jakarta
    </td>
  </tr>
  <tr>
    <td height="85px" colspan="2" style="text-align:center; vertical-align:middle;">
      @if(in_array($data->verification, ['kasatpel', 'kasubbag', 'kabid']))
        <img src="{{ public_path('assets/images/sign_kasubbag.png') }}" height="80px" alt="Sign">
      @endif
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      DARMAWAN APRIYADI
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      NIP. 198504132010011023
    </td>
  </tr>
</table>
@else
<table width="100%" border="0">
  <tr>
    <td width="50%" align="center">Menyetujui,</td>
    <td width="51%" align="center">Jakarta, {{ DateFormat($data->date) }}</td>
  </tr>
  <tr>
    <td align="center">
      Kasubbag Tata Usaha <br>
      Pusat Data dan Informasi PMPTSP<br>
      DPMPTSP Provinsi DKI Jakarta
    </td>
    <td align="center">
      Koordinator Satpel SarprasTI<br>
      Pusat Data dan Informasi PMPTSP<br>
      DPMPTSP Provinsi DKI Jakarta
    </td>
  </tr>
  <tr>
    <td height="85px" style="text-align:center; vertical-align:middle;">
      @if(in_array($data->verification, ['kasatpel', 'kasubbag', 'kabid']))
        <img src="{{ public_path('assets/images/sign_kasubbag.png') }}" height="80px" alt="Sign">
      @endif
    </td>
    <td height="85px" style="text-align:center; vertical-align:middle;">
      @if(in_array($data->verification, ['kasatpel', 'kasubbag', 'kabid']))
        <img src="{{ public_path('assets/images/sign_kasatpel.png') }}" height="80px" alt="Sign">
      @endif
    </td>
  </tr>
  <tr>
    <td align="center">DARMAWAN APRIYADI</td>
    <td align="center">DIDIT KARYADI</td>
  </tr>
  <tr>
    <td align="center">NIP. 198504132010011023</td>
    <td align="center">NIP. 198207092010011020</td>
    
  </tr>
  <tr>
    <td align="center"></td>
    <td align="center"></td>
  </tr>
</table>

@endif


