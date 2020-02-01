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
<h4 class="text-center" >Kartu Rencana Studi</h4>
<h5 class="text-center">Semester: {{ $max->semester_nama }} {{ $max->semester_tahun }} / {{ $max->semester_tahun + 1 }} </h5>

        <div class="row justify-content-between">
        <div class="col-6">
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
        <div class="col-4">
        <img class="pull-right" src="{{  asset('storage/avatars/'.Auth::user()->avatar) }}" alt="user" style="width:75px; height:100px;" />
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
                   <th colspan="6" class="text-center">JADWAL</th>
                   <th style="vertical-align : middle;" rowspan="2" class="text-center">DOSEN</th>
                   <th style="vertical-align : middle;" rowspan="2" class="text-center">STATUS KRS</th>
               </tr>
               <tr>
                   <th class="text-center">KODE</th>
                   <th class="text-center">NAMA</th>
                   <th class="text-center">Sn</th>
                   <th class="text-center">Sl</th>
                   <th class="text-center">Rb</th>
                   <th class="text-center">Km</th>
                   <th class="text-center">Jm</th>
                   <th class="text-center">Sb</th>
               </tr>
           </thead>
           @php
            $no = 1;
            $totalsks=0
           @endphp
           <tbody>
           @foreach($krs as $krskini)
           @if($krskini->semesterkelas == $max->semester_id)
             <tr>
               <td class="text-center">{{ $no++ }}</td>
               <td>{{ $krskini->namakelas }}</td>
               <td>{{ $krskini->matkulkode }}</td>
               <td>{{ $krskini->matkulnama }}</td>
               <td class="text-center">{{ $krskini->matkulsks }}</td>
               
               <td>
                    @if($krskini->jadwalUji == [ ])
                    
                    @else
                    @foreach($krskini->jadwalKul as $jadwal)
                    @if($jadwal->jadwalhari == "Senin")
                        {{ date('g:i', strtotime($jadwal->jadwaljammulai)) }} -
                        {{ date('g:i', strtotime($jadwal->jadwaljamselesai)) }}<br>
                        {{ $jadwal->ruangnama }}
                    @endif
                    @endforeach                        
                    @endif
               </td>
               <td>
                    @if($krskini->jadwalUji == [ ])
                    
                    @else
                    @foreach($krskini->jadwalKul as $jadwal)
                    @if($jadwal->jadwalhari == "Selasa")
                        {{ date('g:i', strtotime($jadwal->jadwaljammulai)) }} -
                        {{ date('g:i', strtotime($jadwal->jadwaljamselesai)) }}<br>
                        {{ $jadwal->ruangnama }}
                    @endif
                    @endforeach                        
                    @endif
               </td>
               <td> 
                    @if($krskini->jadwalUji == [ ])
                    
                    @else
                    @foreach($krskini->jadwalKul as $jadwal)
                    @if($jadwal->jadwalhari == "Rabu")
                        {{ date('g:i', strtotime($jadwal->jadwaljammulai)) }} -
                        {{ date('g:i', strtotime($jadwal->jadwaljamselesai)) }}<br>
                        {{ $jadwal->ruangnama }}
                    @endif
                    @endforeach                        
                    @endif
               </td>
               <td>
                    @if($krskini->jadwalUji == [ ])
                    
                    @else
                    @foreach($krskini->jadwalKul as $jadwal)
                    @if($jadwal->jadwalhari == "Kamis")
                        {{ date('g:i', strtotime($jadwal->jadwaljammulai)) }} -
                        {{ date('g:i', strtotime($jadwal->jadwaljamselesai)) }}<br>
                        {{ $jadwal->ruangnama }}
                    @endif
                    @endforeach                        
                    @endif
               </td>
               <td>
                    @if($krskini->jadwalUji != "")
                    @foreach($krskini->jadwalKul as $jadwal)
                    @if($jadwal->jadwalhari == "Jumat")
                        {{ date('g:i', strtotime($jadwal->jadwaljammulai)) }} -
                        {{ date('g:i', strtotime($jadwal->jadwaljamselesai)) }}<br>
                        {{ $jadwal->ruangnama }}
                    @endif
                    @endforeach                        
                    @endif
               </td>
               <td>
                    @if($krskini->jadwalUji != "")
                    @foreach($krskini->jadwalKul as $jadwal)
                    @if($jadwal->jadwalhari == "Sabtu")
                        {{ date('g:i', strtotime($jadwal->jadwaljammulai)) }} -
                        {{ date('g:i', strtotime($jadwal->jadwaljamselesai)) }}<br>
                        {{ $jadwal->ruangnama }}
                    @endif
                    @endforeach                        
                    @endif
               </td>
               <td>
               @foreach($krskini->dosenKel as $namodosen)
               {{ $namodosen->gelardepan }} {{ $namodosen->dosennama }} {{ $namodosen->gelarbelakang }}
                @endforeach
               </td>
               <td class="text-center">
                   @if($krskini->matkulkrsstatus == "1")
                     Disetujui
                   @else
                     Belum/Tidak Disetujui
                   @endif
               </td>
             </tr>
             @php
             $totalsks += $krskini->matkulsks
             @endphp

             @endif
           @endforeach
           </tbody>
           <tfoot>
             <tr>
                 <th colspan="4">JUMLAH</th>
                 <th class="text-center">
                    @php
                    echo $totalsks
                    @endphp
                 </th>
                 <th colspan="10"></th>
             </tr>
           </tfoot></table>
           </div>

          <table class="table-striped-info col-lg-8 tabel-ip">
          <tbody>
            <tr><th> IP Semester Lalu </th><td>: {{ number_format((float)$sks->ipsemestersebelumnya, 2, '.', '') }} </td></tr>
            <tr><th> Max SKS </th><td>: {{ $sks->sksjatah }} </td></tr>
            <tr><th> Catatan</th><td>:  KRS yang sudah disetujui, diminta kembali tandatangan kepada Dosen PA masing-masing. </td></tr>
          </tbody>
        </table>
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
        <td class="text-center" height="50"> <img class="pull-center" src="{{  asset('storage/signature/'.$signature->signature) }}" alt="user" draggable="false" style="width:90px; height:90px;" /></td>
    </tr>
    <tr>
        <td align="center">{{ $mhs->gelarDepanPA }} {{ $mhs->dosenPA }}, {{ $mhs->gelarBelakangPA }}</td>
        <td width="25%">&nbsp;</td>
        <td align="center"> {{ ucwords(strtolower($mhs->nama)) }} </td>
    </tr>
</tbody></table>
</div>
</body>
</html>
