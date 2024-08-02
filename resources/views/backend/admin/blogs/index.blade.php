@extends('backend.admin.layouts.app')

@section('styles')
    <!-- searchable selector -->
    <link href="{{ asset('backend/vendor/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800">Blogs</h1>
        </div>
        <div class="col-3 text-right">
            <a href="{{ url('admin/blogs/create') }}" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add a Blog</span>
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">

            <div class="row">
                <div class="col-12 col-md-12">

                    <div class="row pb-2">
                        <div class="col-12">
                            <span class="text-gray-800">
                                {{ number_format($blogs_count) . ' ' . __('category_description.records') }}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr class="bg-info text-white">
                                        <th>Image</th>
                                        <th>{{ __('backend.category.name') }}</th>
                                        <th>Short Description</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>{{ __('backend.shared.action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogs as $item)
                                        @php
                                            $category = \App\Models\BlogCategory::find($item->blog_category_id);
                                            $sub_category = \App\Models\BlogSubCategory::find($item->blog_sub_category_id);
                                        @endphp
                                            <tr>
                                                <td><img src="{{ asset('blogs').'/'.$item->image }}" alt="" height="100" width="100"></td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->short_description }}</td>
                                                <td>{{ $category->title }}</td>
                                                <td>{{ $sub_category->title }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ url('admin/blogs/'.$item->id.'/edit') }}" class="btn btn-outline-info btn-sm">Edit</a>
                                                    <form action="{{ url('admin/blogs/'.$item->id) }}" method="post" class="ml-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            {{ $blogs->links() }}
                        </div>
                    </div>

                </div>



            </div>
        </div>
    </div>

@endsection
