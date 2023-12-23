@extends('layouts.template')
@section('content')
    <div class="content bg-light">

        <a href="{{ url('kriteria') }}" type="button" class="btn text-light btn-danger">kembali</a>
        <!-- START FORM -->
        <form action='' method='post'>
            @csrf
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                {{-- <div class="card"> --}}
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="nim" class="col-md-2 col-form-label text-dark">Kriteria</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" disabled value="{{ $data_kriteria->nama_kriteria }}"
                                name='nama_Kriteria'>
                            <input type="text" class="form-control" hidden value="{{ $data_kriteria->id_kriteria }}"
                                name='id_Kriteria'>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nim" class="col-md-2 col-form-label text-dark">Nama Sub Kriteria</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='nama_subKriteria'required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label text-dark">Bobot</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name='bobot' required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10"><button type="submit" class="btn btn-primary">SIMPAN</button></div>

                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </form>
        <!-- AKHIR FORM -->

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <table id="kriteria" class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-4">Nama Sub Kriteria</th>
                        <th class="col-md-1">Bobot</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_subKriteria as $subkriteria)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $subkriteria->nama_subkriteria }}</td>

                            <td>{{ $subkriteria->bobot }}</td>

                            <td>
                                <a href='#' data-toggle="modal"
                                    data-target="#editSubKriteria{{ $subkriteria->id_subkriteria }}"
                                    class="btn btn-warning btn-sm"><span class="material-icons" style="color:white;">edit</span></a>
                                <form
                                    action="{{ url('/kriteria-' . $subkriteria->id_kriteria . '/sub-kriteria/' . $subkriteria->id_subkriteria) }}"
                                    class="d-inline" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        onclick="return confirm('data subkriteria akan terhapus, apakah anda yakin ?')"
                                        class="btn btn-danger btn-sm text-light"><span class="material-icons">delete</span></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- AKHIR DATA -->

    </div>
    @include('subKriteria.editSubKriteria')
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#sub_kriteria').DataTable({
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
