@extends('layouts.master')

@push('custom-css')
@endpush

@section('content')
    <div class="row mb-4">
        <div class="row justify-content-between">
            <div class="col-4">
                <h3 class="display-5">Data Krtieria</h3>
                <a href="{{ route('tambah-kriteria') }}"><button type="button" class="btn btn-dark btn-sm">Tambah
                        Kriteria</button></a>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama Krtieria</th>
                <th scope="col">Jenis</th>
                {{-- <th scope="col">Bobot</th> --}}
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kriteria as $index => $k)
                <tr>
                    <td>{{ $index+1 }}</th>
                    <td>{{ $k->nama_kriteria }}</td>
                    <td>{{ $k->jenis }}</td>
                    {{-- <td>{{ $k->bobot }}</td> --}}
                    <td>
                        <a href="{{route('ubah-kriteria',$k->id_kriteria)}}"><button type="button" class="btn btn-primary btn-sm">Ubah</button></a>
                        <a href="{{route('hapus-kriteria',$k->id_kriteria)}}"><button type="button" class="btn btn-danger btn-sm">Hapus </button></a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
