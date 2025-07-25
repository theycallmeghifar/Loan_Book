@extends('main')

@section('content')
    <title>Categories</title>
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
                                    <h2 class="title-1">Categories</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#addModal">
                                        <i class="zmdi zmdi-plus"></i>Add Categories</button>
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
                                                        <th>Created At</th>
                                                        <th>Updated At</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($categories as $category)
                                                        <tr>
                                                            <td>{{ $category->id ?? '-' }}</td>
                                                            <td>{{ $category->name ?? '-' }}</td>
                                                            <td>{{ $category->created_at ?? '-' }}</td>
                                                            <td>{{ $category->updated_at ?? '-' }}</td>
                                                            <td>
                                                                <!-- Tombol Update -->
                                                                <button 
                                                                    class="btn btn-sm btn-primary" 
                                                                    data-toggle="modal"
                                                                    data-target="#updateModal"
                                                                    onclick="fetchCategoryById({{ $category->id }})"
                                                                    title="Edit"
                                                                >
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </button>

                                                                <!-- Tombol Delete -->
                                                                <button 
                                                                    class="btn btn-sm btn-danger" 
                                                                    onclick="deleteCategory({{ $category->id }})" 
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
                        <h5 class="modal-title" id="addModalLabel">Add Categories</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('addCategories') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">Name</label>
                                <input type="text" id="name" name="name" placeholder="Name" class="form-control" required>
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
                        <h5 class="modal-title" id="updateModalLabel">Update Categories</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('updateCategories') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group" hidden>
                                <label for="idUpdate" class=" form-control-label">ID</label>
                                <input type="text" id="idUpdate" name="idUpdate" placeholder="ID" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nameUpdate" class=" form-control-label">Name</label>
                                <input type="text" id="nameUpdate" name="nameUpdate" class="form-control" required>
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

    function fetchCategoryById(id) {
        $.ajax({
            url: "{{ route('getCategoriesById') }}",
            method: 'GET',
            data: { id: id },
            success: function(response) {
                if (response.status) {
                    $('#idUpdate').val(response.data.id);
                    $('#nameUpdate').val(response.data.name);
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

    function deleteCategory(id) {
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
                fetch(`/deleteCategories/${id}`, {
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
