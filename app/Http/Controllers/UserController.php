<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use App\StatusKerja;
use App\Transaksi;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagename = 'Data Pelanggan';
        $allUsers =User::join('pelanggans as p', 'users.id', '=', 'p.user_id')
            ->where('users.role', 'user')
            ->get();


        return view('admin.users.index', compact('pagename' , 'allUsers'));
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
        $user = User::find($id);
        $kerja = StatusKerja::where('user_id',$user->id);
        $pelanggan = Pelanggan::where('user_id',$user->id);
        $transaksi = Transaksi::where('user_id',$user->id);

        $pelanggan->delete();
        $user->delete();
        $kerja->delete();
        $transaksi->delete();
        return redirect()->route('users.index')->with('success', 'User Deleted');
    }
}
