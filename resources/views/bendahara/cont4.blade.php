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
        <a class="nav-link text-dark" href="/bendahara-%-dwp">
          <i class="material-symbols-rounded opacity-5">dashboard</i>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="/bendahara-%-dwp/cont1">
          <i class="material-symbols-rounded opacity-5">table_view</i>
          <span class="nav-link-text ms-1">Add Homestay</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="/bendahara-%-dwp/cont2">
          <i class="material-symbols-rounded opacity-5">table_view</i>
          <span class="nav-link-text ms-1">Add Package</span>
        </a>
      </li>
      <li class="nav-item">
          <a class="nav-link text-dark" href="/bendahara-%-dwp/cont5">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Add Category</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="/bendahara-%-dwp/cont3">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Add Object</span>
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="/bendahara-%-dwp/cont6">
          <i class="material-symbols-rounded opacity-5">table_view</i>
          <span class="nav-link-text ms-1">Add Payment Method</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="/bendahara-%-dwp/cont7">
          <i class="material-symbols-rounded opacity-5">table_view</i>
          <span class="nav-link-text ms-1">Add Discount</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="/bendahara-%-dwp/cont4">
          <i class="material-symbols-rounded opacity-5">table_view</i>
          <span class="nav-link-text ms-1">Reservation</span>
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
@section('navbar')
    @include('be.navbar')
@endsection
@section('content')
<div class="card my-4">
  <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
      <h6 class="text-white text-capitalize ps-3">Tabel Reservasi Pelanggan</h6>
    </div>
  </div>
  <div class="card-body px-0 pb-2">
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pelanggan</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Paket</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Total</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Reservasi</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Peserta</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bukti TF</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Reservasi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($reservasis as $reservasi)
            <tr>
              <td class="text-xs font-weight-bold mb-0">
                {{ $reservasi->pelanggan->nama_pelanggan ?? '-' }}
              </td>
              <td class="text-xs">
                {{ $reservasi->email }}
              </td>
              <td class="text-xs">
                {{ $reservasi->paketWisata->nama_paket ?? '-' }}
              </td>
              <td class="text-xs">
                Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}
              </td>
              <td class="text-xs">
                {{ \Carbon\Carbon::parse($reservasi->tgl_mulai_reservasi)->format('d M Y') }}
              </td>
              <td class="text-xs">
                {{ $reservasi->jumlah_peserta }}
              </td>
              <td class="text-xs">
                @if($reservasi->bukti_tf)
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modalBuktiTF-{{ $reservasi->id }}">
                    <img src="{{ asset('storage/' . $reservasi->bukti_tf) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="Bukti TF">
                  </a>
                @else
                  <img src="{{ asset('assets/img/default-image.jpg') }}" class="avatar avatar-sm me-3 border-radius-lg" alt="Default Image">
                @endif
              </td> 
              {{-- Modal Foto --}}
                @if($reservasi->bukti_tf)
                <!-- Modal Bukti TF -->
                <div class="modal fade" id="modalBuktiTF-{{ $reservasi->id }}" tabindex="-1" aria-labelledby="modalBuktiTFLabel-{{ $reservasi->id }}" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title" id="modalBuktiTFLabel-{{ $reservasi->id }}">Bukti Transfer</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body text-center">
                        <img src="{{ asset('storage/' . $reservasi->bukti_tf) }}" alt="Bukti Transfer" class="img-fluid rounded">
                      </div>
                    </div>
                  </div>
                </div>
                @endif             
              <td class="text-xs">
                <span class="badge bg-gradient-{{ $reservasi->status_reservasi == 'Selesai' ? 'success' : ($reservasi->status_reservasi == 'Dibatalkan' ? 'danger' : 'secondary') }}">
                  {{ $reservasi->status_reservasi }}
                </span>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection