@extends('layouts.app')

@section('breadcrumb')
    Users Management
@endsection

@section('page-title')
    Users
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header  d-flex justify-content-between">
                    <h6>Users Table</h6>
                    <button type="button" class="btn btn-primary" onclick="openCreateUserModal()">
                        <i class="fas fa-plus me-2"></i> New User
                      </button>
                </div>
                <div class="card-body px-0 pt-0 ">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Role</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Employed</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->count())
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">Manager</p>
                                                <p class="text-xs text-secondary mb-0">{{ $user->Nic }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($user->status === 'active')
                                                    <span class="badge badge-sm bg-gradient-success">Active</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-secondary">Inactive</span>
                                                @endif

                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $user->created_at }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <!-- Action Dropdown Button -->

                                                <button class="btn btn-sm btn-light" type="button"
                                                    id="userActionMenu{{ $user->id }}" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>

                                                <!-- Dropdown Menu Items -->
                                                <ul class="dropdown-menu dropdown-menu-end shadow-sm"
                                                    aria-labelledby="userActionMenu{{ $user->id }}">
                                                    <!-- Edit Option -->
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-primary" href="#"
                                                           onclick="event.preventDefault(); openEditUserModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->phone }}', '{{ $user->Nic }}')">
                                                          <i class="fas fa-edit me-2"></i> Edit
                                                        </a>
                                                      </li>




                                                    <li>
                                                        @if ($user->status === 'active')
                                                            <a class="dropdown-item d-flex align-items-center text-warning"
                                                                href="#"
                                                                onclick="event.preventDefault(); confirmUserStatusChange({{ $user->id }}, '{{ $user->name }}', 'deactivate')">
                                                                <i class="fas fa-user-slash me-2"></i> Deactivate
                                                            </a>
                                                            <form id="deactivate-user-form-{{ $user->id }}"
                                                                action="{{ route('user.deactivate', $user->id) }}" method="POST" class="d-none">
                                                                @csrf
                                                            </form>
                                                        @else
                                                            <a class="dropdown-item d-flex align-items-center text-success"
                                                                href="#"
                                                                onclick="event.preventDefault(); confirmUserStatusChange({{ $user->id }}, '{{ $user->name }}', 'activate')">
                                                                <i class="fas fa-user-check me-2"></i> Activate
                                                            </a>
                                                            <form id="activate-user-form-{{ $user->id }}"
                                                                action="{{ route('user.activate', $user->id) }}" method="POST" class="d-none">
                                                                @csrf
                                                            </form>
                                                        @endif
                                                    </li>



                                                    <!-- Delete Option -->
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-danger"
                                                            href="#"
                                                            onclick="event.preventDefault(); confirmDelete({{ $user->id }}, '{{ $user->name }}')">
                                                            <i class="fas fa-trash-alt me-2"></i> Delete
                                                        </a>
                                                        <form id="delete-user-form-{{ $user->id }}"
                                                            action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </li>
                                                </ul>

                                            </td>


                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="py-3">
                                                <i class="fas fa-users-slash fa-2x text-muted mb-2"></i>
                                                <p class="mb-0">No users found</p>
                                                <a href="{{ route('user.create') }}"
                                                    class="btn btn-sm btn-primary mt-2">Create First User</a>
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


        <div class="modal fade" id="userFormModal" tabindex="-1" role="dialog" aria-labelledby="userFormModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
              <div class="modal-content">
                <div class="modal-body p-0">
                  <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                      <h3 class="font-weight-bolder text-info text-gradient" id="modalTitle">User Information</h3>
                      <p class="mb-0" id="modalSubtitle">Enter User Information</p>
                    </div>
                    <div class="card-body">
                      <form id="userForm" method="POST">
                        @csrf
                        <div id="methodField"></div>
                        <input type="hidden" id="userId" name="user_id">

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userName" class="form-control-label">Name</label>
                              <input type="text" id="userName" name="name" placeholder="Name" class="form-control" required />
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userEmail" class="form-control-label">Email</label>
                              <input type="email" id="userEmail" name="email" class="form-control" placeholder="name@example.com" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userPhone" class="form-control-label">Phone</label>
                              <input class="form-control" type="text" id="userPhone" name="phone" placeholder="Phone number">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userNic" class="form-control-label">NIC</label>
                              <input type="text" id="userNic" name="nic" placeholder="National ID" class="form-control"/>
                            </div>
                          </div>
                        </div>

                        <div class="row mt-4">
                          <div class="col-12 text-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-info" id="saveButton">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


    </div>





    <script>

function openCreateUserModal() {
    // Reset form
    document.getElementById('userForm').reset();
    document.getElementById('methodField').innerHTML = '';

    // Set form action for create
    document.getElementById('userForm').action = "{{ route('user.store') }}";

    // Update modal title
    document.getElementById('modalTitle').textContent = 'New User';
    document.getElementById('modalSubtitle').textContent = 'Enter User Information';
    document.getElementById('saveButton').textContent = 'Create User';

    // Clear hidden ID field
    document.getElementById('userId').value = '';

    // Open modal
    var modal = new bootstrap.Modal(document.getElementById('userFormModal'));
    modal.show();
  }

  function openEditUserModal(id, name, email, phone, nic) {
    // Reset form and add method field for PUT request
    document.getElementById('userForm').reset();
    document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';

    // Set form action for update
    document.getElementById('userForm').action = "{{ route('user.index') }}/" + id;

    // Fill form with user data
    document.getElementById('userId').value = id;
    document.getElementById('userName').value = name;
    document.getElementById('userEmail').value = email;
    document.getElementById('userPhone').value = phone || '';
    document.getElementById('userNic').value = nic || '';

    // Update modal title
    document.getElementById('modalTitle').textContent = 'Edit User';
    document.getElementById('modalSubtitle').textContent = 'Update User Information';
    document.getElementById('saveButton').textContent = 'Update User';

    // Open modal
    var modal = new bootstrap.Modal(document.getElementById('userFormModal'));
    modal.show();
  }

  // Form submission handling
  document.getElementById('userForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Here you could add validation

    // Submit the form
    this.submit();
  });


        function confirmUserStatusChange(userId, userName, action) {
            const statusText = action === 'activate' ? 'activate' : 'deactivate';
            const statusTitle = action === 'activate' ? 'Activate User' : 'Deactivate User';

            Swal.fire({
                title: statusTitle,
                text: `Are you sure you want to ${statusText} ${userName}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: action === 'activate' ? '#28a745' : '#ffc107',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, proceed'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`${action}-user-form-${userId}`).submit();
                }
            });
        }

        function confirmDelete(userId, userName) {
            Swal.fire({
                title: 'Delete User',
                text: `Are you sure you want to delete ${userName}? This action cannot be undone.`,
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-user-form-${userId}`).submit();
                }
            });
        }



    </script>
@endsection
