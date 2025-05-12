@foreach($beritas as $berita)
<div class="modal fade" id="ModalBerdit-{{ $berita->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Judul</label>
                            <input type="text" name="judul" value="{{ $berita->judul }}" class="form-control input-soft" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Kategori</label>
                            <select class="form-control input-soft" name="id_kategori_berita" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori_beritas as $kategori)
                                    <option value="{{ $kategori->id }}" {{ $berita->id_kategori_berita == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->kategori_berita }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Berita</label>
                            <textarea name="berita" class="form-control input-soft" required>{{ $berita->berita }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tanggal Post</label>
                            <input type="date" name="tanggal_post" value="{{ $berita->tanggal_post->format('Y-m-d') }}" class="form-control input-soft" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Foto 1</label>
                            <input type="file" name="foto1" class="form-control input-soft">
                            @if($berita->foto1)
                                <img src="{{ asset('storage/' . $berita->foto1) }}" class="img-thumbnail mt-2" width="100">
                                <input type="hidden" name="foto1_lama" value="{{ $berita->foto1 }}">
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Foto 2</label>
                            <input type="file" name="foto2" class="form-control input-soft">
                            @if($berita->foto2)
                                <img src="{{ asset('storage/' . $berita->foto2) }}" class="img-thumbnail mt-2" width="100">
                                <input type="hidden" name="foto2_lama" value="{{ $berita->foto2 }}">
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Foto 3</label>
                            <input type="file" name="foto3" class="form-control input-soft">
                            @if($berita->foto3)
                                <img src="{{ asset('storage/' . $berita->foto3) }}" class="img-thumbnail mt-2" width="100">
                                <input type="hidden" name="foto3_lama" value="{{ $berita->foto3 }}">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach