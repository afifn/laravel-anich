@extends('admin.layouts.base')


@section('title', 'Items')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-action">
                        <a href="{{ route('admin.item.create') }}" class="btn btn-icon icon-left btn-primary btn-add">
                            <i class="fas fa-plus"></i>Add Item</a>
                    </div>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible y-5" id="success-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif
                @error('item')
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
                                    <th>item</th>
                                    <th>Slug</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td class="text-right">
                                            <a href="javascript:void(0)"
                                                data-action="{{ route('admin.item.update', $item->id) }}"
                                                data-item="{{ $item }}"
                                                class="btn btn-icon icon-left btn-primary btn-edit"><i
                                                    class="fas fa-pen"></i> Edit</a>
                                            <a href="javascript:void(0)"
                                                data-action="{{ route('admin.item.delete', $item->id) }}"
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
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });
        $("#error-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#error-alert").slideUp(500);
        });
    </script>
@endpush
