@extends('layouts.template')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 mt-5">
                @if ($errors->any())
                    <div class="alert alert-danger  d-flex justify-content-start" style="color:#fff;">
                        <!-- Icon Close Bootstrap -->
                        <div class="row">
                            <button type="button" class="btn-close col-4 mx-2" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            <ul class="col-12 mx-5 mt-n4">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Kuisoner</h4>
                    </div>
                    <div class="card-body my-3 p-3 px-5 bg-body rounded">
                        {{-- <div class="table-responsive"> --}}
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Nomor Identitas</td>
                                    <td>{{ $data_kuisoner->nomor_identitas }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $data_kuisoner->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>{{ $data_kuisoner->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Kapal</td>
                                    <td>{{ $data_kuisoner->maskapai }}</td>
                                </tr>
                                <tr>
                                    <td>Foto Tiket</td>
                                    <td>
                                        <div style="height:100px; width:100px">
                                            <img id="image" src="{{ url($data_kuisoner->path_photo) }}"
                                                alt="foto_tiket">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Kriteria</th>
                                        <th>Kriteria</th>
                                        <th>Jawaban</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_kuisoner->penilaian as $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value->kode_kriteria }}</td>
                                            <td>{{ $value->nama_kriteria }}</td>
                                            <td>{{ $value->nama_subkriteria }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/data-kuesioner') }}" class="btn btn-danger">Kembali</a>
            </div>
        </div>
        <div class="modal fade" id="ticket_image" tabindex="-1" aria-labelledby="ticket_imageLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="{{ url($data_kuisoner->path_photo) }}" alt="foto_tiket">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        /* CSS untuk modal */
        

        #ticket_image .modal-content {
            background: transparent;
            
            border: none;
        }

        #ticket_image .modal-body img {
            width: 100%;
            height: auto;
        }
    </style>
@endpush
@push('scripts')
    <script>
        var image = document.getElementById("image");
        var modal = new bootstrap.Modal(document.getElementById('ticket_image'));

        // Menambahkan event listener untuk klik pada gambar
        image.addEventListener("click", function() {
            // Menampilkan modal
            modal.show();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#kuisoner').DataTable({
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
