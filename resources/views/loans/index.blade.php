@extends('main')

@section('content')
    <title>Loans</title>
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
                                    <h2 class="title-1">Loans</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#addModal">
                                        <i class="zmdi zmdi-plus"></i>Loan Book</button>
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
                                                        <th>Librarian</th>
                                                        <th>Member</th>
                                                        <th>Loan At</th>
                                                        <th>Returned At</th>
                                                        <th>Note</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($loans as $loan)
                                                        <tr>
                                                            <td>{{ $loan->id ?? '-' }}</td>
                                                            @foreach($books as $book)
                                                                @if($book->id == $loan->book_id)
                                                                    <td>{{ $book->title ?? '-' }}</td>
                                                                @endif
                                                            @endforeach
                                                            @foreach($librarians as $librarian)
                                                                @if($librarian->id == $loan->librarian_id)
                                                                    <td>{{ $librarian->name ?? '-' }}</td>
                                                                @endif
                                                            @endforeach
                                                            @foreach($members as $member)
                                                                @if($member->id == $loan->member_id)
                                                                    <td>{{ $member->name ?? '-' }}</td>
                                                                @endif
                                                            @endforeach
                                                            <td>{{ $loan->loan_at ?? '-' }}</td>
                                                            <td>{{ $loan->returned_at ?? '-' }}</td>
                                                            <td>{{ $loan->note ?? '-' }}</td>
                                                            <td>
                                                                <!-- Tombol Update -->
                                                                <button 
                                                                    class="btn btn-sm btn-primary" 
                                                                    data-toggle="modal"
                                                                    data-target="#updateModal"
                                                                    onclick="fetchLoanById({{ $loan->id }})"
                                                                    title="Edit"
                                                                >
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </button>

                                                                <!-- Tombol Delete -->
                                                                <button 
                                                                    class="btn btn-sm btn-danger" 
                                                                    onclick="deleteLoan({{ $loan->id }})" 
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
                    <form action="{{ route('addLoans') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col col-md-12">
                                    <label for="book_id" class=" form-control-label">Book</label>
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
                                    <label for="librarian_id" class=" form-control-label">Librarian</label>
                                </div>
                                <div class="col-12 col-md-12">
                                    <select name="librarian_id" id="librarian_id" class="form-control" required>
                                        <option value="" selected disabled>Please select librarian</option>
                                        @foreach ($librarians as $librarian)
                                            <option value="{{ $librarian->id }}">{{ $librarian->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-12">
                                    <label for="member_id" class=" form-control-label">Member</label>
                                </div>
                                <div class="col-12 col-md-12">
                                    <select name="member_id" id="member_id" class="form-control" required>
                                        <option value="" selected disabled>Please select member</option>
                                        @foreach ($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="loan_at" class=" form-control-label">Loan At</label>
                                <input type="datetime-local" id="loan_at" name="loan_at" placeholder="Loan At " class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="returned_at" class=" form-control-label">Returned At</label>
                                <input type="datetime-local" id="returned_at" name="returned_at" placeholder="Returned At" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="note" class=" form-control-label">Note</label>
                                <textarea type="text" id="note" name="note" placeholder="Note" rows="4" class="form-control"></textarea>
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
                    <form action="{{ route('updateLoans') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group" hidden>
                                <label for="idUpdate" class=" form-control-label">ID</label>
                                <input type="text" id="idUpdate" name="idUpdate" placeholder="ID" class="form-control" required>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-12">
                                    <label for="book_idUpdate" class=" form-control-label">Book</label>
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
                                    <label for="librarian_idUpdate" class=" form-control-label">Librarian</label>
                                </div>
                                <div class="col-12 col-md-12">
                                    <select name="librarian_idUpdate" id="librarian_idUpdate" class="form-control" required>
                                        <option value="" selected disabled>Please select librarian</option>
                                        @foreach ($librarians as $librarian)
                                            <option value="{{ $librarian->id }}">{{ $librarian->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-12">
                                    <label for="member_idUpdate" class=" form-control-label">Member</label>
                                </div>
                                <div class="col-12 col-md-12">
                                    <select name="member_idUpdate" id="member_idUpdate" class="form-control" required>
                                        <option value="" selected disabled>Please select member</option>
                                        @foreach ($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="loan_atUpdate" class=" form-control-label">Loan At</label>
                                <input type="datetime-local" id="loan_atUpdate" name="loan_atUpdate" placeholder="Loan At " class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="returned_atUpdate" class=" form-control-label">Returned At</label>
                                <input type="datetime-local" id="returned_atUpdate" name="returned_atUpdate" placeholder="Returned At" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="note" class=" form-control-label">Note</label>
                                <textarea type="text" id="noteUpdate" name="noteUpdate" placeholder="Note" class="form-control" required></textarea>
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

    function fetchLoanById(id) {
        $.ajax({
            url: "{{ route('getLoansById') }}",
            method: 'GET',
            data: { id: id },
            success: function(response) {
                if (response.status) {
                    $('#idUpdate').val(response.data.id);
                    $('#book_idUpdate').val(response.data.book_id);
                    $('#librarian_idUpdate').val(response.data.librarian_id);
                    $('#member_idUpdate').val(response.data.member_id);
                    $('#loan_atUpdate').val(response.data.loan_at);
                    $('#returned_atUpdate').val(response.data.returned_at);
                    $('#noteUpdate')
                        .val(response.data.note)
                        .css('height', 'auto')
                        .height($('#noteUpdate')[0].scrollHeight);
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

    function deleteLoan(id) {
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
                fetch(`/deleteLoans/${id}`, {
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
