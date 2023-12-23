@extends('layouts.template')
@section('content')
    <div class="content bg-light">

        <!-- START FORM -->
        <form action='' method='post'>
            @csrf
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                {{-- <div class="card"> --}}
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="nim" class="col-md-2 col-form-label text-dark">Kode Kriteria</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name='kode_kriteria' required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nim" class="col-md-2 col-form-label text-dark">Nama Kriteria</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name='nama_kriteria'required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label text-dark">Jenis Kriteria</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="jenis" required>
                                    <option value="" disabled selected>Pilih Jenis</option>
                                    <option value="cost">Cost</option>
                                    <option value="benefit">Benefit</option>
                                </select>
                               
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="jurusan" class="col-sm-2 col-form-label text-dark">Bobot</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name='bobot' required>
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
                        <th class="col-md-1">Kode Kriteria</th>
                        <th class="col-md-4">Nama Kriteria</th>
                        <th class="col-md-2">Jenis Kriteria</th>
                        <th class="col-md-1">Bobot</th>
                        <th class="col-md-1">status</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_kriteria as $kriteria)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kriteria->kode_kriteria }}</td>
                        <td>{{ $kriteria->nama_kriteria }}</td>
                        <td>{{ $kriteria->jenis }}</td>
                        <td>{{ $kriteria->bobot }}%</td>
                        <td>{{ $kriteria->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                        <td>
                            <a href='{{ url('/kriteria-'.$kriteria->id_kriteria.'/sub-kriteria') }}' class="btn btn-primary btn-sm"><span class="material-icons" style="color:white;">add</span></a>
                            <a href='#' data-toggle="modal" data-target="#editKriteria{{ $kriteria->id_kriteria }}" class="btn btn-warning btn-sm"><span class="material-icons" style="color:white;">edit</span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- AKHIR DATA -->

    </div>
    @include('kriteria.editKriteria')
@endsection
@push('scripts')

<script>
    $(document).ready(function() {
        $('#kriteria').DataTable({
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
