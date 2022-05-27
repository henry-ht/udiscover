@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Company') }}</div>

                <div class="card-body">
                    <div class="pb-5 w-100 d-flex flex-row-reverse">
                        <a href="{{ route('company.create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i> {{ __('New').__('Company') }}
                        </a>
                    </div>

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

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">
                                    #
                                </th>
                                <th scope="col">
                                    Name
                                </th>
                                <th scope="col">
                                    Web page
                                </th>
                                <th scope="col">
                                    Employees
                                </th>
                                <th scope="col">
                                    Options
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <th scope="row">
                                            {{ $company->id }}
                                        </th>
                                        <td>
                                            @if (isset($company->logo))
                                                <img src="{{$company->logo}}" alt="{{ $company->name}}" class="logo-100x100 img-fluid rounded-circle app-mini-logo" />
                                            @endif
                                            {{ $company->name }}
                                        </td>
                                        <td>
                                            @if (isset($company->web_page))
                                                <a href="{{$company->web_page}}" target="_blank">
                                                    {{parse_url($company->web_page)['host']}}
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $company->employee_count }}
                                        </td>
                                        <td>
                                            <div class="btn-group-sm" role="group" aria-label="Options">

                                                <form method="post" class="btn p-0" action="{{route('company.destroy', $company->id)}}"  name="company_{{$company->id}}" id="company_{{$company->id}}" >
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger" >
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>

                                                <a href="{{ route('company.edit', $company->id) }}" type="button" class="btn btn-sm btn-warning">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-success">
                                                    <i class="fa-solid fa-users"></i>
                                                </button>
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
</div>
@endsection

