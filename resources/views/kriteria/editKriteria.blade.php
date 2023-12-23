@foreach ($data_kriteria as $kriteria)
    <div class="modal fade" id="editKriteria{{ $kriteria->id_kriteria }}" tabindex="-1" aria-labelledby="editKriteriaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kriteria</h5>
                </div>
                <form action="{{ url('/kriteria/'.$kriteria->id_kriteria) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id_kriteria" name="id">
                        <div class="form-group">
                            <label>Kode Kriteria</label>
                            <input type="text" id="kode_kriteria"
                                class="form-control @error('kode') is-invalid @enderror" value="{{ $kriteria->kode_kriteria }}" name="kode_kriteria"
                                placeholder="Kode Kriteria" readonly>
                            @error('kode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Kriteria</label>
                            <input type="text" id="nama_kriteria"
                                class="form-control @error('nama') is-invalid @enderror" value="{{ $kriteria->nama_kriteria }}" name="nama_kriteria"
                                placeholder="Nama Kriteria">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Atribut</label>
                            <select name="jenis" id="select_atribut"
                                class="form-control pt-2">
                                <option value="" disabled>Pilih Jenis</option>
                                <option value="benefit" {{ $kriteria->jenis == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                <option value="cost"{{ $kriteria->jenis == 'cost' ? 'selected' : '' }}>Cost</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bobot</label>
                            <input type="number" id="bobot_kriteria"
                                class="form-control" value="{{ $kriteria->bobot }}" name="bobot" min="1"
                                placeholder="0">
                            @error('bobot')
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
                                <option value="1" {{ $kriteria->status == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0"{{ $kriteria->status == '0' ? 'selected' : '' }}>Tidak Aktif</option>
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
