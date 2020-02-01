<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = User::leftJoin('model_has_roles','users.id','=','model_has_roles.model_id')->where('role_id','=',3)->get();
        // $user = $user->filter(function($u){
        //   $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
        //   $context = stream_context_create($opts);
        //   $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$u->id, false, $context);
        //   $mhs = json_decode($strMhs);
        //   return $u->detail = $mhs;

        // });
        
        return view('admin.user.index',['user'=> $user]);
    }

    public function userdosen()
    {
        $dosen = User::leftJoin('model_has_roles','users.id','=','model_has_roles.model_id')->where('role_id','=',2)->get();
          
        //   $dosen = $dosen->filter(function($u){
        //   $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
        //   $context = stream_context_create($opts);
        //   $strDsn = file_get_contents('http://localhost:8000/api/dosen/'.$u->id, false, $context);
        //   $dsn = json_decode($strDsn);
        //   return $u->detail = $dsn;
        // });
        
    return view('admin.user.userdosen',['dosen'=>$dosen]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->except('roles');
        $roles=$request->roles;
        $user= User::create($requestData);

        $user->assignRole($roles);

        return redirect('admin/user')->with('flash_message', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $user = User::findOrFail($id);
        $user->update($requestData);

        $user->syncRoles($request->roles);

        return redirect('admin/user')->with('flash_message', 'User berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('admin/user')->with('flash_message', 'User berhasil dihapus!');
    }

}
