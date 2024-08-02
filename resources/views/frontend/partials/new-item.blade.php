@php
    $get_count_rating = $item->getCountRating();
    $get_all_categories = $item->getAllCategories(\App\Item::ITEM_TOTAL_SHOW_CATEGORY, isset($parent_category_id) ? $parent_category_id : null);
    $all_categories_count = $item->allCategories()->count();
@endphp
<style>
    .width_fit{
        width: fit-content;
        border-radius:0px !important;
    }
</style>
<div class="col-sm-6">
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
            @if(!$free_item)
                <p class="text-white px-2 pt-1 pb-1 mb-2 item-featured-label width_fit">{{ __('frontend.item.featured') }}</p>
            @endif
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
