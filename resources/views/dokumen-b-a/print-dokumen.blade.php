<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('asset/assets/images/unand-logo.png')}}">
    <title>Portal Akademik Universitas Andalas</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('asset/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  
    <link href="{{asset('asset/css/style.css')}}" rel="stylesheet">
    

</head>
<style>
 
</style>
<body onload="window.print()">
<div class="card-body">
<div class="row">
<img src="{{asset('asset/assets/images/unand-logo.png')}}" style="width:50px; height:50px;" alt="" class="" />&nbsp;
<h5>
Kementerian Riset, Teknologi dan Pendidikan Tinggi <br>
Universitas Andalas <hr> </h5>
</div>
<h4 class="text-center" >Dokumen Bimbingan Akademik</h4>
<h5 class="text-center">Semester:
                        @foreach($smr as $semesterkini)
                           @if($semesterkini->semesterid == $dokumenba->semester_id )
                              {{ $semesterkini->semesternama }} {{ $semesterkini->semestertahun }}/{{ $semesterkini->semestertahun + 1 }}
                           @endif
                        @endforeach

 </h5>

        <div class="row justify-content-between">
        <div class="">
          <table class="table-responsive">
            <tbody><tr>
               <td>Nama</td>
               <td>: {{ ucwords(strtolower($mhs->nama)) }}</td>
               <td></td>
            </tr>
            <tr>
               <td>NIM</td>
               <td>: {{ $mhs->nim }}</td>
            </tr>
         </tbody>
          </table>
        </div>
        <div class="pull-right">
        <table class="table-responsive">
            <tbody>
            <tr>
               <td>Program Studi</td>
               <td>: {{ ucwords(strtolower($mhs->jurusan)) }}</td>
            </tr>
            <tr>
               <td>Dosen PA</td>
               <td>: {{ $mhs->gelarDepanPA }} {{ $mhs->dosenPA }}, {{ $mhs->gelarBelakangPA }}</td>
            </tr>
         </tbody>
          </table>
        </div>
        </div><br>
        <div class="row">
          <table class="table-responsive">
            <tbody>
            <tr>
               <td><b>Topik</b></td>
               <td>:  {{ $dokumenba->topik }}</td>
            </tr>
            <tr>
               <td><b>Periode</b></td>
               <td>:  {{ App\Periode::find($dokumenba->periode_id)->nama }}</td>
            </tr>
            <tr>
               <td><b>Tanggal</b></td>
               <td>:  {{ date('d F Y', strtotime($dokumenba->tanggal)) }}</td>
            </tr>
            <tr>
               <th><b>Catatan</b></th><br>
               <td></td>
            </tr>
         </tbody>
          </table>
         </div>

         <div class="row">
          <table class="table-responsive">
         <tbody>
             <td> <div class="box bg-light-info border">{!! $dokumenba->catatan !!}</div> </td>
         </tbody>
          </table>
         </div>
</div>

<div align="right">
<table class="tabel-nama" width="60%" cellpadding="0" cellspacing="0">
    <tbody><tr>
        <td width="65%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
        <td align="center" width="45%">Padang,.....................................</td>
    </tr>
    <tr>
        <td align="center">Mengetahui</td>
        <td width="10%">&nbsp;</td>
        <td align="center"></td>
    </tr>
    <tr>
        <td align="center">Dosen PA</td>
        <td width="25%">&nbsp;</td>
        <td align="center">Mahasiswa</td>
    </tr>
    <tr>
        <td colspan="3" height="50"></td>
    </tr>
    <tr>
        <td align="center">{{ $mhs->gelarDepanPA }}, {{ $mhs->dosenPA }}, {{ $mhs->gelarBelakangPA }}</td>
        <td width="25%">&nbsp;</td>
        <td align="center"> {{ $mhs->nama }} </td>
    </tr>
</tbody></table>
</div>
</body>
</html>
