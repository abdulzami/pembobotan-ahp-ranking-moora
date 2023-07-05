@extends('layouts.master')

@push('custom-css')
@endpush

@section('content')
    <div class="row mb-4">
        <div class="row justify-content-between">
            <div class="col-12">
                <h3 class="display-5">Form Ubah Penilaian</h3>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('ubah-penilaian.update',$id) }}">
        @csrf
        @method('put')
        @foreach ($kriteria as $k)
            <div class="form-group">
                <label for="">{{ $k->nama_kriteria }}</label>
                @if ($k->sk == 'null')
                    <input type="text" class="form-control" value="{{$k->nilai}}" name="{{$k->id_kriteria}}" id="" aria-describedby="" placeholder=" " required>
                @else
                    <select class="form-select" name="{{$k->id_kriteria}}" required>
                        <option value="">Pilih</option>
                        @foreach ($k->sk as $sk)
                            <option value="{{ $sk->nilai }}" {{$k->nilai == $sk->nilai?'selected':''}}>{{ $sk->nama_sk }} = {{$sk->nilai}}</option>
                        @endforeach
                    </select>
                @endif
            </div>
        @endforeach

        <button type="submit" class="btn btn-dark mt-3">Simpan</button>
    </form>
@endsection
