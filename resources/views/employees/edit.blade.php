<!-- /resources/views/employees/edit.blade.php -->

@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="my-auto mt-3 mb-3">Edit Employee</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('employees.update', $employee->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="firstName">First name:</label>
                        <input type="text" name="firstName" id="firstName" class="form-control" value="{{ $employee->firstName }}">
                    </div>

                    <div class="form-group mt-3">
                        <label for="lastName">Last name:</label>
                        <input type="text" name="lastName" id="lastName" class="form-control" value="{{ $employee->lastName }}">
                    </div>

                    <div class="form-group mt-3">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $employee->email }}">
                    </div>

                    <div class="form-group mt-3">
                        <label for="company_id">Company:</label>
                        <select name="company_id" id="company_id" class="form-control">
                            @forelse ($companies as $company)
                                <option value="{{ $company->id }}" {{ $employee->company_id == $company->id ? "selected" : "" }}>{{ $company->name }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $employee->phone }}">
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Edit Employee</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
<!-- Create Employee Form -->
