@extends('layouts.template')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-title">Dashboard</h5>
                        <p class="card-category">Menampilkan Beberapa Urutan Kapal Dengan Layanan Terbaik</p>
                    </div>
                    <div class="card-body">
                        <canvas id="speedChart" width="200" height="100"></canvas>
                    </div>
                    <div class="card-footer">
                        <hr />
                        <div class="card-stats">
                            <i class="fa fa-check"></i> Total Keseluruhan Data Kuesioner
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var dataArray = @json($hasil);

            var labels = [];
            var data = [];

            // Loop through the dataArray and extract "nama" as labels and "rata_rata" as data
            for (var maskapai in dataArray) {
                if (dataArray.hasOwnProperty(maskapai)) {
                    labels.push(dataArray[maskapai]['nama']);
                    data.push(dataArray[maskapai]['rata_rata']);
                }
            }

            var dataset = {
                label: labels,
                data: data
            };

            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages(dataset);
        });
    </script>
@endpush
