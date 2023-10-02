@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9 ">
            <div class="card text-center">
                <div class="card-header bg-dark text-white">
                    <h2>Edit Company</h2>
                </div>
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    {{-- <div class="alert alert-danger">
                    <ul> --}}
                    @foreach ($errors->all() as $error)
                        {{-- <li>{{ $error }}</li> --}}
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <div class="card-body">
                    <form action="{{ route('companies.update', $company) }}" method="POST" class="forms-sample"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Include a hidden input field for the company ID -->
                        <input type="hidden" name="id" value="{{ $company->id }}">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Company Name</label>
                                <input type="text" class="form-control" name="company_name" value="{{ $company->name }}"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="company_email"
                                    value="{{ $company->email }}">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="">Company Website: </label>
                                <input type="text" class="form-control" name="company_website"
                                    value="{{ $company->website }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Company Logo (Minimum of 100x100): </label>
                                <input type="file" name="company_logo" class="form-control"
                                    accept="image/jpeg, image/png, image/jpg">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
