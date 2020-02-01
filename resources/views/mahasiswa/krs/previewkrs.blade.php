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
        <h4 class="text-center</h4>
            
                <br>
            <div class="table-responsive">
                <table class="table-striped table color-bordered-table success-bordered-table">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">Kelas ID</th>
                            <th class="text-center"> Matkul ID </th>
                            <th class="text-center"> Matkul SKS </th>
                            
                        </tr>
                    </thead>
                    @php
                        $no=1;
                    @endphp
                    <tbody>
                    @foreach($data as $key => $value)

                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            
                            <td class="text-center">{{ $value[0]->kelasid }}</td>
                            <td class="text-center">{{ $value[0]->matkul_id }}</td>
                            <td class="text-center">{{ $value[0]->matkul_sks }}</td>
                        </tr>
                   
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
