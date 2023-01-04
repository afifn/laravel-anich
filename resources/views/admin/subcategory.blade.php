@extends('admin.layouts.base')
@section('title', 'Sub Category')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-action">
                        <a href="javascript:void(0)" class="btn btn-icon icon-left btn-primary add btn-add"><i
                                class="fas fa-plus"></i> Add
                            Item</a>
                    </div>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible y-5" id="success-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $subcategory)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subcategory->name }}</td>
                                        <td>{{ $subcategory->categories->name }}</td>
                                        <td>
                                            @if ($subcategory->status == 1)
                                                <div class="badge badge-success">Enable</div>
                                            @else
                                                <div class="badge badge-warning">Disable</div>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <a href="javascript:void(0)" class="btn btn-primary btn-icon edit btn-edit"
                                                data-action="{{ route('admin.subcategory.update', $subcategory->id) }}"
                                                data-id="{{ $subcategory->id }}" data-subcategory="{{ $subcategory }}"><i
                                                    class="fas fa-edit"></i> Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-icon delete btn-delete"
                                                data-id="{{ $subcategory->id }}"
                                                data-action="{{ route('admin.subcategory.delete', $subcategory->id) }}"><i
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
    <div class="modal fade" tabindex="-1" role="dialog" id="subcategoryModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Custom Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <div class="input-group">
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option disabled>Select One</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group statusGroup">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Enable</option>
                                <option value="0">Disabled</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
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
            let modal = $('#subcategoryModal');
            modal.find('.modal-title').text('Add Subcategory');
            modal.find('#myForm').attr('action', '{{ route('admin.subcategory.store') }}')
            modal.find('.statusGroup').hide();
            modal.modal('show');
        });
        $(document).on('click', '.btn-edit', function() {
            let modal = $('#subcategoryModal');
            var subcategory = $(this).data('subcategory');
            var action = $(this).data('action')

            modal.find('.modal-title').text('Update Subcategory');
            modal.find('.statusGroup').show();
            modal.find('#myForm').attr('action', action);
            modal.find('input[name=name]').val(subcategory.name)
            modal.find('select[name=category_id]').val(subcategory.categories.id)
            modal.find('select[name=status]').val(subcategory.status)
            modal.modal('show');
        });

        $(document).on('click', '.btn-delete', function() {
            let modal = $('#deleteModal');
            var action = $(this).data('action');

            modal.find('#myFormDelete').attr('action', action);
            modal.modal('show');
        })

        $('#subcategoryModal').on('hidden.bs.modal', function() {
            $('#subcategoryModal').find('form')[0].reset();
        });

        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });
    </script>
@endpush
