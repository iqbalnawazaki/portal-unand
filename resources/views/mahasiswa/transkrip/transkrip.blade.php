@extends('layouts.mahasiswa')

@section('content')
<div class="col-lg-12">
  <div class="card ">
      <div class="card-body">
          <h5><i class="mdi mdi-file-document"></i> Transkrip Nilai</h5>
      </div>
  </div>
 
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
              <table class="color-table muted-table col-lg-3">
                <tbody>
                  <tr><th> Nama </th><td> {{ ucwords(strtolower($mhs->nama)) }} </td></tr>
                  <tr><th> No BP </th><td> {{ $mhs->nim }} </td></tr>
                  <tr><th> Program Studi</th><td> {{ ucwords(strtolower($mhs->jurusan)) }} </td></tr>
                </tbody>
              </table>
            </div><br>
            <div class="table-responsive">
                <table class=" table table-striped table color-bordered-table success-bordered-table full-color-table full-success-table hover-table">
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
            <a href="{{ url('cetak-transkrip') }}" target="_blank" class="btn btn-rounded btn-success pull-right" title="KRS">
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
    </div>

</div>
@endsection
