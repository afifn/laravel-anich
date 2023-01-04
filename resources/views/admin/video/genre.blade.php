@extends('admin.layouts.base')
@section('title', 'Genre')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-action">
                        <a href="javascript:void(0)" class="btn btn-primary btn-icon icon-left btn-add"
                            data-action="{{ route('admin.genre.store') }}"><i class="fas fa-plus"></i> Add
                            Item</a>
                    </div>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible y-5" id="success-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif
                @error('genre')
                    <div class="alert alert-danger alert-dismissible y-5" id="error-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ $message }}
                    </div>
                @enderror
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="table-1" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($genres as $genre)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $genre->name }}</td>
                                        <td>{{ $genre->slug }}</td>
                                        <td class="text-right">
                                            <a href="javascript:void(0)" class="btn btn-primary btn-icon icon-left btn-edit"
                                                data-action="{{ route('admin.genre.update', $genre->id) }}"
                                                data-genre="{{ $genre }}"><i class="fas fa-pen"></i> Edit</a>
                                            <a href="javascript:void(0)"
                                                data-action="{{ route('admin.genre.delete', $genre->id) }}"
                                                class="btn btn-danger btn-icon icon-left btn-delete"><i
                                                    class="fas fa-times"></i> Delete</a>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="genreModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Custom Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="myForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <div class="input-group">
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-save">Save changes</button>
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
        $(document).on('click', '.btn-add', function() {
            let modal = $('#genreModal');
            var action = $(this).data('action');

            modal.find('.modal-title').text('Add Genre')
            modal.find('.btn-save').text('Submit')
            modal.find('#myForm').attr('action', action);

            modal.modal('show');
        });
        $(document).on('click', '.btn-edit', function() {
            let modal = $('#genreModal');
            var genre = $(this).data('genre')
            var action = $(this).data('action');

            modal.find('.modal-title').text('Update Genre')
            modal.find('.btn-save').text('Save changes')
            modal.find('input[name=name]').val(genre.name)
            modal.find('#myForm').attr('action', action)
            modal.modal('show');
        });

        $(document).on('click', '.btn-delete', function() {
            let modal = $('#deleteModal');
            var action = $(this).data('action');

            modal.find('#myFormDelete').attr('action', action);
            modal.modal('show');
        })

        $('#genreModal').on('hidden.bs.modal', function() {
            $('#genreModal').find('form')[0].reset();
        });

        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });
        $("#error-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#error-alert").slideUp(500);
        });
    </script>
@endpush
