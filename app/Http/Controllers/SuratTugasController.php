<?php

namespace App\Http\Controllers;

use App\LayananService;
use App\SuratTugas;
use Illuminate\Http\Request;

class SuratTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagename = 'Data Form Surat tugas';
        $allSurattugas = SuratTugas::all();
        return view('admin.surattugas.index', compact('pagename','allSurattugas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dataLayanan = LayananService::all();
        $pagename = 'Tambah Data Surat Tugas';
        return view('admin.surattugas.create',compact('pagename','dataLayanan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_layanan'=>'required',
            'nama_pelanggan' => 'required',
   
        ]);
        
        $hargatotal = LayananService::find($request->get('nama_layanan'));
      
        $data = new SuratTugas([
            'nama_pelanggan' => $request->get('nama_pelanggan'),
            'layanan_id'=> $request->get('nama_layanan'),
            'harga_total'=>$hargatotal->harga,
            ]);
        $data->save();
        return redirect('dashboard/surattugas')->with('success', 'Data Surat Tugas Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
