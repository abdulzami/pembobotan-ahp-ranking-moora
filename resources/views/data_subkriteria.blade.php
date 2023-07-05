@extends('layouts.master')

@push('custom-css')
@endpush

@section('content')
    <div class="row mb-4">
        <div class="row justify-content-between">
            <div class="col-12">
                <h3 class="display-5">Data Sub Krtieria</h3>
                <a href="{{ route('tambah-subkriteria') }}"><button type="button" class="btn btn-dark btn-sm">Tambah Sub
                        Kriteria</button></a>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama Sub Kriteria</th>
                <th scope="col">Nama Krtieria</th>
                <th scope="col">Nilai</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sk as $index => $s)
                <tr>
                    <td>{{$index+1}}</th>
                    <td>{{$s->nama_sk}}</td>
                    <td>{{$s->nama_kriteria}}</td>
                    <td>{{$s->nilai}}</td>
                    <td>
                        <a href="{{route('ubah-sk',$s->id_sk)}}"><button type="button" class="btn btn-primary btn-sm">Ubah</button></a>
                        <a href="{{route('hapus-sk',$s->id_sk)}}"><button type="button" class="btn btn-danger btn-sm">Hapus </button></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
