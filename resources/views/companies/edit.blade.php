<!-- /resources/views/companies/edit.blade.php -->

@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="my-auto mt-3 mb-3">Edit Company</h4>
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
                <form method="post" action="{{ route('companies.update', $company->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $company->name }}">
                    </div>

                    <div class="form-group mt-3">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $company->email }}">
                    </div>

                    <div class="form-group mt-3">
                        <label for="logo">Logo:</label>
                        <input type="file" name="logo" id="logo" class="form-control">
                    </div>

                    <div class="form-group mt-3">
                        <label for="website">Website:</label>
                        <input type="website" name="website" id="website" class="form-control" value="{{ $company->website }}">
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Edit Company</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
<!-- Create Post Form -->
