<?php

namespace App\Http\Controllers;

use App\StatusKerja;
use Illuminate\Http\Request;

class StatusKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $allMekanikStatus = StatusKerja::orderBy('created_at','desc')->get();
        $pagename = 'Data Status Kerja Mekanik';

        return view('admin.status.index', compact('allMekanikStatus', 'pagename'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    public function byProses(){
        $pagename = 'Data Status Kerja Mekanik';
        $allMekanikStatus = StatusKerja::where('status_kerja','Proses')->orderBy('created_at','desc')->get();
        

        return view('admin.status.index', compact('pagename', 'allMekanikStatus' ));
    }

    public function byDiterima(){
        $pagename = 'Data Status Kerja Mekanik';
        $allMekanikStatus = StatusKerja::where('status_kerja','Diterima')->orderBy('created_at','desc')->get();
    
        return view('admin.status.index', compact('pagename', 'allMekanikStatus' ));
    }
    public function bySelesai(){
        $pagename = 'Data Status Kerja Mekanik';
        $allMekanikStatus = StatusKerja::where('status_kerja','Selesai')->orderBy('created_at','desc')->get();

        return view('admin.status.index', compact('pagename', 'allMekanikStatus', ));
    }
}
