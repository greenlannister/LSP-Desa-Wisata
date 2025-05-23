   <!-- Testimonials -->
   <div class="slider">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Stories from Our Travelers</h2>
                <p class="p-heading">Our clients are our partners and we can not imagine a better future for our company without helping them reach their happiness</p>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            <div class="col-lg-12">

                <!-- Card Slider -->
                <div class="slider-container">
                    <div class="swiper-container card-slider">
                        <div class="swiper-wrapper">
                            
                            <!-- Slide -->
                            @foreach($reviews as $review)
                            <div class="swiper-slide">
                                <div class="card">
                                    @if($review->pelanggan->foto)
                                        <img class="card-image" src="{{ asset('storage/' . $review->pelanggan->foto) }}" alt="{{ $review->pelanggan->nama_pelanggan }}">
                                    @else
                                        <img class="card-image" src="{{ asset('image/default-profile.jpg') }}" alt="Default Profile">
                                    @endif
                                    <div class="card-body">
                                        <div class="testimonial-text">{{ $review->ulasan }}</div>
                                        <div class="testimonial-author">{{ $review->pelanggan->nama_pelanggan }}</div>
                                    </div>
                                </div>
                            </div> <!-- end of swiper-slide -->
                            @endforeach
                            <!-- end of slide -->
                        
                        </div> <!-- end of swiper-wrapper -->
    
                        <!-- Add Arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <!-- end of add arrows -->
    
                    </div> <!-- end of swiper-container -->
                </div> <!-- end of sliedr-container -->
                <!-- end of card slider -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of slider -->
<!-- end of testimonials -->

<style>
.card-image {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures image covers the container without distortion */
    transition: transform 0.3s ease;
}

</style>