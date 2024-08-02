@extends('backend.admin.layouts.app')

@section('styles')
    <!-- Image Crop Css -->
    <link href="{{ asset('backend/vendor/croppie/croppie.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/vendor/spectrum/spectrum.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800">{{ __('backend.category.edit-category') }}</h1>
            <p class="mb-4">{{ __('backend.category.edit-category-desc') }}</p>
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
                    <form method="POST" action="{{ url('admin/category/blog/'.$category->id) }}" class="">
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
                                    <div class="col-md-4">
                                        <label for="title" class="text-black">{{ __('backend.category.category-name') }}</label>
                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $category->title }}">
                                        @error('title')
                                        <span class="invalid-tooltip">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="slug" class="text-black">{{ __('backend.category.slug') }}</label>
                                        <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ $category->slug }}">
                                        <small class="text-muted">
                                            {{ __('categories.category-slug-help') }}
                                        </small>
                                        @error('slug')
                                        <span class="invalid-tooltip">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


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
