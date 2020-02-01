@role('mahasiswa')
@extends('layouts.mahasiswa')

@section('content')

<div class="col-lg-12">
  <div class="card ">
      <div class="card-body">
          <h5><i class="mdi mdi-book-multiple"></i> Kartu Rencana Studi</h5>
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
            <tr><th> Semester </th><td> {{ $max->semester_nama }} {{ $max->semester_tahun }} </td></tr>
            <tr><th> Maksimum SKS </th><td> {{ $sks->sksjatah }}  </td></tr>
            </tbody>
        </table>
      </div>
      <a href="{{ url('proses-krs') }} " class="btn btn-rounded btn-success pull-right" title="Tambah KRS">
        <i class="fa fa-plus" aria-hidden="true"></i></a> <br><br>

      <div class="table-responsive">
          <table class="table-striped table color-bordered-table success-bordered-table">
              <thead>
                  <tr>
                      <th class="text-center">NO</th>
                      <th>KODE</th>
                      <th>MATA KULIAH</th>
                      <th class="text-center">SKS</th>
                      <th>NAMA DOSEN</th>
                      <th class="text-center">STATUS</th>
                  </tr>
              </thead>
              @php
               $no = 1;
               $totalskskrs = 0
              @endphp
              <tbody>
              @foreach($krs as $krskini)

              @if($krskini->semesterkelas == $max->semester_id && $krskini->matkulkrsstatus != "" && $krskini->kelas_batal == 0)
                <tr>
                  <td class="text-center">{{ $no++ }}</td>
                  <td>{{ $krskini->matkulkode }}</td>
                  <td>{{ $krskini->matkulnama }}</td>
                  <td class="text-center">{{ $krskini->matkulsks }}</td>
                  <td>
                  @foreach($krskini->dosenKel as $krsnow)
                    {{ $krsnow->gelardepan }} {{ $krsnow->dosennama }} {{ $krsnow->gelarbelakang }}
                  @endforeach
                  </td>
                  <td class="text-center">
                      @if($krskini->matkulkrsstatus == "1")
                      <span style ="font-size:12px; padding:5px;" class="badge badge-success">Disetujui</span>
                      @elseif($krskini->matkulkrsstatus == "0")
                      <span style ="font-size:12px; padding:5px;" class="badge badge-danger">Belum/Tidak Disetujui</span>
                      @endif
                  </td>
                </tr>
               @php
               $totalskskrs += $krskini->matkulsks
               @endphp          
               
               @endif
              @endforeach
              </tbody>
              <tfoot style="background:#006400; color:white;" >
                <tr>

                    <th colspan="2">JUMLAH</th>
                    <th></th>
                    <th class="text-center"> 
                    @php
                    echo $totalskskrs
                    @endphp
                    </th>
                    <th></th>
                    <th></th>
                </tr>
              </tfoot>
          </table>
      </div>

      @if($cetakKrs == false)
      <a href="{{ url('cetak-krs')}}" target="_blank" class="btn btn-rounded btn-success disabled" title="KRS">
        <i class="mdi mdi-printer" aria-hidden="true"></i> KRS</a>
      @elseif($cetakKrs == true)
      <a href="{{ url('cetak-krs')}}" target="_blank" class="btn btn-rounded btn-success" title="KRS">
        <i class="mdi mdi-printer" aria-hidden="true"></i> KRS</a>
      @endif

      @if($cetakUts == false)
      <a href="{{ url('cetak-uts')}}" target="_blank" class="btn btn-rounded btn-success disabled" title="Kartu-UTS">
        <i class="mdi mdi-printer" aria-hidden="true"></i> Kartu UTS</a>
      @elseif($cetakUts == true)
      <a href="{{ url('cetak-uts')}}" target="_blank" class="btn btn-rounded btn-success" title="Kartu-UTS">
        <i class="mdi mdi-printer" aria-hidden="true"></i> Kartu UTS</a>
      @endif

      @if($cetakUas == false)
      <a href="{{ url('cetak-uas')}}" target="_blank" class="btn btn-rounded btn-success disabled" title="Kartu-UAS">
        <i class="mdi mdi-printer" aria-hidden="true"></i> Kartu UAS</a>
      @elseif($cetakUas == true)
      <a href="{{ url('cetak-uas')}}" target="_blank" class="btn btn-rounded btn-success" title="Kartu-UAS">
        <i class="mdi mdi-printer" aria-hidden="true"></i> Kartu UAS</a>
      @endif
        </div>
    </div>

    <div class="card">
    <div class="card-body">
    <h5><i class="mdi mdi-book-multiple"></i> Riwayat Kartu Rencana Studi</h5>
    </div>
    </div>
      <!-- Nav tabs -->     
       
             @foreach($smr as $semester)
          <div class="card">
            <div class="card-body">
            <h5><i class="mdi mdi-timetable"></i> Semester {{$semester->semesternama}} {{$semester->semestertahun}}</h5>
                <div>
                    <hr>
                </div>
                  
              <div class="table-responsive">
                <table class="table-striped table color-bordered-table success-bordered-table">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th>KODE</th>
                            <th>MATA KULIAH</th>
                            <th class="text-center">SKS</th>
                            <th class="text-center">NILAI</th>
                            <th class="text-center">KETERANGAN</th>
                        </tr>
                    </thead>
                    @php
                     $no = 1;
                     $totalsksriwayat = 0
                    @endphp
                    <tbody>
                    @foreach($krs as $item)
                      @if($item->semesterkelas == $semester->semesterid && $item->matkulkrsstatus != "" && $item->kelas_batal == 0)
                        @if($item->nilaikode== "E")
                        <tr style="background:red; color:black; font-weight:bold;">
                          <td class="text-center">{{ $no++ }}</td>
                          <td>{{ $item->matkulkode }}</td>
                          <td>{{ $item->matkulnama }}</td>
                          <td class="text-center">{{ $item->matkulsks }}</td>
                          <td class="text-center">{{ $item->nilaikode }}</td>
                          <td class="text-center">
                          <b>Gagal</b>
                          </td>
                        </tr>
                        @elseif($item->nilaikode== "D")
                        <tr style="background:yellow; color:black; font-weight:bold;">
                          <td class="text-center">{{ $no++ }}</td>
                          <td>{{ $item->matkulkode }}</td>
                          <td>{{ $item->matkulnama }}</td>
                          <td class="text-center">{{ $item->matkulsks }}</td>
                          <td class="text-center">{{ $item->nilaikode }}</td>
                          <td class="text-center">
                          <b>Hampir Cukup</b>
                          </td>
                        </tr>
                      @else
                      <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $item->matkulkode }}</td>
                        <td>{{ $item->matkulnama }}</td>
                        <td class="text-center">{{ $item->matkulsks }}</td>
                        <td class="text-center">{{ $item->nilaikode }}</td>
                        <td class="text-center">
                      
                            @if($item->nilaikode == "A")
                              Sangat Cemerlang
                            @elseif($item->nilaikode == "A-")
                              Cemerlang
                            @elseif($item->nilaikode == "B+")
                              Sangat Baik
                            @elseif($item->nilaikode == "B")
                              Baik
                            @elseif($item->nilaikode == "B-")
                              Hampir Baik
                            @elseif($item->nilaikode == "C+")
                              Lebih Dari Cukup
                            @elseif($item->nilaikode == "C")
                              Cukup
                            @elseif($item->nilaikode == "BL")
                              <b class="text-danger">Belum Lulus</b>
                            @else
                              -
                            @endif
                        </td>
                      </tr>
                          @endif
                              @php
                                  $totalsksriwayat += $item->matkulsks
                              @endphp 
                       @endif
                    @endforeach
                    </tbody>
                    <tfoot style="background:#006400; color:white;" >
                      <tr>
                          <th colspan="2">JUMLAH</th>
                          <th></th>
                          <th></th>
                          <th class="text-center">@php echo $totalsksriwayat @endphp </th>
                          <th></th>
                      </tr>
                    </tfoot>
                </table>
                 </div>
                </div>
           </div>
            @endforeach
       

    

    
</div>

@endsection

@else
    I am not a mahasiswa...
@endrole
