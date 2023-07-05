@extends('layouts.master')

@push('custom-css')
@endpush

@section('content')
    <div class="row mb-4">
        <div class="row justify-content-between">
            <div class="col-4">
                <h3 class="display-5">Penilaian</h3>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama Alternatif</th>
                @foreach ($kriteria as $k)
                    <th scope="col">{{ $k->nama_kriteria }}</th>
                @endforeach
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alternatif as $index => $a)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $a->nama }}</td>
                    @if ($a->penilaian != 'null')
                        @foreach ($a->penilaian as $p)
                            <td>{{ $p->nilai }}</td>
                        @endforeach
                    @else
                        <td colspan="{{ count($kriteria) }}" class="text-center">
                            <a href="{{ route('tambah-penilaian',$a->id_alternatif) }}"><button type="button"
                                    class="btn btn-dark btn-sm">Lakuakan
                                    Penilaian</button></a>
                        </td>
                    @endif
                    <td>
                        @if ($a->penilaian != 'null')
                            <a href="{{ route('ubah-penilaian', $a->id_alternatif) }}"><button type="button"
                                    class="btn btn-primary btn-sm">Ubah</button></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
