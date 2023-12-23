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
                            <label for="nim" class="col-md-2 col-form-label text-dark">Nama Kapal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name='nama_maskapai' required>
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
                        <th class="col-md-1">Kode Kapal</th>
                        <th class="col-md-1">Nama Kapal</th>
                        <th class="col-md-1">status</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maskapai as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_maskapai }}</td>
                        <td>{{ $data->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                        <td>
                            <a href='#' data-toggle="modal" data-target="#editMaskapai{{ $data->id_maskapai }}" class="btn btn-warning btn-sm"><span class="material-icons" style="color:white;">edit</span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- AKHIR DATA -->

    </div>
    @include('maskapai.editMaskapai')
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
