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
        $dataSupplier = Supplier::select('nama_sparepart','stok')->get();
        $pagename = 'Form input sparepart';
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
        $dataSupplier = Supplier::where('nama_sparepart', $request->nama)->get()->first();
        $data = new Sparepart(
            [
                'kode' => $request->get('kode'),
                'nama' => $request->nama,
                'stok' => $dataSupplier->stok,
                'harga' => $request->get('harga'),
                'suplier_id' => $dataSupplier->id,
            ]
        );

        if($request->hasFile('images')) {
            $request->file('images')->move('images/', $request->file('images')->getClientOriginalName());
            $data->images = $request->file('images')->getClientOriginalName();
        }

        $data->save();
        return redirect('dashboard/sparepart')->with('success', 'Sparepart Created');
        
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
        $pagename = 'Update Data Sparepart';
        $data = Sparepart::find($id);
       
    
        return view('admin.sparepart.edit', compact('data', 'pagename'));
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
            'kode' => 'numeric|unique:spareparts',
            'nama' => 'required',
            'harga' => 'required|numeric',
        ]);
    
        $data = Sparepart::find($id);

        $data->nama = $request->get('nama');
        $data->kode = $request->get('kode');
        $data->harga = $request->get('harga');
        $data->stok = $request->get('stok');

        if($request->hasFile('images')) {
            $request->file('images')->move('images/', $request->file('images')->getClientOriginalName());
            $data->images = $request->file('images')->getClientOriginalName();
        }

        $data->update();
        return redirect('dashboard/sparepart')->with('success', 'Sparepart Updated');
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
        return redirect('dashboard/sparepart')->with('success', 'Sparepart Deleted');
    }
}
