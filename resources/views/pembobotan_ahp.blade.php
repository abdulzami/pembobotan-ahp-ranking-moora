@extends('layouts.master')

@push('custom-css')
@endpush

@section('content')
    <div class="row mb-4">
        <div class="row justify-content-between">
            <div class="col-4">
                <h3 class="display-5">Pembobotan AHP</h3>
            </div>
        </div>
    </div>
    <form method="POST">
        @csrf
        <table class="table table-borderless">
            <tr>
                <th scope="col">#</th>
                @foreach ($kriteria as $k)
                    <th scope="col">{{ $k->nama_kriteria }}</th>
                @endforeach

            </tr>


            @foreach ($kriteria as $k)
                <tr>
                    <th>{{ $k->nama_kriteria }}</th>
                    @foreach ($k->Perbandingan as $kp)
                        <td>
                            @if ($kp->id_kriteria_1 - $kp->id_kriteria_2 < 0)
                                <select class="form-select selinp"
                                    name="{{ $kp->id_kriteria_1 . ':' . $kp->id_kriteria_2 }}">
                                    @for ($i = 1; $i < 10; $i++)
                                        <option value="{{ $i }}" {{ $kp->nilai == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            @else
                                <input type="number" class="form-control"
                                    value="{{ $kp->id_kriteria_1 == $kp->id_kriteria_2 ? 1 : (string) $kp->nilai }}"
                                    name="{{ $kp->id_kriteria_1 . ':' . $kp->id_kriteria_2 }}" id="" aria-describedby=""
                                    placeholder="" readonly>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
            <tr>
                <th>Total</th>
                @foreach ($kriteria as $k)
                    <td>
                        <div class="total{{ $k->id_kriteria }}">
                            0
                        </div>
                    </td>
                @endforeach
            </tr>
        </table>
        <center><button type="submit" class="btn btn-dark">Generate</button></center>
    </form>
    @if (isset($bobot))
        <div class="card mt-3">
            <h5 class="card-header">Bobot</h5>
            <div class="card-body">
                <p class="card-text">
                <table class="table table-borderless">
                    <tr>
                    <tr>
                        <th class=" text-left p-3">
                            Kriteria
                        </th>
                        <th class=" text-left p-3">
                            Nilai
                        </th>
                    </tr>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($bobot as $bbt)
                        <tr>
                            <td class="p-3">{{ $bbt->Kriteria->nama_kriteria }}</td>
                            <td class="p-3">{{ $bbt->nilai }}</td>
                        </tr>
                        @php
                            $total += $bbt->nilai;
                        @endphp
                    @endforeach
                    <tr>
                        <th>Total</th>
                        <td class="{{ (string) $total == '1' ? 'text-success' : 'text-danger' }} p-3 font-semibold">
                            {{ $total }}</td>
                    </tr>
                    </tr>
                </table>
                </p>
            </div>
        </div>
        <div class="card mt-3">
            <h5 class="card-header">Rasio Konsistensi</h5>
            <div class="card-body">
                <p class="card-text">
                <table class="table table-borderless">
                    <tr>
                        <th class="p-3">λmax </th>
                        <td class="p-3">{{ $lambdaMax }}</td>
                    </tr>
                    <tr>
                        <th class="p-3">CI </th>
                        <td class="p-3">{{ $ci }}</td>
                    </tr>
                    <tr>
                        <th class="p-3">CR </th>
                        <td class="p-3">{{ $cr }}</td>
                    </tr>
                    <tr>
                        <th class="p-3">Hasil</th>
                        @if ($cr < 0.1)
                            <td class="p-3 text-success">Konsisten</td>
                        @else
                            <td class="p-3 text-danger">Tidak Konsisten</td>
                        @endif

                    </tr>
                </table>
                </p>
            </div>
        </div>
    @endif
@endsection

@push('custom-script')
    <script>
        var arr = []
    </script>
    @foreach ($id_k as $ik)
        <script>
            arr.push({{ $ik->id_kriteria }})
        </script>
    @endforeach

    <script>
        var n = {{ $kriteria->count() }}

        function hitunttl(n) {
            for (let i = 0; i < n; i++) {
                let ttl = 0;
                for (let j = 0; j < n; j++) {
                    let nm = '[name="' + arr[j] + ":" + arr[i] + '"]';
                    let kk = $(nm).val();
                    ttl += parseFloat(kk);
                }
                $(".total" + arr[i]).text(ttl);
            }
        }
        hitunttl(n);
        $(".selinp").on('change', function() {
            let name = $(this).attr('name').split(':');
            let nm = name[1] + ':' + name[0];
            $('input[name="' + nm + '"]').val(1 / this.value);
            hitunttl(n);
        });
    </script>
@endpush
