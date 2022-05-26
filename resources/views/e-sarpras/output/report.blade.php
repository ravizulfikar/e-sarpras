<style type="text/css">
    #trouble {
      padding:10px;
    }

    table { page-break-inside:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }
    tfoot { display:table-footer-group }

</style>

<p></p><p></p><p></p><p></p><p></p><p></p>

<p style="text-align:center;">
  <center>
    <img src="{{ public_path('assets/images/logo_dki.png') }}" height="80px" alt="Logo">
  </center>
</p>

<p></p>

<table width="100%" border="0">
  <tr>
    <td align="center">LAPORAN KINERJA TENAGA AHLI</td>
  </tr>
  <tr>
    <td align="center">SATUAN PELAKSANA SARANA DAN PRASARANA TEKNOLOGI INFORMASI</td>
  </tr>
  <tr>
    <td align="center">PUSAT DATA DAN INFORMASI PENANAMAN MODAL DAN <br>PELAYANAN TERPADU SATU PINTU</td>
  </tr>
  <tr>
    <td align="center"></td>
  </tr>
  <tr>
    <td align="center"></td>
  </tr>
  <tr>
    <td align="center">BULAN
      @if($data->month=='01')
      JANUARI {{$data->year}}
      @elseif($data->month=='02')
      FEBRUARI {{$data->year}}
      @elseif($data->month=='03')
      MARET {{$data->year}}
      @elseif($data->month=='04')
      APRIL {{$data->year}}
      @elseif($data->month=='05')
      MEI {{$data->year}}
      @elseif($data->month=='06')
      JUNI {{$data->year}}
      @elseif($data->month=='07')
      JULI {{$data->year}}
      @elseif($data->month=='08')
      AGUSTUS {{$data->year}}
      @elseif($data->month=='09')
      SEPTEMBER {{$data->year}}
      @elseif($data->month=='10')
      OKTOBER {{$data->year}}
      @elseif($data->month=='11')
      NOVEMBER {{$data->year}}
      @elseif($data->month=='12')
      DESEMBER {{$data->year}}
      @endif
    </td>
  </tr>
  <tr>
    <td align="center"></td>
  </tr>
  <tr>
    <td height="350px" align="center"><img src="{{ public_path('assets/images/ptsp.jpg') }}" height="340px" alt="Logo"></td>
  </tr>
  <tr>
    <td align="center">Disusun Oleh :</td>
  </tr>
</table>

<p></p>
<table width="100%" border="0">
  <tr>
    <td width="30%">Nama</td>
    <td width="70%">: {{ ucfirst($data->user->name) }}</td>
  </tr>
  <tr>
    <td >Formasi</td>
    <td >: {{ RenderJson($data->user->profile, "jabatan") }}</td>
  </tr>
</table>

<br>
<p></p><p></p>
<table width="100%" border="0">
  <tr>
    <td align="center">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</td>
  </tr>
  <tr>
    <td align="center">PROVINSI DKI JAKARTA</td>
  </tr>
  <tr>
    <td align="center">{{$data->year}}</td>
  </tr>
</table>

<p style="page-break-after: always;"></p>

<table width="100%" border="0">
  <tr>
    <td width="32%"></td>
    <td width="6%"></td>
    <td width="63%"></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><b>LAPORAN KINERJA BULANAN</b></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><b>TENAGA AHLI</b></td>
  </tr>

  <tr>
    <td></td>
    <td colspan="2"></td>
  </tr>

  <tr>
    <td>Nama</td>
    <td></td>
    <td>: {{ $data->user->name }}</td>
  </tr>

  <tr>
    <td>Satuan Pelaksana</td>
    <td></td>
    <td>: Sarana dan Prasarana Teknologi Informasi</td>
  </tr>

  <tr>
    <td>Instansi</td>
    <td></td>
    <td>: Pudatin PMPTSP DPMPTSP Provinsi DKI Jakarta</td>
  </tr>

  <tr>
    <td>Bulan</td>
    <td></td>
    <td>: {{ $data->month }}</td>
  </tr>

  <tr>
    <td>Tahun</td>
    <td></td>
    <td>: {{ $data->year }}</td>
  </tr>

<table width="100%" border="0">
  <tr>
    <td width="6%"></td>
    <td width="32%"></td>
    <td width="63%"></td>
  </tr>
</table>

<table width="100%" border="1" cellpadding="5">
  <tr>
    <td width="6%" height="15px" align="center">No</td>
    <td width="20%" align="center">Tanggal</td>
    <td width="51%" align="center">Uraian Pekerjaan</td>
    <td width="25%" align="center">Pemberi Tugas</td>
  </tr>
  @php($no=1)

  @foreach($data->ReportDescription as $row)
  <tr>
    <td height="100px" align="center">{{$no++}}</td>

    <td align="center">{{ DayFormat($row->date) }}<br>{{ DateFormat($row->date) }}</td>
    
    <td>
      <ol style="padding-left:-15px;">
      @foreach(json_decode($row->descriptions, true) as $key => $value)
        <li>{{ $value }}</li>
      @endforeach 
      </ol>
    </td>

    @if(in_array($data->verification, ['kasubbag', 'kabid']))
    <td style="text-align:center;">
      <br>
      <br>
      <br>
      <img src="{{ public_path('assets/images/sign_kasubbag.png') }}" height="80px" alt="Sign">
      <br>
      <br>
      <br>
      Darmawan Apriyadi<br>198504132010011023
    </td>
    @else
    <td style="text-align:center;">
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      Darmawan Apriyadi<br>198504132010011023
    </td>
    @endif
  </tr>
  @endforeach
</table>
<p></p>
{{-- <table width="100%" border="0">
  @foreach($harilibur->sortBy('tanggal') as $row)
  <tr>
    <td width="20%"><i>*{{\TANGGAL::Tanggal($row->tanggal)}}</i></td>
    <td width="80%"><i>{{$row->keterangan}}</i></td>
  </tr>
  @endforeach
</table>
<p></p> --}}
<table width="100%" border="0">
  <tr>
    <td width="6%">-</td>
    <td width="50%"></td>
    <td width="44%" align="center">Menyetujui dan Mengetahui,</td>
  </tr>
  <tr>
    <td width="6%"></td>
    <td width="50%"></td>
    <td width="44%" align="center">Pejabat Pembuat Komitmen</td>
  </tr>
  <tr>
    <td width="6%"></td>
    <td width="50%"></td>
    <td width="44%" align="center">Pusat Data dan Informasi Penanaman Modal dan</td>
  </tr>
  <tr>
    <td width="6%"></td>
    <td width="50%"></td>
    <td width="44%" align="center">Pelayanan Terpadu Satu Pintu</td>
  </tr>
  <tr>
    <td width="6%"></td>
    <td width="50%"></td>
    <td width="44%" align="center">DPMPTSP Provinsi DKI Jakarta</td>
  </tr>
  <tr>
    <td width="6%"></td>
    <td width="50%"></td>
    <td width="44%" align="center"  height="30px" ></td>
  </tr>
  <tr>
    <td width="6%" >
    </td>
    <td width="50%">
    </td>
    <td width="44%" align="center">
      @if($data->verification == 'kabid')
      <strong><i>{!! ReportVerify($data->verification) !!}</i></strong>
      @endif
    </td>
  </tr>
  <tr>
    <td width="6%"></td>
    <td width="50%"></td>
    <td width="44%" align="center"  height="30px" ></td>
  </tr>
  <tr>
    <td width="6%"></td>
    <td width="50%"></td>
    <td width="44%" align="center">BUDI ISMANTO</td>
  </tr>
  
  <tr>
    <td width="6%"></td>
    <td width="50%"></td>
    <td width="44%" align="center">NIP. 197110131995031001</td>
  </tr>
</table>

<p></p>
<table width="100%" border="0">
  @foreach($holidays as $holiday)
  <tr>
    <td width="20%"><i>* {{ DateFormat($holiday->date) }} </i></td>
    <td width="80%"><i>{{ $holiday->name }}</i></td>
  </tr>
  @endforeach
</table>

<p style="page-break-after: always;"></p>

<p></p><p></p><p></p><p></p><p></p><p></p><p></p>

<p style="text-align:center;">
  <center>
    <img src="{{ public_path('assets/images/logo_dki.png') }}" height="80px" alt="Logo">
  </center>
</p>

<table width="100%" border="0">
  <tr>
    <td align="center">LAPORAN FOTO</td>
  </tr>
  <tr>
    <td align="center">HASIL PELAKSANAAN PEKERJAAN</td>
  </tr>
  <tr>
    <td align="center">TENAGA AHLI</td>
  </tr>
  <tr>
    <td align="center"></td>
  </tr>
  <tr>
    <td align="center"></td>
  </tr>

  <tr>
    <td align="center"></td>
  </tr>
  <tr>
    <td height="350px" align="center"><img src="{{ public_path('assets/images/ptsp.jpg') }}" height="340px" alt="Logo"></td>
  </tr>
  <tr>
    <td align="center">Disusun Oleh :</td>
  </tr>
</table>

<p></p>
<table width="100%" border="0">
  <tr>
    <td width="30%">Nama</td>
    <td width="70%">: {{ ucfirst($data->user->name) }}</td>
  </tr>
  <tr>
    <td >Formasi</td>
    <td >: {{ RenderJson($data->user->profile, "jabatan") }}</td>
  </tr>
</table>

<br>
<p></p>
<table width="100%" border="0">
  <tr>
    <td align="center">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</td>
  </tr>
  <tr>
    <td align="center">PROVINSI DKI JAKARTA</td>
  </tr>
  <tr>
    <td align="center">{{ $data->year }}</td>
  </tr>
</table>

{{-- <p style="page-break-after: always;"></p> --}}

<style>
  .imageReport {
      max-width: 100%;
      max-height: 100%;
      display: block; /* remove extra space below image */
  }
  .box{
      width: 250px;        
      /* border: 5px solid black; */
  }    
  .box.large{
      height: 300px;
  }

  .container-box {
    display: flex;
    /* width: 450px; */
    height: 740px;
    /* border: 2px solid red; */
  }
  .container-box div {
    flex: 1;
  }
  .container-box img {
    /* max-width:100%; */
    height : 100px;
    /* max-height: 150px; */
  }
</style>

{{-- <table width="100%" border="1"> --}}
  {{-- <tr>
    <td width="30%">Hari</td>
    <td width="70%">{{ DayFormat($data->date) }}</td>
  </tr>
  <tr>
    <td width="30%">Tanggal</td>
    <td width="70%">{{ DateFormat($data->date) }}</td>
  </tr>
  <tr>
    <td colspan="2" height="750px">
    </td>
  </tr> --}}
  {!! $dataPics !!}
{{-- </table> --}}
