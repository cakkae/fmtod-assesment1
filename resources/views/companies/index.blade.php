<!-- /resources/views/company/index.blade.php -->

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
                <a href="{{ route('companies.create') }}">Add new company</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered mb-5">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Website</th>
                                    <th scope="col" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($companies as $company)
                                    <tr>
                                        <th scope="row" class="align-middle">{{ $company->id }}</th>
                                        <td class="align-middle">{{ $company->name }}</td>
                                        <td class="align-middle">{{ $company->email }}</td>
                                        <td class="align-middle"><img src="{{ url('storage/'.$company->logo) }}" alt="" title="" /></td>
                                        <td class="align-middle">{{ $company->website }}</td>
                                        <td class="align-middle"><a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary w-100">Edit</a></td>
                                        <td class="align-middle">
                                            <form action="{{ route('companies.destroy', $company->id)}}" method="post">
                                              @csrf
                                              @method('DELETE')
                                              <button class="btn btn-danger w-100" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <h3 class="text-center mt-3 mb-3">There is no company</h3>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- Pagination --}}
                        <div class="d-flex justify-content-center">
                            {!! $companies->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<div>
@endsection
