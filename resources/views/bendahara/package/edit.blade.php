@foreach($packageWisatas as $paket)
<div class="modal fade" id="ModalEditPaket-{{ $paket->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('paket-wisata.update', $paket->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Paket Wisata</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Paket Wisata</label>
                            <input type="text" name="nama_paket" value="{{ $paket->nama_paket }}" class="form-control input-soft" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control input-soft" required>{{ $paket->deskripsi }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Fasilitas</label>
                            <textarea name="fasilitas" class="form-control input-soft" required>{{ $paket->fasilitas }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Harga Per Pack</label>
                            <textarea name="harga_per_pack" class="form-control input-soft" required>{{ $paket->harga_per_pack }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Foto 1</label>
                            <input type="file" name="foto1" class="form-control input-soft">
                            @if($paket->foto1)
                                <img src="{{ asset('storage/' . $paket->foto1) }}" class="img-thumbnail mt-2" width="100">
                                <input type="hidden" name="foto1_lama" value="{{ $paket->foto1 }}">
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Foto 2</label>
                            <input type="file" name="foto2" class="form-control input-soft">
                            @if($paket->foto2)
                                <img src="{{ asset('storage/' . $paket->foto2) }}" class="img-thumbnail mt-2" width="100">
                                <input type="hidden" name="foto2_lama" value="{{ $paket->foto2 }}">
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Foto 3</label>
                            <input type="file" name="foto3" class="form-control input-soft">
                            @if($paket->foto3)
                                <img src="{{ asset('storage/' . $paket->foto3) }}" class="img-thumbnail mt-2" width="100">
                                <input type="hidden" name="foto3_lama" value="{{ $paket->foto3 }}">
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Foto 4</label>
                            <input type="file" name="foto4" class="form-control input-soft">
                            @if($paket->foto4)
                                <img src="{{ asset('storage/' . $paket->foto4) }}" class="img-thumbnail mt-2" width="100">
                                <input type="hidden" name="foto4_lama" value="{{ $paket->foto4 }}">
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Foto 5</label>
                            <input type="file" name="foto5" class="form-control input-soft">
                            @if($paket->foto5)
                                <img src="{{ asset('storage/' . $paket->foto5) }}" class="img-thumbnail mt-2" width="100">
                                <input type="hidden" name="foto5_lama" value="{{ $paket->foto5 }}">
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Foto 6</label>
                            <input type="file" name="foto6" class="form-control input-soft">
                            @if($paket->foto6)
                                <img src="{{ asset('storage/' . $paket->foto6) }}" class="img-thumbnail mt-2" width="100">
                                <input type="hidden" name="foto6_lama" value="{{ $paket->foto6 }}">
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Foto 7</label>
                            <input type="file" name="foto7" class="form-control input-soft">
                            @if($paket->foto7)
                                <img src="{{ asset('storage/' . $paket->foto7) }}" class="img-thumbnail mt-2" width="100">
                                <input type="hidden" name="foto7_lama" value="{{ $paket->foto7 }}">
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

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Kategori Wisata ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
    </script>