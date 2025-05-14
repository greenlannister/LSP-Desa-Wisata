<div id="obta" class="filter">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">ATTRACTIONS</div>
                <h2>Destinations That Make Danau Toba Unforgettable</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
               <!-- Filter Kategori -->
                <div class="button-group filters-button-group">
                    <a class="button is-checked" data-filter="*">
                        <span>SHOW ALL KATEGORI WISATA</span>
                    </a>
                    @isset($kategori_wisatas)
                        @foreach($kategori_wisatas as $kategori)
                            <a class="button" data-filter=".kategori-{{ $kategori->id }}">
                                <span>{{ $kategori->kategori_wisata }}</span>
                            </a>
                        @endforeach
                    @endisset
                </div>

                <!-- Grid Objek Wisata -->
                <div class="grid">
                    @isset($obtas)
                        @foreach($obtas as $objek)
                        <div class="element-item kategori-{{ $objek->kategori_wisata->id }}">
                            <a class="popup-with-move-anim" href="#wisata-{{ $objek->id }}">
                                <div class="element-item-overlay">
                                    <span>{{ $objek->nama_wisata }}</span>
                                </div>
                                @if($objek->foto1)
                                    <img src="{{ asset('storage/' . $objek->foto1) }}" class="img-fluid w-100 h-100 object-fit-cover" alt="{{ $objek->nama_wisata }}" style="min-height: 250px;">
                                @else
                                    <img src="{{ asset('assets/img/default-image.jpg') }}" class="img-fluid w-100 h-100 object-fit-cover" alt="Default Image" style="min-height: 250px;">
                                @endif
                            </a>
                        </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@isset($obtas)
    @foreach($obtas as $objek)
    <div id="wisata-{{ $objek->id }}" class="lightbox-basic zoom-anim-dialog mfp-hide">
        <div class="row">
            <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
            <div class="col-lg-8">
                <div id="carousel-{{ $objek->id }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @for($i = 1; $i <= 7; $i++)
                            @if($objek->{'foto'.$i})
                                <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $objek->{'foto'.$i}) }}" class="d-block w-100" alt="Foto {{ $i }}" style="max-height: 500px; object-fit: contain;">
                                </div>
                            @endif
                        @endfor
                    </div>
                    @if($objek->foto2) <!-- Hanya tampilkan kontrol jika ada lebih dari 1 foto -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $objek->id }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $objek->id }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <h3>{{ $objek->nama_wisata }}</h3>
                <hr class="line-heading">
                <h6>{{ $objek->kategori_wisata->kategori_wisata }}</h6>
                <p>{{ $objek->deskripsi }}</p>
                <div class="testimonial-container">
                    <p class="testimonial-text">{{ $objek->fasilitas }}</p>
                </div>
                <a class="btn-outline-reg mfp-close as-button" href="#obta">BACK</a> 
            </div>
        </div>
    </div>
    @endforeach   
@endisset


{{-- Paket Wisata --}}

   <!-- Services -->
   <div id="services" class="cards-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">SERVICES</div>
                <h2>Choose The Service Package<br> That Suits Your Needs</h2>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            <div class="col-lg-12">
                
                <!-- Card -->
            @isset($paket_wisatas)
                @foreach($paket_wisatas as $paket)
                <div class="card">
                    <div class="card-image">
                        @if($paket->foto1)
                        <img src="{{ asset('storage/' . $paket->foto1) }}" alt="Foto Diskon" class="img-fluid">
                        @else
                        <img src="{{ asset('/assets/img/home-decor-1.jpg') }}" alt="Default Image" class="img-fluid">
                        @endif
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">{{ $paket->nama_paket }}</h3>
                        <p>{{ $paket->deskripsi }}</p>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">{{ $paket->fasilitas }}</div>
                            </li>
                        </ul>
                        <p class="price">Starting at <span>{{ $paket->harga_per_pack }}</span></p>
                    </div>
                    <div class="button-container">
                        <a class="btn-solid-reg page-scroll popup-with-move-anim" href="#paket-{{ $paket->id }}">DETAILS</a>
                    </div> <!-- end of button-container -->
                </div>
                <!-- end of card -->            
            </div> <!-- end of col -->
            @endforeach
        @endisset
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of cards-2 -->
<!-- end of services -->

@isset($paket_wisatas)
    @foreach($paket_wisatas as $paket)
    <div id="paket-{{ $paket->id }}" class="lightbox-basic zoom-anim-dialog mfp-hide">
        <div class="row">
            <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
            <div class="col-lg-8">
                <div id="carousel-{{ $paket->id }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @for($i = 1; $i <= 7; $i++)
                            @if($paket->{'foto'.$i})
                                <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $paket->{'foto'.$i}) }}" class="d-block w-100" alt="Foto {{ $i }}" style="max-height: 500px; object-fit: contain;">
                                </div>
                            @endif
                        @endfor
                    </div>
                    @if($paket->foto2) <!-- Hanya tampilkan kontrol jika ada lebih dari 1 foto -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $paket->id }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $paket->id }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <h3>{{ $paket->nama_paket }}</h3>
                <hr class="line-heading">
                <h6>{{ $paket->harga_per_pack }}</h6>
                <p>{{ $paket->deskripsi }}</p>
                <div class="testimonial-container">
                    <p class="testimonial-text">{{ $paket->fasilitas }}</p>
                </div>
                <a class="btn-outline-reg mfp-close as-button" href="#services">BACK</a> 
                <a class="btn-outline-reg mfp-close as-button" href="#">BOOK NOW</a> 
            </div>
        </div>
    </div>
    @endforeach
@endisset

