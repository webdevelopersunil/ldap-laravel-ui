@extends('layouts.user_type.auth')

@section('content')

<div>
    
    <div class="container-fluid py-4">
        <div class="card">
            

            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">{{ $heading }}</h5>
                    </div>
                    <a href="{{ route('project') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button"><-&nbsp; Go Back</a>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('project.store') }}" method="POST" role="form text-left">
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
                                <label for="name" class="form-control-label">{{ __('Project Name') }}</label>
                                <div class="@error('name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ old('name') }}" type="text" placeholder="Project Name" id="name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="url" class="form-control-label">{{ __('URL') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ old('url') }}" type="url" placeholder="URL" id="url" name="url">
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
                                <label for="ip" class="form-control-label">{{ __('IP') }}</label>
                                <div class="@error('ip')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ old('ip') }}" type="text" placeholder="IP Address" id="ip" name="ip">
                                        @error('ip')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="secondary_ip" class="form-control-label">{{ __('Secondary IP') }}</label>
                                <div class="@error('secondary_ip')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ old('secondary_ip') }}" type="text" placeholder="Secondary IP" id="secondary_ip" name="secondary_ip">
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
                                <label for="operating_system" class="form-control-label">{{ __('Operating System') }}</label>
                                <div class="@error('operating_system')border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="operating_system" name="operating_system" >
                                        <option value="window">Windows</option>
                                        <option value="linux">Linux</option>
                                    </select>
                                        @error('operating_system')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="operating_system_version" class="form-control-label">{{ __('Operating System Version') }}</label>
                                <div class="@error('operating_system_version')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ old('operating_system_version') }}" type="float" placeholder="Operating System Version" id="operating_system_version" name="operating_system_version">
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
                                <label for="language" class="form-control-label">{{ __('Language') }}</label>
                                <div class="@error('language')border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="language" name="language" >
                                        @foreach($languages as $language)
                                            <option value="{{$language->id}}">{{$language->title}}</option>
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
                                <label for="language_version" class="form-control-label">{{ __('Language Version') }}</label>
                                <div class="@error('language_version')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ old('language_version') }}" type="float" placeholder="Language Version" id="language_version" name="language_version">
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
                                <label for="framework" class="form-control-label">{{ __('Framework') }}</label>
                                <div class="@error('framework')border border-danger rounded-3 @enderror">
                                <select class="form-control" id="framework" name="framework" >
                                    @foreach($frameworks as $framework)
                                        <option value="{{$framework->id}}">{{$framework->title}}</option>
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
                                <label for="framework_version" class="form-control-label">{{ __('Framework Version') }}</label>
                                <div class="@error('framework_version')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ old('framework_version') }}" type="float" placeholder="Framework Version" id="framework_version" name="framework_version">
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
                                <label for="database" class="form-control-label">{{ __('Database') }}</label>
                                <div class="@error('database')border border-danger rounded-3 @enderror">
                                <select class="form-control" id="database" name="database" >
                                    @foreach($databases as $database)
                                        <option value="{{$database->id}}">{{$database->title}}</option>
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
                                <label for="database_version" class="form-control-label">{{ __('Database Version') }}</label>
                                <div class="@error('database_version')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ old('database_version') }}" type="float" placeholder="Database Version" id="database_version" name="database_version">
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
                                <label for="is_exposed_to_content" class="form-control-label">{{ __('Is Exposed to Content') }}</label>
                                <div class="@error('is_exposed_to_content')border border-danger rounded-3 @enderror">
                                <select class="form-control" id="is_exposed_to_content" name="is_exposed_to_content" >
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select>
                                        @error('is_exposed_to_content')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_dr" class="form-control-label">{{ __('Database Version') }}</label>
                                <div class="@error('is_dr')border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="is_dr" name="is_dr" >
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>
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
                                <label for="is_vapt_done" class="form-control-label">{{ __('Is Vapt Done') }}</label>
                                <div class="@error('is_vapt_done')border border-danger rounded-3 @enderror">
                                <select class="form-control" id="is_vapt_done" name="is_vapt_done" >
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select>
                                    @error('is_vapt_done')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_backup" class="form-control-label">{{ __('Database Version') }}</label>
                                <div class="@error('is_backup')border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="is_backup" name="is_backup" >
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>
                                    </select>
                                        @error('is_backup')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection