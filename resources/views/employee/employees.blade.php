@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Employee') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

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
                                Email
                            </th>
                            <th scope="col">
                                Phone
                            </th>
                            <th scope="col">
                                Company
                            </th>
                            <th scope="col">
                                Options
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <th scope="row">
                                        {{ $employee->id }}
                                    </th>
                                    <td>
                                        {{ $employee->first_name . $employee->last_name}}
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $employee->email }}">
                                            {{ $employee->email }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @if (isset($employee->phone))
                                            <a href="tel:{{ $employee->phone }}">
                                                {{ $employee->phone }}
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $employee->company->name}}
                                    </td>
                                    <td>
                                        <div class="btn-group-sm" role="group" aria-label="Options">
                                            <button type="button" class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
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
@endsection
