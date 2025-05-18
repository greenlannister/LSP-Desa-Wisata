<div id="discount" class="filter">
  <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <div class="section-title">DISCOUNTS</div>
              <h2>Special Discounts for an Unforgettable Journey!</h2>
          </div> <!-- end of col -->
      </div> <!-- end of row -->

      <div class="row">
        <div class="col-12 mt-4">
          <div class="row">
          @isset($diskons)
            @foreach($diskons as $diskon)
            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
              <div class="card card-blog card-plain">
                <div class="card-header p-0 m-2">
                  <a class="d-block shadow-xl border-radius-xl">
                    @if($diskon->foto)
                      <img src="{{ asset('storage/' . $diskon->foto) }}" alt="Foto Diskon" class="img-fluid shadow border-radius-lg">
                    @else
                      <img src="{{ asset('/assets/img/home-decor-1.jpg') }}" alt="Default Image" class="img-fluid shadow border-radius-lg">
                    @endif
                  </a>
                </div>
                <div class="card-body p-3">
                  <p class="mb-0 text-sm">{{ $diskon->nama_diskon }}</p>
                  <h5>
                    {{ $diskon->kode_diskon }}
                  </h5>
                  <p class="mb-0 text-sm">{{ $diskon->persentase_diskon }}%</p>
                  <p class="mb-4 text-sm">
                    {{ $diskon->deskripsi }}
                  </p>
                  <div class="d-flex justify-content-between">
                    <span class="text-xs">Mulai: {{ $diskon->tanggal_mulai->format('d M Y') }}</span>
                    <span class="text-xs">Berakhir: {{ $diskon->tanggal_berakhir->format('d M Y') }}</span>
                  </div>
                  <div class="mt-2">
                    <span class="badge badge-sm {{ $diskon->aktif ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                      {{ $diskon->aktif ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          @endisset
          </div>
        </div>
      </div>
  </div>
</div>