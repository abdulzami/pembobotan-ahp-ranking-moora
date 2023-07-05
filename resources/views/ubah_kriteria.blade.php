@extends('layouts.master')

@push('custom-css')
@endpush

@section('content')
    <div class="row mb-4">
        <div class="row justify-content-between">
            <div class="col-12">
                <h3 class="display-5">Form Ubah Krtieria</h3>
            </div>
        </div>
    </div>

    <form action="{{route('ubah-kriteria.update',$kriteria->id_kriteria)}}" method="POST">
      @csrf
      @method('put')
        <div class="form-group">
          <label for="">Nama Kriteria</label>
          <input type="text" value="{{$kriteria->nama_kriteria}}" name="nama_kriteria" class="form-control" id="" aria-describedby="" placeholder=" " required>
        </div>
        <div class="form-group">
          <label for="">Jenis</label>
          <select class="form-select" name="jenis" aria-label="Default select example" required>
            <option selected value="">Pilih</option>
            <option value="benefit" {{$kriteria->jenis == 'benefit'?'selected':''}}>Benefit</option>
            <option value="cost" {{$kriteria->jenis == 'cost'?'selected':''}} >Cost</option>
          </select>
        </div>
        {{-- <div class="form-group">
            <label for="">Bobot</label>
            <input type="number" value="{{$kriteria->bobot}}" name="bobot" class="form-control" id="" placeholder="">
          </div> --}}
        <button type="submit" class="btn btn-dark mt-3">Simpan</button>
      </form>
@endsection
