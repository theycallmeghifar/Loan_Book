@extends('main')

@section('content')
    <title>Users</title>
        <div class="page-wrapper">
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            @if(session('success'))
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show w-100">
                                    <span class="badge badge-pill badge-success">Success</span>
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if(session('failed'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show w-100">
                                    <span class="badge badge-pill badge-danger">Failed</span>
                                    {{ session('failed') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Users</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#addModal">
                                        <i class="zmdi zmdi-plus"></i>Add User</button>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-lg-12">
                                <div class="au-card recent-report">
                                    <div class="au-card-inner">
                                        <div class="table-responsive m-b-40">
                                            <table id="myTable" class="table table-borderless table-data3">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th hidden>Email</th>
                                                        <th>Password</th>
                                                        <th>Phone</th>
                                                        <th>Address</th>
                                                        <th>Role</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $user)
                                                        <tr>
                                                            <td>{{ $user->id ?? '-' }}</td>
                                                            <td>{{ $user->name ?? '-' }}</td>
                                                            <td>{{ $user->email ?? '-' }}</td>
                                                            <td hidden>{{ $user->password ?? '-' }}</td>
                                                            <td>{{ $user->phone ?? '-' }}</td>
                                                            <td>{{ $user->address ?? '-' }}</td>
                                                            <td>{{ $user->role ?? '-' }}</td>
                                                            <td>
                                                                <!-- Tombol Update -->
                                                                <button 
                                                                    class="btn btn-sm btn-primary" 
                                                                    data-toggle="modal"
                                                                    data-target="#updateModal"
                                                                    onclick="fetchUsersById({{ $user->id }})"
                                                                    title="Edit"
                                                                >
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </button>

                                                                <!-- Tombol Delete -->
                                                                <button 
                                                                    class="btn btn-sm btn-danger" 
                                                                    onclick="deleteUser({{ $user->id }})" 
                                                                    title="Delete"
                                                                >
                                                                    <i class="zmdi zmdi-delete"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2025. All rights reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('addUsers') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Name</label>
                                <input type="text" id="name" name="name" placeholder="Name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class=" form-control-label">Email</label>
                                <input type="email" id="email" name="email" placeholder="Email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class=" form-control-label">Password</label>
                                <input type="password" id="password" name="password" placeholder="Password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phone" class=" form-control-label">Phone</label>
                                <input type="text" id="phone" name="phone" placeholder="Phone" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="address" class=" form-control-label">Address</label>
                                <textarea type="text" id="address" name="address" placeholder="Address" class="form-control" required></textarea>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-12">
                                    <label for="role" class=" form-control-label">Role</label>
                                </div>
                                <div class="col-12 col-md-12">
                                    <select name="role" id="role" class="form-control" required>
                                        <option value="" selected disabled>Please select role</option>
                                        <option value="admin">Admin</option>
                                        <option value="librarian">Librarian</option>
                                        <option value="member">Member</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('updateUsers') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group" hidden>
                                <label for="idUpdate" class=" form-control-label">ID</label>
                                <input type="text" id="idUpdate" name="idUpdate" placeholder="Name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nameUpdate" class=" form-control-label">Name</label>
                                <input type="text" id="nameUpdate" name="nameUpdate" placeholder="Name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="emailUpdate" class=" form-control-label">Email</label>
                                <input type="email" id="emailUpdate" name="emailUpdate" placeholder="Email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="passwordUpdate" class=" form-control-label">Password</label>
                                <input type="password" id="passwordUpdate" name="passwordUpdate" placeholder="Password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phoneUpdate" class=" form-control-label">Phone</label>
                                <input type="text" id="phoneUpdate" name="phoneUpdate" placeholder="Phone" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="addressUpdate" class=" form-control-label">Address</label>
                                <textarea type="text" id="addressUpdate" name="addressUpdate" placeholder="Address" rows="3" class="form-control" required></textarea>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-12">
                                    <label for="roleUpdate" class=" form-control-label">Role</label>
                                </div>
                                <div class="col-12 col-md-12">
                                    <select name="roleUpdate" id="roleUpdate" class="form-control" required>
                                        <option value="" selected disabled>Please select role</option>
                                        <option value="admin">Admin</option>
                                        <option value="librarian">Librarian</option>
                                        <option value="member">Member</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });

    function fetchUsersById(id) {
        $.ajax({
            url: "{{ route('getUsersById') }}",
            method: 'GET',
            data: { id: id },
            success: function(response) {
                if (response.status) {
                    $('#idUpdate').val(response.data.id);
                    $('#nameUpdate').val(response.data.name);
                    $('#emailUpdate').val(response.data.email);
                    $('#passwordUpdate').val(response.data.password);
                    $('#phoneUpdate').val(response.data.phone);
                    $('#addressUpdate')
                        .val(response.data.address)
                        .css('height', 'auto')
                        .height($('#addressUpdate')[0].scrollHeight);
                    $('#roleUpdate').val(response.data.role);
                    $('#updateModal').modal('show');
                } else {
                    alert('Data not found.');
                }
            },
            error: function(xhr) {
                alert('Terjadi kesalahan saat mengambil data.');
            }
        });
    }

    function deleteUser(id) {
        Swal.fire({
            title: 'Are you sure you want to delete?',
            text: "The data will be moved to the trash (soft delete).",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/deleteUsers/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Gagal!', data.message, 'error');
                    }
                })
                .catch(err => {
                    Swal.fire('Error!', 'Terjadi kesalahan saat menghapus.', 'error');
                    console.error(err);
                });
            }
        });
    }

    $('#addModal').on('hidden.bs.modal', function () {
        $(this).find('input, textarea, select').val('');
    });

    $('#updateModal').on('hidden.bs.modal', function () {
        $(this).find('input, textarea, select').val('');
    });
</script>
@endpush
