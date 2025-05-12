<!-- Modal Edit -->
@foreach($kategoriBeritas as $kategori)
<div class="modal fade" id="ModalKatgorEdit-{{ $kategori->id }}" tabindex="-1" aria-labelledby="ModalEditLabel-{{ $kategori->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Header -->
        <div class="card-header p-0 position-relative mt-n4 mx-3 mb-5 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Edit Kategori Berita</h6>
          </div>
        </div>
  
        <!-- Form -->
        <form action="{{ route('kategori-berita.update', $kategori->id) }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3 row">
              <label for="kategori_berita_{{ $kategori->id }}" class="col-sm-2 col-form-label">Kategori&nbsp;Berita</label>
              <div class="col-sm-10">
                <input type="text" class="form-control input-soft" name="kategori_berita" id="kategori_berita_{{ $kategori->id }}" value="{{ $kategori->kategori_berita }}" required>
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
    @if(Session::has('swal'))
       Swal.fire({
           title: "{{ Session::get('swal.title') }}",
           text: "{{ Session::get('swal.text') }}",
           icon: "{{ Session::get('swal.icon') }}",
           draggable: {{ Session::get('swal.draggable', 'false') }}
       });
   @endif
</script>