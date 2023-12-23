@extends('layouts.template')
@section('content')
    <div class="content">
        @if ($errors->any())
            <div class="alert alert-danger  d-flex justify-content-start" style="color:#fff;">
                <!-- Icon Close Bootstrap -->
                <div class="row">
                    <button type="button" class="btn-close col-4 mx-2" data-bs-dismiss="alert" aria-label="Close"></button>
                    <ul class="col-12 mx-5 mt-n4">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach

                    </ul>
                </div>
            </div>
        @endif
        <!-- START FORM -->
        <form method="post" action="">
            {{ csrf_field('') }}
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <div class="mb-3 row">
                    <label for="namaLengkap" class="col-sm-2 col-form-label">Nama Admin</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_lengkap" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password2" class="col-sm-2 col-form-label">Password Confirmation</label>
                    <div class="col-sm-10">
                        <input type="password" id="password2" class="form-control" name="password_confirmation" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jurusan" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">simpan</button>
                    </div>
                </div>
        </form>
    </div>
    <!-- AKHIR FORM -->

    <!-- START DATA -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- FORM PENCARIAN -->

        <!-- TOMBOL TAMBAH DATA -->
        <!-- <div class="pb-3">
                                              <a href='' class="btn btn-primary">+ Tambah Data</a>
                                            </div> -->

        <table id="user" class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-3">Nama Admin</th>
                    <th class="col-md-4">Username</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nama_lengkap }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <form action="{{ url('/admin/' . $user->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('data admin akan terhapus, apakah anda yakin ?')"><span
                                        class="material-icons">delete</span></button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <!-- AKHIR DATA -->
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#user').DataTable({
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
