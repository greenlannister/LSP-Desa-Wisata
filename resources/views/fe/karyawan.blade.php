   <!-- Team -->
   <div class="basic-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Our Team Of Consultants</h2>
                <p class="p-heading">We're only as strong and as knowledgeable as our team. So here are the strongest women which help customers meet goals and happiness</p>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            <div class="col-lg-12">
                @isset($karyawans)
                    @foreach ($karyawans as $kar )
                        <!-- Team Member -->
                        <div class="team-member">
                                <div class="image-wrapper" style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; margin: 0 auto;">
                                    @if($kar->foto_karyawan)
                                        <img src="{{ asset('storage/' . $kar->foto_karyawan) }}" 
                                            style="width: 100%; height: 100%; object-fit: cover;" 
                                            alt="{{ $kar->foto_karyawan }}">
                                    @else
                                        <img src="{{ asset('assets/img/default-avatar.png') }}" 
                                            style="width: 100%; height: 100%; object-fit: cover;" 
                                            alt="Foto Default">
                                    @endif
                                </div>
                             <!-- end of image-wrapper -->
                            <p class="p-large">{{ $kar->nama_karyawan }}</p>
                            <p class="job-title">{{ $kar->jabatan }}</p>
                        </div> <!-- end of team-member -->
                        <!-- end of team member -->

                    @endforeach
                @endisset
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of basic-2 -->
<!-- end of team -->