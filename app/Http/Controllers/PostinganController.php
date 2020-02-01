<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Postingan;
use Carbon\Carbon;
use App\User;

class PostinganController extends Controller
{
  public function show($id)
  {
      $postingan = Postingan::findOrFail($id);
      $user = Auth::user();

      if ($user->hasRole('administrator')) {
      $postingan = Postingan::findOrFail($id);
        return view('admin.postingan', compact('postingan'));
      }
      elseif ($user->hasRole('dosen')) {
        $postingan = Postingan::findOrFail($id);
        return view('dosen.postingan', compact('postingan','current_time'));
      }
      elseif ($user->hasRole('mahasiswa')) {       
      $postingan = Postingan::findOrFail($id);
        return view('mahasiswa.postingan', compact('postingan'));
      }

  }
}
