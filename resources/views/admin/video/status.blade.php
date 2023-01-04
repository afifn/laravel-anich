@extends('admin.layouts.base')
@section('title', 'Status')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-action">
                        <a href="javascript:void(0)" class="btn btn-icon icon-left btn-primary btn-add"
                            data-action="{{ route('admin.status.store') }}">
                            <i class="fas fa-plus"></i>Add Item</a>
                    </div>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible y-5" id="success-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif
                @error('status')
                    <div class="alert alert-danger alert-dismissible y-5" id="error-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ $message }}
                    </div>
                @enderror
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Slug</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($status as $status)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $status->status }}</td>
                                        <td>{{ $status->slug }}</td>
                                        <td class="text-right">
                                            <a href="javascript:void(0)"
                                                data-action="{{ route('admin.status.update', $status->id) }}"
                                                data-status="{{ $status }}"
                                                class="btn btn-icon icon-left btn-primary btn-edit"><i
                                                    class="fas fa-pen"></i> Edit</a>
                                            <a href="javascript:void(0)"
                                                data-action="{{ route('admin.status.delete', $status->id) }}"
                                                class="btn btn-icon icon-left btn-danger delete btn-delete"><i
                                                    class="fas fa-times"></i>
                                                Delete</a>
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
@endsection

@section('modal')
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="myForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="input-group">
                                <input type="text" name="status" id="status" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke fr">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Realy?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to continue?</p>
                </div>
                <form action="" method="post" id="myFormDelete">
                    @method('delete')
                    @csrf
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-danger">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let modal = $('#myModal');
        $(document).on('click', '.btn-add', function() {
            var action = $(this).data('action')

            modal.find('.modal-title').text('Add Status')
            modal.find('.btn-submit').text('Submit')
            modal.find('#myForm').attr('action', action)
            modal.modal('show');
        });
        $(document).on('click', '.btn-edit', function() {
            var status = $(this).data('status')
            var action = $(this).data('action')

            modal.find('.modal-title').text('Update Status')
            modal.find('.btn-submit').text('Save changes')
            modal.find('input[name=status]').val(status.status)
            modal.find('#myForm').attr('action', action)
            modal.modal('show')
        });
        $(document).on('click', '.btn-delete', function() {
            let modals = $('#deleteModal');
            var action = $(this).data('action')

            modals.find('#myFormDelete').attr('action', action)
            modals.modal('show')
        });

        modal.on('hidden.bs.modal', function() {
            modal.find('form')[0].reset();
        })
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });
        $("#error-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#error-alert").slideUp(500);
        });
    </script>
@endpush
