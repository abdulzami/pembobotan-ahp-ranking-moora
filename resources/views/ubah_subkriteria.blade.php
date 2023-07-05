@extends('layouts.master')

@push('custom-css')
@endpush

@section('content')
    <div class="row mb-4">
        <div class="row justify-content-between">
            <div class="col-12">
                <h3 class="display-5">Form Ubah Sub Krtieria</h3>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('ubah-sk.update',$sk->id_sk) }}">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="">Nama Sub Kriteria</label>
            <input type="text" value="{{$sk->nama_sk}}" class="form-control" name="nama_sk" id="" aria-describedby="" placeholder=" " required>
        </div>
        <div class="form-group">
            <label for="">Kriteria</label>
            <select class="form-select" name="id_kriteria">
                <option value="">Pilih</option>
                @foreach ($kriteria as $k)
                    <option value="{{ $k->id_kriteria }}"
                      {{$sk->id_kriteria == $k->id_kriteria?'selected':''}}
                      >{{ $k->nama_kriteria }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Nilai</label>
            <input type="number" value="{{$sk->nilai}}" name='nilai' class="form-control" id="" placeholder="" required>
        </div>
        <button type="submit" class="btn btn-dark mt-3">Simpan</button>
    </form>
@endsection
