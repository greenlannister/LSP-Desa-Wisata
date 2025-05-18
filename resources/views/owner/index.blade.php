@extends('be.master')
@section('sidebar')
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="{{ asset('image/logo.png') }}" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Creative Tim</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="../pages/dashboard.html">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="#" 
             onclick="event.preventDefault(); document.getElementById('logout-form-karyawan').submit();">
              <i class="material-symbols-rounded opacity-5">login</i>
              <span class="nav-link-text ms-1">Sign Out</span>
          </a>
          
          <form id="logout-form-karyawan" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
      </li>
      </ul>
    </div>
  </aside>
@endsection
@section('navbar2')
    @include('be.navbar2')
@endsection
@section('content')
{{-- Laporan Start --}}
<div class="container-fluid py-2">
  <div class="row gap-4">

    {{-- FORM: Laporan Reservasi untuk PDF --}}
    <div class="col-lg-4">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <h6 class="mb-0">Laporan Reservasi Bulanan</h6>
        </div>
        <div class="card-body p-3">
          <form action="{{ route('owner.laporan.pdf') }}" method="GET" target="_blank">
            <div class="row mb-3">
              <div class="col">
                <label for="bulan" class="form-label">Bulan</label>
                <select name="bulan" id="bulan" class="form-select" required>
                  @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}">{{ \Carbon\Carbon::create()->month($i)->format('F') }}</option>
                  @endfor
                </select>
              </div>
              <div class="col">
                <label for="tahun" class="form-label">Tahun</label>
                <select name="tahun" id="tahun" class="form-select" required>
                  @for($i = now()->year; $i >= 2020; $i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">
              <i class="material-symbols-rounded">picture_as_pdf</i> Unduh Laporan PDF
            </button>
          </form>
        </div>
      </div>
    </div>

    {{-- Chart Laporan Reservasi --}}
    <div class="col-lg-8">
      <div class="card h-100">
        <div class="card-body">
          <h6 class="mb-0">Chart Reservasi</h6>
          <p class="text-sm">Desa Wisata Danau Toba</p>
          <div class="pe-1">
            <div class="chart">
              <canvas id="chart-bars" class="chart-canvas" height="200" width="200"></canvas>
            </div>
          </div>
          <hr class="dark horizontal">
          <div class="d-flex">
            <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
            <p class="mb-0 text-sm">Data diperbarui: {{ now()->format('d M Y H:i') }}</p>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById("chart-bars").getContext("2d");
    
        new Chart(ctx, {
            type: "bar",
            data: {
                labels: @json($labels),
                datasets: [{
                    label: "Jumlah Reservasi",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "#43A047",
                    data: @json($jumlahReservasi),
                    barThickness: 'flex'
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                const fullMonths = ["January", "February", "March", "April", "May", "June", 
                                                  "July", "August", "September", "October", "November", "December"];
                                return fullMonths[context[0].dataIndex] + ' ' + {{ $data['tahun'] }};
                            },
                            label: function(context) {
                                return 'Jumlah Reservasi: ' + context.raw;
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: '#e5e5e5'
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: Math.max(...@json($jumlahReservasi)) + 5 || 10,
                            beginAtZero: true,
                            padding: 10,
                            font: {
                                size: 14,
                                lineHeight: 2
                            },
                            color: "#737373"
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#737373',
                            padding: 10,
                            font: {
                                size: 14,
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>

  </div>
</div>

  {{-- Laporan End --}}
@endsection

