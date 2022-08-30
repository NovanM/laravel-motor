<?php

namespace App\Http\Controllers;

use App\LayananService;
use App\StatusKerja;
use Illuminate\Http\Request;

class LayananServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagename = 'Data Layanan';
        $allLayanan = LayananService::all();
        return view('admin.layanan.index', compact('pagename', 'allLayanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = LayananService::all();
        $pagename = 'Form Tambah Data Layanan';

        return view('admin.layanan.create', compact('pagename', 'data'));
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
            'jenis_layanan' => 'required',
            'harga' => 'required|numeric',
            'keterangan' => 'required',
        ]);

        $data = new LayananService(
            [
                'jenis_layanan' => $request->get('jenis_layanan'),
                'keterangan' => $request->get('keterangan'),
                'harga' => $request->get('harga'),
            ]
        );

        $data->save();
        return redirect('dashboard/layanan')->with('success', 'Layanan Service Ditambahkan');
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
        $pagename = 'Edit Data Layanan Service';
        $data = LayananService::find($id);
        return view('admin.layanan.edit', compact('data', 'pagename',));
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
        $data = LayananService::find($id);

        $data->jenis_layanan = $request->get('jenis_layanan');
        $data->keterangan = $request->get('keterangan');
        $data->harga = $request->get('harga');


        $data->save();
        return redirect('dashboard/layanan')->with('success', 'Layanan Service Diperbaruhi');
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
        $data = LayananService::find($id);
        $statusMekanik = StatusKerja::all()->where('layanan_id', $data->id);
        foreach ($statusMekanik as $value) {
            $value->delete();
        }
        $data->delete();
        return redirect('dashboard/layanan')->with('success', 'Layanan Service Dihapus');
    }
}
