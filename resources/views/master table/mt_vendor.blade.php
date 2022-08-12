@extends('layouts.app')

@section('content')
<div class="header bg-primary pb-6">
    {{-- !!! ROUTE DIHEADER !!! --}}
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Master Table</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Vendor</a></li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    {{-- !! MCU !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">vendor</h6>
                <h5 class="h3 mb-0">Medical Check Up</h5>
              </div>
            </div>
          </div>
          <div class="card-body">

          </div>
        </div>
      </div>
    </div>

    {{-- !! PSIKOTEST !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">vendor</h6>
                <h5 class="h3 mb-0">Psikotest</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            
          </div>
        </div>
      </div>
    </div>
  </div>
{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}
@endsection
