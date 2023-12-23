@extends('layouts.template')
@section('content')
    <div class="content">

        <div class="row">
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <!-- FORM PENCARIAN -->
                <label for="analisa" class="text-black fs-4 font-weight-bold">Hasil Analisa</label>
                <div class="table-responsive">
                    <table id="analisa" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col-md-1" rowspan="2">No</th>
                                <th class="col-md-1" rowspan="2">Nama Kapal</th>
                                <th class="col-md-1">#</th>
                                @foreach ($data_kriteria as $kriteria)
                                    <th class="col-md-1">{{ $kriteria->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                            <tr>
                                <th class="col-md-1">kode kriteria</th>
                                @foreach ($data_kriteria as $kriteria)
                                    <th class="col-md-1">{{ $kriteria->kode_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($data_kuesioner))
                                @foreach ($data_kuesioner as $kuesioner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kuesioner->nama_maskapai }}</td>
                                        <td>A{{ $loop->iteration }}</td>
                                        @foreach ($kuesioner->penilaian as $nilai)
                                            <td>{{ $nilai->sub_kriteria->bobot }}</td>
                                        @endforeach
                                        <!-- Menambah kolom 0 jika jumlah kolom tidak sesuai -->
                                        @for ($i = count($kuesioner->penilaian); $i < count($data_kriteria); $i++)
                                            <td>0</td>
                                        @endfor
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <!-- FORM PENCARIAN -->
                <label for="normalisasi" class="text-black fs-4 font-weight-bold">Hasil Normalisasi</label>
                <div class="table-responsive">

                    <table id="normalisasi" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col-md-1" rowspan="2">No</th>
                                <th class="col-md-1">#</th>
                                @foreach ($data_kriteria as $kriteria)
                                    <th class="col-md-1">{{ $kriteria->kode_kriteria }}</th>
                                @endforeach
                            </tr>
                            <tr>
                                <th class="col-md-1">Bobot</th>
                                @foreach ($data_kriteria as $kriteria)
                                    <th class="col-md-1">{{ $kriteria->bobot }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($data_kuesioner))
                                @foreach ($transpose_normalisasi as $normalisasi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>A{{ $loop->iteration }}</td>
                                        @foreach ($normalisasi as $value)
                                            <td>{{ $value }}</td>
                                        @endforeach
    
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <!-- FORM PENCARIAN -->
                <label for="perhitungan" class="text-black fs-4 font-weight-bold">Hasil Perhitungan</label>
                <div class="table-responsive">
                    <table id="perhitungan" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col-md-1" rowspan="2">No</th>
                                <th class="col-md-1">#</th>
                                @foreach ($data_kriteria as $kriteria)
                                    <th class="col-md-1">{{ $kriteria->kode_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($data_kuesioner))
                                @foreach ($transpose_bobot_nilai as $bobot_nilai)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>A{{ $loop->iteration }}</td>
                                        @foreach ($bobot_nilai as $value)
                                            <td>{{ $value }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#analisa').DataTable({
                "language": {
                    "paginate": {
                        "previous": "<",
                        "next": ">"
                    }
                }
            });
            $('#normalisasi').DataTable({
                "language": {
                    "paginate": {
                        "previous": "<",
                        "next": ">"
                    }
                }
            });
            $('#perhitungan').DataTable({
                "language": {
                    "paginate": {
                        "previous": "<",
                        "next": ">"
                    }
                }
            });
        });
    </script>
@endpush
