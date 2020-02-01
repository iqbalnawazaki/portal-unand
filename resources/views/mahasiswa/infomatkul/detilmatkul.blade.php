@extends('layouts.mahasiswa')
@section('content')
<div class="col-lg-12">

  <div class="card ">
      <div class="card-body">
          <h5><i class="mdi mdi-library-books"></i> Detil Kelas</h5>
      </div>
  </div>

  <div class="card">
      <div class="card-body">
          <div class="table-responsive">
                <table class="table full-color-table full-success-table hover-table">
                    <thead>
                        <tr>
                            <th>JADWAL KULIAH</th>
                            <th class="text-center"></th>
                            <th class="text-center">Hari</th>
                            <th class="text-center">Jam</th>
                            <th class="text-center">RUANGAN</th>
                           
                        </tr>
                    </thead>
                    
                    <tbody>
                   
                        <tr>
                            <td>  {{ $matkul->kelas_nama }}</td>
                            <td></td>
                            <td class="text-center"> @foreach($matkul->jadwalKul as $jadwal)
                                    {{ $jadwal->jadwalhari }}
                                 @endforeach
                            </td>
                            <td class="text-center"> @foreach($matkul->jadwalKul as $jadwal)
                                    {{ $jadwal->jadwaljammulai }} - {{ $jadwal->jadwaljamselesai }}
                                 @endforeach
                            </td>
                            <td class="text-center"> @foreach($matkul->jadwalKul as $jadwal)
                                    {{ $jadwal->ruangnama }}
                                 @endforeach
                            </td>
                        </tr>
                   
                    </tbody>
                </table>
            </div>
      </div>
  </div>

   <div class="card">
      <div class="card-body">
          <div class="table-responsive">
                <table class="table full-color-table full-success-table hover-table">
                    <thead>
                        <tr>
                            <th>JADWAL UJIAN</th>
                            <th class="text-center"> </th>
                            <th class="text-center">Hari</th>
                            <th class="text-center">Jam</th>
                            <th class="text-center">RUANGAN</th>
                           
                        </tr>
                    </thead>
                    
                    <tbody>
                   
                        <tr>
                            <td> @foreach($matkul->jadwalUji as $jadwal)
                                    @if($jadwal->ujianjenis == "T")
                                        UJIAN TENGAH SEMESTER
                                    @elseif($jadwal->ujianjenis == "A")
                                        UJIAN AKHIR SEMESTER
                                    @endif <br>
                                 @endforeach
                            </td>
                            <td></td>
                           <td class="text-center"> @foreach($matkul->jadwalUji as $jadwal)
                                    {{ $jadwal->ujiantanggal }} <br>
                                 @endforeach
                            </td>
                            <td class="text-center"> @foreach($matkul->jadwalUji as $jadwal)
                                    {{ $jadwal->ujianjammulai }} - {{ $jadwal->ujianjamselesai }} <br>
                                 @endforeach
                            </td>
                            <td class="text-center">
                            </td>
                        </tr>
                   
                    </tbody>
                </table>
            </div>
      </div>
  </div>

<div class="card">
<div class="card-body">
<div class="table-responsive">
    <table class="table full-color-table full-success-table hover-table">
    <thead>
        <tr>
            <th>Detil Kelas Berdasar Program Studi</th> 
            <th></th>                          
        </tr>
    </thead>
    <tbody>
        <tr><th> Program Studi </th><td>{{ $matkul->matkul_prodi }} </td></tr>
        <tr><th> Nama Matakuliah </th><td>{{ $matkul->matkul_nama }} </td></tr>
        <tr><th> Kode Matakuliah </th><td>{{ $matkul->matkul_kode }} </td></tr>
        <tr><th> Semester</th><td> {{ $matkul->matkul_semesterke }} </td></tr>
        <tr><th> Bobot SKS</th><td> {{ $matkul->matkul_sks }} </td></tr>
        <tr><th> Nilai Minimal Kelulusan</th><td>  </td></tr>
        <tr><th> Prasyarat</th><td>  </td></tr>
        <tr><th> Sifat Matakuliah</th><td> @if($matkul->matkul_sifat == "W")
                                            Wajib
                                            @elseif($matkul->matkul_sifat == "P")
                                            Pilihan
                                            @endif
                                    </td></tr>
        <tr><th> Keterangan</th><td>  </td></tr>
    </tbody>
    </table>
</div>
</div>
</div>
@endsection