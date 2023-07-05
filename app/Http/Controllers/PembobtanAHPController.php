<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Kriteria;
use App\Models\Perbandingan;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class PembobtanAHPController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::get();
        $id_k = Kriteria::select('id_kriteria')->get();
        $kc = $kriteria->count();

        if (Perbandingan::get()->count() != pow($kc, 2)) {
            Perbandingan::truncate();
            foreach ($kriteria as $k1) {
                foreach ($kriteria as $k2) {
                    Perbandingan::create([
                        'id_kriteria_1' => $k1->id_kriteria,
                        'id_kriteria_2' => $k2->id_kriteria,
                        'nilai' => 1
                    ]);
                }
            }
        }
        $perbandingan = Perbandingan::get();
        $bobot = Bobot::get();

        if ($bobot->count() > 0) {
            $arr_idk = array();
            foreach ($id_k as $idk) {
                array_push($arr_idk, $idk->id_kriteria);
            }
            $total = array_fill(0, $kc, 0);
            for ($i = 0; $i < $kc; $i++) {
                $temp = 0;
                for ($j = 0; $j < $kc; $j++) {
                    $p = Perbandingan::where('id_kriteria_1', '=', $arr_idk[$j])->where('id_kriteria_2', '=', $arr_idk[$i])->get()->first();
                    $temp += $p->nilai;
                }
                $total[$i] = $temp;
            }

            $tabel_bobot = array_fill(0, $kc, array_fill(0, $kc, 0));

            for ($i = 0; $i < $kc; $i++) {
                for ($j = 0; $j < $kc; $j++) {
                    $p = Perbandingan::where('id_kriteria_1', '=', $arr_idk[$i])->where('id_kriteria_2', '=', $arr_idk[$j])->get()->first();
                    $tabel_bobot[$j][$i] = $p->nilai / $total[$j];
                }
            }

            $tabel_bobot_total = array_fill(0, $kc, 0);
            $pv = array_fill(0, $kc, 0);
            for ($i = 0; $i < $kc; $i++) {
                $tt = 0;
                for ($j = 0; $j < $kc; $j++) {
                    $tt += $tabel_bobot[$j][$i];
                }
                $tabel_bobot_total[$i] = $tt;
                $pv[$i] = $tt / $kc;
            }
            
            $lambdaMax = 0;
            for($i=0;$i<$kc;$i++)
            {
                $lambdaMax += $total[$i]*$pv[$i];
            }
            $tab_rand_index = [1 => 0.0, 2 => 0.0, 3 => 0.58, 4 => 0.90, 5 => 1.12, 6 => 1.24, 7 => 1.32, 8 => 1.41, 9 => 1.45, 10 => 1.49];
            $ci = ($lambdaMax - $kc) / ($kc - 1);
            $cr = $ci / $tab_rand_index[$kc];
            return view('pembobotan_ahp', compact('kriteria', 'perbandingan', 'id_k', 'bobot', 'lambdaMax', 'ci', 'cr'));
        }
        return view('pembobotan_ahp', compact('kriteria', 'perbandingan', 'id_k'));
    }
    public function findBobot($id)
    {
        $nilai = Bobot::where('id_kriteria', $id)->first();
        return $nilai->nilai;
    }
    public function generate(Request $request)
    {
        $kriteria = Kriteria::get();
        $id_k = Kriteria::select('id_kriteria')->get();
        $arr_idk = array();
        foreach ($id_k as $idk) {
            array_push($arr_idk, $idk->id_kriteria);
        }

        $kc = $kriteria->count();
        $total = array_fill(0, $kc, 0);
        for ($i = 0; $i < $kc; $i++) {
            $temp = 0;
            for ($j = 0; $j < $kc; $j++) {
                $p = Perbandingan::where('id_kriteria_1', '=', $arr_idk[$i])->where('id_kriteria_2', '=', $arr_idk[$j])->get()->first();
                $p->nilai = $request[$arr_idk[$i] . ":" . $arr_idk[$j]];
                $temp += $request[$arr_idk[$j] . ":" . $arr_idk[$i]];
                $p->save();
            }
            $total[$i] = $temp;
        }

        $tabel_bobot = array_fill(0, $kc, array_fill(0, $kc, 0));

        for ($i = 0; $i < $kc; $i++) {
            for ($j = 0; $j < $kc; $j++) {
                $tabel_bobot[$j][$i] = $request[$arr_idk[$i] . ":" . $arr_idk[$j]] / $total[$j];
            }
        }


        $tabel_bobot_total = array_fill(0, $kc, 0);
        $pv = array_fill(0, $kc, 0);
        for ($i = 0; $i < $kc; $i++) {
            $tt = 0;
            for ($j = 0; $j < $kc; $j++) {
                $tt += $tabel_bobot[$j][$i];
            }
            $tabel_bobot_total[$i] = $tt;
            $pv[$i] = $tt / $kc;
        }

        foreach ($kriteria as $index => $k) {
            $bobot = Bobot::where('id_kriteria', '=', $k->id_kriteria)->first();
            if ($bobot == null) {
                Bobot::create([
                    'id_kriteria' => $k->id_kriteria,
                    'nilai' => $pv[$index],
                ]);
            } else {
                $bobot->nilai = $pv[$index];
                $bobot->save();
            }
        }

        return redirect()->back();
    }
}
