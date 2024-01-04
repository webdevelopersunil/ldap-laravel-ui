
@extends('layouts.user')

@section('content')
  
  
  @include('partials.sidebar')


  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <!-- Start Navbar -->
    @include('partials.navbar')
    <!-- End Navbar -->
    
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>{{ $title }}</h6>
            </div>
            <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0"></h5>
                    </div>
                    <a href="{{ route('manage.index') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;{{ __('Go Back') }}</a>
                </div>
            </div>

            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-body pt-4 p-3">
                        @if($mode == 'database')
                            <form action="{{ route('database.store') }}" method="POST" role="form text-left">
                        @elseif($mode == 'os')
                            <form action="{{ route('os.store') }}" method="POST" role="form text-left">
                        @elseif($mode == 'language')
                            <form action="{{ route('language.store') }}" method="POST" role="form text-left">
                        @elseif($mode == 'framework')
                            <form action="{{ route('framework.store') }}" method="POST" role="form text-left">
                        @endif

                            @csrf
                            @if($errors->any())
                                <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                                    <span class="alert-text text-white">
                                    {{$errors->first()}}</span>
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
                            @if(session('error'))
                                <div class="m-3  alert alert-danger alert-dismissible fade show" id="alert-success" role="alert">
                                    <span class="alert-text text-white">
                                    {{ session('error') }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </button>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">{{ $label }}</label>
                                        <div class="@error('name')border border-danger rounded-3 @enderror">
                                            <input type="text" class="form-control" aria-label="Default select example" name="name" id="template">
                                            @error('name')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Create' }}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            
          </div>
        </div>
      </div>
      
    </div>
  </main>


@endsection