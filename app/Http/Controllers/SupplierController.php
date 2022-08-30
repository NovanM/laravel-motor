<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagename = 'Data Supplier';
        $allUsers = Supplier::all();
        return view('admin.supplier.index', compact('pagename', 'allUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $supplier = Supplier::all();
        $pagename = 'Form Tambah Data Supplier';
        return view('admin.supplier.create', compact('pagename', 'supplier'));
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
            'name' => 'required',
            'telepon' => 'required',
          
            
        ]);
      
        $data = new Supplier(
            [
                'nama' => $request->get('name'),
                'telepon' => $request->telepon,
                'alamat' => $request->get('alamat'),
            
              
            
            ]
        );

        $data->save();
        return redirect('dashboard/supplier')->with('success', 'Supplier Created');
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
        $pagename = 'Edit Data Supplier';
        $data = Supplier::find($id);
        return view('admin.supplier.edit', compact('data', 'pagename',));
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
    

        $data = Supplier::find($id);


        $data->nama = $request->get('name');
        $data->telepon  = $request->get('telepon');
        $data->alamat = $request->get('alamat');
        $data->tanggal_masuk = $request->get('tanggal_masuk');
        


        $data->save();
        return redirect('dashboard/supplier')->with('success', 'Supplier Updated');
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
        $data = Supplier::find($id);

        $data->delete();
        return redirect('dashboard/supplier')->with('success', 'Supplier Deleted');
    }
}
