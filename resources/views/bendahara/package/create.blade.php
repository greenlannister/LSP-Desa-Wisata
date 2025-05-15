<form action="{{ route('paket.management') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="ModalPaket" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="card-header p-0 position-relative mt-n4 mx-3 mb-5 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3 modal-title">Tambahkan Paket Baru</h6>
                    </div>
                </div>
  
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="mb-3 row" >
                        <label for="nama_paket" class="col-sm-2 col-form-label">Nama&nbsp;Paket</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-soft" name="nama_paket" id="nama_paket" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control  input-soft" name="deskripsi" id="deskripsi" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fasilitas" class="col-sm-2 col-form-label">Fasilitas</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control  input-soft" name="fasilitas" id="fasilitas" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="harga_per_pack" class="col-sm-2 col-form-label">Harga Per Pack</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control input-soft" name="harga_per_pack" id="harga_per_pack" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="max_kapasitas" class="col-sm-2 col-form-label">Maximum Kapasitas</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control input-soft" name="max_kapasitas" id="max_kapasitas" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                          <label for="foto1" class="col-sm-2 col-form-label">Foto 1</label>
                          <div class="col-sm-10  input-soft">
                              <input type="file" class="form-control" name="foto1" id="foto1">
                          </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="foto2" class="col-sm-2 col-form-label">Foto 2</label>
                        <div class="col-sm-10  input-soft">
                            <input type="file" class="form-control" name="foto2" id="foto2">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="foto3" class="col-sm-2 col-form-label">Foto 3</label>
                        <div class="col-sm-10  input-soft">
                            <input type="file" class="form-control" name="foto3" id="foto3">
                        </div>
                    </div>
                    <div class="mb-3 row">
                            <label for="foto4" class="col-sm-2 col-form-label">Foto 4</label>
                            <div class="col-sm-10  input-soft">
                                <input type="file" class="form-control" name="foto4" id="foto4">
                            </div>
                    </div>
                    <div class="mb-3 row">
                          <label for="foto5" class="col-sm-2 col-form-label">Foto 5</label>
                          <div class="col-sm-10  input-soft">
                              <input type="file" class="form-control" name="foto5" id="foto5">
                          </div>
                    </div>
                    <div class="mb-3 row">
                          <label for="foto6" class="col-sm-2 col-form-label">Foto 6</label>
                          <div class="col-sm-10  input-soft">
                              <input type="file" class="form-control" name="foto6" id="foto6">
                          </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="foto7" class="col-sm-2 col-form-label">Foto 7</label>
                        <div class="col-sm-10  input-soft">
                            <input type="file" class="form-control" name="foto7" id="foto7">
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