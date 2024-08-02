@extends('frontend.layouts.new')

@section('styles')
    <link rel="preload" href="{{ asset('frontend/images/placeholder/header-1.webp') }}" as="image">
@endsection

@section('content')
<section class="hero_single version_2">
    <div class="wrapper">
        <div class="container">
            <h3  style="color: {{ $site_homepage_header_title_font_color }};">{{ __('frontend.homepage.title') }}</h3>
            <p style="color: {{ $site_homepage_header_paragraph_font_color }};">{{ __('frontend.homepage.description') }}</p>
            <form method="get" action="{{ route('page.search') }}">
                <div class="row g-0 custom-search-input-2">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <input  id="search_query" name="search_query" class="form-control rounded @error('search_query') is-invalid @enderror" type="text" placeholder="{{ __('categories.search-query-placeholder') }}" value="{{ old('search_query') ? old('search_query') : (isset($last_search_query) ? $last_search_query : '') }}" >
                            <i class="icon_search"></i>
                        </div>
                        @error('search_query')
                            <div class="invalid-tooltip">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-2">
                        <input type="submit" value="{{ __('frontend.search.search') }}">
                    </div>
                </div>
                <!-- /row -->
            </form>
        </div>
    </div>
</section>
<!-- /hero_single -->

<div class="main_categories">
    <div class="container">
        <ul class="clearfix">
            @php
                $categories_count = $categories->count();
            @endphp

            @if($categories_count > 0)
                @foreach($categories as $categories_key => $category)
                    <li>

                        @if($category->category_thumbnail_type == \App\Category::CATEGORY_THUMBNAIL_TYPE_ICON)
                            <a href="{{ route('page.category', $category->category_slug) }}" >
                                @if($category->category_icon)
                                    <i class="{{ $category->category_icon }} text-primary"></i>
                                @else
                                    <i class="fa-solid fa-heart text-primary"></i>
                                @endif
                                <h3>{{ $category->category_name }}</h3>
                            </a>
                        @elseif($category->category_thumbnail_type == \App\Category::CATEGORY_THUMBNAIL_TYPE_IMAGE)
                            <a href="{{ route('page.category', $category->category_slug) }}">
                                <span class="icon image-category-span">
                                    <span>
                                        @if($category->category_image)
                                            <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url('category/'. $category->category_image) }}" alt="Image" class="img-fluid rounded image-category-img">
                                        @else
                                            <img src="{{ asset('frontend/images/placeholder/category-image.webp') }}" alt="Image" class="img-fluid rounded image-category-img">
                                        @endif
                                    </span>
                                </span>
                                <span class="caption d-block image-category-caption">{{ $category->category_name }}</span>
                            </a>
                        @endif

                    </li>
                @endforeach
            @else
                <li>
                    <a href="#">
                        <h3>{{ __('frontend.homepage.no-categories') }}</h3>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <!-- /container -->
</div>
<!-- /main_categories -->

<div class="container margin_60_35">
    <div class="main_title_3 mb-3">
        <span></span>
        <h2 class="mb-4">{{ __('frontend.homepage.featured-ads') }}</h2>
        {{-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
        <a href="grid-listings-filterscol.html">See all</a> --}}
    </div>
    <div class="row add_bottom_30">

        @if($paid_items->count() > 0)
            @foreach($paid_items as $paid_items_key => $item)
            <div class="col-lg-3 col-sm-6">
                <div class="item">
                    <div class="strip grid">
                        <figure>
                            <a href="{{ route('page.item', $item->item_slug) }}" class="wish_bt"></a>
                            <a href="{{ route('page.item', $item->item_slug) }}"><img src="{{ !empty($item->item_image_medium) ? Storage::disk('public')->url('item/' . $item->item_image_medium) : (!empty($item->item_image) ? Storage::disk('public')->url('item/' . $item->item_image) : asset('frontend/images/placeholder/full_item_feature_image_medium.webp')) }}" class="img-fluid" alt="" width="400" height="266"><div class="read_more"><span>Read more</span></div></a>
                            @php
                                $paid_item_getAllCategories = $item->getAllCategories(\App\Item::ITEM_TOTAL_SHOW_CATEGORY_HOMEPAGE);
                            @endphp
                            <div class="item_categories">
                                @foreach($paid_item_getAllCategories as $item_all_categories_key => $category)
                                    <a href="{{ route('page.category', $category->category_slug) }}" class="text-white">
                                        <small >
                                            @if(!empty($category->category_icon))
                                                <i class="{{ $category->category_icon }}"></i>
                                            @else
                                                <i class="fa-solid fa-heart"></i>
                                            @endif
                                            {{ $category->category_name }}
                                        </small>
                                    </a>
                                @endforeach
                            </div>

                            @php
                                $paid_item_allCategories_count = $item->allCategories()->count();
                            @endphp
                            @if($paid_item_allCategories_count > \App\Item::ITEM_TOTAL_SHOW_CATEGORY_HOMEPAGE)
                                <small>{{ __('categories.and') . " " . strval($paid_item_allCategories_count - \App\Item::ITEM_TOTAL_SHOW_CATEGORY_HOMEPAGE) . " " . __('categories.more') }}</small>
                            @endif
                        </figure>
                        <div class="wrapper">
                            <h3><a href="{{ route('page.item', $item->item_slug) }}">{{ str_limit($item->item_title, 44, '...') }}</a></h3>

                            @if($item->item_type == \App\Item::ITEM_TYPE_REGULAR)
                                <address>
                                    <a href="{{ route('page.city', ['state_slug'=>$item->state->state_slug, 'city_slug'=>$item->city->city_slug]) }}">{{ $item->city->city_name }}</a>,
                                    <a href="{{ route('page.state', ['state_slug'=>$item->state->state_slug]) }}">{{ $item->state->state_name }}</a>
                                </address>
                            @endif
                                @php
                                    $paid_item_getCountRating = $item->getCountRating();
                                @endphp
                                @if($paid_item_getCountRating > 0)
                                    <div class="row">
                                        <div class="px-2 d-flex gap-1 align-items-center">
                                            <div class="pl-0 rating_stars rating_stars_{{ $item->item_slug }}" data-id="rating_stars_{{ $item->item_slug }}" data-rating="{{ $item->item_average_rating }}"></div>
                                            <span class="mt-0">
                                                @if($paid_item_getCountRating == 1)
                                                    {{ '(' . $paid_item_getCountRating . ' ' . __('review.frontend.review') . ')' }}
                                                @else
                                                    {{ '(' . $paid_item_getCountRating . ' ' . __('review.frontend.reviews') . ')' }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                @endif
                            {{-- <a class="address" href="https://www.google.com/maps/dir//Assistance+–+Hôpitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x47e66e1de36f4147:0xb6615b4092e0351f!2sAssistance+Publique+-+Hôpitaux+de+Paris+(AP-HP)+-+Siège!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361">Get directions</a> --}}
                        </div>
                        <ul>
                            @if($item->item_hour_show_hours == \App\Item::ITEM_HOUR_SHOW)
                                @if($item->hasOpened())
                                    <li><span class="loc_open">{{ __('item_hour.frontend-item-box-hour-opened') }}</span></li>
                                @else
                                    <li><span class="loc_closed">{{ __('item_hour.frontend-item-box-hour-closed') }}</span></li>
                                @endif
                            @endif
                            <li><div class="score"><span>{{ str_limit($item->user->name, 12, '.') }}<em>{{ $item->created_at->diffForHumans() }}</em></span>
                            @if(empty($item->user->user_image))
                                <img src="{{ asset('frontend/images/placeholder/profile-'. intval($item->user->id % 10) . '.webp') }}" alt="Image" class="img-fluid rounded-circle" width="40px" height="40px">
                            @else
                                <img src="{{ Storage::disk('public')->url('user/' . $item->user->user_image) }}" alt="{{ $item->user->name }}" class="img-fluid rounded-circle" width="40px" height="40px">
                            @endif
                            </div></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="d-block d-md-flex listing vertical">
            </div>
        @endif
    </div>
    <!-- /row -->

    <div class="main_title_3">
        <span></span>
        <h2>{{ __('frontend.homepage.nearby-listings') }}</h2>
        <p>{{ __('frontend.homepage.popular-listings') }}</p>
        <a href="grid-listings-filterscol.html">See all</a>
    </div>
    <div class="row add_bottom_30">
        @if($popular_items->count() > 0)
            @foreach($popular_items as $popular_items_key => $item)
                <div class="col-lg-3 col-sm-6">
                    <a href="{{ route('page.item', $item->item_slug) }}" class="grid_item small">
                        <figure>

                            <img src="{{ !empty($item->item_image_medium) ? Storage::disk('public')->url('item/' . $item->item_image_medium) : (!empty($item->item_image) ? Storage::disk('public')->url('item/' . $item->item_image) : asset('frontend/images/placeholder/full_item_feature_image_medium.webp')) }}" alt="" class="f_img">
                            <div class="info">
                                @php
                                    $paid_item_getCountRating = $item->getCountRating();
                                @endphp
                                @if($paid_item_getCountRating > 0)
                                    <div class="row">
                                        <div class="px-2 d-flex gap-1 align-items-center">
                                            <div class="pl-0 rating_stars rating_stars_{{ $item->item_slug }}" data-id="rating_stars_{{ $item->item_slug }}" data-rating="{{ $item->item_average_rating }}"></div>
                                            <span class="mt-0">
                                                @if($paid_item_getCountRating == 1)
                                                    {{ '(' . $paid_item_getCountRating . ' ' . __('review.frontend.review') . ')' }}
                                                @else
                                                    {{ '(' . $paid_item_getCountRating . ' ' . __('review.frontend.reviews') . ')' }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                <h3 class="mb-1">{{ str_limit($item->item_title, 44, '...') }}</h3>
                                @if($item->item_type == \App\Item::ITEM_TYPE_REGULAR)
                                    <address>
                                        <span>{{ $item->city->city_name }}</span>,
                                        <span>{{ $item->state->state_name }}</span>
                                    </address>
                                @endif
                                <ul class="d-flex align-items-center justify-content-between m-2">
                                    @if($item->item_hour_show_hours == \App\Item::ITEM_HOUR_SHOW)
                                        @if($item->hasOpened())
                                            <li><span class="loc_open">{{ __('item_hour.frontend-item-box-hour-opened') }}</span></li>
                                        @else
                                            <li><span class="loc_closed">{{ __('item_hour.frontend-item-box-hour-closed') }}</span></li>
                                        @endif
                                    @endif
                                    <li><div class="score"><span>{{ str_limit($item->user->name, 12, '.') }}<em>{{ $item->created_at->diffForHumans() }}</em></span>
                                    @if(empty($item->user->user_image))
                                        <img src="{{ asset('frontend/images/placeholder/profile-'. intval($item->user->id % 10) . '.webp') }}" alt="Image" class="img-fluid rounded-circle" width="40px" height="40px">
                                    @else
                                        <img src="{{ Storage::disk('public')->url('user/' . $item->user->user_image) }}" alt="{{ $item->user->name }}" class="img-fluid rounded-circle" width="40px" height="40px">
                                    @endif
                                    </div></li>
                                </ul>
                            </div>
                        </figure>
                    </a>
                </div>
            @endforeach
        @endif
    </div>
    <!-- /row -->

    <div class="main_title_3 mb-3">
        <span></span>
        <h2 class="mb-4">{{ __('frontend.homepage.recent-listings') }}</h2>
        <a href="grid-listings-filterscol.html">See all</a>
    </div>
    <div class="row ">
        @if($latest_items->count() > 0)
            @foreach($latest_items as $latest_items_key => $item)
            <div class="col-lg-3 col-sm-6">
                <a href="{{ route('page.item', $item->item_slug) }}" class="grid_item small">
                    <figure>
                        <img src="{{ !empty($item->item_image_medium) ? Storage::disk('public')->url('item/' . $item->item_image_medium) : (!empty($item->item_image) ? Storage::disk('public')->url('item/' . $item->item_image) : asset('frontend/images/placeholder/full_item_feature_image_medium.webp')) }}" alt="" class="f_img">
                        <div class="info">
                            @php
                                $paid_item_getCountRating = $item->getCountRating();
                            @endphp
                            @if($paid_item_getCountRating > 0)
                                <div class="row">
                                    <div class="px-2 d-flex gap-1 align-items-center">
                                        <div class="pl-0 rating_stars rating_stars_{{ $item->item_slug }}" data-id="rating_stars_{{ $item->item_slug }}" data-rating="{{ $item->item_average_rating }}"></div>
                                        <span class="mt-0">
                                            @if($paid_item_getCountRating == 1)
                                                {{ '(' . $paid_item_getCountRating . ' ' . __('review.frontend.review') . ')' }}
                                            @else
                                                {{ '(' . $paid_item_getCountRating . ' ' . __('review.frontend.reviews') . ')' }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endif
                            <h3 class="mb-1">{{ str_limit($item->item_title, 44, '...') }}</h3>
                            @if($item->item_type == \App\Item::ITEM_TYPE_REGULAR)
                                <address>
                                    <span>{{ $item->city->city_name }}</span>,
                                    <span>{{ $item->state->state_name }}</span>
                                </address>
                            @endif
                            <ul class="d-flex align-items-center justify-content-between m-2">
                                @if($item->item_hour_show_hours == \App\Item::ITEM_HOUR_SHOW)
                                    @if($item->hasOpened())
                                        <li><span class="loc_open">{{ __('item_hour.frontend-item-box-hour-opened') }}</span></li>
                                    @else
                                        <li><span class="loc_closed">{{ __('item_hour.frontend-item-box-hour-closed') }}</span></li>
                                    @endif
                                @endif
                                <li><div class="score"><span>{{ str_limit($item->user->name, 12, '.') }}<em>{{ $item->created_at->diffForHumans() }}</em></span>
                                @if(empty($item->user->user_image))
                                    <img src="{{ asset('frontend/images/placeholder/profile-'. intval($item->user->id % 10) . '.webp') }}" alt="Image" class="img-fluid rounded-circle" width="40px" height="40px">
                                @else
                                    <img src="{{ Storage::disk('public')->url('user/' . $item->user->user_image) }}" alt="{{ $item->user->name }}" class="img-fluid rounded-circle" width="40px" height="40px">
                                @endif
                                </div></li>
                            </ul>
                        </div>
                    </figure>
                </a>
            </div>
            @endforeach
        @endif
    </div>
    <!-- /row -->
</div>
<!-- /container -->

@if($all_testimonials->count() > 0)

<div class="container-fluid margin_80_55">
    <div class="main_title_2">
        <span><em></em></span>
        <h2>{{ __('frontend.homepage.testimonials') }}</h2>
    </div>
    <style>
        .slick-prev:before, .slick-next:before{
            color: #004dda;
            font-size: 45px;
        }
        .slick-next {
            right: 80px;
        }
        .slick-prev {
            left: 40px;
            z-index: 100;
        }
    </style>
    <div id="testimonials">
        @foreach($all_testimonials as $key => $testimonial)
            <div class="item d-flex align-items-center justify-content-center ">
                <div class="d-flex align-items-center justify-content-center col-md-8 col-12">
                    <figure class="mb-4 d-flex align-items-center justify-content-center flex-column">
                        @if(empty($testimonial->testimonial_image))
                            <img src="{{ asset('frontend/images/placeholder/profile-'. intval($testimonial->id % 10) . '.webp') }}" alt="Image" class="img-fluid mb-3 rounded-circle">
                        @else
                            <img src="{{ Storage::disk('public')->url('testimonial/' . $testimonial->testimonial_image) }}" alt="Image" class="img-fluid mb-3 rounded-circle">
                        @endif
                        <p>
                            {{ $testimonial->testimonial_name }}
                            @if($testimonial->testimonial_job_title)
                                {{ '• ' . $testimonial->testimonial_job_title }}
                            @endif
                            @if($testimonial->testimonial_company)
                                {{ '• ' . $testimonial->testimonial_company }}
                            @endif
                        </p>
                        <blockquote>
                            <h4 class="text-center">{{ $testimonial->testimonial_description }}</h4>
                        </blockquote>
                    </figure>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endif
@if($recent_blog != null)
<div class="container margin_80_55">
    <div class="main_title_2">
        <span><em></em></span>
        <h2>{{ __('frontend.homepage.our-blog') }}</h2>
        <p>{{ __('frontend.homepage.our-blog-decr') }}</p>
    </div>
    <div class="row">
        @foreach($recent_blog as $recent_blog_key => $post)
        @php
             $category = \App\Models\BlogCategory::find($post->blog_category_id);
             $sub_category = \App\Models\BlogSubCategory::find($post->blog_sub_category_id);
        @endphp
        <div class="col-lg-6">
            <a class="box_news" href="{{ route('page.blog.show', $post->slug) }}">
                <figure>

                @if(empty($post->image))
                    <img src="{{ asset('frontend/images/placeholder/full_item_feature_image_medium.webp') }}" alt="">
                @else
                    <img src="{{ asset('blogs'.'/' . $post->image) }}" alt="">
                @endif
                </figure>
                <ul>
                    <li>{{ $category->title }} <i class="fa fa-angle-right" style="font-size: 10px;"></i> {{ $sub_category->title }}</li>
                    <li>{{ $post->created_at->diffForHumans() }}</li>
                </ul>
                <h4>{{ $post->title }}</h4>
                <p>{{ substr($post->short_description ,0,200).'...' }}</p>
            </a>
        </div>
        @endforeach
    </div>
    <!-- /row -->
    <p class="btn_home_align"><a href="{{ url('/blog') }}" class="btn_1 rounded">View all blogs</a></p>
</div>
@endif
<!-- /container -->
@endsection
