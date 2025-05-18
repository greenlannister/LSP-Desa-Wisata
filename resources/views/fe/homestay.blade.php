<!-- Homestay Listing Section -->
<div id="homestay-listing" class="container py-5">
    @isset($penginapans)
        @foreach ($penginapans as $inep)
        <div class="homestay-card mb-5 p-4 border border-2 border-primary-subtle rounded-3" style="background-color: #f8f9fa;">
            <!-- Homestay Name -->
            <h2 class="mb-4" style="color: #0d6efd;">{{ $inep->nama_penginapan }}</h2>
            
            <div class="row">
                <!-- Carousel Images -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <div id="carousel-{{ $inep->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @for($i = 1; $i <= 5; $i++)
                                @if($inep->{'foto'.$i})
                                    <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $inep->{'foto'.$i}) }}" class="d-block w-100" alt="Foto {{ $i }}" style="max-height: 400px; object-fit: cover; border-radius: 0.25rem;">
                                    </div>
                                @endif
                            @endfor
                        </div>
                        @if($inep->foto2)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $inep->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: none;"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $inep->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="filter: none;"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        @endif
                    </div>
                </div>
                
                <!-- Homestay Details -->
                <div class="col-md-6">
                    <div class="accordion" id="accordion-{{ $inep->id }}">
                        <!-- Description -->
                        <div class="accordion-item mb-3 border-0">
                            <h3 class="accordion-header" id="headingOne-{{ $inep->id }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{ $inep->id }}" aria-expanded="true" aria-controls="collapseOne-{{ $inep->id }}" style="background-color: #e7f1ff; color: #0a58ca;">
                                    <span class="badge me-2" style="background-color: #0d6efd;">1</span>
                                    Deskripsi Penginapan
                                </button>
                            </h3>
                            <div id="collapseOne-{{ $inep->id }}" class="accordion-collapse collapse show" aria-labelledby="headingOne-{{ $inep->id }}" data-bs-parent="#accordion-{{ $inep->id }}">
                                <div class="accordion-body" style="background-color: #f8f9fa;">
                                    {{ $inep->deskripsi }}
                                </div>
                            </div>
                        </div>
                        
                        <!-- Facilities -->
                        <div class="accordion-item border-0">
                            <h3 class="accordion-header" id="headingTwo-{{ $inep->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo-{{ $inep->id }}" aria-expanded="false" aria-controls="collapseTwo-{{ $inep->id }}" style="background-color: #e7f1ff; color: #0a58ca;">
                                    <span class="badge me-2" style="background-color: #0d6efd;">2</span>
                                    Fasilitas
                                </button>
                            </h3>
                            <div id="collapseTwo-{{ $inep->id }}" class="accordion-collapse collapse" aria-labelledby="headingTwo-{{ $inep->id }}" data-bs-parent="#accordion-{{ $inep->id }}">
                                <div class="accordion-body" style="background-color: #f8f9fa;">
                                    {{ $inep->fasilitas }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endisset
</div>

<style>
    .homestay-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .homestay-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(13, 110, 253, 0.1);
    }
    .accordion-button:not(.collapsed) {
        color: #071b3a;
        background-color: #e7f1ff;
    }
    .accordion-button:focus {
        box-shadow: 0 0 0 0.25rem rgba(128, 154, 194, 0.25);
        border-color: #86b7fe;
    }
</style>