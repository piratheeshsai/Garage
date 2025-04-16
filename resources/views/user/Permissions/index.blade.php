@extends('layouts.app')

@section('breadcrumb')
    Role Management
@endsection

@section('page-title')
       Role Management
@endsection

@section('content')
<div class="container-fluid py-3">

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0">Role Permissions</h5>
                        <a href="{{ route('Permission.create') }}" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="fa-solid fa-plus me-2"></i>
                            Create Role
                        </a>
                </div>

                <div class="card-body px-0 pt-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center  mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Role Name</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Permissions</th>
                                    <th  class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($roles->count())
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="role-icon bg-light rounded-circle p-2 me-3">
                                                        <i class="fas fa-user-shield text-primary"></i>
                                                    </div>
                                                    <h6 class="fw-bold mb-0">{{ $role->name }}</h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="permission-tags">
                                                    @foreach ($role->permissions->pluck('name')->take(3) as $permission)
                                                        <span
                                                            class="badge bg-light text-dark me-1 mb-1">{{ $permission }}</span>
                                                    @endforeach

                                                    @if ($role->permissions->count() > 3)
                                                        <span class="badge bg-secondary" data-bs-toggle="tooltip"
                                                            title="{{ implode(', ', $role->permissions->pluck('name')->slice(3)->toArray()) }}">
                                                            +{{ $role->permissions->count() - 3 }} more
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">

                                                <button class="btn btn-sm btn-light" type="button"
                                                 data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>


                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">


                                                <li>
                                                    <a href="{{ route('Permission.edit', $role->id) }}"
                                                        class="dropdown-item d-flex align-items-center text-primary" data-bs-toggle="tooltip"
                                                        title="Edit Role">
                                                        <i class="fas fa-edit me-2"></i> Edit
                                                    </a>
                                                  </li>
                                                  <li>

                                                    <a class="dropdown-item d-flex align-items-center text-danger"
                                                            href="#"
                                                            onclick="event.preventDefault(); confirmDelete({{ $role->id }}, '{{ $role->name }}')">
                                                            <i class="fas fa-trash-alt me-2"></i> Delete
                                                        </a>
                                                        <form id="delete-user-form-{{ $role->id }}"
                                                            action="{{ route('Permission.destroy', $role->id) }}" method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                  </li>
                                            </ul>


                                                {{-- <div class="d-flex justify-content-center gap-2">


                                                        <a href="{{ route('Permission.edit', $role->id) }}"
                                                            class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                                            title="Edit Role">
                                                            <i class="fas fa-edit"></i>
                                                        </a>



                                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                            onclick="confirmDelete({{ $role->id }}, '{{ $role->name }}')"
                                                            data-bs-toggle="tooltip" title="Delete Role">
                                                            <i class="fas fa-trash"></i>
                                                        </button>

                                                    <form id="delete-form-{{ $role->id }}"
                                                        action="{{ route('Permission.destroy', $role->id) }}" method="POST"
                                                        class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center py-4">
                                            <div class="py-3">
                                                <i class="fas fa-user-slash fa-2x text-muted mb-2"></i>
                                                <p class="mb-0">No roles found</p>
                                                <a href="{{ route('Permission.create') }}"
                                                    class="btn btn-sm btn-primary mt-2">Create First Role</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });


            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });

function confirmDelete(roleId, roleName) {
    Swal.fire({
        title: 'Delete Role',
        text: `Are you sure you want to delete ${roleName} role ? This action cannot be undone.`,
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`delete-user-form-${roleId}`).submit();
        }
    });
}



</script>
@endsection
