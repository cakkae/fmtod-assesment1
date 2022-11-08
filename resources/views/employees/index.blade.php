<!-- /resources/views/employees/index.blade.php -->

@extends('layouts.app')

@section('content')

    @if (session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="container">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('employees.create') }}">Add new employee</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered mb-5">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First name</th>
                                    <th scope="col">Last name</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employees as $key => $employee)
                                    <tr>
                                        <th scope="row" class="align-middle">
                                            {{ $key + $employees->firstItem() }}
                                        </th>
                                        <td class="align-middle">{{ $employee->firstName }}</td>
                                        <td class="align-middle">{{ $employee->lastName }}</td>
                                        <td class="align-middle">{{ App\Models\Company::where('id', $employee->company_id)->pluck('name')[0] }}</td>
                                        <td class="align-middle">{{ $employee->email }}</td>
                                        <td class="align-middle">{{ $employee->phone }}</td>
                                        <td class="align-middle"><a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary w-100">Edit</a></td>
                                        <td class="align-middle">
                                            <form action="{{ route('employees.destroy', $employee->id)}}" method="post">
                                              @csrf
                                              @method('DELETE')
                                              <button class="btn btn-danger w-100" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <h3 class="text-center mt-3 mb-3">There is no employee</h3>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- Pagination --}}
                        <div class="d-flex justify-content-center">
                            {!! $employees->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<div>
@endsection
