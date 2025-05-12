@foreach($karyawans as $karyawan)
<div class="modal fade" id="ModalEdit-{{ $karyawan->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('admin.user.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Karyawan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label>Nama Karyawan</label>
              <input type="text" name="nama_karyawan" value="{{ $karyawan->nama_karyawan }}" class="form-control input-soft" required>
            </div>
            <div class="col-md-6 mb-3">
              <label>Email</label>
              <input type="email" name="email" value="{{ $karyawan->user->email }}" class="form-control input-soft" required>
            </div>
            <div class="col-md-6 mb-3">
              <label>Alamat</label>
              <input type="text" name="alamat" value="{{ $karyawan->alamat }}" class="form-control input-soft" required>
            </div>
            <div class="col-md-6 mb-3">
              <label>Nomor HP</label>
              <input type="text" name="no_hp" value="{{ $karyawan->no_hp }}" class="form-control input-soft" required>
            </div>
            <div class="col-md-6 mb-3">
              <label>Level</label>
              <select name="level" class="form-control input-soft">
                <option value="admin" {{ $karyawan->user->level == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="pemilik" {{ $karyawan->user->level == 'pemilik' ? 'selected' : '' }}>Pemilik</option>
                <option value="bendahara" {{ $karyawan->user->level == 'bendahara' ? 'selected' : '' }}>Bendahara</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label>Status</label>
              <select name="status" class="form-control input-soft">
                  <option value="aktif" {{ $karyawan->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                  <option value="banned" {{ $karyawan->status == 'banned' ? 'selected' : '' }}>Banned</option>
              </select>
            </div>
            <div class="col-md-12 mb-3">
              <label>Foto Karyawan</label>
              <input type="file" name="foto_karyawan" class="form-control input-soft">
              @if($karyawan->foto_karyawan)
              <img src="{{ asset('storage/' . $karyawan->foto_karyawan) }}" class="img-thumbnail mt-2" width="100">
              @endif
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
function confirmBan(userId) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Anda akan membanned akun ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, banned!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                // Lakukan AJAX atau form submit untuk banned
                // Contoh dengan form:
                document.getElementById('ban-form-'+userId).submit();
            }
        });
    }
</script>
@endforeach