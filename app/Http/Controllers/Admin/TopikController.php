<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Topik;
use App\Periode;
use Illuminate\Http\Request;

class TopikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topik = Topik::all();

        return view('admin.topik.index', compact('topik'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periode = Periode::pluck('nama','id');
        return view('admin.topik.create', compact('periode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        Topik::create($requestData);
        return redirect('admin/topik-bimbinganakademik')->with('flash_message', 'Postingan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topik  $topik
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topik = Topik::findOrFail($id);

        return view('admin.topik.show', compact('topik'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topik  $topik
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topik = Topik::findOrFail($id);
        $periode = Periode::get()->pluck('nama','id');
        return view('admin.topik.edit', compact('topik','periode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topik  $topik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $topik = Topik::findOrFail($id);
        $topik->update($requestData);
        return redirect('admin/topik-bimbinganakademik')->with('flash_message', 'Topik berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topik  $topik
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Topik::destroy($id);

        return redirect('admin/topik-bimbinganakademik')->with('flash_message', 'Postingan berhasil dihapus!');
    }
}
