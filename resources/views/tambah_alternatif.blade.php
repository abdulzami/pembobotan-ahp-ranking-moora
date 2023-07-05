@extends('layouts.master')

@push('custom-css')
@endpush

@section('content')
    <div class="row mb-4">
        <div class="row justify-content-between">
            <div class="col-12">
                <h3 class="display-5">Form Tambah Alternatif</h3>
            </div>
        </div>
    </div>

    <form method="POST" action="{{route('tambah-alternatif.store')}}">
      @csrf
        <div class="form-group">
          <label for="">Nama Alternatif</label>
          <input type="text" class="form-control" name="nama" id="" aria-describedby="" placeholder=" " required>
        </div>
        <button type="submit" class="btn btn-dark mt-3">Simpan</button>
      </form>
@endsection
