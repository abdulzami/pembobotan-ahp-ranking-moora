<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sk = SubKriteria::
        join('kriterias','kriterias.id_kriteria','=','sub_kriterias.id_kriteria')
        ->get();   
        return view('data_subkriteria',compact('sk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kriteria = Kriteria::get();
        return view('tambah_subkriteria',compact('kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SubKriteria::create([
            'nama_sk' => $request->nama_sk,
            'id_kriteria' => $request->kriteria,
            'nilai' => $request->nilai
        ]);
        return redirect()->route('subkriteria');
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
        $kriteria = Kriteria::get();
        $sk = SubKriteria::where('id_sk',$id)->first();
        return view('ubah_subkriteria',compact('kriteria','sk'));
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
        $sk = SubKriteria::find($id);
        $vld = $request->validate([
            'nama_sk' => 'required',
            'id_kriteria' => 'required',
            'nilai' => 'required'
        ]);
        $sk->fill($vld)->save();
        return redirect()->route('subkriteria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubKriteria::where('id_sk',$id)->first()->delete();
        return back();
    }
}
