<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::orderby('id_kriteria')->get();
        $alternatif = Alternatif::get();
        for ($a = 0; $a < count($alternatif); $a++) {
            $penilaian = Penilaian::where('id_alternatif', $alternatif[$a]->id_alternatif)
                ->join('kriterias', 'kriterias.id_kriteria', '=', 'penilaians.id_kriteria')
                ->join('bobots','kriterias.id_kriteria','=','bobots.id_kriteria')
                ->select(
                    'penilaians.id',
                    'penilaians.id_alternatif',
                    'penilaians.id_kriteria',
                    'penilaians.nilai',
                    'kriterias.jenis',
                    'kriterias.nama_kriteria',
                    'bobots.nilai as bobot'
                    )
                ->orderby('penilaians.id_kriteria')->get();
            $alternatif[$a]->penilaian = $penilaian;
        }
        $pembagi = array();
        $matriks_t = $alternatif;
        for ($b = 0; $b < count($kriteria); $b++) {
            $temp = 0;
            for ($c = 0; $c < count($matriks_t); $c++) {
                $temp2 = $matriks_t[$c]->penilaian[$b]->nilai;
                $temp += pow($temp2, 2);
            }
            array_push($pembagi, sqrt($temp));
        }

        for ($d = 0; $d < count($matriks_t); $d++) {
            for ($e = 0; $e < count($pembagi); $e++) {
                $matriks_t[$d]->penilaian[$e]->nilai_ternormalisasi = $matriks_t[$d]->penilaian[$e]->nilai / $pembagi[$e];
            }
        }

        $matriks_t_k_bobot = $matriks_t;
        for ($f = 0; $f < count($matriks_t_k_bobot); $f++) {
            for ($g = 0; $g < count($matriks_t_k_bobot[$f]->penilaian); $g++) {
                $matriks_t_k_bobot[$f]->penilaian[$g]->nilai_ternormalisasi_k_bobot = ($matriks_t_k_bobot[$f]->penilaian[$g]->nilai_ternormalisasi * $matriks_t_k_bobot[$f]->penilaian[$g]->bobot);
            }
        }

        $nilai_optimasi_moora = $matriks_t_k_bobot;
        for ($h = 0; $h < count($nilai_optimasi_moora); $h++) {
            $temp3 = 0;
            for ($i = 0; $i < count($nilai_optimasi_moora[$h]->penilaian); $i++) {
                if ($nilai_optimasi_moora[$h]->penilaian[$i]->jenis == 'benefit') {
                    $temp3 += $nilai_optimasi_moora[$h]->penilaian[$i]->nilai_ternormalisasi_k_bobot;
                } else {
                    $temp3 -= $nilai_optimasi_moora[$h]->penilaian[$i]->nilai_ternormalisasi_k_bobot;
                }
            }
            $nilai_optimasi_moora[$h]->optimasi_moora = $temp3;
        }

        $nilai_optimasi_mosra = $matriks_t_k_bobot;
        for ($h = 0; $h < count($nilai_optimasi_mosra); $h++) {
            $min = 0;
            $max = 0;
            for ($i = 0; $i < count($matriks_t_k_bobot[$h]->penilaian); $i++) {
                if ($matriks_t_k_bobot[$h]->penilaian[$i]->jenis == 'cost') {
                    $min += $matriks_t_k_bobot[$h]->penilaian[$i]->nilai_ternormalisasi_k_bobot;
                } else {
                    $max += $matriks_t_k_bobot[$h]->penilaian[$i]->nilai_ternormalisasi_k_bobot;
                }
            }
            if ($min != 0 && $max != 0) {
                $matriks_t_k_bobot[$h]->optimasi_mosra = $max / $min;
            } elseif ($min == 0 && $max != 0) {
                $matriks_t_k_bobot[$h]->optimasi_mosra = $max;
            } else {
                $matriks_t_k_bobot[$h]->optimasi_mosra = $min;
            }
        }

        $arr_moora = array();
        $arr_mosra = array();
        for ($j = 0; $j < count($nilai_optimasi_mosra); $j++) {
            array_push($arr_moora, $nilai_optimasi_mosra[$j]->optimasi_moora);
            array_push($arr_mosra, $nilai_optimasi_mosra[$j]->optimasi_mosra);
        }
        $rank_moora = array();
        $ordered_moora = $arr_moora;
        rsort($ordered_moora);
        foreach ($arr_moora as $key => $value) {
            foreach ($ordered_moora as $ordered_key => $ordered_value) {
                if ($value === $ordered_value) {
                    $key = $ordered_key;
                    break;
                }
            }
            array_push($rank_moora, $key + 1);
        }

        $rank_mosra = array();
        $ordered_mosra = $arr_mosra;
        rsort($ordered_mosra);
        foreach ($arr_mosra as $key1 => $value1) {
            foreach ($ordered_mosra as $ordered_key1 => $ordered_value1) {
                if ($value1 === $ordered_value1) {
                    $key1 = $ordered_key1;
                    break;
                }
            }
            array_push($rank_mosra, $key1 + 1);
        }


        return view('hasil', compact('kriteria', 'alternatif', 'pembagi', 'matriks_t', 'matriks_t_k_bobot', 'nilai_optimasi_moora', 'nilai_optimasi_mosra', 'rank_moora', 'rank_mosra'));
    }
}
