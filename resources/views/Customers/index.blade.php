@extends('layouts.app')

@section('breadcrumb')
    Users Management
@endsection

@section('page-title')
    Users
@endsection

@section('content')
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 ">
                        <div class="table-responsive p-0">
                            <table id="customersTable" class="table align-items-center mb-0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Full Name</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mobile</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DOB</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <style>
        .dataTables_filter {
            text-align: right !important;
            padding-right: 20px;
        }
        .dataTables_filter input {
            margin-top: 10%;
            display: inline-block;
            width: auto !important;
            margin-left: 0.5rem;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#customersTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route("customers.index") }}',

                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name',  className: 'text-center' },
                    { data: 'phone', name: 'phone',  className: 'text-center'},
                    { data: 'email', name: 'email' },
                    { data: 'DOB', name: 'DOB' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endsection
