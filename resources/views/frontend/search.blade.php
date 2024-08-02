@extends('frontend.layouts.new')
@section('content')
<div id="results">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-10">
                <h4><strong>{{ number_format($total_results) }}</strong> {{ __('theme_directory_hub.filter-results') }}</h4>
            </div>
            <div class="col-lg-9 col-md-8 col-2">
                <a href="#0" class="search_mob btn_search_mobile"></a> <!-- /open search panel -->
                <form method="get" action="{{ route('page.search') }}">
                    <div class="row g-0 custom-search-input-2 inner ">
                        <div class="col-lg-11">
                            <div class="form-group">
                                <input  id="search_query" name="search_query" class="form-control rounded @error('search_query') is-invalid @enderror" type="text" placeholder="{{ __('categories.search-query-placeholder') }}" value="{{ old('search_query') ? old('search_query') : (isset($last_search_query) ? $last_search_query : '') }}" >
                            </div>
                            @error('search_query')
                                <div class="invalid-tooltip">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-1">
                            <input type="submit" value="{{ __('frontend.search.search') }}">
                        </div>
                    </div>
                    <!-- /row -->
                </form>

            </div>
        </div>
        <!-- /row -->
         <div class="search_mob_wp">
             <div class="custom-search-input-2">
                 <div class="form-group">
                     <input class="form-control" type="text" placeholder="What are you looking for...">
                     <i class="icon_search"></i>
                 </div>
                 <div class="form-group">
                     <input class="form-control" type="text" placeholder="Where">
                     <i class="icon_pin_alt"></i>
                 </div>
                 <select class="wide">
                     <option>All Categories</option>
                     <option>Shops</option>
                     <option>Hotels</option>
                     <option>Restaurants</option>
                     <option>Bars</option>
                     <option>Events</option>
                     <option>Fitness</option>
                 </select>
                 <input type="submit">
             </div>
         </div>
         <!-- /search_mobile -->
    </div>
    <!-- /container -->
</div>
<!-- /results -->

 <div class="filters_listing version_2  sticky_horizontal">
     <div class="container">
         <ul class="clearfix">
             <li>
                 <div class="switch-field">
                     <input type="radio" id="all" name="listing_filter" value="all" checked>
                     <label for="all">All</label>
                 </div>
             </li>
             <li>
                 <a class="btn_map" data-bs-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
             </li>
         </ul>
     </div>
     <!-- /container -->
 </div>
 <!-- /filters -->

 <div class="collapse" id="collapseMap">
     <div id="map" class="map"></div>
 </div>
 <!-- /Map -->

 <div class="container margin_60_35">
     <div class="row">
         <aside class="col-lg-3" id="sidebar">
             <div id="filters_col">
                 <a data-bs-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters </a>
                 <div class="collapse show" id="collapseFilters" >
                    <form action="{{ route('page.search') }}" id="filter_form" method="GET">
                        <div class="filter_type">
                            <h6>States</h6>
                            <select class="selectpicker form-control @error('filter_state') is-invalid @enderror" name="filter_state" id="filter_state" data-live-search="true">
                                <option value="0" {{ empty($filter_state) ? 'selected' : '' }}>{{ __('prefer_country.all-state') }}</option>
                                @foreach($all_states as $all_states_key => $state)
                                    <option value="{{ $state->id }}" {{ $filter_state == $state->id ? 'selected' : '' }}>{{ $state->state_name }}</option>
                                @endforeach
                            </select>
                            @error('filter_state')
                            <span class="invalid-tooltip">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="filter_type">
                            <h6>Cities</h6>
                            <select class="selectpicker form-control @error('filter_city') is-invalid @enderror" name="filter_city" id="filter_city" data-live-search="true">
                                <option value="0" {{ empty($filter_city) ? 'selected' : '' }}>{{ __('prefer_country.all-city') }}</option>
                                @foreach($all_cities as $all_cities_key => $city)
                                    <option value="{{ $city->id }}" {{ $filter_city == $city->id ? 'selected' : '' }}>{{ $city->city_name }}</option>
                                @endforeach
                            </select>
                            @error('filter_city')
                            <span class="invalid-tooltip">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="filter_type">
                            <h6>Sort By</h6>
                            <select class="selectpicker form-control @error('filter_sort_by') is-invalid @enderror" name="filter_sort_by" id="filter_sort_by">
                                <option value="{{ \App\Item::ITEMS_SORT_BY_NEWEST_CREATED }}" {{ $filter_sort_by == \App\Item::ITEMS_SORT_BY_NEWEST_CREATED ? 'selected' : '' }}>{{ __('listings_filter.sort-by-newest') }}</option>
                                <option value="{{ \App\Item::ITEMS_SORT_BY_OLDEST_CREATED }}" {{ $filter_sort_by == \App\Item::ITEMS_SORT_BY_OLDEST_CREATED ? 'selected' : '' }}>{{ __('listings_filter.sort-by-oldest') }}</option>
                                <option value="{{ \App\Item::ITEMS_SORT_BY_HIGHEST_RATING }}" {{ $filter_sort_by == \App\Item::ITEMS_SORT_BY_HIGHEST_RATING ? 'selected' : '' }}>{{ __('listings_filter.sort-by-highest') }}</option>
                                <option value="{{ \App\Item::ITEMS_SORT_BY_LOWEST_RATING }}" {{ $filter_sort_by == \App\Item::ITEMS_SORT_BY_LOWEST_RATING ? 'selected' : '' }}>{{ __('listings_filter.sort-by-lowest') }}</option>
                                <option value="{{ \App\Item::ITEMS_SORT_BY_NEARBY_FIRST }}" {{ $filter_sort_by == \App\Item::ITEMS_SORT_BY_NEARBY_FIRST ? 'selected' : '' }}>{{ __('theme_directory_hub.filter-sort-by-nearby-first') }}</option>
                            </select>
                            @error('filter_sort_by')
                            <span class="invalid-tooltip">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="filter_type">
                            <h6>Category</h6>
                            <ul>
                                @foreach($all_printable_categories as $key => $all_printable_category)
                                    <li>
                                        <label class="container_check" for="filter_categories_{{ $all_printable_category['category_id'] }}"> {{ $all_printable_category['category_name'] }}
                                        <input {{ in_array($all_printable_category['category_id'], $filter_categories) ? 'checked' : '' }} name="filter_categories[]" class="form-check-input" type="checkbox" value="{{ $all_printable_category['category_id'] }}" id="filter_categories_{{ $all_printable_category['category_id'] }}">
                                        <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    @error('filter_categories')
                                    <span class="invalid-tooltip">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                @endforeach
                            </ul>
                        </div>
                        <div class="row ">
                            <div class="col-12 text-right justify-content-between d-flex">
                                <a class="btn btn-sm btn-outline-primary rounded" href="{{ route('page.search') }}">
                                    {{ __('theme_directory_hub.filter-link-reset-all') }}
                                </a>
                                <a class="btn btn-sm btn-primary text-white rounded" id="filter_form_submit">
                                    {{ __('theme_directory_hub.filter-button-filter-results') }}
                                </a>
                            </div>
                        </div>
                    </form>
                 </div>
             </div>
         </aside>

         <div class="col-lg-9">
             <div class="row">

                @if($paid_items->count() > 0)
                    @foreach($paid_items as $paid_items_key => $item)
                        @include('frontend.partials.new-item ', ['item' => $item, 'free_item' => false])
                    @endforeach
                 @endif

                 @if($free_items->count() > 0)
                     @foreach($free_items as $free_items_key => $item)
                        @include('frontend.partials.new-item' , ['item' => $item, 'free_item' => true])
                     @endforeach
                  @endif

             </div>
             <!-- /row -->

             <div class="d-flex justify-content-center">
                 {{ $pagination->links() }}
             </div>
         </div>
         <!-- /col -->
     </div>
 </div>
 <!-- /container -->
@endsection
@section('scripts')
<script>
    var markersDataOr = {
        'Marker': [
            @foreach($paid_items as $item)
            {
                type_point: 'Hotel', // Adjust this if the type can vary
                name: '{{ $item->item_title }}',
                location_latitude: {{ $item->item_lat }},
                location_longitude: {{ $item->item_lng }},
                map_image_url: "{{ !empty($item->item_image_medium) ? Storage::disk('public')->url('item/' . $item->item_image_medium) : (!empty($item->item_image) ? Storage::disk('public')->url('item/' . $item->item_image) : asset('frontend/images/placeholder/full_item_feature_image_medium.webp')) }}",
                rate: '{{ $item->item_price }}',
                name_point: '{{ $item->name_point }}',
                get_directions_start_address: '{{ $item->item_address }}',
                phone: '{{ $item->item_phone }}',
                url_point: "{{ route('page.item', $item->item_slug) }}"
            },
            @endforeach
            @foreach($free_items as $item)
            {
                type_point: '{{ $item->item_type == "1" ? "Regular Item" : "Online Item"}}', // Adjust this if the type can vary
                name: '{{ $item->item_title }}',
                location_latitude: {{ $item->item_lat }},
                location_longitude: {{ $item->item_lng }},
                map_image_url: "{{ !empty($item->item_image_medium) ? Storage::disk('public')->url('item/' . $item->item_image_medium) : (!empty($item->item_image) ? Storage::disk('public')->url('item/' . $item->item_image) : asset('frontend/images/placeholder/full_item_feature_image_medium.webp')) }}",
                rate: '{{ $item->item_price }}',
                name_point: '{{ $item->name_point }}',
                get_directions_start_address: '{{ $item->item_address }}',
                phone: '{{ $item->item_phone }}',
                url_point: "{{ route('page.item', $item->item_slug) }}"
            },
            @endforeach
        ]
    };
</script>

    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="{{ asset('frontend_new/js/markerclusterer.js') }}"></script>
    <script src="{{ asset('frontend_new/js/map.js') }}"></script>
    <script src="{{ asset('frontend_new/js/infobox.js') }}"></script>
@endsection
