@extends('layouts.user')

@section('content')
  
  @include('partials.sidebar')
  
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
    <!-- Start Navbar -->
    @include('partials.navbar')
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Portals</p>
                    <h5 class="font-weight-bolder mb-0">
                        0
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Back-up Configured</p>
                    <h5 class="font-weight-bolder mb-0">
                    0
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Vapt Done</p>
                    <h5 class="font-weight-bolder mb-0">
                    0
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">DR Configured</p>
                    <h5 class="font-weight-bolder mb-0">
                    0
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
      <div class="row my-4">


        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Users List</h6>
                </div>
              </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                @if(session('error'))
                    <div class="m-3  alert alert-danger alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('error') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                    </div>
                @endif
                @if(session('success'))
                    <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text text-white">
                        {{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif
                
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">cpfNo</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($users as $index => $user)
                  
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="../assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm me-3" alt="jira">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6>{{ ucfirst($user->name) }}</h6>
                                <p class="text-sm mb-0">
                                <span class="font-weight-bold ms-1" style="color:#2684FF;" >
                                    {{ ucfirst($user->email) }}
                                </span>
                              </p>
                            </div>
                          </div>
                        </td>

                        <td>
                          <div class="avatar-group mt-2">
                            <p class="text-sm mb-0">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6>{{$user->cpfNo}}</h6>
                                </div>
                              </p>
                          </div>
                        </td>

                        <td>
                          <div class="avatar-group mt-2">
                            <p class="text-sm mb-0">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6>{{  ucfirst($user->email) }}</h6>
                                </div>
                              </p>
                          </div>
                        </td>

                        <td>
                          <div class="avatar-group mt-2">
                            <p class="text-sm mb-0">
                                <span class="font-weight-bold ms-1" style="color:#2684FF;" >
                                    @auth
                                        @foreach(auth()->user()->roles as $role)
                                            {{$role->name}}
                                        @endforeach
                                    @endauth
                                </span>
                              </p>
                          </div>
                        </td>

                        <td>
                          <div class="avatar-group mt-2">
                                <a href="{{ route('users.edit', $user->id) }}">
                                    Edit
                                </a>
                          </div>
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

      <!-- Footer Section -->

    </div>
  </main>

    @section('script')

        <!-- Script Here -->

    @endsection

@endsection