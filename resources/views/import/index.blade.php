
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
              <h6> {{__('Import Page')}} </h6>
            </div>
            <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0"></h5>
                    </div>
                    <!-- <a href="" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;{{ __('Download Sample File') }}</a> -->
                    <a href="{{ route('download.sample') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button" download="+Download Sample File">+&nbsp;{{ __('Download Sample File') }}</a>
                </div>
            </div>

            
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-body pt-4 p-3">
                        <form action="{{ route('import.store') }}" method="POST" role="form text-left" enctype="multipart/form-data" >
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

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="url" class="form-control-label">{{ __('File') }} <span style="color:red;">*</span></label>
                                        <div class="@error('email')border border-danger rounded-3 @enderror">
                                            <input class="form-control" value="{{ old('file') }}" type="file" id="file" name="file">
                                                @error('url')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Import' }}</button>
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