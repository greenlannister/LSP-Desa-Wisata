<form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <!-- Modal -->
  <div class="modal fade" id="ModalUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <!-- Modal Header -->
              <div class="card-header p-0 position-relative mt-n4 mx-3 mb-5 z-index-2">
                  <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                      <h6 class="text-white text-capitalize ps-3 modal-title">Masukkan Data Karyawan</h6>
                  </div>
              </div>

              <!-- Modal Body -->
              <div class="modal-body">
                  <div class="mb-3 row" >
                      <label for="nama_karyawan" class="col-sm-2 col-form-label">Nama&nbsp;Karyawan</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control input-soft" name="nama_karyawan" id="nama_karyawan" required>
                      </div>
                  </div>
                  <div class="mb-3 row">
                      <label for="email" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                          <input type="email" class="form-control  input-soft" name="email" id="email" required>
                      </div>
                  </div>
                  <div class="mb-3 row">
                      <label for="password" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                          <input type="password" class="form-control input-soft" name="password" id="password" min="3"  required>
                      </div>
                  </div>
                  <div class="mb-3 row">
                      <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                      <div class="col-sm-10">
                          <textarea class="form-control input-soft" name="alamat" id="alamat" required></textarea>
                      </div>
                  </div>
                  <div class="mb-3 row">
                      <label for="no_hp" class="col-sm-2 col-form-label">Nomor HP</label>
                      <div class="col-sm-10">
                          <input type="tel" class="form-control input-soft" name="no_hp" id="no_hp" required>
                      </div>
                  </div>
                    <div class="mb-3 row" >
                        <label class="col-sm-2 col-form-label">Level</label>
                        <div class="col-sm-10 input-soft">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="level" id="level_admin" value="admin" required>
                                <label class="form-check-label" for="level_admin">Admin</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="level" id="level_pemilik" value="pemilik" required>
                                <label class="form-check-label" for="level_pemilik">Pemilik</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="level" id="level_bendahara" value="bendahara" required>
                                <label class="form-check-label" for="level_bendahara">Bendahara</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10 input-soft">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_aktif" value="aktif" checked required>
                                <label class="form-check-label" for="status_aktif">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_banned" value="banned">
                                <label class="form-check-label" for="status_banned">Banned</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10  input-soft">
                            <input type="file" class="form-control" name="foto_karyawan" id="foto_karyawan">
                        </div>
                    </div>
                </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
          </div>
      </div>
  </div>
</form>

<script>
     @if(Session::has('swal'))
        Swal.fire({
            title: "{{ Session::get('swal.title') }}",
            text: "{{ Session::get('swal.text') }}",
            icon: "{{ Session::get('swal.icon') }}",
            draggable: {{ Session::get('swal.draggable', 'false') }}
        });
    @endif
</script>