@extends('main')

@section('content')
    <title>Book Categories</title>
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
                                    <h2 class="title-1">Book Categories</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#addModal">
                                        <i class="zmdi zmdi-plus"></i>Add Book Categories</button>
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
                                                        <th>Book</th>
                                                        <th>Category</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($bookCategories as $bookCategory)
                                                        <tr>
                                                            <td>{{ $bookCategory->id ?? '-' }}</td>
                                                            @foreach($books as $book)
                                                                @if($book->id == $bookCategory->book_id)
                                                                    <td>{{ $book->title ?? '-' }}</td>
                                                                @endif
                                                            @endforeach
                                                            @foreach($categories as $category)
                                                                @if($category->id == $bookCategory->category_id)
                                                                    <td>{{ $category->name ?? '-' }}</td>
                                                                @endif
                                                            @endforeach
                                                            <td>
                                                                <!-- Tombol Update -->
                                                                <button 
                                                                    class="btn btn-sm btn-primary" 
                                                                    data-toggle="modal"
                                                                    data-target="#updateModal"
                                                                    onclick="fetchBookCategoryById({{ $bookCategory->id }})"
                                                                    title="Edit"
                                                                >
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </button>

                                                                <!-- Tombol Delete -->
                                                                <button 
                                                                    class="btn btn-sm btn-danger" 
                                                                    onclick="deleteBookCategory({{ $bookCategory->id }})" 
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
                        <h5 class="modal-title" id="addModalLabel">Add Book Categories</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('addBookCategories') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col col-md-12">
                                    <label for="book" class=" form-control-label">Book</label>
                                </div>
                                <div class="col-12 col-md-12">
                                    <select name="book_id" id="book_id" class="form-control" required>
                                        <option value="" selected disabled>Please select book</option>
                                        @foreach ($books as $book)
                                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-12">
                                    <label for="category" class=" form-control-label">Category</label>
                                </div>
                                <div class="col-12 col-md-12">
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="" selected disabled>Please select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
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
                        <h5 class="modal-title" id="updateModalLabel">Update Book Categories</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('updateBookCategories') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group" hidden>
                                <label for="idUpdate" class=" form-control-label">ID</label>
                                <input type="text" id="idUpdate" name="idUpdate" placeholder="ID" class="form-control" required>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-12">
                                    <label for="book" class=" form-control-label">Book</label>
                                </div>
                                <div class="col-12 col-md-12">
                                    <select name="book_idUpdate" id="book_idUpdate" class="form-control" required>
                                        <option value="" selected disabled>Please select book</option>
                                        @foreach ($books as $book)
                                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-12">
                                    <label for="category" class=" form-control-label">Category</label>
                                </div>
                                <div class="col-12 col-md-12">
                                    <select name="category_idUpdate" id="category_idUpdate" class="form-control" required>
                                        <option value="" selected disabled>Please select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
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

    function fetchBookCategoryById(id) {
        $.ajax({
            url: "{{ route('getBookCategoriesById') }}",
            method: 'GET',
            data: { id: id },
            success: function(response) {
                if (response.status) {
                    $('#idUpdate').val(response.data.id);
                    $('#book_idUpdate').val(response.data.book_id);
                    $('#category_idUpdate').val(response.data.category_id);
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

    function deleteBookCategory(id) {
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
                fetch(`/deleteBookCategories/${id}`, {
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
