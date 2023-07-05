@extends('layouts.master')

@push('custom-css')
@endpush

@section('content')
    <div class="row mb-4">
        <div class="row justify-content-between">
            <div class="col-12">
                <h3 class="display-5">Form Tambah Krtieria</h3>
            </div>
        </div>
    </div>

    <form method="POST" action="{{route('tambah-kriteria.store')}}">
      @csrf
        <div class="form-group">
          <label for="">Nama Kriteria</label>
          <input type="text" class="form-control" name="nama_kriteria" id="" aria-describedby="" placeholder=" " required>
        </div>
        <div class="form-group">
          <label for="">Jenis</label>
          <select class="form-select" name="jenis" aria-label="Default select example">
            <option selected>Pilih</option>
            <option value="benefit">Benefit</option>
            <option value="cost">Cost</option>
          </select>
        </div>
        {{-- <div class="form-group">
            <label for="">Bobot</label>
            <input type="number" name="bobot" class="form-control" id="" placeholder="">
          </div> --}}
        <button type="submit" class="btn btn-dark mt-3">Simpan</button>
      </form>
@endsection
