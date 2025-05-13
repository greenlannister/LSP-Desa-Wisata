<!-- resources/views/admin/diskon/modal-edit.blade.php -->
@foreach($diskons as $diskon)
<div class="modal fade" id="ModalDiskonEdit-{{ $diskon->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('diskon.update', $diskon->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Diskon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Kode Diskon</label>
                            <input type="text" name="kode_diskon" value="{{ $diskon->kode_diskon }}" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Nama Diskon</label>
                            <input type="text" name="nama_diskon" value="{{ $diskon->nama_diskon }}" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Persentase Diskon (%)</label>
                            <input type="number" step="0.01" name="persentase_diskon" value="{{ $diskon->persentase_diskon }}" class="form-control" min="0" max="100" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select class="form-control" name="aktif" required>
                                <option value="1" {{ $diskon->aktif ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ !$diskon->aktif ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" value="{{ $diskon->tanggal_mulai->format('Y-m-d') }}" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tanggal Berakhir</label>
                            <input type="date" name="tanggal_berakhir" value="{{ $diskon->tanggal_berakhir->format('Y-m-d') }}" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Foto Diskon</label>
                            <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                            @if($diskon->foto)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/diskons/' . $diskon->foto) }}" alt="Foto Diskon" style="max-width: 200px;">
                                    <small class="d-block">Foto saat ini</small>
                                </div>
                            @endif
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3">{{ $diskon->deskripsi }}</textarea>
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