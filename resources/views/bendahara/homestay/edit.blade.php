@foreach ($penginapans as $penginapan )
<div class="modal fade" id="ModalEditpenginapan-{{ $penginapan->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form action="{{ route('homestay.update', $penginapan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="card-header p-0 position-relative mt-n4 mx-3 mb-5 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3 modal-title">Edit Data Penginapan</h6>
            </div>
          </div>
          <div class="modal-body">
            @foreach(['nama_penginapan', 'deskripsi', 'fasilitas'] as $field)
              <div class="mb-3 row">
                <label for="{{ $field }}" class="col-sm-2 col-form-label">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-soft" name="{{ $field }}" id="{{ $field }}" value="{{ $penginapan->$field }}" required>
                </div>
              </div>
            @endforeach
          </div>
          <div class="col-md-12 mb-3">
            <label>Foto 1</label>
            <input type="file" name="foto1" class="form-control input-soft">
            @if($penginapan->foto1)
            <img src="{{ asset('storage/' . $penginapan->foto1) }}" class="img-thumbnail mt-2" width="100">
            @endif
          </div>
          <div class="col-md-12 mb-3">
            <label>Foto 2</label>
            <input type="file" name="foto1" class="form-control input-soft">
            @if($penginapan->foto2)
            <img src="{{ asset('storage/' . $penginapan->foto2) }}" class="img-thumbnail mt-2" width="100">
            @endif
          </div>
          <div class="col-md-12 mb-3">
            <label>Foto 3</label>
            <input type="file" name="foto1" class="form-control input-soft">
            @if($penginapan->foto3)
            <img src="{{ asset('storage/' . $penginapan->foto3) }}" class="img-thumbnail mt-2" width="100">
            @endif
          </div>
          <div class="col-md-12 mb-3">
            <label>Foto 4</label>
            <input type="file" name="foto1" class="form-control input-soft">
            @if($penginapan->foto4)
            <img src="{{ asset('storage/' . $penginapan->foto4) }}" class="img-thumbnail mt-2" width="100">
            @endif
          </div>
          <div class="col-md-12 mb-3">
            <label>Foto 5</label>
            <input type="file" name="foto1" class="form-control input-soft">
            @if($penginapan->foto5)
            <img src="{{ asset('storage/' . $penginapan->foto5) }}" class="img-thumbnail mt-2" width="100">
            @endif
          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

@endforeach

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Penginapan ini akan dihapus!",
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