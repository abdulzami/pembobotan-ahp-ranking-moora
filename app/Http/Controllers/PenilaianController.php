<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = Kriteria::select('nama_kriteria')->orderby('id_kriteria')->get();
        $alternatif = Alternatif::orderby('id_alternatif')->get();
        for ($i = 0; $i < count($alternatif); $i++) {
            $penilaian = Penilaian::where('id_alternatif', $alternatif[$i]->id_alternatif)->orderby('id_kriteria')->get();
            if (count($penilaian) != 0) {
                $alternatif[$i]->penilaian = $penilaian;
            } else {
                $alternatif[$i]->penilaian = "null";
            }
        }
        return view('penilaian', compact('kriteria', 'alternatif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $alternatif = Alternatif::get();
        $kriteria = Kriteria::orderby('id_kriteria')->get();
        for ($i = 0; $i < count($kriteria); $i++) {
            $sk = SubKriteria::where('id_kriteria', $kriteria[$i]->id_kriteria)->get();
            if (count($sk) != 0) {
                $kriteria[$i]->sk = $sk;
            } else {
                $kriteria[$i]->sk = "null";
            }
        }
        return view('tambah_penilaian', compact('alternatif', 'kriteria', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $kriteria = Kriteria::orderby('id_kriteria')->get();
        $cek = Penilaian::where('id_alternatif', $id)->get();
        if (count($cek) == 0) {
            foreach ($kriteria as $k) {
                $id_k = $k->id_kriteria;
                Penilaian::create([
                    'id_alternatif' => $id,
                    'id_kriteria' => $k->id_kriteria,
                    'nilai' => $request->$id_k
                ]);
            }
            return redirect()->route('penilaian');
        } else {
            return back();
        }
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
        $alternatif = Alternatif::get();
        $kriteria = Kriteria::leftJoin('penilaians', 'penilaians.id_kriteria', '=', 'kriterias.id_kriteria')
            ->orderby('kriterias.id_kriteria')->where('penilaians.id_alternatif', $id)
            ->get();
        for ($i = 0; $i < count($kriteria); $i++) {
            $sk = SubKriteria::where('id_kriteria', $kriteria[$i]->id_kriteria)->get();
            if (count($sk) != 0) {
                $kriteria[$i]->sk = $sk;
            } else {
                $kriteria[$i]->sk = "null";
            }
        }
        return view('ubah_penilaian', compact('alternatif', 'kriteria', 'id'));
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
        $kriteria = Kriteria::orderby('id_kriteria')->get();
        foreach ($kriteria as $k) {
            $id_k = $k->id_kriteria;
            Penilaian::where('id_alternatif', $id)->where('id_kriteria', $k->id_kriteria)->update([
                'nilai' => $request->$id_k
            ]);
        }
        return redirect()->route('penilaian');
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
