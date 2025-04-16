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
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0">User Roles</h5>

                    <button class="btn btn-primary btn-sm d-flex align-items-center" id="assignRoleBtn" data-bs-toggle="modal" data-bs-target="#assignRoleModal">
                        <i class="fa-solid fa-user-plus me-2"></i>
                        Assign Role
                    </button>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>User</th>
                                    <th>Role</th>
                                    <th width="120">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->count())
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center px-2">
                                                <div>
                                                    <h6 class="mb-0">{{ $user->name }}</h6>
                                                    <span class="text-muted small">{{ $user->email }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($user->hasRole($roles))
                                                <span class="badge bg-success text-white">{{ $user->getRoleNames()->first() }}</span>
                                            @else
                                                <span class="badge bg-warning text-dark">No Role Assigned</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                <li>
                                                    <a href="#" class="dropdown-item d-flex align-items-center text-primary edit-role-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editRoleModal"
                                                        data-user-id="{{ $user->id }}"
                                                        data-user-name="{{ $user->name }}"
                                                        data-user-email="{{ $user->email }}"
                                                        data-user-role="{{ $user->hasRole($roles) ? $user->roles->first()->id : '' }}">
                                                        <i class="fas fa-edit me-2"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center text-danger"
                                                        href="#"
                                                        onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')">
                                                        <i class="fas fa-trash-alt me-2"></i> Remove
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center py-4">No users found</td>
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

<!-- Edit Role Modal -->
<!-- Edit Role Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoleModalLabel">Edit User Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editRoleForm" action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">User</label>
                        <input type="text" class="form-control" id="edit_user_name" readonly>
                        <small id="edit_user_email" class="form-text text-muted"></small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Assign Role</label>
                        <select class="form-select" name="role_id" id="edit_user_role">
                            <option value="">No Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Role</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Assign Role Modal -->
<div class="modal fade" id="assignRoleModal" tabindex="-1" aria-labelledby="assignRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignRoleModalLabel">Assign Role to User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Role.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select User</label>
                        <select class="form-select" name="user_id" required>
                            <option value="">Select User</option>
                            @foreach($allUsers as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Assign Role</label>
                        <select class="form-select" name="role_id">
                            <option value="">No Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Assign Role</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Hidden form for delete operation -->
<form id="deleteRoleForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    // Edit role button click handler
    const editButtons = document.querySelectorAll('.edit-role-btn');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            const userName = this.getAttribute('data-user-name');
            const userEmail = this.getAttribute('data-user-email');
            const userRole = this.getAttribute('data-user-role');

            // Set the form action with the new dedicated update route
            document.getElementById('editRoleForm').action = `/update-user-role/${userId}`;

            document.getElementById('edit_user_name').value = userName;
            document.getElementById('edit_user_email').textContent = userEmail;

            // Set the selected role
            const selectElement = document.getElementById('edit_user_role');
            selectElement.value = userRole;
        });
    });
});

    // Function to confirm role deletion with SweetAlert2
    function confirmDelete(userId, userName) {
        Swal.fire({
            title: 'Are you sure?',
            html: `You are about to remove the role from <strong>${userName}</strong>. This action cannot be undone.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, remove role!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Set the form action with the correct resource route
                const form = document.getElementById('deleteRoleForm');
                form.action = `/Role/${userId}`;
                form.submit();
            }
        });
    }
</script>
@endsection
