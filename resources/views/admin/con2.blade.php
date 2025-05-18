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
            <a class="nav-link text-dark" href="/admin-%-dwp">
              <i class="material-symbols-rounded opacity-5">dashboard</i>
              <span class="nav-link-text ms-1">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="/admin-%-dwp/con1">
              <i class="material-symbols-rounded opacity-5">table_view</i>
              <span class="nav-link-text ms-1">User Manage</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="/admin-%-dwp/con2">
              <i class="material-symbols-rounded opacity-5">table_view</i>
              <span class="nav-link-text ms-1">Desa's News Category</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="/admin-%-dwp/con3">
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

{{-- Kategori Berita --}}
<div class="row">
    <div class="col-12 text-end">
      <button type="button" class="bg-gradient-dark mb-4 btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalKatgor">
          <span class="materspanal-symbols-rounded text-sm">+</span>&nbsp;&nbsp;Add New Category
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
      <div class="card">
        <div class="card-header pb-0 px-3">
          <h6 class="mb-0">Table Kategori Berita</h6>
        </div>
        <div class="card-body pt-4 p-3">
          <ul class="list-group">
            @forelse($kategoriBeritas as $kategori)
              <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                <div class="d-flex flex-column">
                  <h6 class="mb-3 text-sm">{{ $kategori->kategori_berita }}</h6>
                </div>
                <div class="ms-auto text-end">
                  <!-- Tombol Delete -->
                  <form action="{{ route('kategori-berita.destroy', $kategori->id) }}" method="POST" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0" onclick="return confirm('Yakin ingin menghapus?')">
                          <i class="material-symbols-rounded text-sm me-2">delete</i>Delete
                      </button>
                  </form>

                  <!-- Tombol Edit -->
                  <a class="btn btn-link text-dark px-3 mb-0" data-bs-toggle="modal" data-bs-target="#ModalKatgorEdit-{{ $kategori->id }}">
                      <i class="material-symbols-rounded text-sm me-2">edit</i>Edit
                  </a>
                </div>
              </li>
              @empty
                <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm text-muted">Belum ada kategori berita.</h6>
                  </div>
                </li>
              @endforelse
          </ul>          
        </div>
      </div>
    </div>
  </div>

@include('admin.kategori_berita.create')
@include('admin.kategori_berita.edit')
@endsection