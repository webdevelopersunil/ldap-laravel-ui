@extends('layouts.user')

@section('content')
  
  @include('partials.sidebar')

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <!-- Start Navbar -->
    @include('partials.navbar')
    <!-- End Navbar -->
    @if(session('success'))
        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
            <span class="alert-text text-white">
            {{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </button>
        </div>
    @endif
    <div class="row my-6">
        <!-- Database -->
        <div class="col-lg-3 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>{{ __("Operating System's") }}</h6>
              <p class="text-sm" style="text-align: right;" >
                <a href="{{ route('os.create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;{{ __('Add') }}</a>
              </p>
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side">
                
                @if(isset($oss))
                    @foreach( $oss as $index => $os )
                        <div class="timeline-block mb-3">
                        <span class="timeline-step">
                          <a href="{{ route('os.edit', $os->id) }}"><i class="ni ni-active-40 text-primary text-gradient"></i></a>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">{{$index+1}}. &nbsp {{ $os->name }} </h6>
                            <!-- <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p> -->
                            
                        </div>
                        </div>
                    @endforeach
                @else
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            <i class="ni ni-key-25 text-primary text-gradient"></i>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">{{ __('No Data') }}</h6>
                        </div>
                    </div>
                @endif

              </div>
            </div>
          </div>
        </div>


        <!-- Database -->
        <div class="col-lg-3 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>{{ __("Database's") }}</h6>
              <p class="text-sm" style="text-align: right;" >
                <a href="{{ route('database.create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;{{ __('Add') }}</a>
              </p>
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side">
                
                @if(isset($databases))
                    @foreach( $databases as $index => $database )
                        <div class="timeline-block mb-3">
                        <span class="timeline-step">
                          <a href="{{ route('database.edit', $database->id) }}"><i class="ni ni-active-40 text-primary text-gradient"></i></a>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">{{$index+1}}. &nbsp {{ $database->name }}</h6>
                        </div>
                        </div>
                    @endforeach
                @else
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            <i class="ni ni-key-25 text-primary text-gradient"></i>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">{{ __('No Data') }}</h6>
                        </div>
                    </div>
                @endif
              </div>
            </div>
          </div>
        </div>



        <!-- Database -->
        <div class="col-lg-3 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>{{ __("Language's") }}</h6>
              <p class="text-sm" style="text-align: right;" >
                <a href="{{ route('language.create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;{{ __('Add') }}</a>
              </p>
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side">
                
                @if(isset($languages))
                    @foreach( $languages as $index => $language )
                        <div class="timeline-block mb-3">
                        <span class="timeline-step">
                          <a href="{{ route('language.edit', $language->id) }}"><i class="ni ni-active-40 text-primary text-gradient"></i></a>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">{{$index+1}}. &nbsp {{ $language->name }}</h6>
                        </div>
                        </div>
                    @endforeach
                @else
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            <i class="ni ni-key-25 text-primary text-gradient"></i>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">{{ __('No Data') }}</h6>
                        </div>
                    </div>
                @endif

              </div>
            </div>
          </div>
        </div>



        <!-- Database -->
        <div class="col-lg-3 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>{{ __("Framework's") }}</h6>
              <p class="text-sm" style="text-align: right;" >
                <a href="{{ route('framework.create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;{{ __('Add') }}</a>
              </p>
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side">
                
                @if(isset($frameworks))
                    @foreach( $frameworks as $index => $framework )
                        <div class="timeline-block mb-3">
                        <span class="timeline-step">
                          <a href="{{ route('framework.edit', $framework->id) }}"><i class="ni ni-active-40 text-primary text-gradient"></i></a>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">{{$index+1}}. &nbsp {{ $framework->name }}</h6>
                        </div>
                        </div>
                    @endforeach
                @else
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            <i class="ni ni-key-25 text-primary text-gradient"></i>
                        </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">{{ __('No Data') }}</h6>
                        </div>
                    </div>
                @endif

              </div>
            </div>
          </div>
        </div>

    </div>


    
  </main>


@endsection