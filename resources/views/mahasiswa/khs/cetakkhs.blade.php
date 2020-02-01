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
<h4 class="text-center" >Kartu Hasil Studi(KHS)</h4>
<h5 class="text-center">Semester: @foreach($smr as $semesterkini)
                                      @if($semesterkini->semesterid == $idsemester )
                                           {{ $semesterkini->semesternama }} {{ $semesterkini->semestertahun }}/{{ $semesterkini->semestertahun + 1 }}
                                      @endif
                                    @endforeach </h5>

        <div class="row justify-content-between">
        <div class="col-5">
          <table class="table-responsive">
            <tbody><tr>
               <td>Nama</td>
               <td>: {{ ucwords(strtolower($mhs->nama)) }}</td>
               <td></td>
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
        <table class="table-responsive">
        <tr>
            <td>NIM</td>
            <td>: {{ $mhs->nim }}</td>
        </tr>
         <tr>
            <td>Angkatan</td>
            <td>: {{ $mhs->angkatan }}</td>
        </tr>
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
                   <th style="vertical-align : middle;" rowspan="2" class="text-center">NILAI</th>
                   <th style="vertical-align : middle;" rowspan="2" class="text-center">BOBOT</th>
                   <th style="vertical-align : middle;" rowspan="2" class="text-center">NILAI SKS</th>
               </tr>
               <tr>
                   <th class="text-center">KODE</th>
                   <th class="text-center">NAMA</th>
               </tr>
           </thead>
           @php
            $no = 1;
            $totalsks=0;
            $totalbobot=0;
            $khssks = 0;
            $khsip = 0;
            $total_bobot = 0;
            $total_sks = 0;
            
           @endphp
           <tbody>
           @foreach($krs as $krskini)
           @if($krskini->semesterkelas == $idsemester && $krskini->matkulkrsstatus != "" && $krskini->kelas_batal == 0)
             <tr>
               <td class="text-center">{{ $no++ }}</td>
               <td class="text-center">{{ $krskini->namakelas }}</td>
               <td class="text-center">{{ $krskini->matkulkode }}</td>
               <td >{{ $krskini->matkulnama }}</td>
               <td class="text-center">{{ $krskini->matkulsks }}</td>
               <td  class="text-center">{{ $krskini->nilaikode }}</td>
               <td  class="text-center">{{ $krskini->nilaibobot }}</td>
               <td  class="text-center">{{ ($krskini->nilaibobot * $krskini->matkulsks) }}</td>
             </tr>
             @php
             $totalsks += $krskini->matkulsks;
             $khssks += $krskini->matkulsks;
             $totalbobot += ($krskini->nilaibobot * $krskini->matkulsks)
             @endphp

             @endif
           @endforeach
           </tbody>
           <tfoot>
             <tr>
                 <th colspan="4">JUMLAH</th>
                 <th class="text-center">{{$totalsks}}</th>
                 <th colspan="2"></th>
                 <th class="text-center">{{$totalbobot}}</th>
             </tr>
           </tfoot></table>
           </div>
     <div class="row justify-content-between">
        <div class="col-6">
         <div class="table-responsive">
          <table class="table-striped-info col-lg-12">
            <tr><th> IP Semester (IPS)	</th>
            <td>:  @foreach($ip as $ipsemester)
                        @if($ipsemester->semester_id == $idsemester)
                        @php
                         $ips = $ipsemester->ip_semester
                        @endphp
                        {{ number_format((float)$ips, 2, '.', '') }}
                        @endif
                    @endforeach 
            </td></tr>
            <tr><th> IP Kumulatif (IPK)	 </th>
            <td>:   @foreach($ip as $ipsemester)
                        @if($ipsemester->semester_id <= $idsemester)
                            @php
                            $total_bobot += $ipsemester->total_bobot;
                            $total_sks += $ipsemester->total_sks;
                            @endphp
                        @endif
                    @endforeach
                    {{ number_format((float)$total_bobot / $total_sks, 2, '.', '') }}
             </td></tr>
            <tr><th> Maks. beban SKS semester berikutnya </th>
                <td>:
                @if(!empty($ips))               
                @foreach($sks as $jatah)
                @if($ips >= $jatah->batas_min_ip && $ips <= $jatah->batas_max_ip )
                    {{ $jatah->jatah_sks }}
                @endif
                @endforeach
                @endif

                </td>
            </tr>
          </table>
         </div>
        </div>
        
        <div class="col-4">
        </div>
         <div class="col-4">
        </div>
         <div class="col-4">
        </div>
    </div>
</div>
<div class="container">
<div class="row">
 <div class="col align-self-start">
      
    </div>
    <div class="col align-self-center">
      
    </div>
     <div class="col align-self-center">
      
    </div>
     <div class="col align-self-center">
      
    </div>
     <div class="col align-self-center">
      
    </div>

<div class="col align-self-end">
<table class="table-striped-info">
    <tbody>
    <tr><td class="text-center">Padang,.....................................</td></tr>
    <tr><td class="text-center">Mengetahui</td></tr>
    <tr><td class="text-center">Dosen PA</td></tr>
    <tr><td colspan="3" height="50"></td></tr>
    <tr><td class="text-center">{{ $mhs->gelarDepanPA }} {{ $mhs->dosenPA }}, {{ $mhs->gelarBelakangPA }}</td></tr>
</tbody></table>
</div>
</div>
</div>
</body>
</html>
