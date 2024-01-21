@extends('layouts.user')

@section('content')
  
  
  @include('partials.sidebar')
 
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <!-- Navbar -->
    @include('partials.navbar')
    <!-- End Navbar -->
    <div class="container-fluid">
      <div class="page-header min-height-100 border-radius-xl mt-4" style="background-image: url({{ asset('assets/img/curved-images/curved0.jpg') }}); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="{{ asset('assets/img/User-Profile-PNG-Image.png') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{ ucfirst($user->name) }}
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
              {{ $user->cpfNo }} / {{ ucfirst($user->email) }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">

        <div class="col-12 col-xl-6">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="col-md-8 d-flex align-items-center">
                    <h6 class="mb-0">Website Information</h6>
                </div>
            </div>
            <div class="card-body p-3">
              <hr class="horizontal gray-light my-4">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Name:</strong> &nbsp; {{ ucfirst($website->name) }}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">URL:</strong> &nbsp; <a href="{{$website->url}}" target="_blank" >{{$website->url}}</a></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">IP:</strong> &nbsp; {{$website->ip}} &nbsp<strong class="text-dark">Secondary IP:</strong> &nbsp; {{$website->secondary_ip}} </li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; {{$website->name}}</li>

                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Operating System:</strong> &nbsp; {{$website->operatingSystem->name}} &nbsp<strong class="text-dark">Version:</strong> &nbsp; {{$website->operating_system_version}}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Language:</strong> &nbsp; {{$website->getLanguage->name}} &nbsp<strong class="text-dark">Version:</strong> &nbsp; {{$website->language_version}}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Framework:</strong> &nbsp; {{$website->getFramework->name}} &nbsp<strong class="text-dark">Version:</strong> &nbsp; {{$website->framework_version}}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Database:</strong> &nbsp; {{$website->getDatabase->name}} &nbsp<strong class="text-dark">Version:</strong> &nbsp; {{$website->database_version}}</li>

                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Is Exposed To Internet:</strong> &nbsp; {{$website->is_exposed_to_content}}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Is DR:</strong> &nbsp; {{$website->is_dr}}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Is Vapt Done:</strong> &nbsp; {{$website->is_vapt_done}}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Is Backup:</strong> &nbsp; {{$website->is_backup}}</li>

              </ul>
            </div>
          </div>
        </div>   

        <!-- <div class="col-12 col-xl-6">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Website Information</h6>
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <hr class="horizontal gray-light my-4">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Name:</strong> &nbsp; {{ ucfirst($website->name) }}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">URL:</strong> &nbsp; <a href="{{$website->url}}" target="_blank" >{{$website->url}}</a></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">IP:</strong> &nbsp; {{$website->ip}}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; {{$website->name}}</li>

                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Operating System:</strong> &nbsp; {{$website->operating_system}} / {{$website->operating_system_version}}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Language:</strong> &nbsp; {{$website->language}} / {{$website->language_version}}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Framework:</strong> &nbsp; {{$website->framework}} / {{$website->framework_version}}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Database:</strong> &nbsp; {{$website->database}} / {{$website->database_version}}</li>

                <li class="list-group-item border-0 ps-0 pb-0">
                  <strong class="text-dark text-sm">Social:</strong> &nbsp;
                  <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-facebook fa-lg"></i>
                  </a>
                  <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-twitter fa-lg"></i>
                  </a>
                  <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-instagram fa-lg"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>         -->

      </div>

    </div>
  </div>

@endsection