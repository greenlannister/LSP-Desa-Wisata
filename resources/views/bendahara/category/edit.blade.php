<!-- Modal Edit -->
@foreach($kategoriWisatas as $kategori)
<div class="modal fade" id="ModalKatwisEdit-{{ $kategori->id }}" tabindex="-1" aria-labelledby="ModalEditLabel-{{ $kategori->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Header -->
        <div class="card-header p-0 position-relative mt-n4 mx-3 mb-5 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Edit Kategori Wisata</h6>
          </div>
        </div>
  
        <!-- Form -->
        <form action="{{ route('katwis-wisata.update', $kategori->id) }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3 row">
              <label for="kategori_berita_{{ $kategori->id }}" class="col-sm-2 col-form-label">Kategori&nbsp;Wisata</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-soft" name="kategori_wisata" id="kategori_wisata_{{ $kategori->id }}" value="{{ $kategori->kategori_wisata }}" required>
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