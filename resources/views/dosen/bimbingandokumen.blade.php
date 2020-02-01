@extends('layouts.dosen')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-body">
          <h5><i class="mdi mdi-account-multiple"></i> Bimbingan Akademik</h5>
        </div>
      </div>

      <div class="card">
        <div class="card-body p-b-0">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs customtab2" role="tablist">
            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#krs" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">KRS</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profil" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Profil</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#dokumen" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Dokumen</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#transkrip" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Transkrip</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#statistik" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Statistik Nilai</span></a> </li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
              <br>

             <!-- Tab krs -->
            <div class="tab-pane active" id="krs" role="tabpanel">

                <div class="table-responsive">
                  <table class="table-striped-info">
                    <tbody>
                      <tr><th> Nama </th><td>: {{ ucwords(strtolower($mhs->nama)) }} </td></tr>
                      <tr><th> No BP </th><td>: {{ $mhs->nim }} </td></tr>
                      <tr><th> Program Studi</th><td>: {{ ucwords(strtolower($mhs->jurusan)) }} </td></tr>
                      <tr><th> Semester </th><td>: {{ $max->semester_nama }} {{ $max->semester_tahun }} </td></tr>
                      <tr><th> Maksimum SKS </th><td>: {{ $sks->sksjatah }}  </td></tr>
                      </tbody>
                  </table>
                </div><br>
                <form action="{{url('http://localhost:8000/api/krs-status')}}" method="post" id="form">
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
                              <th class="text-center">AKSI</th>
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
                          <td>
                            <!-- <select class="selectpicker m-b-5 m-r-5 form-action" data-style="btn-success" name="status_krs[{{ $krskini->krsdetil_id }}]"  id="status_krs"> -->
                              @foreach($status_krs as $status)
                                   <!-- <option class="text-center" value="{{$status}}" @if($status == $krskini->matkulkrsstatus) selected @endif >@if($status == "0") Belum/Tidak Disetujui @elseif($status == "1" ) Disetujui @endif</option> -->
                                  <input type="radio" class="check" id="status_krs" value="{{$status}}" name="status_krs[{{ $krskini->krsdetil_id }}]" data-radio="iradio_flat-green" @if($status == $krskini->matkulkrsstatus) checked @endif>
                                  <label for="flat-radio-1">@if($status == "0") Belum/Tidak Disetujui @elseif($status == "1" ) Disetujui @endif</label>
                                  <br>
                              @endforeach
                            <!-- </select> -->
                                
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
                            <th>
                               
                            </th>
                        </tr>
                      </tfoot>
                  </table>
              </div>
                      <button type="submit" class="btn btn-rounded btn-success pull-right">
                        <i class="fa fa-edit "></i> Ubah
                      </button> </form>
                        <br><br>
                        <div><hr></div>

                        <h5><i class="mdi mdi-book-multiple"></i>Riwayat Kartu Rencana Studi</h5><br>

                         

                    
                          @foreach($smr as $semester)
                          <div class="tab-pane" id="{{$semester->semesterid}}" role="tabpanel">
                             <div class="table-responsive">
                                <table class="table-striped table color-bordered-table success-bordered-table">
                                    <thead>
                                        <tr>
                                          <th colspan="6">Semester {{$semester->semesternama}} {{$semester->semestertahun}}/{{$semester->semestertahun + 1}}</th>                                          
                                        </tr>
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
                                          <th colspan="5">INDEKS PRESTASI</th>
                                          <th  class="text-center">
                                               @foreach($ip as $ips)
                                                  @if($ips->semester_id == $semester->semesterid)
                                                  {{ number_format((float)$ips->ip_semester, 2, '.', '') }}
                                                  @endif
                                              @endforeach
                                          </t>
                                      </tr>
                                    </tfoot>
                                </table>
                          </div>
                          </div>
                          @endforeach
                  

            </div>
            
            <!-- Tab profil -->
            <div class="tab-pane" id="profil" role="tabpanel">
            <div class="row">
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <center class="m-t-30">
                  <div class="el-card-item">
                    <div class="el-card-avatar el-overlay-1"> <img src="{{ asset('storage/avatars/'.$poto) }}" alt="user" style="width:150px; height:200px;" />
                    </div>
                    <div class="el-card-content">
                      <small></small>
                      <br/> </div>
                    </div>
                  </center>
                  <div><hr></div>
                  <center class="m-t-30">
                    <small class="text-muted">Nama </small><h6> {{ ucwords(strtolower($mhs->nama)) }} </h6>
                    <small class="text-muted">NIM </small><h6> {{ $mhs->nim }}</h6>
                    <small class="text-muted">Angkatan </small><h6> {{ $mhs->angkatan }}</h6>
                    <small class="text-muted">Status</small><h6> {{ $mhs->status }}</h6>
                  </center>
                  </div>
                  <div class="table-responsive col-lg-8 col-xlg-9 col-md-7">
                    <table class="table color-bordered-table muted-bordered-table">
                      <tbody>
                        <tr><th> No BP </th><td> {{ $mhs->nim }} </td></tr>
                        <tr><th> Alamat </th><td> {{ $mhs->alamat }} </td></tr>
                        <tr><th> Tempat Tanggal Lahir</th><td> {{ $mhs->kotalahir }}, {{ date('d F Y', strtotime($mhs->tglahir)) }} </td></tr>
                        <tr><th> Agama </th><td> {{ $mhs->agama }} </td></tr>
                        <tr><th> Jenis Kelamin</th><td> 
                                 @if($mhs->jenis_kelamin == "L")
                                    Laki-Laki
                                 @else
                                    Perempuan
                                 @endif
                        </td></tr>
                        <tr><th> Asal SLTA</th><td> {{ $mhs->asalsma }} </td></tr>
                        <tr><th> Tanggal Terdaftar</th><td> {{ $mhs->tglterdaftar }} </td></tr>
                        <tr><th> Nama Orangtua </th><td> {{ $mhs->namaayah }} </td></tr>
                        <tr><th> Alamat Orangtua</th><td> {{ $mhs->alamatortu }} </td></tr>
                        <tr><th> Warga Negara</th><td> {{ $mhs->negara }} </td></tr>
                        <tr><th> Status</th><td> {{ $mhs->status }} </td></tr>
                        <tr><th> Level/Jalur Masuk</th><td> {{ $mhs->jalurmasuk }} </td></tr>
                        <tr><th> Besar Uang Kuliah</th><td> - </td></tr>
                      </tbody>
                    </table>
                  </div>
                  </div>
                  </div>

            <!-- Tab dokumen -->
            <div class="tab-pane" id="dokumen" role="tabpanel">
              
              <div class="table-responsive">
                <table class="table-striped-info">
                  <tbody>
                    <tr><th> Nama </th><td>: {{ ucwords(strtolower($mhs->nama)) }} </td></tr>
                    <tr><th> No BP </th><td>: {{ $mhs->nim }} </td></tr>
                    <tr><th> Program Studi</th><td>: {{ ucwords(strtolower($mhs->jurusan)) }} </td></tr>
                  </tbody>
                </table>
              </div>
              <br>
              <h5>Bimbingan Akademik Melalui Chatting</h5>
              <div class="row">
              <div class="col-6">
              <form action="{{ url('bimbingan-chat/'.$mhs->nim)}}" target="_blank" method="get" id="form">
                <div class="row justify-content-between">
                <div class="col-9">
                <select class="selectpicker m-b-20 m-r-10 form-action" data-style="btn-success" name="carisemester" id="carisemester">
                <option data-tokens="">Pilih semester</option>
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

              <div>
                @yield('cetak-chat')
              </div>

              <div><hr></div>
              <br>

            </div>

            <!-- Tab transkrip -->
            <div class="tab-pane" id="transkrip" role="tabpanel">
                      <div class="table-responsive">
              <table class="color-table muted-table">
                <tbody>
                  <tr><th> Nama </th><td>: {{ ucwords(strtolower($mhs->nama)) }} </td></tr>
                  <tr><th> No BP </th><td>: {{ $mhs->nim }} </td></tr>
                  <tr><th> Program Studi</th><td>: {{ ucwords(strtolower($mhs->jurusan)) }} </td></tr>
                </tbody>
              </table>
            </div><br>
            <div class="table-responsive">
                <table class="table-striped table color-bordered-table success-bordered-table">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>SEMESTER</th>
                            <th>KODE</th>
                            <th>MATA KULIAH</th>
                            <th>SKS</th>
                            <th>NILAI</th>
                        </tr>
                    </thead>
                    @php
                        $no=1;
                    @endphp
                    <tbody>
                    @foreach($krs as $item)
                      @if($item->nilaikode != "" && $item->nilaikode != "BL")
                        <tr>
                            <td> {{ $no++ }} </td>
                            <td> Semester {{ $item->semesternama }} {{ $item->semestertahun }} </td>
                            <td>{{ $item->matkulkode }}</td>
                            <td>{{ $item->matkulnama }}</td>
                            <td>{{ $item->matkulsks }} </td>
                            <td>{{ $item->nilaikode }}</td>
                        </tr>
                      @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ url('/print-transkrip', $mhs->nim)}}" target="_blank" class="btn btn-rounded btn-success pull-right" title="KRS">
              <i class="mdi mdi-printer" aria-hidden="true"></i>  </a>
              <div class="table-responsive">
                <table class="color-table muted-table col-lg-3">
                  <tbody>
                    <tr><th><b> Prestasi Akademik :</b></th><td>  </td></tr>
                    <tr><th> Jumlah SKS diambil </th><td> {{ $mhs->skstotal }} </td></tr>
                    <tr><th> Jumlah mata kuliah diambil </th><td> @php echo $no=$no-1 @endphp </td></tr>
                    <tr><th> IP Kumulatif</th><td> {{ number_format((float)$mhs->ipktranskrip, 2, '.', '') }} </td></tr>
                  </tbody>
                </table>
              </div><br>
              <div class="table-responsive">
                <table class="color-table muted-table col-lg-4">
                  <tbody>
                    <tr><th><b> Keterangan </b></th><td><b> : </b></td></tr>
                    <tr><th> A  </th><td> 4.00 </td><td> Sangat Cemerlang </td></tr>
                    <tr><th> A-  </th><td> 3.50 </td><td> Cemerlang </td></tr>
                    <tr><th> B+ </th><td> 3.25 </td><td> Sangat Baik </td></tr>
                    <tr><th> B </th><td> 3.00 </td><td> Baik </td></tr>
                    <tr><th> B- </th><td> 2.75 </td><td> Hampir Baik </td></tr>
                    <tr><th> C+ </th><td> 2.25 </td><td> Lebih Dari Cukup </td></tr>
                    <tr><th> C </th><td> 2.00 </td><td> Cukup </td></tr>
                    <tr><th> D </th><td> 1.00 </td><td> Hampir Cukup </td></tr>
                    <tr><th> BL </th><td> 0 </td><td> Belum Lulus </td></tr>
                    <tr><th> E </th><td> 0 </td><td> Gagal  </td></tr>
                  </tbody>
                </table>
              </div>
            </div>

             <div class="tab-pane" id="statistik" role="tabpanel">
                <div class="table-responsive">
              <table class="color-table muted-table">
                <tbody>
                  <tr><th> Nama </th><td>: {{ ucwords(strtolower($mhs->nama)) }} </td></tr>
                  <tr><th> No BP </th><td>: {{ $mhs->nim }} </td></tr>
                  <tr><th> Program Studi</th><td>: {{ ucwords(strtolower($mhs->jurusan)) }} </td></tr>
                  <tr><th> IPK</th><td>: {{ number_format((float)$mhs->ipktranskrip, 2, '.', '') }} </td></tr>
                </tbody>
              </table>
            </div><br>
              <div class="card-body">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs customtab2" role="tablist">
                      <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#ip" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Indeks Prestasi</span></a> </li>
                      <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#nilai" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Nilai</span></a> </li>
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                      <div class="tab-pane active" id="ip" role="tabpanel">
                          <div style=" height: 400px; width: 100%;">
                              {!! $ipsemester->container() !!}
                          </div>
                      </div>
                      <div class="tab-pane  p-20" id="nilai" role="tabpanel">
                        <div style=" height: 400px; width: 100%;">
                          {!! $chart->container() !!}
                        </div>
                      </div>
                  </div>
              </div>
          </div>

          </div>

         

          <!-- Tab content end -->

        </div>
      </div>

    </div>
  </div>
</div>
{!! $chart->script() !!}
{!! $ipsemester->script() !!}
@endsection
