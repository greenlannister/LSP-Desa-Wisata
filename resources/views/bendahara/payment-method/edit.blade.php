<!-- Modal Edit -->
@foreach($jenisPembayarans as $method)
<div class="modal fade" id="ModalPaymentEdit-{{ $method->id }}" tabindex="-1" aria-labelledby="ModalEditLabel-{{ $method->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Header -->
        <div class="card-header p-0 position-relative mt-n4 mx-3 mb-5 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Edit Jenis Pembayaran</h6>
          </div>
        </div>
  
        <!-- Form -->
        <form action="{{ route('jenis-pembayaran.update', $method->id) }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3 row">
              <label for="jenis_pembayaran_{{ $method->id }}" class="col-sm-2 col-form-label">Jenis&nbsp;Pembayara</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-soft" name="jenis_pembayaran" id="jenis_pembayaran_{{ $method->id }}" value="{{ $method->jenis_pembayaran }}" required>
              </div>
            </div>
            <div class="mb-3 row">
                <label for="nomor_tf_{{ $method->id }}" class="col-sm-2 col-form-label">Nomor rek</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control input-soft" name="nomor_tf" id="nomor_tf_{{ $method->id }}" value="{{ $method->nomor_tf }}" required>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label>Foto</label>
                <input type="file" name="foto" class="form-control input-soft">
                @if($method->foto)
                <img src="{{ asset('storage/' . $method->foto) }}" class="img-thumbnail mt-2" width="100">
                @endif
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