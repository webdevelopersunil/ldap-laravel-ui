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
                    {{ $portals }}
                      <span class="text-success text-sm font-weight-bolder">
                        <a href="" style="text-decoration:none;" >
                          View
                        </a>
                      </span>
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
                      {{$back_up_configured}}
                      <!-- <span class="text-success text-sm font-weight-bolder">+3%</span> -->
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
                      {{ $vapt }}
                      <!-- <span class="text-danger text-sm font-weight-bolder">-2%</span> -->
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
                      {{$dr}}
                      <!-- <span class="text-success text-sm font-weight-bolder">+5%</span> -->
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
                  <h6>Recent Website's</h6>
                </div>
              </div>
            </div>
            
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Website Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">OS/Version</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Language/Version</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Framework/Version</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Database/Version</th>

                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Is Exposed To Content</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Is DR</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Is Vapt Done</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Is Backup</th>


                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($websites as $index => $website)
                  
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="../assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm me-3" alt="jira">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                            <h6>{{ ucfirst($website->name) }}</h6>
                              <p class="text-sm mb-0">
                                <span class="font-weight-bold ms-1">
                                  <a href="{{ ucfirst($website->url) }}" target="_blank">
                                    {{ ucfirst(Str::limit($website->url, 30)) }}
                                  </a>
                                </span>
                              </p>
                            </div>
                          </div>
                        </td>

                        <td>
                          <div class="avatar-group mt-2">
                            <p class="text-sm mb-0">
                                <span class="font-weight-bold ms-1">{{$website->operating_system}} |</span>{{$website->operating_system}}
                              </p>
                          </div>
                        </td>

                        <td>
                          <div class="avatar-group mt-2">
                            <p class="text-sm mb-0">
                                <span class="font-weight-bold ms-1">{{$website->language}} |</span>{{$website->language_version}}
                              </p>
                          </div>
                        </td>

                        <td>
                          <div class="avatar-group mt-2">
                            <p class="text-sm mb-0">
                                <span class="font-weight-bold ms-1">{{$website->framework}} |</span>{{$website->framework_version}}
                              </p>
                          </div>
                        </td>

                        <td>
                          <div class="avatar-group mt-2">
                            <p class="text-sm mb-0">
                                <span class="font-weight-bold ms-1">{{$website->database}} |</span>{{$website->database_version}}
                              </p>
                          </div>
                        </td>

                        <td>
                          <div class="avatar-group mt-2">
                            <p class="text-sm mb-0" style="text-align: center;" >
                                <span class="font-weight-bold ms-1">{{$website->is_exposed_to_content}}</span>
                              </p>
                          </div>
                        </td>

                        <td>
                          <div class="avatar-group mt-2">
                            <p class="text-sm mb-0" style="text-align: center;" >
                                <span class="font-weight-bold ms-1">{{$website->is_dr}}</span>
                              </p>
                          </div>
                        </td>

                        <td>
                          <div class="avatar-group mt-2">
                            <p class="text-sm mb-0" style="text-align: center;" >
                                <span class="font-weight-bold ms-1">{{$website->is_vapt_done}}</span>
                              </p>
                          </div>
                        </td>

                        <td>
                          <div class="avatar-group mt-2">
                            <p class="text-sm mb-0" style="text-align: center;" >
                                <span class="font-weight-bold ms-1">{{$website->is_backup}}</span>
                              </p>
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