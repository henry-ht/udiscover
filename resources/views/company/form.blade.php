@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    @if (isset($edit_mode))
                        {{__('Edit')}}
                    @else
                        {{__('New')}}
                    @endif
                    {{__('Company') }}
                </div>

                <div class="card-body">
                    @error('error')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                                <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                                <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{isset($edit_mode) ? route('company.update',$company->id):route('company.store')}}" enctype="multipart/form-data" >

                        @if (isset($edit_mode))
                            @method('PUT')
                        @endif

                        @csrf
                         <div class="form-group mb-3">
                           <label for="name">Name</label>
                           <input type="text" id="name" name="name" class="form-control" required value="{{ $company->name ?? request()->old('name')}}" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required value="{{$company->email ?? request()->old('email')}}" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="web_page">Web page</label>
                            <input type="url" id="web_page" name="web_page" class="form-control" value="{{ $company->web_page ?? request()->old('web_page')}}" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="logo">Logo</label>
                            <input type="file" id="logo" name="logo" class="form-control" />
                        </div>

                        @if (isset($edit_mode) && isset($company->logo))
                            <div class="form-group mb-3">
                                <img src="{{$company->logo}}" alt="{{ $company->name}}" class="logo-100x100 img-fluid app-mini-logo" />
                            </div>
                        @endif

                        <div class="mt-4 text-center">
                            <button type="submit" class="btn btn-primary">
                                @if (isset($edit_mode))
                                    {{__('Edit')}}
                                @else
                                    {{__('Submit')}}
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
