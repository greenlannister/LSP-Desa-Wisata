<!-- News Section -->
<style>
    .text-truncate-news {
        display: -webkit-box;
        -webkit-line-clamp: 7;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.5;
        min-height: 10.5em; /* 7 lines * 1.5 line-height */
    }
    .read-more-btn {
        margin-top: 10px;
    }
    .news-container {
        margin-bottom: 50px;
    }
</style>

<div id="intro" class="basic-1">
    @isset($beritas)
        @php
            // Determine if we should show only 2 news (for Home) or all (for News page)
            $showLimited = request()->is('/') || request()->is('home');
            $newsToShow = $showLimited ? array_slice($beritas->all(), 0, 2) : $beritas;
        @endphp
        
        @foreach ($newsToShow as $index => $news)
        <div class="container news-container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="text-container">
                        <div class="section-title">NEWS</div>
                        <h2>{{ $news->judul }}</h2>
                        <div class="text-truncate-news">
                            <p>{{ $news->berita }}</p>
                        </div>
                        <button class="btn btn-outline-success read-more-btn" data-bs-toggle="modal" data-bs-target="#newsModal{{ $index }}">
                            Baca Selengkapnya
                        </button>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="image-container">
                        <img class="img-fluid rounded" src="{{ asset('storage/' . $news->foto1) }}" alt="Berita Gambar">
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="newsModal{{ $index }}" tabindex="-1" aria-labelledby="newsModalLabel{{ $index }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newsModalLabel{{ $index }}">{{ $news->judul }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Carousel --}}
                        <div id="carouselNews{{ $index }}" class="carousel slide mb-3" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @php
                                    $photos = [];
                                    if ($news->foto1) $photos[] = $news->foto1;
                                    if ($news->foto2) $photos[] = $news->foto2;
                                    if ($news->foto3) $photos[] = $news->foto3;
                                    if ($news->foto4) $photos[] = $news->foto4;
                                    if ($news->foto5) $photos[] = $news->foto5;
                                @endphp
        
                                @foreach ($photos as $i => $photo)
                                <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $photo) }}" class="d-block w-100 rounded" alt="Foto Berita {{ $i + 1 }}">
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselNews{{ $index }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Sebelumnya</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselNews{{ $index }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Berikutnya</span>
                            </button>
                        </div>
        
                        {{-- Isi Berita Lengkap --}}
                        <p>{{ $news->berita }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        @if($showLimited && count($beritas) > 2)
        <div class="container text-center mt-4">
            <a href="/news-dwp" class="btn btn-outline-success read-more-btn">Lihat Semua Berita</a>
        </div>
        @endif
    @endisset
</div>