@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9 ">
            <div class="card text-center">
                <div class="card-header bg-dark text-white">
                    <h2>Employee Page</h2>
                </div>
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
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
                    <div id="table-wrapper">
                        <div id="table-scroll">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Company Name</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->id }}</td>
                                            <td>{{ $employee->company->name }}</td>
                                            <td>{{ $employee->first_name }}</td>
                                            <td>{{ $employee->last_name }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->phone }}</td>
                                            <td>
                                                <a href="{{ route('employees.edit', $employee) }}" type="button"
                                                    class="btn btn-outline-secondary btn-icon-text">
                                                    <i class="mdi mdi-file-check btn-icon-append"></i> Edit</a>
                                                <button class="btn btn-outline-danger btn-delete btn-icon-text "
                                                    style="margin-left: 5px;"
                                                    data-url="{{ route('employees.destroy', $employee) }}">
                                                    <i class="mdi mdi-alert btn-icon-prepend"></i> Delete </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row" id="links" style="height: 50px">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-delete', function() {
                $this = $(this);
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                Swal.fire({
                    title: "<h3 style='color:black'>" + 'Are you sure?' + "</h3>",
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post($this.data('url'), {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}',

                        }, function(res) {
                            $this.closest('tr').fadeOut(500, function() {
                                $(this).remove();
                            })
                        })
                        Swal.fire(
                            "<h3 style='color:black'>" + 'Deleted!' + "</h3>",
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })
        })
    </script>
@endsection
