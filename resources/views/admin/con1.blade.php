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
          <a class="nav-link text-dark" href="/admin-dwp">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="/admin-dwp/con1">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">User Manage</span>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="/admin-dwp/con2">
              <i class="material-symbols-rounded opacity-5">table_view</i>
              <span class="nav-link-text ms-1">Desa's News Category</span>
            </a>
          </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="/admin-dwp/con3">
            <i class="material-symbols-rounded opacity-5">table_view</i>
            <span class="nav-link-text ms-1">Desa's News</span>
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
<div class="container-fluid py-2">
  <div class="row">
      <div class="col-12">
          <div class="col-12 text-end">
              <button type="button" class="bg-gradient-dark mb-4 btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalUser">
                  <span class="materspanal-symbols-rounded text-sm">+</span>&nbsp;&nbsp;Add New User
              </button>
          </div>
          @if($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
          <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                  <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                      <h6 class="text-white text-capitalize ps-3">User Table</h6>
                  </div>
              </div>
              <div class="card-body px-0 pb-2">
                  <div class="table-responsive p-0">
                      <table class="table align-items-center mb-0">
                          <thead>
                              <tr>
                                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Karyawan</th>
                                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alamat</th>
                                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor HP</th>
                                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jabatan</th>
                                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($karyawans as $karyawan)
                              <tr>
                                  <td>
                                      <div class="d-flex px-2 py-1">
                                          <div>
                                              @if($karyawan->foto_karyawan)
                                              <img src="{{ asset('storage/' . $karyawan->foto_karyawan) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="{{ $karyawan->foto_karyawan }}">
                                              @else
                                              <img src="{{ asset('assets/img/default-avatar.png') }}" class="avatar avatar-sm me-3 border-radius-lg" alt="{{ $karyawan->foto_karyawan }}">
                                              @endif
                                          </div>
                                          <div class="d-flex flex-column justify-content-center">
                                              <h6 class="mb-0 text-sm">{{ $karyawan->nama_karyawan }}</h6>
                                              <p class="text-xs text-secondary mb-0">{{ $karyawan->user->email }}</p>
                                          </div>
                                      </div>
                                  </td>
                                  <td>
                                      <p class="text-xs font-weight-bold mb-0">{{ $karyawan->user->email }}</p>
                                  </td>
                                  <td>
                                      <p class="text-xs font-weight-bold mb-0">{{ Str::limit($karyawan->alamat, 30) }}</p>
                                  </td>
                                  <td class="align-middle text-center">
                                      <span class="text-secondary text-xs font-weight-bold">{{ $karyawan->no_hp }}</span>
                                  </td>
                                  <td class="align-middle text-center">
                                      <span class="text-secondary text-xs font-weight-bold">{{ ucfirst($karyawan->jabatan) }}</span>
                                  </td>
                                  <td class="align-middle text-center">
                                      @if($karyawan->status == 'aktif')
                                      <span class="badge badge-sm bg-gradient-success">Aktif</span>
                                      @else
                                      <span class="badge badge-sm bg-gradient-danger">Banned</span>
                                      @endif
                                  </td>
                                  <td class="align-middle">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#ModalEdit-{{ $karyawan->id }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                        <form id="ban-form-{{ $karyawan->id }}" action="{{ route('admin.karyawan.ban', $karyawan->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <a href="#" onclick="confirmBan({{ $karyawan->id }})" class="text-secondary font-weight-bold text-xs ms-2" data-toggle="tooltip" data-original-title="Banned user">
                                                Banned
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
@include('admin.m-user.edit')
@include('admin.m-user.create')
@endsection