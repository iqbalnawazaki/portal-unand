<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\DokumenBA;
use App\Message;
use App\Periode;
use App\Charts\Charts;
use App\Charts\Fusioncharts;

class BimbinganController extends Controller
{
   
    public function bimbinganmahasiswa(){

      $user = Auth::user();
      $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
      $context = stream_context_create($opts);
      $strDsn = file_get_contents('http://localhost:8000/api/dosen/'.$user->id, false, $context);
      $dsn = json_decode($strDsn);
      $strDsnPA = file_get_contents('http://localhost:8000/api/dosenpa/'.$user->id, false, $context);
      $dsnpa = json_decode($strDsnPA);

      return view('dosen.bimbinganakademik', compact('dsn', 'dsnpa'));
    }

    public function bimbingandokumen($nim){

      $user = Auth::user();

      if (User::find($nim)) {
      $penerimaid = User::where('id', $nim)->first();
      $id = $penerimaid->id;
      $bimbinganChatting = Message::where(function($q) use ($id) {
           $q->where('user_id', auth()->id());
           $q->where('penerima_id', $id);
       })->orWhere(function($q) use ($id) {
           $q->where('user_id', $id);
           $q->where('penerima_id', auth()->id());
       })
       ->get();
       }     
     
     
    
      $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
      $context = stream_context_create($opts);
      $strDsn = file_get_contents('http://localhost:8000/api/dosen/'.$user->id, false, $context);
      $dsn = json_decode($strDsn);
      
      $strDsnPA = file_get_contents('http://localhost:8000/api/dosenpa/'.$user->id, false, $context);
      $dsnpa = json_decode($strDsnPA);

      $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$nim, false, $context);
      $mhs = json_decode($strMhs);

      $strKrs = file_get_contents('http://localhost:8000/api/krs/'.$nim, false, $context);
      $krs = json_decode($strKrs);

      $strsmr = file_get_contents('http://localhost:8000/api/semester/'.$nim, false, $context);
      $smr = json_decode($strsmr);

      $link = file_get_contents('http://localhost:8000/api/semester_aktif', false, $context);
      $max = json_decode($link);

      $strSks = file_get_contents('http://localhost:8000/api/sks/'.$nim, false, $context);
      $sks = json_decode($strSks);

      $strIp = file_get_contents('http://localhost:8000/api/ip-semester/'.$nim, false, $context);
      $ip = json_decode($strIp);

      $photo = User::where('id', $nim)->select('avatar')->first();
      $poto = $photo->avatar;

      foreach ($ip as $key => $value) {
         $ips[] = number_format((float)$value->ip_semester, 2, '.', '');
         $nama_semester[] =$value->semester_nama;
       }

      $status_krs = (object) array("tidakdisetujui"=>"0","disetujui"=>"1");

      //charts
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
            $nilaiD++;
            }
          elseif($item->nilaikode == "E"){
            $nilaiE++;
            }
          elseif($item->nilaikode == "BL"){
            $nilaiBL++;
            }
         }
      }
      
      $chart = new Fusioncharts;
      $chart->labels(['Nilai A', 'Nilai A-', 'Nilai B+', 'Nilai B', 'Nilai B-', 'Nilai C+', 'Nilai C', 'Nilai D', 'Nilai E', 'Nilai BL']);
      $chart->dataset('Grafik Nilai Riwayat Kartu Rencana Studi', 'pie2d', [$nilaiA,  $nilaiAmin, $nilaiBplus,  $nilaiB, $nilaiBmin, $nilaiCplus, $nilaiC, $nilaiD, $nilaiE, $nilaiBL])
      ->options([
        'color' => ['#1d97c1', '#26baee', '#00ad7c', '#52d681', '#b5ff7d', '#ff9234', '#ffcd3c', '#f9ff21', '#ff0000', '#9a9b94'],
      ]);

      $ipsemester = new Fusioncharts;
      $ipsemester->labels($nama_semester);
      $ipsemester->dataset('Indeks Prestasi Semester', 'line', $ips)
      ->options([
        'color' => '#006400'
      ]);     
            
      return view('dosen.bimbingandokumen', compact('bimbinganChatting','poto','smr', 'dsn', 'dsnpa', 'dokumenba','mhs','krs','max','sks','status_krs','chart','ipsemester','ip'));
    }

    public function printTranskrip($nim)
    {
       $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
       $context = stream_context_create($opts);
       $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$nim, false, $context);
       $mhs = json_decode($strMhs);
       
       $strKrs = file_get_contents('http://localhost:8000/api/krs/'.$nim, false, $context);
       $krs = json_decode($strKrs);
       
       return view('dosen.cetak-transkrip', compact('mhs','krs'));      
    }


    public function cetakChat(Request $request, $nim)
    {
      // $db = User::where('nim', '=',$nim)->firstOrFail();
      // dd($db);
      if ($request->user()->hasRole('dosen') && User::where('id', '=',$nim)->firstOrFail()) {

      $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
      $context = stream_context_create($opts);
      $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$nim, false, $context);
      $mhs = json_decode($strMhs);

      $strsmr = file_get_contents('http://localhost:8000/api/semester/'.$nim, false, $context);
      $smr = json_decode($strsmr);      


      $idsemester = $request->input('carisemester');
      $user = Auth::user();

      $periodeid = Periode::select('id','nama')->get();
        
      $penerimaid = User::where('id', $nim)->first();
      $id = $penerimaid->id;
              
      $bimbinganChatting = Message::join('users','messages.user_id','=','users.id')
      ->join('topiks','messages.topik_id','=','topiks.id')
       ->where(function($q) use ($id) {
           $q->where('user_id', auth()->id());
           $q->where('penerima_id', $id)
           ->whereNotIn('topik_id',[8]);
       })->orWhere(function($q) use ($id) {
           $q->where('user_id', $id);
           $q->where('penerima_id', auth()->id())
           ->whereNotIn('topik_id',[8]);
       })
       ->select(
           'messages.id as id',
           'user_id',
           'penerima_id',
           'name',
           'pesan',
           'image',
           'read',
           'messages.semester_id as semester_id',
           'topiks.topik as topik',
           'topiks.periode_id as periode_id',
           'messages.created_at as created_at'
       )
       ->get();

      // $bimbinganChatting = Message::join('users','messages.user_id','=','users.id')
      // ->where(function($q) use ($id) {
      //      $q->where('user_id', auth()->id());
      //      $q->where('penerima_id', $id);
      //  })->orWhere(function($q) use ($id) {
      //      $q->where('user_id', $id);
      //      $q->where('penerima_id', auth()->id());
      //  })
      //  ->get();
      // dd($bimbinganChatting);
      return view('dosen.chatting.cetak-chat', compact('bimbinganChatting','idsemester','mhs','smr','periodeid','user'));
      }
      else {
        return view('not-registered');
      } 
      
    }
   

}
