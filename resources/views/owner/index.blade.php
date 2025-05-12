@extends('be.master')
@section('sidebar')
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="{{ asset('image/logo.svg') }}" class="navbar-brand-img" width="26" height="26" alt="main_logo">
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
    <div class="row gap-5">
      
      {{-- Website Views Card --}}
      <div class="col-lg-4 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <h6 class="mb-0">Website Views</h6>
            <p class="text-sm">Last Campaign Performance</p>
            <div class="pe-2">
              <div class="chart">
                <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
              </div>
            </div>
            <hr class="dark horizontal">
            <div class="d-flex">
              <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
              <p class="mb-0 text-sm"> campaign sent 2 days ago </p>
            </div>
          </div>
        </div>
      </div>

            {{-- Invoices Card --}}
      <div class="col-lg-4 col-md-6 ml-10">
        <div class="card h-100">
          <div class="card-header pb-0 p-3">
            <div class="row">
              <div class="col-6 d-flex align-items-center">
                <h6 class="mb-0">Desa Danau Toba's Invoices</h6>
              </div>
            </div>
          </div>
          <div class="card-body p-3 pb-0">
            <ul class="list-group">
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="mb-1 text-dark font-weight-bold text-sm">March, 01, 2020</h6>
                </div>
                <div class="d-flex align-items-center text-sm">
                  <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="material-symbols-rounded text-lg position-relative me-1">picture_as_pdf</i> PDF</button>
                </div>
              </li>
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="text-dark mb-1 font-weight-bold text-sm">February, 10, 2021</h6>
                </div>
                <div class="d-flex align-items-center text-sm">
                  <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="material-symbols-rounded text-lg position-relative me-1">picture_as_pdf</i> PDF</button>
                </div>
              </li>
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="text-dark mb-1 font-weight-bold text-sm">April, 05, 2020</h6>
                </div>
                <div class="d-flex align-items-center text-sm">
                  <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="material-symbols-rounded text-lg position-relative me-1">picture_as_pdf</i> PDF</button>
                </div>
              </li>
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="text-dark mb-1 font-weight-bold text-sm">June, 25, 2019</h6>
                </div>
                <div class="d-flex align-items-center text-sm">
                  <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="material-symbols-rounded text-lg position-relative me-1">picture_as_pdf</i> PDF</button>
                </div>
              </li>
              <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="text-dark mb-1 font-weight-bold text-sm">March, 01, 2019</h6>
                </div>
                <div class="d-flex align-items-center text-sm">
                  <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="material-symbols-rounded text-lg position-relative me-1">picture_as_pdf</i> PDF</button>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Laporan End --}}
@endsection