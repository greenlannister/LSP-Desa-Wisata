    <!-- Details 1 -->
	<div id="details" class="accordion">
        @isset($penginapans)
            @foreach ($penginapans as $inep)
		<div class="area-1"><div id="carousel-{{ $inep->id }}" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @for($i = 1; $i <= 5; $i++)
                    @if($inep->{'foto'.$i})
                        <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $inep->{'foto'.$i}) }}" class="d-block w-100" alt="Foto {{ $i }}" style="max-height: 500px; object-fit: contain;">
                        </div>
                    @endif
                @endfor
            </div>
            @if($inep->foto2) <!-- Hanya tampilkan kontrol jika ada lebih dari 1 foto -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $inep->id }}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $inep->id }}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            @endif
        </div>
		</div><!-- end of area-1 on same line and no space between comments to eliminate margin white space --><div class="area-2">
                    <!-- Accordion -->
                    <div class="accordion-container" id="accordionOne">
                        <h2>{{ $inep->nama_penginapan }}</h2>
                        <div class="item">
                            <div id="headingOne">
                                <span data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" role="button">
                                    <span class="circle-numbering">1</span><span class="accordion-title">Deskripsi Penginapan</span>
                                </span>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionOne">
                                <div class="accordion-body">
                                    {{ $inep->deskripsi }}
                                </div>
                            </div>
                        </div> <!-- end of item -->
                    
                        <div class="item">
                            <div id="headingTwo">
                                <span class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" role="button">
                                    <span class="circle-numbering">2</span><span class="accordion-title">Fasilitas</span>
                                </span>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionOne">
                                <div class="accordion-body">
                                    {{ $inep->fasilitas }}
                                </div>
                            </div>
                        </div> <!-- end of item -->
                    </div> <!-- end of accordion-container -->
            <!-- end of accordion -->
                @endforeach
            @endisset

		</div> <!-- end of area-2 -->
    </div> <!-- end of accordion -->
    <!-- end of details 1 -->
