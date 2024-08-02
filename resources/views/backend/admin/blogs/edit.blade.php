@extends('backend.admin.layouts.app')

@section('styles')
    <!-- Image Crop Css -->
    <link href="{{ asset('backend/vendor/croppie/croppie.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/vendor/spectrum/spectrum.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800">Edit A Blog</h1>
            <p class="mb-4">This page allows you to edit a blog in the database.</p>
        </div>
        <div class="col-3 text-right">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-backspace"></i>
                </span>
                <span class="text">{{ __('backend.shared.back') }}</span>
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="{{ url('admin/blogs/'.$blog->id) }}" class="" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row border-left-primary mb-4">
                            <div class="col-12">

                                <div class="form-row mb-4 bg-primary pl-1 pt-1 pb-1">
                                    <div class="col-md-12">
                                        <span class="text-lg text-white">
                                             <i class="fa-solid fa-layer-group"></i>
                                            {{ __('category_image_option.section-general-information') }}
                                        </span>
                                        <small class="form-text text-white">
                                            {{ __('category_image_option.section-general-information-desc') }}
                                        </small>
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="col-md-12">
                                        <label for="title" class="text-black">Title</label>
                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $blog->title }}">
                                        @error('title')
                                        <span class="invalid-tooltip">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="short_description" class="text-black">Short Description</label>
                                        <textarea id="short_description" type="text" class="form-control @error('short_description') is-invalid @enderror" name="short_description" value="Short Description">{{ $blog->short_description }}</textarea>
                                        @error('short_description')
                                        <span class="invalid-tooltip">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="content" content="text-black">Content</label>
                                        <textarea rows="10" class="form-control @error('content') is-invalid @enderror" name="content" placeholder="Content" id="summernote">{{ $blog->content }}</textarea>
                                        @error('content')
                                        <span class="invalid-tooltip">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label for="slug" class="text-black">Category</label>
                                        <select name="category_id" class="form-control" id="category">
                                            <option selected disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if($category->id == $blog->blog_category_id) selected @endif>{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="invalid-tooltip">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="sub_category_id" class="text-black">Sub category</label>
                                        <select name="sub_category_id" class="form-control" id="sub_category">
                                            <option selected disabled>Select Sub Category</option>
                                            @foreach ($sub_categories as $sub_category)
                                                <option value="{{ $sub_category->id }}" @if($sub_category->id == $blog->blog_sub_category_id) selected @endif>{{ $sub_category->title }}</option>
                                            @endforeach

                                        </select>
                                        @error('sub_category_id')
                                        <span class="invalid-tooltip">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label for="status" class="text-black">Status</label>
                                        <select name="status" class="form-control" id="status">
                                            <option value="1" @if($blog->status == '1') selected @endif>Active</option>
                                            <option value="0" @if($blog->status == '0') selected @endif>Draft</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-tooltip">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row border-left-primary mb-4">
                            <div class="col-12">

                                <div class="form-row mb-4 bg-primary pl-1 pt-1 pb-1">
                                    <div class="col-md-12">
                                        <span class="text-lg text-white">
                                             <i class="fa-solid fa-layer-group"></i>
                                            SEO Information
                                        </span>
                                        <small class="form-text text-white">
                                            Fill out the basic seo information of the category.
                                        </small>
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="col-md-12">
                                        <label for="meta_title" class="text-black">Meta Title</label>
                                        <input id="meta_title" type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" value="{{ $blog->meta_title }}">
                                        @error('meta_title')
                                        <span class="invalid-tooltip">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="meta_description" class="text-black">Meta Description</label>
                                        <textarea id="meta_description" type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" placeholder="Meta Description">{{ $blog->meta_description }}</textarea>
                                        @error('meta_description')
                                        <span class="invalid-tooltip">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="meta_keywords" class="text-black">Meta Keywords</label>
                                        <input id="meta_keywords" type="text" class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords" value="{{ $blog->meta_keywords }}">
                                        @error('meta_keywords')
                                        <span class="invalid-tooltip">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row border-left-primary mb-4">
                            <div class="col-12">

                                <div class="form-row mb-4 bg-primary pl-1 pt-1 pb-1">
                                    <div class="col-md-12">
                                        <span class="text-lg text-white">
                                             <i class="fa-solid fa-layer-group"></i>
                                            File Upload
                                        </span>
                                        <small class="form-text text-white">
                                            Fill out the basic file information of the category.
                                        </small>
                                    </div>
                                </div>

                                <div class="form-row mb-3">
                                    <div class="col-md-12">
                                        <label for="image" class="text-black">Featured Image</label>
                                        <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                                        @error('image')
                                        <span class="invalid-tooltip">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <img src="{{ asset('blogs').'/'.$blog->image }}" width="auto" height="300" class="mt-3">
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success py-2 px-4 text-white">
                                    {{ __('backend.shared.update') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function(){
        $('#summernote').summernote();


        $(document).on('change','#category',function(){
            var id = $(this).val();
            $.ajax({
                url:'{{ url("admin/blog/get/subcategory") }}',
                type:"GET",
                data:{id},
                success:function(response){
                    $('#sub_category').html(response);
                }
            });
        });
    });
</script>
@endsection
