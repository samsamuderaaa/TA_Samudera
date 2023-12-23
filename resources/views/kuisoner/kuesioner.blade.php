@extends('layouts.template')
@section('content')
    <div class="content">

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <button class="btn btn-primary mb-5" data-toggle="modal" data-target="#qrCodeModal">Buat Qr Code</button>
            <!-- Modal for displaying the QR code -->
            <div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="qrCodeModalLabel">QR Code</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row mx-3">
                                <input type="text" class="form-control" placeholder="Masukkan Alamat Ip" id="qrText">
                                <div class="text-center mt-4">
                                    <div id="loading" style="display: none;">
                                        <p>Loading...</p>
                                    </div>
                                    <div id="imgBox">
                                        <img src="" id="qrImage">
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-5" onclick="generateQR()">Generate</button>

                                <button class="btn btn-success mt-3" id="downloadLink" style="display: none;"
                                    onclick="downloadQR()">Download QR</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FORM PENCARIAN -->

            <table id="kuisoner" class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">Nomor Identitas</th>
                        <th class="col-md-4">Nama Pelanggan</th>
                        <th class="col-md-2">Jenis Kelamin</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_kuisoner as $kuisoner)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kuisoner->nomor_identitas }}</td>
                            <td>{{ $kuisoner->nama }}</td>
                            <td>{{ $kuisoner->jenis_kelamin }}</td>
                            <td>
                                <a href='{{ url('kuesioner/' . $kuisoner->id_kuisoner) }}' class="btn btn-info btn-sm"><span
                                        class="material-icons">menu</span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- AKHIR DATA -->
    </div>
@endsection
@push('scripts')
    <script>
        let imgBox = document.getElementById('imgBox');
        let qrImage = document.getElementById('qrImage');
        let qrText = document.getElementById('qrText');

        function generateQR() {
            // Tampilkan elemen loading
            loading.style.display = 'block';

            // Sembunyikan gambar QR code sebelumnya
            qrImage.style.display = 'none';

            qrImage.src = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" + qrText.value +
                ":8000/kuesioner";
            qrImage.onload = function() {
                loading.style.display = 'none';
                qrImage.style.display = 'block';
                qrImage.classList.add('text-center', 'mx-auto');
            };
            document.getElementById('downloadLink').style.display = 'block';
        }

        function downloadQR() {
            // Mengambil data gambar dari elemen img
            let imageDataUrl = qrImage.src;

            // Membuat Blob dari data gambar
            fetch(imageDataUrl)
                .then(response => response.blob())
                .then(blob => {
                    // Membuat URL objek dari Blob
                    let url = URL.createObjectURL(blob);

                    // Membuat elemen <a> untuk men-download gambar
                    let a = document.createElement('a');
                    a.href = url;
                    a.download = 'qr_code.png';

                    // Menjalankan klik pada elemen <a> secara otomatis
                    document.body.appendChild(a);
                    a.click();

                    // Menghapus elemen <a> setelah proses unduhan selesai
                    window.URL.revokeObjectURL(url);
                    document.body.removeChild(a);
                })
                .catch(error => {
                    console.error('Error downloading QR code: ', error);
                });
        }
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
