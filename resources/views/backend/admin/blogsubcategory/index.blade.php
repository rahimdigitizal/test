@extends('backend.admin.layouts.app')

@section('styles')
    <!-- searchable selector -->
    <link href="{{ asset('backend/vendor/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
@endsection

@section('content')

    <div class="row justify-content-between">
        <div class="col-9">
            <h1 class="h3 mb-2 text-gray-800">Sub Category</h1>
        </div>
        <div class="col-3 text-right">
            <a href="{{ url('admin/sub/category/blog/create') }}" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add a Sub category</span>
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row bg-white pt-4 pl-3 pr-3 pb-4">
        <div class="col-12">

            <div class="row">
                <div class="col-12 col-md-10">

                    <div class="row pb-2">
                        <div class="col-12">
                            <span class="text-gray-800">
                                {{ number_format($categories_count) . ' ' . __('category_description.records') }}
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr class="bg-info text-white">
                                        <th>{{ __('backend.category.name') }}</th>
                                        <th>{{ __('backend.category.slug') }}</th>
                                        <th>{{ __('backend.shared.action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $item)
                                            <tr>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->slug }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ url('admin/sub/category/blog/'.$item->id.'/edit') }}" class="btn btn-outline-info btn-sm">Edit</a>
                                                    <form action="{{ url('admin/sub/category/blog/'.$item->id) }}" method="post" class="ml-2">
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
                            {{ $categories->links() }}
                        </div>
                    </div>

                </div>



            </div>
        </div>
    </div>

@endsection
