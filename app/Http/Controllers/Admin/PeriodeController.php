<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use App\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
      $periode = Periode::all();
      $status_krs = (object) array("tidakdisetujui"=>0,"disetujui"=>1);

      return view('admin.periode.index', compact('periode','status_krs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.periode.create');
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

        $periode = new Periode();
        $periode->id = $request->id;
        $periode->nama = $request->nama;
        $periode->save();
        return redirect('admin/periode')->with('flash_message', 'Periode berhasil ditambahkan!');
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
        $periode = Periode::findOrFail($id);

        return view('admin.periode.show', compact('periode'));
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
        $periode = Periode::findOrFail($id);

        return view('admin.periode.edit', compact('periode'));
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

        $periode = Periode::findOrFail($id);
        $periode->id = $request->id;
        $periode->nama = $request->nama;
        $periode->save();

        return redirect('admin/periode')->with('flash_message', 'Periode berhasil diubah!');
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
        Periode::destroy($id);

        return redirect('admin/periode')->with('flash_message', 'Periode berhasil dihapus!');
    }
    
    public function statusPeriode(Request $request)
    {
        $status_periode = $request->input("status");
        $jml = 0;
        foreach ($status_periode as $key => $value) {
            if ($value == 1) {
                $jml = $jml+$value;
            }
        }
       
        if ($jml ==1) {
        foreach ($status_periode as $key => $value) {
            $krs = Periode::findOrFail($key);
            $krs->status = $value;
            $krs->save();
            }
            return redirect()->back();
        }
        else {
            return Redirect::back()->withErrors(['msg', 'The Message']);
        }

    }


}
