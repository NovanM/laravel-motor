<?php

namespace App\Http\Controllers;

use App\Sparepart;
use App\Supplier;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagename = 'Data Sparepart';

        $data = Sparepart::all();
        return view('admin.sparepart.index', compact('pagename','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = Sparepart::all();
        $dataSupplier = Supplier::select('nama')->get();
        $pagename = 'Form Tambah Data Sparepart';
        return view('admin.sparepart.create', compact('pagename','data', 'dataSupplier'));
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
            'kode' => 'required|numeric|unique:spareparts',
            'nama' => 'required',
            'images' => 'required',
            'harga' => 'required|numeric',
        ]);
        $dataSupplier = Supplier::where('nama', $request->nama_supplier)->first();
   
        $data = new Sparepart(
            [
                'kode' => $request->get('kode'),
                'nama' => $request->get('nama'),
                'stok' => $request->get('stok'),
                'harga' => $request->get('harga'),
                'harga_jual'=>$request->get('harga_jual'),
                'suplier_id'=> $dataSupplier->id,
            ]
        );

        if($request->hasFile('images')) {
            $request->file('images')->move('images/', $request->file('images')->getClientOriginalName());
            $data->images = $request->file('images')->getClientOriginalName();
        }

        $data->save();
        return redirect('dashboard/sparepart')->with('success', 'Sparepart Ditambahkan');
        
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
        $pagename = 'Edit Data Sparepart';
        $data = Sparepart::find($id);
       
        $dataSupplier = Supplier::select('nama_sparepart','nama')->get();
        return view('admin.sparepart.edit', compact('data', 'pagename','dataSupplier'));
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
        $request->validate([
            'kode' => 'numeric|unique:spareparts,id,'. $id,
            'nama' => 'required',
            'harga' => 'required|numeric',
        ]);
        $dataSupplier = Supplier::where('nama', $request->nama_supplier)->first();
        $data = Sparepart::find($id);

        $data->nama = $request->get('nama');
        $data->kode = $request->get('kode');
        $data->harga = $request->get('harga');
        $data->stok = $request->get('stok');
        $data->harga_jual = $request->get('harga_jual');
        $data->suplier_id = $dataSupplier->id;
        

        if($request->hasFile('images')) {
            $request->file('images')->move('images/', $request->file('images')->getClientOriginalName());
            $data->images = $request->file('images')->getClientOriginalName();
        }

        $data->update();
        return redirect('dashboard/sparepart')->with('success', 'Sparepart Diperbaruhi');
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
        $data = Sparepart::find($id);
        $data->delete();
        return redirect('dashboard/sparepart')->with('success', 'Sparepart Dihapus');
    }
}
