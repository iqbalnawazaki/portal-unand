<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Carbon;
use App\Postingan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();

      // $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
      // $context = stream_context_create($opts);
      // $strMhs = file_get_contents('http://localhost:8000/api/mahasiswas', false, $context);
      // $mhs = json_decode($strMhs);
      //
      // return $mhs;

      if ($user->hasRole('administrator')) {
        $postingans=Postingan::all();
        return view('admin.dashboard', compact('postingans','user',$user));
      }
      elseif ($user->hasRole('dosen')) {
        $postingans=Postingan::all();
        return view('dosen.dashboard', compact('postingans','user',$user));
      }
      elseif ($user->hasRole('mahasiswa')) {
        $postingans=Postingan::all();
        return view('mahasiswa.dashboard', compact('postingans','user',$user));
      }
      else {
        return view('home');
      }
    }
}
