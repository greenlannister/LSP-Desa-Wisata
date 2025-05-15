<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('image/logo.svg') }}">
  <link rel="icon" type="image/png" href="{{ asset('image/logo.svg') }}">
  <title>{{ $title }}</title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('/assets/css/material-dashboard.css?v=3.2.0') }}}}" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
  <div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">

      @php
        $dashboardRoute = match (Auth::user()->level) {
            'pelanggan' => '/',
        };
      @endphp

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <li class="nav-item px-3 d-flex align-items-center">
                <a href="{{ $dashboardRoute }}" class="nav-link text-body p-0" title="Kembali ke Dashboard">
                    <i class="material-symbols-rounded fixed-plugin-button-nav">arrow_back</i>
                </a>
            </li>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('{{ asset('sig/img/Danau-Toba.png') }}');">
        <span class="mask  bg-gradient-dark  opacity-6"></span>
      </div>
      <div class="card card-body mx-2 mx-md-2 mt-n6">
        <div class="row gx-4 mb-2">
            <div class="col-auto">
                <div class="d-flex px-2 py-1">
                    <div class="avatar avatar-xl position-relative mb-3">
                        @if($profilepel->pelanggan->foto)
                        <img src="{{ asset('storage/' . $profilepel->pelanggan->foto) }}" class="w-100 border-radius-lg shadow-sm" alt="{{ $profilepel->pelanggan->foto}}">
                        @else
                        <img src="{{ asset('assets/img/default-avatar.png') }}" class="w-100 border-radius-lg shadow-sm" alt="{{ $profilepel->pelanggan->foto}}">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $profilepel->pelanggan->nama_pelanggan ?? '-' }}
                    </h5>              
                </div>
            </div>
        </div>
        
        <!-- Baris baru untuk konten profile dan card -->
        <div class="d-flex align-items-start">
            <!-- Kolom Profile Information -->
            <div class="flex-grow-1 me-4"> <!-- Menambahkan margin kanan -->
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Profile Information</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <p class="text-sm">
                            {{ $profilepel->pelanggan->alamat ?? '-' }}
                        </p>
                        <hr class="horizontal gray-light my-4">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                <strong class="text-dark">Full Name:</strong> &nbsp; {{ $profilepel->pelanggan->nama_pelanggan ?? '-' }}
                            </li>
                            <li class="list-group-item border-0 ps-0 text-sm">
                                <strong class="text-dark">Mobile:</strong> &nbsp; {{ $profilepel->pelanggan->nomor_HP ?? '-' }}
                            </li>
                            <li class="list-group-item border-0 ps-0 text-sm">
                                <strong class="text-dark">Email:</strong> &nbsp; {{ $profilepel->email ?? '-' }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Kolom Today's Money Card -->
            <div class="flex-shrink-0" style="width: 300px; margin-right: 777px;"> <!-- Lebar tetap dan margin kiri -->
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Download Nota</p>
                            </div>
                            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">weekend</i>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-sm btn-outline-primary mt-5" data-bs-toggle="modal" data-bs-target="#reservasiModal">
                  Lihat Reservasi
                </button>
            </div>
        </div>
    </div>

 {{-- Modal Table reservasis --}}
    <!-- Modal Reservasi -->
    <div class="modal fade" id="reservasiModal" tabindex="-1" aria-labelledby="reservasiModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="reservasiModalLabel">Riwayat Reservasi Anda</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  @if($reservasis->isEmpty())
                      <div class="alert alert-info">
                          Anda belum memiliki riwayat reservasi.
                      </div>
                  @else
                      <div class="table-responsive">
                          <table class="table align-items-center mb-0">
                              <thead>
                                  <tr>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Paket Wisata</th>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Mulai</th>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Berakhir</th>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Harga</th>
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($reservasis as $reservasi)
                                  <tr>
                                      <td>
                                          <p class="text-xs font-weight-bold mb-0">
                                              {{ $reservasi->paketWisata->nama_paket ?? '-' }}
                                          </p>
                                      </td>
                                      <td>
                                          <p class="text-xs font-weight-bold mb-0">
                                              {{ $reservasi->tgl_mulai_reservasi->format('d M Y') }}
                                          </p>
                                      </td>
                                      <td>
                                          <p class="text-xs font-weight-bold mb-0">
                                              {{ $reservasi->tgl_selesai_reservasi->format('d M Y') }}
                                          </p>
                                      </td>
                                      <td>
                                          <p class="text-xs font-weight-bold mb-0">
                                              Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}
                                          </p>
                                      </td>
                                      <td>
                                          <span class="badge badge-sm 
                                              @if($reservasi->status_reservasi == 'Selesai') bg-gradient-success
                                              @elseif($reservasi->status_reservasi == 'Dipesan') bg-gradient-primary
                                              @elseif($reservasi->status_reservasi == 'Menunggu Konfirmasi') bg-gradient-warning
                                              @else bg-gradient-danger @endif">
                                              {{ $reservasi->status_reservasi }}
                                          </span>
                                      </td>
                                  </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  @endif
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              </div>
          </div>
      </div>
    </div>

  </div>
  <div class="fixed-plugin">
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-symbols-rounded">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark active" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2  active ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-info w-100" href="https://www.creative-tim.com/product/material-dashboard-pro">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('/assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>
</body>
</html>