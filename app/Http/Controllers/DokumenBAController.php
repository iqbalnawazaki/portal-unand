<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DokumenBA;
use Illuminate\Http\Request;
use App\Periode;
use App\User;


class DokumenBAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
      $dokumenba = DokumenBA::where('user_id', Auth::id())->get();
      $user = Auth::user();
        $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
        $context = stream_context_create($opts);

        $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$user->nim, false, $context);
        $mhs = json_decode($strMhs);
        $strsmr = file_get_contents('http://localhost:8000/api/semester/'.$user->nim, false, $context);
        $smr = json_decode($strsmr);
               

      return view('dokumen-b-a.index', compact('dokumenba','mhs','smr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
        $context = stream_context_create($opts);
        $link = file_get_contents('http://localhost:8000/api/semester_aktif', false, $context);
        $max = json_decode($link);
        $periode = Periode::where('status',1)->select('id')->first();

        $semester = $max->semester_id;
        $periodes = $periode->id;
        return view('dokumen-b-a.create',compact('periodes','semester'));
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
        $requestData = $request->all();
        auth()->user()->dokumenba()->create($requestData);
       

        return redirect('dokumen-b-a')->with('flash_message', 'Dokumen Bimbingan Akademik berhasil ditambahkan!');
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
        $dokumenba = DokumenBA::findOrFail($id);

        $user = Auth::user();
        $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
        $context = stream_context_create($opts);

        $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$user->nim, false, $context);
        $mhs = json_decode($strMhs);

        $strsmr = file_get_contents('http://localhost:8000/api/semester/'.$user->nim, false, $context);
        $smr = json_decode($strsmr);

        return view('dokumen-b-a.show', compact('dokumenba','smr'));
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
        $user = Auth::user();
        $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
        $context = stream_context_create($opts);
        $strsmr = file_get_contents('http://localhost:8000/api/semester/'.$user->nim, false, $context);
        $smr = json_decode($strsmr);
        $periode = Periode::where('status',1)->select('id')->first();
        $dokumensmr = DokumenBA::where('id', $id)->first();

        $semester = $dokumensmr->semester_id;       
        $periodes = $periode->id;
        $dokumenba = DokumenBA::findOrFail($id);

        return view('dokumen-b-a.edit', compact('dokumenba','periodes','semester'));
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

        $dokumenba = DokumenBA::findOrFail($id);
        $dokumenba->update($requestData);

        return redirect('dokumen-b-a')->with('flash_message', 'Dokumen Bimbingan Akademik berhasil diubah!');
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
        DokumenBA::destroy($id);

        return redirect('dokumen-b-a')->with('flash_message', 'Dokumen Bimbingan Akademik berhasil dihapus!');
    }

    public function printDokumenAkademik($id)
    {
        $dokumenba = DokumenBA::findOrFail($id);

        $user = Auth::user();
        $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
        $context = stream_context_create($opts);

        $strMhs = file_get_contents('http://localhost:8000/api/mahasiswa/'.$user->nim, false, $context);
        $mhs = json_decode($strMhs);

        $strsmr = file_get_contents('http://localhost:8000/api/semester/'.$user->nim, false, $context);
        $smr = json_decode($strsmr);

        
        return view('dokumen-b-a.print-dokumen', compact('dokumenba','mhs','smr'));
    }

}
