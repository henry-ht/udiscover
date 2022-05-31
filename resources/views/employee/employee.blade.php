@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Employee') }}</div>

                <div class="card-body">

                    <div class="pb-5 w-100 d-flex flex-row-reverse">
                        <a href="{{ route('employee.create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i> {{ __('New').' '.__('Employee') }}
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

                                                <form method="post" class="btn p-0" action="{{route('employee.destroy', $employee->id)}}"  name="employee_{{$employee->id}}" id="employee_{{$employee->id}}" >
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger" >
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>

                                                <a href="{{ route('employee.edit', $employee->id) }}" type="button" class="btn btn-sm btn-warning">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$employees}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
