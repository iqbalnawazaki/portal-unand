<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Image;
use Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

  public function profile()
  {
    $user = Auth::user();
     

    if ($user->hasRole('administrator')) {
      return view('admin.profile', compact('user',$user));
    }
    elseif ($user->hasRole('dosen')) {
      
      $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
      $context = stream_context_create($opts);
      $strDsn = file_get_contents('http://localhost:8000/api/dosen/'.$user->id, false, $context);
      $dsn = json_decode($strDsn);
      $user->detail = $dsn;

      // return response()->json($user);
      return view('dosen.profile', compact('user',$user));
    }
    elseif ($user->hasRole('mahasiswa')) {
      $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
      $context = stream_context_create($opts);
      $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$user->id, false, $context);
      $mhs = json_decode($strMhs);
      $user->detail = $mhs;
      return view('mahasiswa.profile', compact('user',$user));
    }
    else {
      return view('home');
    }
  }

  public function update_avatar(Request $request){
     $user = Auth::user();
     $oldFile = $user->avatar;
     $request->validate([
         'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
     ]);
     
     if ($oldFile != "profile.jpg") {
     if (Storage::exists('avatars' . '/' . $oldFile))
                    Storage::delete('avatars' . '/' . $oldFile);
     }

     $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
     Image::make($request->avatar)->resize(300, 400);
     $request->avatar->storeAs('avatars',$avatarName);
     $user->avatar = $avatarName;
     $user->save();
     return back()
         ->with('success','Foto Profil Anda Berhasil Diubah.');

 }
 
 public function updateSignature(Request $request){
     $user = Auth::user();
     $oldFile = $user->signature;
     $request->validate([
         'signature' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
     ]);
      
     if (Storage::exists('signature' . '/' . $oldFile))
                    Storage::delete('signature' . '/' . $oldFile);

     $signatureName = $user->id.'_signature'.time().'.'.request()->signature->getClientOriginalExtension();
     Image::make($request->signature);
     $request->signature->storeAs('signature',$signatureName);
     $user->signature = $signatureName;
     $user->save();
     return back()
         ->with('success','Tanda Tangan Anda Berhasil Ditambahkan.');

  }


 public function showChangePasswordForm(){
     $user = Auth::user();

    if ($user->hasRole('administrator')) {
      return view('admin.profile', compact('user',$user));
    }
    elseif ($user->hasRole('dosen')) {
      
     return view('auth.ganti-passwords-dos');
      // return response()->json($user);
      return view('dosen.profile', compact('user',$user));
    }
    elseif ($user->hasRole('mahasiswa')) {
     return view('auth.ganti-passwords');
    }
    else {
      return view('home');
    }


        
 }

 public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }

}
