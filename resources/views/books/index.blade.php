@extends('main')

@section('content')
    <title>Books</title>
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
                                    <h2 class="title-1">Books</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#addModal">
                                        <i class="zmdi zmdi-plus"></i>Add Books</button>
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
                                                        <th>Title</th>
                                                        <th>Authors</th>
                                                        <th>Description</th>
                                                        <th>ISBN</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($books as $book)
                                                        <tr>
                                                            <td>{{ $book->id ?? '-' }}</td>
                                                            <td>{{ $book->title ?? '-' }}</td>
                                                            <td>{{ $book->authors ?? '-' }}</td>
                                                            <td>{{ $book->description ?? '-' }}</td>
                                                            <td>{{ $book->isbn ?? '-' }}</td>
                                                            <td>
                                                                <!-- Tombol Update -->
                                                                <button 
                                                                    class="btn btn-sm btn-primary" 
                                                                    data-toggle="modal"
                                                                    data-target="#updateModal"
                                                                    onclick="fetchBookById({{ $book->id }})"
                                                                    title="Edit"
                                                                >
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </button>

                                                                <!-- Tombol Delete -->
                                                                <button 
                                                                    class="btn btn-sm btn-danger" 
                                                                    onclick="deleteBook({{ $book->id }})" 
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
                        <h5 class="modal-title" id="addModalLabel">Add Books</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('addBooks') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title" class=" form-control-label">Title</label>
                                <input type="text" id="title" name="title" placeholder="Title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="authors" class=" form-control-label">Authors</label>
                                <input type="text" id="authors" name="authors" placeholder="Authors" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="description" class=" form-control-label">Description</label>
                                <textarea type="text" id="description" name="description" placeholder="Description" rows="4" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="isbn" class=" form-control-label">ISBN</label>
                                <input type="text" id="isbn" name="isbn" placeholder="ISBN" class="form-control" required>
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
                        <h5 class="modal-title" id="updateModalLabel">Update Books</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('updateBooks') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group" hidden>
                                <label for="idUpdate" class=" form-control-label">ID</label>
                                <input type="text" id="idUpdate" name="idUpdate" placeholder="ID" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="titleUpdate" class=" form-control-label">Title</label>
                                <input type="text" id="titleUpdate" name="titleUpdate" placeholder="Title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="authorsUpdate" class=" form-control-label">Authors</label>
                                <input type="text" id="authorsUpdate" name="authorsUpdate" placeholder="Authors" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="descriptionUpdate" class=" form-control-label">Description</label>
                                <textarea type="text" id="descriptionUpdate" name="descriptionUpdate" placeholder="Description" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="isbnUpdate" class=" form-control-label">ISBN</label>
                                <input type="text" id="isbnUpdate" name="isbnUpdate" placeholder="ISBN" class="form-control" required>
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

    function fetchBookById(id) {
        $.ajax({
            url: "{{ route('getBooksById') }}",
            method: 'GET',
            data: { id: id },
            success: function(response) {
                if (response.status) {
                    $('#idUpdate').val(response.data.id);
                    $('#titleUpdate').val(response.data.title);
                    $('#authorsUpdate').val(response.data.authors);
                    $('#descriptionUpdate')
                        .val(response.data.description)
                        .css('height', 'auto')
                        .height($('#descriptionUpdate')[0].scrollHeight);
                    $('#isbnUpdate').val(response.data.isbn);
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

    function deleteBook(id) {
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
                fetch(`/deleteBooks/${id}`, {
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
