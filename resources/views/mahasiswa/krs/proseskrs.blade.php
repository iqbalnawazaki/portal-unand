@extends('layouts.mahasiswa')

@section('content')
<div class="col-lg-12">
  <div class="card ">
      <div class="card-body">
          <h5><i class="mdi mdi-file-document"></i> Tambah Kartu Rencana Studi</h5>
      </div>
  </div>
    <div class="card">
        <div class="card-body">
        <h4 class="text-center">Daftar Matakuliah Ditawarkan</h4>
            
        <h5 class="text-center">Semester {{ $max->semester_nama }} {{ $max->semester_tahun }}/{{ $max->semester_tahun + 1 }} </h5>
                <br>
            <div class="table-responsive">
                <table class="table-striped table color-bordered-table success-bordered-table">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th >AKSI</th>
                            <th class="text-center">KELAS</th>
                            <th>NAMA DOSEN</th>
                            <th class="text-center">KODE</th>
                            <th>MATAKULIAH</th>
                            <th class="text-center">SKS</th>
                            <th class="text-center">W/P</th>
                            <th class="text-center">KE</th>
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
                            <td class="text-center"> 
                            <form action="{{url('http://localhost:8000/api/krs-input/'.$krsAktif)}}" method="post" id="form">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="kelasid" name="kelas_id[]" value="{{ $item->kelas_id }}"
                                    @foreach($krsCe as $krsCekarang)
                                        @if($krsCekarang->kelas_id == $item->kelas_id)
                                            checked
                                        @endif
                                    @endforeach                                    
                                     >
                                    <span class="custom-control-indicator"></span>
                                </label>
                            </td>
                            <td>{{ $item->kelas_nama }} </td>
                             <td> @foreach($item->dosenKel as $namadosen)
                                    {{ $namadosen->gelardepan }} {{ $namadosen->dosennama }}, {{ $namadosen->gelarbelakang }} <br>
                                 @endforeach
                            </td>
                            <td>{{ $item->matkul_kode }}</td>
                            <td>{{ $item->matkul_nama }}</td>
                            <td class="text-center">{{ $item->matkul_sks }}</td>
                            <td class="text-center">{{ $item->matkul_sifat }}</td>
                            <td class="text-center">{{ $item->matkul_semesterke }}</td>
                        </tr>
                       @endif
                    @endforeach
                    </tbody>
                </table>
                                    <button type="submit" class="btn btn-rounded btn-success">
                                        <i class="mdi mdi-content-save-all"></i> Simpan
                                    </button>
                            </form>
             
            </div>
            
             
        </div>
    </div>

</div>
@endsection
