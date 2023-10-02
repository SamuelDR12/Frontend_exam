@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9 ">
            <div class="card text-center">
                <div class="card-header bg-dark text-white">
                    <h2>Add a Employee</h2>
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
                    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Include a hidden input field for the company ID -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <select class="form-select text-center" name="company_id" required>
                                    <option value="" disabled selected>Select a Company</option>
                                    @foreach ($companies as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} Email : {{ $item->email }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">First Name</label>
                                <input type="text" class="form-control" name="first_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Last Name</label>
                                <input type="text" class="form-control" name="last_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Phone</label>
                                <input type="number" class="form-control" name="phone">
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
