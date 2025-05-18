<div id="obta" class="filter">
    <div class="container center">
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
                <div class="grid center">
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
        <div class="row justify-content-center">
            <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
            <div class="col-lg-8 tex">
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
            <div class="col-lg-12 text-center">
                <div class="section-title">SERVICES</div>
                <h2>Choose The Service Package<br>That Suits Your Needs</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            @isset($paket_wisatas)
                @php
                    // Determine if we should show only 3 packages (for Home) or all (for Packages)
                    $showLimited = request()->is('/') || request()->is('home'); // Adjust these routes as needed
                    $packagesToShow = $showLimited ? array_slice($paket_wisatas->all(), 0, 3) : $paket_wisatas;
                @endphp
                
                @foreach($packagesToShow as $paket)
                <div class="col-lg-{{ $showLimited ? '4' : '3' }} col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-image" style="height: 200px; overflow: hidden;">
                            @if($paket->foto1)
                            <img src="{{ asset('storage/' . $paket->foto1) }}" alt="{{ $paket->nama_paket }}" class="img-fluid h-100 w-100 object-fit-cover">
                            @else
                            <img src="{{ asset('/assets/img/home-decor-1.jpg') }}" alt="Default Image" class="img-fluid h-100 w-100 object-fit-cover">
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title text-center">{{ $paket->nama_paket }}</h3>
                            <p class="text-start text-truncate-2" style="text-align: left !important;">{{ $paket->deskripsi }}</p>
                            <ul class="list-unstyled li-space-lg text-start mb-3" style="max-height: 80px; overflow: hidden;">
                                @php
                                    $facilities = array_slice(explode("\n", $paket->fasilitas), 0, 2);
                                @endphp
                                @foreach($facilities as $fasilitas)
                                    @if(trim($fasilitas))
                                        <li class="media">
                                            <i class="fas fa-square me-2"></i>
                                            <div class="media-body">{{ $fasilitas }}</div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            <p class="price text-center mb-0">Starting at 
                                <span>Rp {{ number_format($paket->harga_per_pack, 0, ',', '.') }}</span>
                             </p>
                        </div>
                        <div class="button-container p-3 text-center">
                            <a class="btn-solid-reg popup-with-move-anim" href="#paket-{{ $paket->id }}">DETAILS</a>
                        </div>
                    </div>
                </div>
                @endforeach
                
                @if($showLimited && count($paket_wisatas) > 3)
                <div class="col-12 text-center mt-4">
                    <a href="/package-%-dwp" class="btn-solid-reg popup-with-move-anim">View All Packages</a>
                </div>
                @endif
            @endisset
        </div>
    </div>
</div>

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
                    @if($paket->foto2)
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
                <h6>Rp {{ number_format($paket->harga_per_pack, 0, ',', '.') }}</h6>
                <p>{{ $paket->deskripsi }}</p>
                <div class="testimonial-container">
                    <p class="testimonial-text">{{ $paket->fasilitas }}</p>
                </div>
                <a class="btn-outline-reg mfp-close as-button" href="#services">BACK</a> 
                <a class="btn-outline-reg mfp-close as-button" href="{{ route('reservasi.create', $paket->id) }}">BOOK NOW</a>
                <br><br>
                <a class="btn-outline-reg mfp-close as-button" href="/homestay-%-dwp">See All Homestay</a> 
            </div>
        </div>
    </div>
    @endforeach
@endisset

<style>
    /* Custom styling for the packages */
    .cards-2 {
        padding: 60px 0;
    }
    
    .card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .card:hover {
        transform: translateY(-10px);
    }
    
    .card-image {
        transition: transform 0.5s ease;
    }
    
    .card:hover .card-image {
        transform: scale(1.05);
    }
    
    .price span {
        font-weight: bold;
        color: #2c3e50;
        font-size: 1.2rem;
    }
    
    .button-container {
        margin-top: auto;
        padding-bottom: 20px;
    }
    
    .li-space-lg li {
        margin-bottom: 10px;
    }
    
    .fas.fa-square {
        color: #2c3e50;
        font-size: 0.5rem;
        margin-top: 7px;
    }
    
    /* Text truncation for 2 lines */
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        min-height: 2.8em; /* Adjust based on your line-height */
        line-height: 1.4em;
    }
</style>

