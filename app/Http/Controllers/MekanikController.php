<?php

namespace App\Http\Controllers;

use App\Console\Kernel;
use App\Rating;
use App\StatusKerja;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MekanikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagename = 'Data Mekanik';
        $i = 0;
        $allUsers = User::all()->where('role', 'mekanik');
        return view('admin.mekanik.index', compact('pagename', 'allUsers', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $mekanik = User::all();
        $pagename = 'Form Input create Mekanik';
        return view('admin.mekanik.create', compact('pagename', 'mekanik'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'username' => 'required|unique:users'
        ]);

        $data = new User(
            [
                'name' => $request->get('name'),
                'username' => $request->get('username'),
                'password' => Hash::make($request->get('password')),
                'email' => $request->get('email'),
                'telepon' => $request->get('telepon'),
                'role' => 'mekanik',
            ]
        );

        $data->save();
        return redirect('dashboard/mekanik')->with('success', 'Mekanik Created');
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
        $pagename = 'Update Data mekanik';
        $data = User::find($id);
        return view('admin.mekanik.edit', compact('data', 'pagename',));
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

        
        $data = User::find($id);
        
        if ($request->get('password')!= ''|| $request->get('password')!= null) {
            $password_hash = Hash::make($request->password);
            $data->password = $password_hash;
        }

        $data->name = $request->get('name');
        $data->email = $request->get('email');
        $data->telepon = $request->get('telepon');

        $data->save();
        return redirect('dashboard/mekanik')->with('success', 'Mekanik Updated');
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
        $data = User::find($id);
        $kerja = StatusKerja::where('user_id',$data->id);
        $rating = Rating::where('user_id',$data->id);
        $kerja->delete();
        $rating->delete();
        $data->delete();
        return redirect('dashboard/mekanik')->with('success', 'Mekanik User Deleted');
    }
}
