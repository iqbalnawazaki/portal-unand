<!DOCTYPE html>
<html lang="en">
<head>
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

<body onload="window.print()">
<div class="card-body row">
<img src="{{asset('asset/assets/images/unand-logo.png')}}" style="width:50px; height:50px;" alt="" class="" />&nbsp;
<h5>
Kementerian Riset, Teknologi dan Pendidikan Tinggi <br>
Universitas Andalas <hr> </h5>
</div>
<h4 class="text-center" >KARTU TANDA PESERTA UJIAN</h3>
<h5 class="text-center">AKHIR SEMESTER : {{ $max->semester_nama }} {{ $max->semester_tahun }} / {{ $max->semester_tahun + 1 }}</h5>

 <div class="row justify-content-between">
        <div class="col-8">
          <table class="table-responsive">
            <tbody><tr>
               <td>Nama</td>
               <td>: {{ ucwords(strtolower($mhs->nama)) }} </td>
               <td></td>
            </tr>
            <tr>
               <td>NIM</td>
               <td>: {{ $mhs->nim }} </td>
            </tr>
         </tbody>
        </table>
        </div>

        <div class="col-4">
          <table class="table-responsive">
            <tbody>
            <tr>
               <td>Program Studi</td>
               <td>: {{ ucwords(strtolower($mhs->jurusan)) }} </td>
            </tr>
            <tr>
               <td>Dosen PA</td>
               <td>: {{ $mhs->gelarDepanPA }} {{ $mhs->dosenPA }}, {{ $mhs->gelarBelakangPA }} </td>
            </tr>
         </tbody>
        </table>
        </div>
        </div><br>
        <div class="table">
         <table class="table table-bordered success-table">
           <thead style="background:#a6ed8e;" class="table-bordered">
               <tr>
                   <th style="vertical-align : middle;" rowspan="2" class="text-center">NO</th>
                   <th style="vertical-align : middle;" rowspan="2" class="text-center">KELAS</th>
                   <th colspan="2" class="text-center">MATAKULIAH</th>
                   <th style="vertical-align : middle;" rowspan="2" class="text-center">SKS</th>
                   <th style="vertical-align : middle;" rowspan="2" class="text-center">DOSEN</th>
                   <th style="vertical-align : middle;" rowspan="2" class="text-center">STATUS <br> KRS</th>
                   <th colspan="4" class="text-center">JADWAL UJIAN</th>
               </tr>
               <tr>
                   <th class="text-center">KODE</th>
                   <th class="text-center">NAMA</th>
                   <th class="text-center">Tanggal</th>
                   <th class="text-center">Jam</th>
                   <th class="text-center">Ruang</th>
                   <th class="text-center">No.Kursi</th>
               </tr>
           </thead>
           @php
            $no=1;
            $totalsks=0
           @endphp
           <tbody>
           @foreach($krs as $item)
              @if($item->semesterkelas == $max->semester_id)
                
             <tr>
               <td class="text-center">{{ $no++ }}</td>
               <td>{{ $item->namakelas }}</td>
               <td>{{ $item->matkulkode }}</td>
               <td>{{ $item->matkulnama }}</td>
               <td class="text-center">{{ $item->matkulsks }}</td>
               <td>
                    @foreach($item->dosenKel as $dosenmatkul)
                        {{ $dosenmatkul->gelardepan }} {{ $dosenmatkul->dosennama }} {{ $dosenmatkul->gelarbelakang }} 
                    @endforeach
               </td>
               <td>
                    @if($item->matkulkrsstatus == "1")
                        Disetujui
                    @else
                        Tidak Disetujui
                    @endif
               </td>
               
               <td class="text-center">  
                    @foreach($ujian as $ruang)
                        @if($ruang->semesterkelas == $max->semester_id && $ruang->kelasnama == $item->namakelas && $ruang->jenisujian == "A" )
                            {{ date('d-m-Y',strtotime($ruang->ujiantanggal)) }}
                        @endif
                    @endforeach
               </td>
               <td class="text-center"> 
                    @foreach($ujian as $ruang)
                        @if($ruang->semesterkelas == $max->semester_id && $ruang->kelasnama == $item->namakelas && $ruang->jenisujian == "A" )
                            {{ date('H:i', strtotime($ruang->ujianjammulai)) }} - {{ date('H:i', strtotime($ruang->ujianjamselesai)) }}
                        @endif
                    @endforeach
               </td>
          
               <td class="text-center">
                    @foreach($ujian as $ruang)
                        @if($ruang->semesterkelas == $max->semester_id && $ruang->kelasnama == $item->namakelas && $ruang->jenisujian == "A" )
                            {{ $ruang->ruanganujian }}
                        @endif
                    @endforeach
               </td>
               <td class="text-center">
                    @foreach($ujian as $ruang)
                        @if($ruang->semesterkelas == $max->semester_id && $ruang->kelasnama == $item->namakelas && $ruang->jenisujian == "A" )
                            {{ $ruang->kursipeserta }}
                        @endif
                    @endforeach
               </td>
             </tr>
             @php
             $totalsks += $item->matkulsks
             @endphp

              @endif
           @endforeach
             
           </tbody>
           <tfoot>
             <tr>
                 <th colspan="2">JUMLAH</th>
                 <th colspan="2"></th>
                 <th class="text-center">
                    @php
                    echo $totalsks
                    @endphp
                 </th>
                 <th colspan="7"></th>
             </tr>
           </tfoot></table>
           </div>

          <table class="table-striped-info col-lg-8 tabel-ip">
          <tbody>
            <tr><th> IP Semester Lalu </th><td>: {{ number_format((float)$sks->ipsemestersebelumnya, 2, '.', '') }}  </td></tr>
            <tr><th> Max SKS </th><td>: {{ $sks->sksjatah }} </td></tr>
            <tr><th> Catatan</th><td>:  KRS yang sudah disetujui, diminta kembali tandatangan kepada Dosen PA masing-masing. </td></tr>
          </tbody>
        </table><br>
</div>

<div class="row justify-content-end">
<div class="col-4">
<br>
    <img class="pull-right" src="{{  asset('storage/avatars/'.Auth::user()->avatar) }}" alt="user" style="width:75px; height:100px;" />
</div>

<div class="col-4">
<table class="tabel-nama" width="60%" cellpadding="0" cellspacing="0">
    <tbody><tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>..................................................</td>
    </tr>
    <tr> 
        <td align="center"></td>
        <td width="10%">&nbsp;</td>
        <td align="center">Mengetahui</td>
    </tr>
    <tr> 
        <td align="center"></td>
        <td width="25%">&nbsp;</td>
        <td align="center">Dosen PA</td>
    </tr>
   <tr>
        <td align="center"></td>
        <td width="25%">&nbsp;</td>
        <td class="text-center" height="50"> <img class="pull-center" src="{{  asset('storage/signature/'.$signature->signature) }}" alt="user" style="width:90px; height:90px;" /></td>
    </tr>
    <tr> 
        <td align="center"></td>
        <td width="25%">&nbsp;</td>
        <td align="center">{{ $mhs->gelarDepanPA }} {{ $mhs->dosenPA }}, {{ $mhs->gelarBelakangPA }}</td>
    </tr>
</tbody></table>
</div>

</div>
</body>
</html>