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
@section('navbar2')
    @include('be.navbar2')
@endsection

@section('content')
<div class="ms-3">
  <h1 class="mb-0 h1 font-weight-bolder">Dashboard {{ $title }}</h1>
</div>
@endsection