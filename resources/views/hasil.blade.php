@extends('layouts.master')

@push('custom-css')
@endpush

@section('content')
    <div class="row mb-4">
        <div class="row justify-content-between">
            <div class="col-4">
                <h3 class="display-5">Hasil Perhitungan</h3>
            </div>
        </div>
    </div>
    <div class="card">
        <h5 class="card-header">Matriks</h5>
        <div class="card-body">
            <p class="card-text">
            <table class="table table-borderless">
                <tr>
                    <th>Alternatif</th>
                    @foreach ($kriteria as $k)
                        <th scope="col">{{ $k->nama_kriteria }}</th>
                    @endforeach
                </tr>
                @foreach ($alternatif as $a)
                    <tr>
                        <td>{{ $a->nama }}</td>
                        @foreach ($a->penilaian as $p)
                            <td>{{ $p->nilai }}</td>
                        @endforeach

                    </tr>
                @endforeach
            </table>
            </p>
        </div>
    </div>
    <div class="card mt-3">
        <h5 class="card-header">Pembagi</h5>
        <div class="card-body">
            <p class="card-text">
            <table class="table table-borderless">
                <tr>
                    @foreach ($kriteria as $k)
                        <th scope="col">{{ $k->nama_kriteria }}</th>
                    @endforeach
                </tr>
                <tr>
                    @for ($a = 0; $a < count($pembagi); $a++)
                        <td>{{ $pembagi[$a] }}</td>
                    @endfor
                </tr>
            </table>
            </p>
        </div>
    </div>
    <div class="card mt-3">
        <h5 class="card-header">Matriks Ternormalisasi</h5>
        <div class="card-body">
            <p class="card-text">
            <table class="table table-borderless">
                <tr>
                    <th>Alternatif</th>
                    @foreach ($kriteria as $k)
                        <th scope="col">{{ $k->nama_kriteria }}</th>
                    @endforeach
                </tr>
                @foreach ($matriks_t as $mt)
                    <tr>
                        <td>{{ $mt->nama }}</td>
                        @foreach ($mt->penilaian as $mtp)
                            <td>{{ $mtp->nilai_ternormalisasi }}</td>
                        @endforeach

                    </tr>
                @endforeach
            </table>
            </p>
        </div>
    </div>
    <div class="card mt-3">
        <h5 class="card-header">Matriks Ternormalisasi x Bobot</h5>
        <div class="card-body">
            <p class="card-text">
            <table class="table table-borderless">
                <tr>
                    <th>Alternatif</th>
                    @foreach ($kriteria as $k)
                        <th scope="col">{{ $k->nama_kriteria }}</th>
                    @endforeach
                </tr>
                @foreach ($matriks_t_k_bobot as $mtkb)
                    <tr>
                        <td>{{ $mtkb->nama }}</td>
                        @foreach ($mtkb->penilaian as $mtkbp)
                            <td>{{ $mtkbp->nilai_ternormalisasi_k_bobot }}</td>
                        @endforeach

                    </tr>
                @endforeach
            </table>
            </p>
        </div>
    </div>
    <div class="card mt-3">
        <h5 class="card-header">Nilai Optimasi</h5>
        <div class="card-body">
            <p class="card-text">
            <table class="table table-borderless">
                <tr>
                    <th>Alternatif</th>
                    <th>Nilai Optimasi</th>
                    <th>Rank</th>
                </tr>
                @foreach ($nilai_optimasi_moora as $index => $no)
                    <tr>

                        @if ($rank_moora[$index] == 41)
                            <td class="bg-dark text-white border-0">{{ $no->nama }}</td>
                            <td class="bg-dark text-white border-0">{{ $no->optimasi_moora }}</td>
                            <td class="bg-dark text-white border-0">{{ $rank_moora[$index] }}</td>
                        @else
                            <td>{{ $no->nama }}</td>
                            <td>{{ $no->optimasi_moora }}</td>
                            <td>{{ $rank_moora[$index] }}</td>
                        @endif
                    </tr>
                @endforeach
            </table>
            </p>
        </div>
    </div>
    {{-- <div class="card mt-3">
        <h5 class="card-header">Nilai Optimasi MOSRA</h5>
        <div class="card-body">
            <p class="card-text">
            <table class="table table-borderless">
                <tr>
                    <th>Alternatif</th>
                    <th>Nilai Optimasi</th>
                    <th>Rank</th>
                </tr>
                @foreach ($nilai_optimasi_mosra as $index => $no)
                    <tr>
                        @if ($rank_mosra[$index] == 1)
                            <td class="bg-dark text-white border-0">{{ $no->nama }}</td>
                            <td class="bg-dark text-white border-0">{{ $no->optimasi_mosra }}</td>
                            <td class="bg-dark text-white border-0">{{ $rank_mosra[$index] }}</td>
                        @else
                            <td>{{ $no->nama }}</td>
                            <td>{{ $no->optimasi_mosra }}</td>
                            <td>{{ $rank_mosra[$index] }}</td>
                        @endif

                    </tr>
                @endforeach
            </table>
            </p>
        </div>
    </div> --}}
@endsection
