@extends('admin.layouts.base')
@push('css')
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"
        integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        #episode {
            display: none
        }
    </script>
@endpush
@section('title', 'Add Item')
@section('breadcrumbs')
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Video</a></div>
        <div class="breadcrumb-item"><a href="#">All Item Videos</a></div>
        <div class="breadcrumb-item">Add Item</div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-header-action">
                        <h5 class="header">Add new item</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.item.store') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="portrait">Portrait Image</label>
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">Choose File</label>
                                    <input type="file" name="portrait" id="image-upload"
                                        accept=".png, .jpg, .jpeg, .webp" required />
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="portrait">Portrait Image</label>
                                <div id="image-preview-landscape" class="image-preview-landscape">
                                    <label for="image-upload-landscape" id="image-label">Choose File</label>
                                    <input type="file" name="landscape" id="image-upload-landscape"
                                        accept=".png, .jpg, .jpeg, .webp" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="item_type">Item Type</label>
                                <select class="form-group selectric" id="item_type" name="item_type" required>
                                    <option value="" disabled selected>Select one</option>
                                    <option value="0" class="singleItem">Single Item</option>
                                    <option value="1" class="episodeItem">Episode Item</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="preview_text">Preview</label>
                                <textarea cols="5" type="text" class="form-control" name="preview_text" required></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description">Description</label>
                                <textarea cols="5" type="text" class="form-control" name="description" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category" class="form-control selectric" required>
                                    <option value="" disabled selected>Select one</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            data-subcategories="{{ $category->subcategories }}">{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sub_category_id">Sub Category</label>
                                <select name="sub_category_id" id="sub_category" class="form-control selectric">
                                    <option value="" disabled selected>Select one</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="genre" class="">Genre</label>
                                <select type="text" name="genre[]" id="select2"
                                    class="form-control selectric js-example-basic-multiple" multiple="multiple" required>
                                    <option></option>
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                <select name="status" class="form-control selectric" required id="">
                                    <option value="" disabled selected>Select one</option>
                                    <option value="ongoing">Ongoing</option>
                                    <option value="completed">Completed</option>
                                    <option value="drop">Drop</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="director">Director</label>
                                <input type="text" name="director" id="" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="countri">Countri</label>
                                <input type="text" name="countri" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="studio">Studio</label>
                                <input type="text" name="studio" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="network">Network</label>
                                <input type="text" name="network" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="duration">Duration</label>
                                <input type="text" name="duration" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Rates">Rating</label>
                                <input type="number" name="Rates" id="" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="release_date">Release Date</label>
                                <input type="text" name="release_date" class="form-control datepicker">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="featured">Featured</label>
                                <select name="featured" id="" class="form-control selectric" required>
                                    <option value="" selected disabled>Select one</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 episode" id="episode">
                                <label for="episode">Episode</label>
                                <input type="number" name="episode" class="form-control">
                            </div>
                            <div class="form-group">
                            </div>

                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary form-control">Create Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('stisla/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('stisla/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('stisla/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script>
    <script src="{{ asset('stisla/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('stisla/assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script type="text/javascript">
        (function($) {
            "use strict"

            $(document).on('change', '#category', function(e) {
                var subcategories = $(this).find(':selected').data('subcategories');
                var subcategoryOption = '';

                $('#sub_category').append($('<option>', {
                    html: "Temporary"
                }));
                subcategories.forEach(subcategory => {
                    subcategoryOption += '<option value="' + subcategory.id + '">' + subcategory.name +
                        '</option>';
                    console.log(subcategoryOption);
                });
                $('#sub_category').html(subcategoryOption);
            });

            $('.js-example-basic-single').select2({
                tags: true,
                multiple: true,
                placeholder: "wo",
                allowClear: true
            });

            $('#item_type').change(function(e) {
                $('#sub_category').append("<option value='0'>Select</option>");

                var val_id = e.target.id
                if ($(this).val() == "Episode Item") {
                    $('#episode').show();
                } else {
                    $('#episode').hide();
                }
            });
        })(jQuery);
    </script>
@endpush
