<?php

namespace App\Http\Controllers;

use App\LayananService;
use App\Sparepart;
use App\StatusKerja;
use App\SuratTugas;
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
        $allSparepart = Sparepart::all();
        return view('admin.layanan.index', compact('pagename', 'allLayanan', 'allSparepart'));
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
        $data_sparepart = Sparepart::all();
        return view('admin.layanan.create', compact('pagename', 'data', 'data_sparepart'));
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
        dd($request->all());
        $request->validate([
            'jenis_layanan' => 'required',
            'harga' => 'required|numeric',
            'sparepart_id' => 'required',
        ]);
        $harga_Sparepart = Sparepart::whereIn('id', request()->get('sparepart_id'))->sum('harga');

        $data = new LayananService(
            [
                'jenis_layanan' => $request->get('jenis_layanan'),
                'sparepart_id' => implode(",", $request->get('sparepart_id')),
                'harga' => $request->get('harga') + $harga_Sparepart,
            ]
        );
        
        $allSparepart = Sparepart::all();
        $keterangan = [];
        foreach ($allSparepart as $value) {
            foreach (explode(",", $data->sparepart_id) as $key) {
                if ($value->id == $key) {
                    array_push($keterangan, $value->nama);
                }
            }
        }
        $stringarray = implode(', ', $keterangan);
        $data->keterangan = $stringarray;

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
        $data_sparepart = Sparepart::all();
        return view('admin.layanan.edit', compact('data', 'pagename','data_sparepart'));
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
        $surttugas = SuratTugas::where('layanan_id',$data->id);
        $surttugas->delete();
        foreach ($statusMekanik as $value) {
            $value->delete();
        }
        $data->delete();
        return redirect('dashboard/layanan')->with('success', 'Layanan Service Dihapus');
    }
}
