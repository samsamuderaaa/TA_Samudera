@foreach ($data_subKriteria as $subKriteria)
    <div class="modal fade" id="editSubKriteria{{ $subKriteria->id_subkriteria }}" tabindex="-1" aria-labelledby="editSubKriteriaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kriteria</h5>
                </div>
                <form action="{{ url('/kriteria-'.$data_kriteria->id_kriteria.'/sub-kriteria/'.$subKriteria->id_subkriteria) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode Kriteria</label>
                            <input type="text" id="kode_kriteria"
                                class="form-control @error('kode') is-invalid @enderror" value="{{ $subKriteria->nama_subkriteria }}" name="nama_subkriteria"
                                placeholder="Kode Kriteria">
                            @error('kode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Bobot</label>
                            <input type="number" id="bobot_kriteria"
                                class="form-control" value="{{ $subKriteria->bobot }}" name="bobot" min="1"
                                placeholder="0">
                            @error('bobot')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-warning">Edit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
