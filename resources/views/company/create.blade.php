@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('New').__('Company') }}</div>

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

                    <form method="post" action="{{route('company.store')}}" enctype="multipart/form-data" >
                        @csrf
                         <div class="form-group mb-3">
                           <label for="name">Name</label>
                           <input type="text" id="name" name="name" class="form-control" required value="{{request()->old('name')}}" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required value="{{request()->old('email')}}" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="web_page">Web page</label>
                            <input type="url" id="web_page" name="web_page" class="form-control" value="{{request()->old('web_page')}}" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="logo">Logo</label>
                            <input type="file" id="logo" name="logo" class="form-control" value="{{request()->old('logo')}}" />
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
