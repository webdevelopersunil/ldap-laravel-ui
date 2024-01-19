
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
                    <a href="{{ route('users.list') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;{{ __('Go Back') }}</a>
                </div>
            </div>

            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-body pt-4 p-3">
                        
                        <form action="{{ route($route) }}" method="POST" role="form text-left">
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
                            
                            @if(isset($user->id))
                                <input type="hidden" name="id" value="{{ $user->id }}" >
                            @endif

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">Email Address</label>
                                        <div>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="template"
                                                value="{{ucfirst($user->name)}}"
                                                disabled
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">User Name</label>
                                        <div>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="template"
                                                value="{{ucfirst($user->email)}}"
                                                disabled
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">Role</label>
                                        <div class="@error('name')border border-danger rounded-3 @enderror">
                                            <select class="form-control"  name="role" id="">
                                                <option disabled selected>Please Select</option>
                                                @foreach( $roles as $index => $role )
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('name')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Update' }}</button>
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