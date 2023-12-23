@extends('layouts.template')
@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h4>{{ $date->format('F Y') }}</h4>
            </div>
            <div class="card-body">
                <form action="" method="GET">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-2">
                            <select class="form-control" name="month" required>
                                <option value="" selected disabled>Pilih Bulan</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <select class="form-control" name="year" required>
                                <option value="" selected disabled>Pilih tahun</option>
                                @php
                                    $currentYear = date('Y');
                                    $startYear = $currentYear - 5; // Tahun awal untuk loop
                                @endphp

                                @for ($year = $currentYear; $year >= $startYear; $year--)
                                    <option value="{{ $year }}">
                                        {{ $year }}</option>
                                @endfor

                            </select>
                        </div>
                        <div class="col-2">
                            {{-- <div class="d-flex justify-content-end"> --}}
                            <button type="submit" class="btn btn-info mt-1">Filter</button>
                            {{-- </div> --}}
                        </div>
                    </div>
                </form>
                <table id="laporan" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">Kode Kapal</th>
                            <th class="col-md-3">Nama Kapal</th>
                            <th class="col-md-4">Rata rata</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($hasil))
                            @foreach ($hasil as $hasilItem)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $hasilItem['nama'] }}</td>
                                    <td>{{ $hasilItem['rata_rata'] }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total Kuisoner</td>
                            <th>{{ $jumlah_kuesioner }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#laporan').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    text: 'Export ke Excel',
                        extend: 'excel',
                        className: 'btn btn-primary',
                    },
                    {
                        text: 'Export ke PDF',
                        extend: 'pdf',
                        className: 'btn btn-primary',
                    }
                ]
            });


        });
    </script>
@endpush
