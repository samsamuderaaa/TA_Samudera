@foreach($maskapai as $data)
    <div class="modal fade" id="editMaskapai{{ $data->id_maskapai }}" tabindex="-1" aria-labelledby="editMaskapaiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Nama Kapal</h5>
                </div>
                <form action="{{ url('/maskapai/'.$data->id_maskapai) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        {{-- <input type="hidden" id="id_kriteria" name="id"> --}}
                        <div class="form-group">
                            <label>Nama Maskapai</label>
                            <input type="text" id="nama_maskapai"
                                class="form-control @error('nama') is-invalid @enderror" value="{{ $data->nama_maskapai }}" name="nama_maskapai"
                                placeholder="Nama Kriteria">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="select_atribut"
                                class="form-control pt-2">
                                <option value="" disabled>Pilih status</option>
                                <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0"{{ $data->status == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning">Edit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
