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
    <link href="{{asset('asset/css/transkrip.css')}}" rel="stylesheet">

</head>

<body onload="window.print()">
   <div id="container">
         <div class="nobreak">
            <div id="header">
               <img src="http://portal.unand.ac.id//images/logo.gif" alt="logo">
               <h3></h3>
               <h2></h2>
               <h4><b></b></h4>
               <h4></h4>
               <hr>
            </div>
      
            <div id="nomor_transkrip">
               <h1 style="color:black;">TRANSKRIP NILAI</h1>
               <hr>
               <h1 style="color:black;">Nomor : ............................................</h1>
            </div>
      
               <div id="info_mhs">
                  <table style="color:black;">
                     <tbody><tr>
                        <th>Nama Mahasiswa</th>
                        <th>:</th>
                        <td>{{ $mhs->nama }}</td>
                        <th>Tempat Lahir</th>
                        <th>:</th>
                        <td>{{ $mhs->kotalahir }}</td>
                     </tr>
                     <tr>
                        <th>No. Induk Mahasiswa</th>
                        <th>:</th>
                        <td>{{ $mhs->nim }}</td>
                        <th>Tanggal Lahir</th>
                        <th>:</th>
                        <td>{{ date('d F Y', strtotime($mhs->tglahir)) }}</td>
                     </tr>
                     <tr>
                        <th>Terdaftar Mulai</th>
                        <th>:</th>
                        <td>{{ date('d F Y', strtotime($mhs->tglterdaftar)) }}</td>
                        <th>Lulus Sarjana</th>
                        <th>:</th>
                        <td>0</td>
                     </tr>
                     <tr>
                        <th>Program Studi</th>
                        <th>:</th>
                        <td>{{ $mhs->jurusan }}</td>
                        <th>Nomor Ijazah</th>
                        <th>:</th>
                        <td>{{ $mhs->no_ijazah }}</td>
                     </tr>
                  </tbody></table>
               </div>
             
         
               <div id="table_transkrip" class="row justify-content-between">
               @php
                  $no=1;
                  $jumlahsks = 0;
                  $jumlahbobot = 0;
                  $nilaiD = 0;
               @endphp

               @php
               echo ' <div class="col-6">';
               echo '<table class="table border black" style="color:black;"><th class="text-center">No</th><th class="text-center">Matakuliah</th><th class="text-center">sks</th><th class="text-center">Nilai<br>Huruf</th><th class="text-center">Nilai<br>Mutu</th><tr>';
               $i=1;
               foreach ($krs as $key => $item){
                  if($i%2==0 && $i!=0 && $item->nilaikode != "" && $item->nilaikode != "BL")
                  {
                  echo '</tr><tr><td class="text-center">'.$no++.'</td>
                                 <td class="text-left">'.$item->matkulnama.'</td>
                                 <td class="text-center">'.$item->matkulsks.'</td>
                                 <td class="text-center">'.$item->nilaikode.'</td>
                                 <td class="text-center">'.$item->nilaibobot * $item->matkulsks.'</td>
                  ';
                  }
                 
               $i++;
               }
                echo '</tr><tr><td class="text-center"></td><td class="text-center"></td><td class="text-center"></td><td class="text-center"></td><td>&nbsp;</td>';
               echo '</tr></table>';
               echo '</div><div class="col-6">';

               echo '<table class="table table border black" style="color:black;"><th class="text-center">No</th><th class="text-center">Matakuliah</th><th class="text-center">sks</th><th class="text-center">Nilai<br>Huruf</th><th class="text-center">Nilai<br>Mutu</th><tr>';
               $i=1;
              
               foreach ($krs as $key => $item){
               if($item->nilaikode != "" && $item->nilaikode != "BL"){
                  if($i%2!=0 && $i!=0)
                  {
                  echo '</tr><tr><td class="text-center">'.$no++.'</td>
                                 <td class="text-left">'.$item->matkulnama.'</td>
                                 <td class="text-center">'.$item->matkulsks.'</td>
                                 <td class="text-center">'.$item->nilaikode.'</td>
                                 <td class="text-center">'.$item->nilaibobot * $item->matkulsks.'</td>
                  ';
                  }
                  if($item->nilaikode == "D"){
                     $nilaiD++;
                  }
                $jumlahsks+=$item->matkulsks;
                $jumlahbobot+=$item->nilaibobot * $item->matkulsks;
               }
               $i++;
                
               }
               echo '</tr><tr><td class="text-center"></td><td class="text-center"><b>JUMLAH</b></td><td class="text-center">'.$jumlahsks.'</td><td class="text-center"></td><td class="text-center">'.$jumlahbobot.'</td>';
               echo '</tr></table>';
               @endphp
               </div>
              </div>
              
               <div id="judul-skripsi">
               <table style="color:black;">
                  <tbody><tr>
                     <th>Judul Skripsi</th>
                     <td>: </td>
                  </tr>
               </tbody></table>
               </div>

                  

            <div class="row justify-content-between">
            <div id="pembimbing" class="col-6">
               <table style="color:black;">
                  <tbody>
                  <tr>
                    <td></td>
                  </tr>
                  <tr>
                     <th>Indeks Prestasi</th>
                     <th>:</th>
                     <td>@php echo number_format((float)$jumlahbobot/$jumlahsks, 2, '.', '')  @endphp </td>
                  </tr>
                  <tr>
                     <th>Predikat Lulus</th>
                     <th>:</th>
                     <td>{{ $mhs->predikat_lulus }} </td>
                  </tr>
                  <tr>
                     <th>Nilai D</th>
                     <th>:</th>
                     <td>@php echo $nilaiD @endphp </td>
                  </tr>
                   <tr>
                     <th>Lama Studi</th>
                     <th>:</th>
                     <td>0 th 0 bl</td>
                  </tr>
                  
                  <tr>
                     <th>Pembimbing TA 1</th>
                     <th>:</th>
                     <td></td>
                  </tr>
                  <tr>
                     <th>Pembimbing Akd.</th>
                     <th>:</th>
                     <td>{{ $mhs->gelarDepanPA }}{{ $mhs->dosenPA }}, {{ $mhs->gelarBelakangPA }}</td>
                  </tr>
               </tbody></table>
            </div>
      
            <div id="table_right" class="col-6">
            <table style="color:black;">
                  <tbody>                   
                  <tr>
                     <th colspan="3">Padang, @php $mytime = Carbon\Carbon::now();
                                                $tanggal = date_format($mytime,"Y-m-d");
                                     echo date('d F Y', strtotime($tanggal)) @endphp</th>
                  </tr>
                  <tr>
                     <th><span id="jabatan"></span></th>
                  </tr>
                  <tr>
                     <th height="60">&nbsp; </th>
                  </tr>
                  <tr>
                     <th><span id="nama">........................................</span></th>
                  </tr>
                  <tr>
                     <th>NIP. <span id="nip">.................................</span></th>
                  </tr>
      
               </tbody></table>
               </div>
               </div>


         </div>
   </div>
</body>
</html>
