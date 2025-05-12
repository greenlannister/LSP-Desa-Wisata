<form action="{{ route('news.manage') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="ModalBerita" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="card-header p-0 position-relative mt-n4 mx-3 mb-5 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3 modal-title">Tambahkan Berita Baru</h6>
                    </div>
                </div>
  
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="mb-3 row" >
                        <label for="judul" class="col-sm-2 col-form-label">Judul&nbsp;Berita</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-soft" name="judul" id="judul" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="berita" class="col-sm-2 col-form-label">Berita</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control  input-soft" name="berita" id="berita" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tanggal_post" class="col-sm-2 col-form-label">Tanggal Post</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control input-soft" name="tanggal_post" id="tanggal_post" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="id_kategori_berita" class="col-sm-2 col-form-label">Pilih Kategori</label>
                        <div class="col-sm-10">
                            <select class="form-control input-soft" name="id_kategori_berita" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori_beritas as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->kategori_berita }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                  <div class="mb-3 row">
                      <div class="mb-3 row">
                          <label for="foto" class="col-sm-2 col-form-label">Foto 1</label>
                          <div class="col-sm-10  input-soft">
                              <input type="file" class="form-control" name="foto1" id="foto1">
                          </div>
                      </div>
                      <div class="mb-3 row">
                        <label for="foto" class="col-sm-2 col-form-label">Foto 1</label>
                        <div class="col-sm-10  input-soft">
                            <input type="file" class="form-control" name="foto2" id="foto2">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="foto" class="col-sm-2 col-form-label">Foto 1</label>
                        <div class="col-sm-10  input-soft">
                            <input type="file" class="form-control" name="foto3" id="foto3">
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