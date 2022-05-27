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
                    {{__('Employee') }}
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

                    <form method="post" action="{{isset($edit_mode) ? route('employee.update',$employee->id):route('employee.store')}}" enctype="multipart/form-data" >

                        @if (isset($edit_mode))
                            @method('PUT')
                        @endif

                        @csrf
                        <div class="form-group mb-3">
                           <label for="first_name">First name</label>
                           <input type="text" id="first_name" name="first_name" class="form-control" required value="{{ $employee->first_name ?? request()->old('first_name')}}" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="last_name">Last name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" required value="{{ $employee->last_name ?? request()->old('last_name')}}" />
                         </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required value="{{$employee->email ?? request()->old('email')}}" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="company_id">Company</label>
                            <select id="company_id" name="company_id" class="form-control" value="{{ $employee->company_id ?? request()->old('company_id')}}" >
                                @foreach ($companies as $company)
                                    <option
                                        value="{{$company->id}}"

                                        @if (isset($employee->company_id))
                                            @if ($employee->company_id == $company->id)
                                                selected="selected"
                                            @endif
                                        @endif

                                        @if (request()->old('company_id') )
                                            @if (request()->old('company_id') == $company->id)
                                                selected="selected"
                                            @endif
                                        @endif


                                    >
                                        {{$company->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" class="form-control" required value="{{$employee->phone ?? request()->old('phone')}}" />
                        </div>

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
