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
          <span class="nav-link-text ms-1">Confirmation</span>
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
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="col-12 text-end">
            <button type="button" class="bg-gradient-dark mb-4 btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalDiskon">
                <span class="materspanal-symbols-rounded text-sm">+</span>&nbsp;&nbsp;Add New Discount
            </button>
            </div>
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Discount table</h6>
                    </div>
                </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Foto</th>
                                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Kode Diskon</th>
                                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Nama Diskon</th>
                                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Persentase</th>
                                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Periode</th>
                                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Status</th>
                                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($diskons as $diskon)
                                    <tr>
                                        <td>
                                          @if($diskon->foto)
                                            <img src="{{ asset('storage/' . $diskon->foto) }}" class="avatar avatar-s me-3 border-radius-lg" alt="Foto">
                                          @else
                                            <img src="{{ asset('assets/img/default-image.jpg') }}" class="avatar avatar-s me-3 border-radius-lg" alt="Default Foto">
                                          @endif
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $diskon->kode_diskon }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $diskon->nama_diskon }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs mb-0">{{ $diskon->persentase_diskon }}%</p>
                                        </td>
                                        <td>
                                            <p class="text-xs mb-0">
                                                {{ $diskon->tanggal_mulai->format('d M Y') }} - 
                                                {{ $diskon->tanggal_berakhir->format('d M Y') }}
                                            </p>
                                        </td>
                                        <td>
                                            <span class="badge badge-sm {{ $diskon->aktif ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                {{ $diskon->aktif ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <!-- Tombol Edit -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#ModalDiskonEdit-{{ $diskon->id }}" 
                                               class="text-secondary font-weight-bold text-xs me-3" data-toggle="tooltip" title="Edit">
                                                Edit
                                            </a>
                                            
                                            <!-- Tombol Delete -->
                                            <form id="delete-form-{{ $diskon->id }}" action="{{ route('diskon.destroy', $diskon->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" onclick="confirmDelete({{ $diskon->id }})" 
                                                   class="text-danger font-weight-bold text-xs" data-toggle="tooltip" title="Hapus">
                                                    Delete
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@include('bendahara.discount.edit')
@include('bendahara.discount.create')
@endsection