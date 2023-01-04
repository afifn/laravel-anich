@extends('admin.layouts.base')

@section('title', 'Category')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-action">
                        <button class="btn btn-icon icon-left btn-primary" id="addBtn"><i class="fas fa-plus"></i>
                            Add Item</button>
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
                                    <th>
                                        #
                                    </th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            @if ($category->status == 1)
                                                <div class="badge badge-success">Enabled</div>
                                            @elseif ($category->status == 0)
                                                <div class="badge badge-warning">Disabled</div>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <a href="javascript:void(0)" class="btn btn-primary edit btn-edit-plan"
                                                data-id="{{ $category->id }}"
                                                data-action="{{ route('admin.category.update', $category->id) }}"
                                                data-category="{{ $category }}"><i class="far fa-edit"></i> Edit</a>

                                            <a href="javascript:void(0)" class="btn btn-danger delete btn-delete"
                                                data-id="{{ $category->id }}"
                                                data-action="{{ route('admin.category.delete', $category->id) }}"
                                                data-category="{{ $category }}"><i class="fas fa-times"></i> Delete</a>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="categoryModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="myForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
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
    <script type=text/javascript>
        $('#addBtn').on('click', function() {
            $('#categoryModal').find('.modal-title').text('Add Category');
            $('#categoryModal').find('#myForm').attr('action', '{{ route('admin.category.store') }}');
            $('#categoryModal').find('.statusGroup').hide();

            $('#categoryModal').modal('show');
        });
        $(document).on('click', '.btn-edit-plan', function() {
            var category = $(this).data('category');
            var act = $(this).data('action');
            var id = $(this).attr('data-id')
            let modal = $('#categoryModal');

            $(modal).find('.modal-title').text('Update Category');
            $(modal).find('#myForm').attr('action', act);
            $(modal).find('input[name=name]').val(category.name)

            $(modal).find('.statusGroup').show();
            $(modal).find('select[name=status]').val(category.status)
            $(modal).modal('show');
        })

        $('#categoryModal').on('hidden.bs.modal', function() {
            $('#categoryModal').find('form')[0].reset();
        });

        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });

        $(document).on('click', '.btn-delete', function() {
            var me = $(this);
            var id = me.attr('data-id');
            var act = me.data('action');
            let modal = $('#deleteModal');
            modal.find('#myFormDelete').attr('action', act);
            modal.modal('show');
        })
    </script>
@endpush
