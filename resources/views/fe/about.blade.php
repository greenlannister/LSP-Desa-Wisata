<!-- About -->
    <div id="about" class="counter">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-xl-6">
                    <div class="image-container">
                        <img class="img-fluid" src="{{ asset('image/danau1.jpeg') }}" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
                <div class="col-lg-7 col-xl-6">
                    <div class="text-container">
                        <div class="section-title">ABOUT</div>
                        <h2>We’re Passionate About Showcasing the Wonders of Danau Toba</h2>
                        <p>Our mission is to introduce the breathtaking charm of Danau Toba and its surrounding gems—like the mystical Samosir Island, cultural villages, and panoramic highlands—so visitors can experience the magic of North Sumatra and bring home unforgettable memories.</p>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Every destination we highlight offers authentic natural and cultural beauty</div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">You’re not just a visitor — you become part of our living tradition</div>
                            </li>
                        </ul>

                        <!-- Counter -->
                        <div id="counter">
                            <div class="cell">
                                <?php
                                // Hitung jumlah Happy Users (jumlah reservasi unik berdasarkan id_pelanggan)
                                $happyUsers = DB::table('reservasis')
                                              ->distinct('id_pelanggan')
                                              ->count('id_pelanggan');
                                ?>
                                <div class="counter-value number-count" data-count="<?php echo $happyUsers; ?>">1</div>
                                <div class="counter-info">Happy<br>Users</div>
                            </div>
                            <div class="cell">
                                <?php
                                // Hitung jumlah Packages (jumlah paket wisata)
                                $packages = DB::table('paket_wisatas')->count();
                                ?>
                                <div class="counter-value number-count" data-count="<?php echo $packages; ?>">1</div>
                                <div class="counter-info">Packages</div>
                            </div>
                            <div class="cell">
                                <?php
                                // Hitung jumlah Good Reviews (jumlah review)
                                $goodReviews = DB::table('review')->count();
                                ?>
                                <div class="counter-value number-count" data-count="<?php echo $goodReviews; ?>">1</div>
                                <div class="counter-info">Good<br>Reviews</div>
                            </div>
                        </div>
                        <!-- end of counter -->

                    </div> <!-- end of text-container -->      
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of counter -->
    <!-- end of about -->