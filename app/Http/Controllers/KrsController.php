<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Message;
use App\View;
use App\Charts\Charts;
use App\Charts\Fusioncharts;
use Carbon\Carbon;

class KrsController extends Controller
{

  public function krs(){

    $user = Auth::user();
      $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
      $context = stream_context_create($opts);
      
      $strKrs = file_get_contents('http://localhost:8000/api/krs/'.$user->id, false, $context);
      $krs = json_decode($strKrs);

      $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$user->id, false, $context);
      $mhs = json_decode($strMhs);

      $link = file_get_contents('http://localhost:8000/api/semester_aktif', false, $context);
      $max = json_decode($link);

      $strSks = file_get_contents('http://localhost:8000/api/sks/'.$user->id, false, $context);
      $sks = json_decode($strSks);

      $strsmr = file_get_contents('http://localhost:8000/api/semester/'.$user->id, false, $context);
      $smr = json_decode($strsmr);
      
      $chatKrs = [];
      $chatUts = [];
      $chatUas = [];
     
      $chat  = Message::where('user_id', $mhs->nip_dosenPA)
                      ->where('penerima_id',$user->id)
                      ->where('semester_id', $max->semester_id)
                      ->get();
      foreach ($chat as $key => $value) {
        if ($value->topik_id == 1) {
            $chatKrs[] = $value;
        }
        elseif ($value->topik_id == 2) {
            $chatUts[] = $value;
        }
        elseif ($value->topik_id == 3) {
            $chatUas[] = $value;
        }
      }
          
      //Cetak KRS
      $cetakKrs = false;
      $kunciKrs  = 'cetak krs';
      $arrayKrs = array();
      foreach($chatKrs as $k=>$v) {
          if(preg_match("/\b$kunciKrs\b/i", $v)) {
              $arrayKrs[$k] = $v;
              $cetakKrs = true;
          }
      }
      //Cetak Kartu UTS
      $cetakUts = false;
      $kunciUts  = 'cetak kartu uts';
      $arrayUts = array();
      foreach($chatUts as $k=>$v) {
          if(preg_match("/\b$kunciUts\b/i", $v)) {
              $arrayUts[$k] = $v;
              $cetakUts = true;
          }
      }
      //Cetak Kartu UAS
      $cetakUas = false;
      $kunciUas  = 'cetak kartu uas';
      $arrayUas = array();
      foreach($chatUas as $k=>$v) {
          if(preg_match("/\b$kunciUas\b/i", $v)) {
              $matches[$k] = $v;
              $arrayUas = true;
          }
      }

      
   
    return view('mahasiswa.krs.index', compact('krs', 'max','sks','mhs','smr','cetakKrs','cetakUts','cetakUas'));
  }


  public function cetakkrs()
  {
      $user = Auth::user();
      $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
      $context = stream_context_create($opts);

      $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$user->id, false, $context);
      $mhs = json_decode($strMhs);
      $user->detail = $mhs;

      $newKrs = file_get_contents('http://localhost:8000/api/krs/'.$user->id, false, $context);
      $krs = json_decode($newKrs);

      $link = file_get_contents('http://localhost:8000/api/semester_aktif', false, $context);
      $max = json_decode($link);

      $strSks = file_get_contents('http://localhost:8000/api/sks/'.$user->id, false, $context);
      $sks = json_decode($strSks);

      $signature = User::where('id',$mhs->nip_dosenPA)->select('signature')->first();

      // $user->jdwdetail=$jdwKrs;
      // dd($max);
     // return response()->json($mhs);
     return view('mahasiswa.krs.cetakkrs', compact('krs', 'max','mhs','sks','signature'));
  }
  public function cetakuts(){

    $user = Auth::user();
      $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
      $context = stream_context_create($opts);

      $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$user->id, false, $context);
      $mhs = json_decode($strMhs);
      $user->detail = $mhs;

      $newKrs = file_get_contents('http://localhost:8000/api/krs/'.$user->id, false, $context);
      $krs = json_decode($newKrs);

      $link = file_get_contents('http://localhost:8000/api/semester_aktif', false, $context);
      $max = json_decode($link);

      $strSks = file_get_contents('http://localhost:8000/api/sks/'.$user->id, false, $context);
      $sks = json_decode($strSks);

      $strUji = file_get_contents('http://localhost:8000/api/jadwalujian/'.$user->id, false, $context);
      $ujian = json_decode($strUji);

      $signature = User::where('id',$mhs->nip_dosenPA)->select('signature')->first();

    return view('mahasiswa.krs.cetakuts', compact('krs', 'max','mhs','sks','ujian','signature'));
  }
  public function cetakuas(){
      $user = Auth::user();
      $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
      $context = stream_context_create($opts);

      $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$user->id, false, $context);
      $mhs = json_decode($strMhs);
      $user->detail = $mhs;

      $newKrs = file_get_contents('http://localhost:8000/api/krs/'.$user->id, false, $context);
      $krs = json_decode($newKrs);

      $link = file_get_contents('http://localhost:8000/api/semester_aktif', false, $context);
      $max = json_decode($link);

      $strSks = file_get_contents('http://localhost:8000/api/sks/'.$user->id, false, $context);
      $sks = json_decode($strSks);

      $strUji = file_get_contents('http://localhost:8000/api/jadwalujian/'.$user->id, false, $context);
      $ujian = json_decode($strUji);

      $signature = User::where('id',$mhs->nip_dosenPA)->select('signature')->first();

    return view('mahasiswa.krs.cetakuas', compact('krs', 'max','mhs','sks','ujian','signature'));
  }



  public function khs(Request $request){
    
    $user = Auth::user();
    $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
    $context = stream_context_create($opts);
    $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$user->id, false, $context);
    $mhs = json_decode($strMhs);

    $strKrs = file_get_contents('http://localhost:8000/api/krs/'.$user->id, false, $context);
    $krs = json_decode($strKrs);

    $strsmr = file_get_contents('http://localhost:8000/api/semester/'.$user->id, false, $context);
    $smr = json_decode($strsmr);

    $strIp = file_get_contents('http://localhost:8000/api/ip-semester/'.$user->id, false, $context);
    $ip = json_decode($strIp);

    foreach ($ip as $key => $value) {
         $ips[] = number_format((float)$value->ip_semester, 2, '.', '');
         $nama_semester[] =$value->semester_nama;
       }

    $user->detail = $krs;

      $nilaiA=0;
      $nilaiAmin=0;
      $nilaiBplus=0;
      $nilaiB=0;
      $nilaiBmin=0;
      $nilaiCplus=0;
      $nilaiC=0;
      $nilaiD=0;
      $nilaiE=0;
      $nilaiBL=0;
     
      foreach ($krs as $key => $item) {
      if($item->matkulkrsstatus != "" && $item->matkulkrsstatus != "0" && $item->kelas_batal == 0){
         if($item->nilaikode == "A"){
          $nilaiA++;}
          else if($item->nilaikode == "A-"){
           $nilaiAmin++;}
          elseif($item->nilaikode == "B+"){
          $nilaiBplus++; }
          elseif($item->nilaikode == "B"){
           $nilaiB++; }
          elseif($item->nilaikode == "B-"){
           $nilaiBmin++;}
          elseif($item->nilaikode == "C+"){
           $nilaiCplus++; }
          elseif($item->nilaikode == "C"){
           $nilaiC++;  }
          elseif($item->nilaikode == "D"){
            $nilaiD++;  }
          elseif($item->nilaikode == "E"){
            $nilaiE++;  }
          elseif($item->nilaikode == "BL"){
            $nilaiBL++; }
         }
      }
    
      $nilai = new Fusioncharts;
      $nilai->labels(['Nilai A', 'Nilai A-', 'Nilai B+', 'Nilai B', 'Nilai B-', 'Nilai C+', 'Nilai C', 'Nilai D', 'Nilai E', 'Nilai BL']);
      $nilai->dataset('Grafik Nilai Riwayat Kartu Rencana Studi', 'pie2d', [$nilaiA,  $nilaiAmin, $nilaiBplus,  $nilaiB, $nilaiBmin, $nilaiCplus, $nilaiC, $nilaiD, $nilaiE, $nilaiBL])
      ->options([
        'color' => ['#1d97c1', '#26baee', '#00ad7c', '#52d681', '#b5ff7d', '#ff9234', '#ffcd3c', '#f9ff21', '#ff0000', '#9a9b94']
      ]);
      // dd($ip);
    
      $chart = new Fusioncharts;
      $chart->labels($nama_semester);
      $chart->dataset('Indeks Prestasi Semester', 'line', $ips)
      ->options([
        'color' => '#0b8457'
      ]);        

    $idsemester = $request->input('carisemester');
    
    return view('mahasiswa.khs.index', compact('krs','smr','chart','nilai','idsemester','ip','mhs'));
  }
  
  public function cetakkhs($idsemester){

      $user = Auth::user();
      $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
      $context = stream_context_create($opts);

      $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$user->id, false, $context);
      $mhs = json_decode($strMhs);
      
      $strKrs = file_get_contents('http://localhost:8000/api/krs/'.$user->id, false, $context);
      $krs = json_decode($strKrs);

      $strsmr = file_get_contents('http://localhost:8000/api/semester/'.$user->id, false, $context);
      $smr = json_decode($strsmr);

      $strSks = file_get_contents('http://localhost:8000/api/jatah_sks', false, $context);
      $sks = json_decode($strSks);

      $strIp = file_get_contents('http://localhost:8000/api/ip-semester/'.$user->id, false, $context);
      $ip = json_decode($strIp);

 
      // $idsemester = $request->input('carisemester');     
    
    return view('mahasiswa.khs.cetakkhs', compact('krs', 'mhs','idsemester','smr','sks','ip'));
  }


  public function transkrip(){

    $user = Auth::user();
    $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
    $context = stream_context_create($opts);

    $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$user->id, false, $context);
    $mhs = json_decode($strMhs);

    $strKrs = file_get_contents('http://localhost:8000/api/krs/'.$user->id, false, $context);
    $krs = json_decode($strKrs);

    // dd($krs[0]->krs);
        
    // return response()->json($krs);

    return view('mahasiswa.transkrip.transkrip', compact('krs','mhs'));
  }

  public function cetakTranskrip()
  {
      $user = Auth::user();
      $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
      $context = stream_context_create($opts);

      $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$user->id, false, $context);
      $mhs = json_decode($strMhs);
      
      $strKrs = file_get_contents('http://localhost:8000/api/krs/'.$user->id, false, $context);
      $krs = json_decode($strKrs);
    
    return view('mahasiswa.transkrip.cetak-transkrip', compact('mhs','krs'));
  }


  public function infomatkul()
  {
    $user = Auth::user();

    $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
    $context = stream_context_create($opts);

    $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$user->id, false, $context);
    $mhs = json_decode($strMhs);

    $strMatkul = file_get_contents('http://localhost:8000/api/semester_kelas', false, $context);
    $matkul = json_decode($strMatkul);

    $link = file_get_contents('http://localhost:8000/api/semester_aktif', false, $context);
    $max = json_decode($link);

    return view('mahasiswa.infomatkul.index', compact('matkul','max','mhs'));
  }

  public function detilmatkul($kelasid)
  {
    $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
    $context = stream_context_create($opts);

    $strMatkul = file_get_contents('http://localhost:8000/api/semesterkelas_matkul/'.$kelasid, false, $context);
    $matkul = json_decode($strMatkul);

    $link = file_get_contents('http://localhost:8000/api/semester_aktif', false, $context);
    $max = json_decode($link);
    
    return view('mahasiswa.infomatkul.detilmatkul', compact('matkul','max'));
  }

  public function prosesKrs()
  {
    $user = Auth::user();
    $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
    $context = stream_context_create($opts);

    $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$user->id, false, $context);
    $mhs = json_decode($strMhs);

    $strMatkul = file_get_contents('http://localhost:8000/api/semester_kelas', false, $context);
    $matkul = json_decode($strMatkul);

    $link = file_get_contents('http://localhost:8000/api/semester_aktif', false, $context);
    $max = json_decode($link);

    $linkKrs = file_get_contents('http://localhost:8000/api/krs_aktif/'.$user->id, false, $context);
    $krsAk = json_decode($linkKrs);

    $strkrsCe = file_get_contents('http://localhost:8000/api/krs_cekarang/'.$user->id, false, $context);
    $krsCe = json_decode($strkrsCe);

    
    $krsAktif = $krsAk->krs_id;
   

    return view('mahasiswa.krs.proseskrs', compact('matkul','max','krsAktif','krsCe','mhs'));
  }
  
  public function previewKrs(Request $request)
  {
    
    $user = Auth::user();
    $kelas_id = $request->kelas_id;
    $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
    $context = stream_context_create($opts);
    $strKrsAktif = file_get_contents('http://localhost:8000/api/krs_aktif/'. $user->id, false, $context);
    $krsAktif = json_decode($strKrsAktif);
    
    $strMatkul = file_get_contents('http://localhost:8000/api/semester_kelas', false, $context);
    $matkul = json_decode($strMatkul);

    


   foreach ($kelas_id as $key => $kelas) {
     $strPre = file_get_contents('http://localhost:8000/api/krs-input/'.$kelas, false, $context);
     $pre = json_decode($strPre);

     $celas[] = $pre; 
   }
    // $krs_id = $krsAktif->krs_id;

    $data = (object) $celas;

    
    // dd($kelas_id);

   
    // $curl = curl_init();

    // curl_setopt_array($curl, array(
    //     CURLOPT_URL => "http://localhost:8000/api/krs-input",
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_ENCODING => "",
    //     CURLOPT_MAXREDIRS => 10,
    //     CURLOPT_TIMEOUT => 30000,
    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     CURLOPT_CUSTOMREQUEST => "POST",
    //     CURLOPT_POSTFIELDS => $kelas_id,
    //     CURLOPT_HTTPHEADER => array(
    //       // Set here requred headers
    //         "accept: */*",
    //         "accept-language: en-US,en;q=0.8",
    //         "content-type: application/json",
    //     ),
    // ));

    // $response = curl_exec($curl);
    // $err = curl_error($curl);

    // curl_close($curl);
    
    // if ($err) {
    //     echo "cURL Error #:" . $err;
    // } else {
    //     print_r(json_decode($response));
    // }
    

      return view('mahasiswa.krs.previewkrs', compact('kelas_id','matkul','data','pre'));
    // return response()->json($data);
    // return redirect('krs')->with('pesan', 'Berhasil menambah data');
  }

 

}
