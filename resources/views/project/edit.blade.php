
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
              <h6> {{__('Create Project Detail')}} </h6>
            </div>
            <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0"></h5>
                    </div>
                    <a href="{{ route('project.index') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;{{ __('Go Back') }}</a>
                </div>
            </div>

            
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-body pt-4 p-3">
                        <form action="{{ route('website.update') }}" method="POST" role="form text-left" enctype="multipart/form-data" >
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

                            @if (session('error'))
                                <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                                    <span class="alert-text text-white">
                                    {{ session('error') }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </button>
                                </div>
                            @endif


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">{{ __('Project Name') }} <span style="color:red;">*</span></label>
                                        <div class="@error('name')border border-danger rounded-3 @enderror">
                                            <input type="hidden" value="{{$website->id}}" name="id">
                                            <input class="form-control" 
                                                value="{{ $website->name }}" 
                                                type="text" 
                                                placeholder="Project Name" 
                                                id="name" 
                                                name="name">
                                                @error('name')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="url" class="form-control-label">{{ __('URL') }} <span style="color:red;">*</span></label>
                                        <div class="@error('email')border border-danger rounded-3 @enderror">
                                            <input class="form-control" value="{{ $website->url }}" type="url" placeholder="URL" id="url" name="url">
                                                @error('url')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ip" class="form-control-label">{{ __('IP') }} <span style="color:red;">*</span></label>
                                        <div class="@error('ip')border border-danger rounded-3 @enderror">
                                            <input class="form-control" value="{{ $website->ip }}" type="text" placeholder="IP Address" id="ip" name="ip">
                                                @error('ip')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="secondary_ip" class="form-control-label">{{ __('Secondary IP') }} ( <span style="color:#c04343;" >Comma Seperated IP</span> )</label>
                                        <div class="@error('secondary_ip')border border-danger rounded-3 @enderror">
                                            <input class="form-control" value="{{ $website->secondary_ip }}" type="text" placeholder="Secondary IP" id="secondary_ip" name="secondary_ip">
                                                @error('secondary_ip')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="operating_system" class="form-control-label">{{ __('Operating System') }} <span style="color:red;">*</span></label>
                                        <div class="@error('operating_system')border border-danger rounded-3 @enderror">
                                                
                                            <select class="form-control" id="operating_system" name="operating_system" >
                                                <option disabled selected>{{ __('Please Select') }}</option>
                                                    @foreach($operatingSystems as $operatingSystem)
                                                        <option value="{{ $operatingSystem->id }}"
                                                         @if( isset($website->operating_system) && $website->operating_system == $operatingSystem->id ) selected @endif >
                                                         {{ $operatingSystem->name }}
                                                        </option>
                                                    @endforeach
                                            </select>
                                                @error('operating_system')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="operating_system_version" class="form-control-label">{{ __('Operating System Version') }} <span style="color:red;">*</span></label>
                                        <div class="@error('operating_system_version')border border-danger rounded-3 @enderror">
                                        <input class="form-control" 
                                            value="{{ isset($website->operating_system_version) ? $website->operating_system_version : old('operating_system_version') }}"
                                            type="text" 
                                            placeholder="Operating System Version" 
                                            id="operating_system_version" 
                                            name="operating_system_version"
                                            oninput="validateOperatingSystemVersion(this)">
                                            @error('operating_system_version')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="language" class="form-control-label">{{ __('Language') }} <span style="color:red;">*</span></label>
                                        <div class="@error('language')border border-danger rounded-3 @enderror">
                                            <select class="form-control" id="language" name="language" >
                                                <option disabled selected>{{ __('Please Select') }}</option>
                                                @foreach($languages as $language)
                                                    <option value="{{$language->id}}"
                                                    @if( isset($website->language) && $website->language == $language->id ) selected @endif >
                                                    {{$language->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('language')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="language_version" class="form-control-label">{{ __('Language Version') }} <span style="color:red;">*</span></label>
                                        <div class="@error('language_version')border border-danger rounded-3 @enderror">
                                            <input class="form-control" 
                                                value="{{ isset($website->language_version) ? $website->language_version : old('language_version') }}"
                                                type="text" 
                                                placeholder="Language Version" 
                                                id="language_version" 
                                                name="language_version"
                                                oninput="validateLanguageVersion(this)">
                                                @error('language_version')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="framework" class="form-control-label">{{ __('Framework') }} <span style="color:red;">*</span></label>
                                        <div class="@error('framework')border border-danger rounded-3 @enderror">
                                        <select class="form-control" id="framework" name="framework" >
                                            <option disabled selected>{{ __('Please Select') }}</option>
                                            @foreach($frameworks as $framework)
                                                <option value="{{$framework->id}}"
                                                @if( isset($website->framework) && $website->framework == $framework->id ) selected @endif >
                                                {{$framework->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('framework')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="framework_version" class="form-control-label">{{ __('Framework Version') }} <span style="color:red;">*</span></label>
                                        <div class="@error('framework_version')border border-danger rounded-3 @enderror">
                                            <input class="form-control" 
                                                value="{{ isset($website->framework_version) ? $website->framework_version : old('framework_version') }}"
                                                type="text" 
                                                placeholder="Framework Version" 
                                                id="framework_version" 
                                                name="framework_version"
                                                oninput="validateFrameworkVersion(this)">
                                                @error('framework_version')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="database" class="form-control-label">{{ __('Database') }} <span style="color:red;">*</span></label>
                                        <div class="@error('database')border border-danger rounded-3 @enderror">
                                            <select class="form-control" id="database" name="database" >
                                                <option disabled selected>{{ __('Please Select') }}</option>
                                                @foreach($databases as $database)
                                                    <option value="{{$database->id}}"
                                                        @if( isset($website->database) && $website->database == $database->id ) selected @endif >
                                                        {{$database->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('database')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="database_version" class="form-control-label">{{ __('Database Version') }} <span style="color:red;">*</span></label>
                                        <div class="@error('database_version')border border-danger rounded-3 @enderror">
                                            <input class="form-control" 
                                                value="{{ isset($website->database_version) ? $website->database_version : old('database_version') }}"
                                                type="text" 
                                                placeholder="Database Version" 
                                                id="database_version" 
                                                name="database_version"
                                                oninput="validateDatabaseVersion(this)">
                                            @error('database_version')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_exposed_to_content" class="form-control-label">{{ __('Is Exposed to Internet') }} <span style="color:red;" > * </span> </label>
                                        <div class="@error('is_exposed_to_content')border border-danger rounded-3 @enderror">
                                        <select class="form-control" id="is_exposed_to_content" name="is_exposed_to_content" >
                                            <option selected disabled class="fw-bold" >Please Select</option>
                                            <option @if( isset($website->is_exposed_to_content) && $website->is_exposed_to_content == 'YES' ) selected @endif value="YES" >YES</option>
                                            <option @if( isset($website->is_exposed_to_content) && $website->is_exposed_to_content == 'NO' ) selected @endif value="NO">NO</option>
                                        </select>
                                            @error('is_exposed_to_content')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_dr" class="form-control-label">{{ __('Is Disaster Recovery') }} <span style="color:red;" > * </span> </label>
                                        <div class="@error('is_dr')border border-danger rounded-3 @enderror">
                                            <select class="form-control" id="is_dr" name="is_dr" >
                                                <option selected disabled class="fw-bold" >Please Select</option>
                                                <option @if( isset($website->is_dr) && $website->is_dr == 'YES' ) selected @endif value="YES">YES</option>
                                                <option @if( isset($website->is_dr) && $website->is_dr == 'NO' ) selected @endif value="NO">NO</option>
                                            </select>
                                                @error('database_version')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_vapt_done" class="form-control-label">{{ __('Is Vapt Done') }} <span style="color:red;" > * </span> </label>
                                        <div class="@error('is_vapt_done')border border-danger rounded-3 @enderror">
                                            <select class="form-control" id="is_vapt_done" name="is_vapt_done">
                                                <option selected disabled class="fw-bold">Please Select</option>
                                                <option @if( isset($website->is_vapt_done) && $website->is_vapt_done == 'YES' ) selected @endif value="YES">YES</option>
                                                <option @if( isset($website->is_vapt_done) && $website->is_vapt_done == 'NO' ) selected @endif value="NO">NO</option>
                                            </select>
                                            @error('is_vapt_done')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_backup" class="form-control-label">{{ __('Is Backup Recovery') }} <span style="color:red;" > * </span> </label>
                                        <div class="@error('is_backup')border border-danger rounded-3 @enderror">
                                            <select class="form-control" id="is_backup" name="is_backup" >
                                                <option selected disabled class="fw-bold" >Please Select</option>
                                                <option @if( isset($website->is_backup) && $website->is_backup == 'YES' ) selected @endif value="YES">YES</option>
                                                <option @if( isset($website->is_backup) && $website->is_backup == 'NO' ) selected @endif value="NO">NO</option>
                                            </select>
                                                @error('is_backup')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" id="fileInputContainer" style="display:none;">
                                    <div class="form-group">
                                        <label for="file" class="form-control-label">{{ __('File') }}</label>
                                        <div class="@error('file')border border-danger rounded-3 @enderror">
                                            <input class="form-control" type="file" name="file" id="file">
                                            @error('file')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Update Changes' }}</button>
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

    <script>
        function validateDatabaseVersion(input) {
            const value = input.value.trim();
            const regex = /^(\d+(\.\d*)?|\.\d+)$/;
            if (!regex.test(value)) {
                input.value = '';
            }
        }

        function validateOperatingSystemVersion(input) {
            const value = input.value.trim();
            const regex = /^(\d+(\.\d*)?|\.\d+)$/;
            if (!regex.test(value)) {
                input.value = '';
            }
        }
        function validateLanguageVersion(input) {
            const value = input.value.trim();
            const regex = /^(\d+(\.\d*)?|\.\d+)$/;
            if (!regex.test(value)) {
                input.value = '';
            }
        }
        function validateFrameworkVersion(input) {
            const value = input.value.trim();
            const regex = /^(\d+(\.\d*)?|\.\d+)$/;
            if (!regex.test(value)) {
                input.value = '';
            }
        }
        document.getElementById('is_vapt_done').addEventListener('change', function () {
            var fileInputContainer = document.getElementById('fileInputContainer');
            if (this.value === 'YES') {
                fileInputContainer.style.display = 'block';
            }else{
                fileInputContainer.style.display = 'none';
            }
        });
    </script>

@endsection