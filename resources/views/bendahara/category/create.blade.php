<form action="{{ route('katwis.management') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Modal -->
    <div class="modal fade" id="ModalKatWis" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="card-header p-0 position-relative mt-n4 mx-3 mb-5 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3 modal-title">Buat kategori wisata terbaru</h6>
                    </div>
                </div>
  
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="mb-3 row" >
                        <label for="kategori_wisata" class="col-sm-2 col-form-label">Kategori&nbsp;Wisata</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-soft" name="kategori_wisata" id="kategori_wisata" required>
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