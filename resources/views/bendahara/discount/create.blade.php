<!-- resources/views/admin/diskon/modal-create.blade.php -->
<form action="{{ route('diskon.management') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="ModalDiskon" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="card-header p-0 position-relative mt-n4 mx-3 mb-5 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3 modal-title">Tambah Diskon Baru</h6>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="kode_diskon" class="col-sm-3 col-form-label">Kode Diskon</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kode_diskon" id="kode_diskon" required>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="nama_diskon" class="col-sm-3 col-form-label">Nama Diskon</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_diskon" id="nama_diskon" required>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="persentase_diskon" class="col-sm-3 col-form-label">Persentase Diskon (%)</label>
                        <div class="col-sm-9">
                            <input type="number" step="0.01" class="form-control" name="persentase_diskon" id="persentase_diskon" min="0" max="100" required>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="tanggal_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" required>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="tanggal_berakhir" class="col-sm-3 col-form-label">Tanggal Berakhir</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="tanggal_berakhir" id="tanggal_berakhir" required>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="foto" class="col-sm-3 col-form-label">Foto Diskon</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"></textarea>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="aktif" class="col-sm-3 col-form-label">Status Aktif</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="aktif" id="aktif" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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