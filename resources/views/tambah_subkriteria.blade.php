@extends('layouts.master')

@push('custom-css')
@endpush

@section('content')
    <div class="row mb-4">
        <div class="row justify-content-between">
            <div class="col-12">
                <h3 class="display-5">Form Tambah Sub Krtieria</h3>
            </div>
        </div>
    </div>

    <form method="POST" action="{{route('tambah-subkriteria.store')}}">
      @csrf
        <div class="form-group">
          <label for="">Nama Sub Kriteria</label>
          <input type="text" class="form-control" name="nama_sk" id="" aria-describedby="" placeholder=" " required>
        </div>
        <div class="form-group">
          <label for="">Kriteria</label>
          <select class="form-select" name="kriteria" required>
            <option value="">Pilih</option>
            @foreach ($kriteria as $k)
                <option value="{{$k->id_kriteria}}">{{$k->nama_kriteria}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
            <label for="">Nilai</label>
            <input type="number" name='nilai' class="form-control" id="" placeholder="">
          </div>
        <button type="submit" class="btn btn-dark mt-3">Simpan</button>
      </form>
@endsection
