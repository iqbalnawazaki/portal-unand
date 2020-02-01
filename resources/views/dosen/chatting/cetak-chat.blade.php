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
Jurusan {{ ucwords(strtolower($mhs->jurusan)) }} <br>
Universitas Andalas <hr> </h5>
</div>
<h4 class="text-center" >Dokumen Bimbingan Akademik</h4>
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
        @foreach($periodeid as $periode)
        <div class="table">
         <table class="table table-bordered success-table">
           <tbody>
               <tr style="background:#98ccd3;">
                   <th>Bimbingan akademik <b>{{$periode->nama}}</b></th>                  
               </tr>
            @foreach($bimbinganChatting as $item)
            @if($item->semester_id == $idsemester && $item->periode_id == $periode->id)
            <tr>        
                <td style="padding: 4px;">
                    @if(!$item->image)
                    <div row justify-content-between> 
                    <div style="color: black; padding: 4px;" class="badge badge-success border">{{ $item->name }}</div>
                     <div style="color: black; padding: 4px;" class="badge badge-success pull-right border">{{ $item->topik }} : {{ $item->created_at }}</div>
                    </div>
                    <div style="padding: 2px;" class="box bg-light-info border">{{ $item->pesan }}</div>
                    @else(!$item->pesan)
                    <div row justify-content-between> 
                    <div style="color: black; padding: 4px;" class="badge badge-success border">{{ $item->name }}</div>
                     <div style="color: black;" class="badge badge-success pull-right border">{{ $item->created_at }} {{ $item->topik }}</div>
                    </div>
                    <div>
                    <img src="{{  asset('images/'.$item->image) }}" alt="user" style="width:150px; height:100px; padding-top: 4px;" />
                    </div>
                    @endif
                </td> 
            </tr>
            @endif
            @endforeach
            </tbody>
          </table>
        </div>
          @endforeach

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
    <tr><td class="text-center" colspan="3" height="50"><img class="pull-center" src="{{  asset('storage/signature/'.$user->signature) }}" alt="user" style="width:90px; height:90px;" /></td></tr>
    <tr><td class="text-center">{{ $mhs->gelarDepanPA }}, {{ $mhs->dosenPA }}, {{ $mhs->gelarBelakangPA }}</td></tr>
</tbody></table>
</div>
</div>
</div>
</body>
</html>