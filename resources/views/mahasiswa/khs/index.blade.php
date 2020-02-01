@extends('layouts.mahasiswa')
@section('content')
<div class="col-lg-12">

  <div class="card ">
      <div class="card-body">
          <h5><i class="mdi mdi-library-books"></i> Kartu Hasil Studi</h5>
      </div>
  </div>

  <div class="card">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table-striped-info col-lg-4">
        <tbody>
                <tr><th> Nama </th><td> {{ ucwords(strtolower($mhs->nama)) }}  </td></tr>
                <tr><th> No BP </th><td> {{ $mhs->nim }} </td></tr>
                <tr><th> Program Studi</th><td> {{ ucwords(strtolower($mhs->jurusan)) }} </td></tr>
                </tbody>
        </table>
        </div><br>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs customtab2" role="tablist">
        @php $no = 1; @endphp
            @foreach($smr as $semester)
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#{{$semester->semesterid}}" role="tab"><span class="hidden-sm-up"><i></i>{{$no++}}</span> <span class="hidden-xs-down">{{$semester->semesternama}} {{$semester->semestertahun}}</span></a> </li>
            @endforeach
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
             @foreach($smr as $semester)
            <div class="tab-pane" id="{{$semester->semesterid}}" role="tabpanel">
                <br><br>
              <div class="table-responsive">
               <h5> Semester {{ $semester->semesternama }} {{ $semester->semestertahun }}/{{ $semester->semestertahun + 1 }} </h5>
                <table class="table-striped table color-bordered-table success-bordered-table">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th>KODE</th>
                            <th>MATA KULIAH</th>
                            <th>KELAS</th>
                            <th class="text-center">W/P</th>
                            <th class="text-center">SKS</th>
                            <th class="text-center">NILAI</th>
                        </tr>
                    </thead>
                    @php
                    $no = 1;
                    $totalsks=0;
                    @endphp
                    <tbody>
                    @foreach($krs as $key => $item)
                    @if($item->semesterkelas == $semester->semesterid && $item->kelas_batal == 0)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $item->matkulkode }}</td>
                        <td>{{ $item->matkulnama }}</td>
                        <td> {{ $item->namakelas }} </td>
                        <td class="text-center"> {{ $item->matkulsifat }} </td>
                        <td class="text-center">{{ $item->matkulsks }}</td>
                        <td class="text-center">{{ $item->nilaikode }}</td>
                    </tr>
                        @php
                          $totalsks += $item->matkulsks;                            
                        @endphp
                        @endif  
                    @endforeach
                    </tbody>
                    </table>
                </div>
            
                 <div class="row justify-content-between">
                <div class="col-8">
                    <div class="table-responsive">
                    <table class="table-striped-info col-lg-4">
                        <tr><th> Jumlah SKS diambil	 </th><td> {{$totalsks}}</td></tr>
                        <tr><th> Jumlah mata kuliah diambil	</th><td> {{$no - 1}} </td></tr>
                        <tr><th> IP Semester (IPS)	</th>
                        <td> 
                            @foreach($ip as $ipsemester)
                                @if($ipsemester->semester_id == $semester->semesterid)
                                {{ number_format((float)$ipsemester->ip_semester, 2, '.', '') }}
                                @endif
                            @endforeach
                        </td></tr>
                    </table>
                    </div>
                    </div>
                <div class="col-4">
                    <a href="{{ url('cetak-khs', $semester->semesterid)}}"  target="_blank" title="Krs">
                    <button type="submit" class="btn btn-rounded btn-success pull-right"><i class="mdi mdi-printer" aria-hidden="true"></i></button>
                    </a>
                    </div>
                </div>

            </div>
             @endforeach
        </div>
    </div>
</div>

<!-- 
  <div class="card col-lg-6 container">
      <div class="card-body">
          <h5>Pilih semester yang ingin anda lihat</h5>
          <div class="row">
              <div class="col-11">
              <form action="/khs" method="get" id="form">
                <div class="row justify-content-between">
                <div class="col-9">
                <select class="selectpicker m-b-20 m-r-10 form-action" data-style="btn-success" name="carisemester" id="carisemester">
                <option value="0" data-tokens="">Pilih semester</option>
                @foreach($smr as $item)
                  <option value="{{ $item->semesterid }}">Semester {{ $item->semesternama }} {{ $item->semestertahun }}</option>
                @endforeach
                </select>
                </div>
                 <div class="col-3 pull-left">
                     <button type="submit" class="btn btn-rounded btn-block btn-outline-success">
                        <i class="mdi mdi-file-find"></i> cari
                     </button>
                 </div>
                 </div>
                </form>
              </div>
             
          </div>
      </div>
  </div> -->

  <!-- @if($idsemester != null && $idsemester != 0)
  <div class="card">
   <div class="card-body">
    <div class="table-responsive">
    <table class="table-striped-info col-lg-4">
    <tbody>
            <tr><th> Nama </th><td> {{ ucwords(strtolower($mhs->nama)) }}  </td></tr>
            <tr><th> No BP </th><td> {{ $mhs->nim }} </td></tr>
            <tr><th> Program Studi</th><td> {{ ucwords(strtolower($mhs->jurusan)) }} </td></tr>
            <tr><th> Semester </th><td> @foreach($smr as $semesterkini)
                                        @if($semesterkini->semesterid == $idsemester )
                                            {{ $semesterkini->semesternama }} {{ $semesterkini->semestertahun }}/{{ $semesterkini->semestertahun + 1 }}
                                        @endif
                                        @endforeach
                            </td></tr>
            </tbody>
    </table>
    </div><br>
   <div class="table-responsive">
    <table class="table-striped table color-bordered-table success-bordered-table">
        <thead>
            <tr>
                <th class="text-center">NO</th>
                <th>KODE</th>
                <th>MATA KULIAH</th>
                <th>KELAS</th>
                <th class="text-center">W/P</th>
                <th class="text-center">SKS</th>
                <th class="text-center">NILAI</th>
            </tr>
        </thead>
        @php
         $no = 1;
         $totalsks=0;
         $totalbobot=0;
         $khssks = 0;
         $khsip = 0
        @endphp
        <tbody>
        @foreach($krs as $key => $item)
          @if($item->semesterkelas == $idsemester && $item->matkulkrsstatus == "1" && $item->kelas_batal == 0)
          <tr>
            <td class="text-center">{{ $no++ }}</td>
            <td>{{ $item->matkulkode }}</td>
            <td>{{ $item->matkulnama }}</td>
            <td> {{ $item->namakelas }} </td>
            <td class="text-center"> {{ $item->matkulsifat }} </td>
            <td class="text-center">{{ $item->matkulsks }}</td>
            <td class="text-center">{{ $item->nilaikode }}</td>
          </tr>
                @php
                if($item->nilaikode != ""){
                $totalsks += $item->matkulsks;
                $khssks += $item->matkulsks;
                $totalbobot += ($item->nilaibobot * $item->matkulsks);
                }
                @endphp
            @endif  
        @endforeach
        </tbody>
        </table>
    </div>
    <div class="row justify-content-between">
       <div class="col-8">
         <div class="table-responsive">
          <table class="table-striped-info col-lg-4">
            <tr><th> Jumlah SKS diambil	 </th><td> @php echo $khssks @endphp </td></tr>
            <tr><th> Jumlah mata kuliah diambil	</th><td> @php $jmlmatkul = $no - 1; echo $jmlmatkul @endphp </td></tr>
            <tr><th> IP Semester (IPS)	</th><td> @php echo number_format((float)$totalbobot/$totalsks, 2, '.', '') @endphp </td></tr>
          </table>
         </div>
        </div>
       <div class="col-4">
        <a href="{{ url('cetak-khs', $idsemester)}}"  target="_blank" title="Krs">
        <button type="submit" class="btn btn-rounded btn-success pull-right"><i class="mdi mdi-printer" aria-hidden="true"></i></button>
        </a>
        </div>
    </div>
    </div>
    </div>
    @endif -->

   <div class="card">
        <div class="card-body">
            <h4 class="card-title">Statistik Hasil Studi</h4>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs customtab2" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#ip" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Indeks Prestasi</span></a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#nilai" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Nilai</span></a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="ip" role="tabpanel">
                     <div style=" height: 400px; width: 100%;">
                        {!! $chart->container() !!}
                    </div>
                </div>
                <div class="tab-pane  p-20" id="nilai" role="tabpanel">
                  <div style=" height: 400px; width: 100%;">
                     {!! $nilai->container() !!}
                  </div>
                </div>
            </div>
        </div>
    </div>


</div>
{!! $nilai->script() !!}
{!! $chart->script() !!}
@endsection