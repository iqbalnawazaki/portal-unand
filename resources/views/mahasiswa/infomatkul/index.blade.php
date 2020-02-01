@extends('layouts.mahasiswa')

@section('content')
<div class="col-lg-12">
  <div class="card ">
      <div class="card-body">
          <h5><i class="mdi mdi-file-document"></i> Informasi Matakuliah</h5>
      </div>
  </div>
    <div class="card">
        <div class="card-body">
        <h4>Daftar Matakuliah Ditawarkan</h4>
            <div class="table-responsive">
              <table class="color-table muted-table">
                <tbody>
                  <tr><th> Semester </th><td> {{ $max->semester_nama }} {{ $max->semester_tahun }}/{{ $max->semester_tahun + 1 }} </td></tr>
                </tbody>
              </table>
            </div><br>
            <div class="table-responsive">
                <table class="table-striped table color-bordered-table success-bordered-table full-color-table full-success-table hover-table">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">KODE</th>
                            <th>MATAKULIAH</th>
                            <th>NAMA DOSEN</th>
                            <th class="text-center">KELAS</th>
                            <th class="text-center">W/P</th>
                            <th class="text-center">SKS</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    @php
                        $no=1;
                    @endphp
                    <tbody>
                    @foreach($matkul as $item)
                        @if($item->jurusan_kode == $mhs->jurusan_kode)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $item->matkul_kode }}</td>
                            <td>{{ $item->matkul_nama }}</td>
                            <td> @foreach($item->dosenKel as $namadosen)
                                    {{ $namadosen->gelardepan }} {{ $namadosen->dosennama }}, {{ $namadosen->gelarbelakang }} <br>
                                 @endforeach
                            </td>
                            <td>{{ $item->kelas_nama }} </td>
                            <td class="text-center">{{ $item->matkul_sifat }}</td>
                            <td class="text-center">{{ $item->matkul_sks }}</td>
                            <td class="text-center"> <a href="{{ url('detilmatkul', $item->kelas_id )}}" title="Lihat matakuliah"><button class="btn btn-rounded btn-success"><i class="mdi mdi-file-find" aria-hidden="true"></i></button></a></td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            
             
        </div>
    </div>

</div>
@endsection
