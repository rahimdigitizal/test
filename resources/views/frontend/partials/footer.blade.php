<footer class="plus_border">
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <h3 data-bs-target="#collapse_ft_1">{{ __('frontend.footer.about') }}</h3>
                <p>{!! clean(nl2br($site_global_settings->setting_site_about), array('HTML.Allowed' => 'b,strong,i,em,u,ul,ol,li,p,br')) !!}</p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <h3 data-bs-target="#collapse_ft_2">{{ __('frontend.footer.navigations') }}</h3>
                <div class="collapse dont-collapse-sm" id="collapse_ft_2">
                    <ul class="links">
                        <li><a href="{{ route('page.pricing') }}">{{ __('theme_directory_hub.pricing.footer.pricing') }}</a></li>
                        @if($site_global_settings->setting_page_about_enable == \App\Setting::ABOUT_PAGE_ENABLED)
                        <li><a href="{{ route('page.about') }}">{{ __('frontend.footer.about-us') }}</a></li>
                        @endif
                        <li><a href="{{ route('page.contact') }}">{{ __('frontend.footer.contact-us') }}</a></li>
                        @if($site_global_settings->setting_page_terms_of_service_enable == \App\Setting::TERM_PAGE_ENABLED)
                            <li><a href="{{ route('page.terms-of-service') }}">{{ __('frontend.footer.terms-of-service') }}</a></li>
                        @endif
                        @if($site_global_settings->setting_page_privacy_policy_enable == \App\Setting::PRIVACY_PAGE_ENABLED)
                            <li><a href="{{ route('page.privacy-policy') }}">{{ __('frontend.footer.privacy-policy') }}</a></li>
                        @endif
                        @if($site_global_settings->setting_site_sitemap_show_in_footer == \App\Setting::SITE_SITEMAP_SHOW_IN_FOOTER)
                            <li><a href="{{ route('page.sitemap.index') }}">{{ __('sitemap.sitemap') }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <h3 data-bs-target="#collapse_ft_3">{{ __('frontend.footer.follow-us') }}</h3>
                <div class="follow_us">
                    <ul>
                        @foreach(\App\SocialMedia::orderBy('social_media_order')->get() as $key => $social_media)
                            <li><a href="{{ $social_media->social_media_link }}"><i class="{{ $social_media->social_media_icon }}"></i></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <h3 data-bs-target="#collapse_ft_4">{{ __('frontend.footer.posts') }}</h3>
                <div class="collapse dont-collapse-sm" id="collapse_ft_4">
                    <ul class="links">
                        @php
                            $blogs = \App\Models\Blog::where('status',1)->latest()->take(5)->get();
                        @endphp
                        @foreach($blogs as $key => $post)
                            <li><a href="{{ route('page.blog.show', $post->slug) }}">{{ $post->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- /row-->
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <ul id="footer-selector">
                    <li>
                        <div class="styled-select" id="lang-selector">
                            <select id="countrySelect">
                                @foreach($site_available_countries as $site_available_countries_key => $country)
                                        @if($country->country_status == \App\Country::COUNTRY_STATUS_ENABLE)
                                        <option value="{{ $country->id}}" data-url="{{ route('page.country.update', ['user_prefer_country_id' => $country->id]) }}" {{ $site_prefer_country_name == $country->country_name ? 'selected' : '' }}>{{ $country->country_name }}</option>
                                        @endif
                                @endforeach
                            </select>
                            <div class="btn-group dropup">
                                <button class="btn btn-sm rounded dropdown-toggle btn-footer-dropdown" type="button" id="table_option_dropdown_country" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-globe"></i>
                                    {{ $site_prefer_country_name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="table_option_dropdown_country">
                                    @foreach($site_available_countries as $site_available_countries_key => $country)
                                        @if($country->country_status == \App\Country::COUNTRY_STATUS_ENABLE)
                                        <li><a class="dropdown-item" href="{{ route('page.country.update', ['user_prefer_country_id' => $country->id]) }}">
                                            {{ $country->country_name }}
                                        </a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </li>
                    <li>
                        <div class="styled-select" id="currency-selector">
                            <select id="currencySelect">
                                @foreach(\App\Setting::LANGUAGES as $setting_languages_key => $language)
                                    @if(\Illuminate\Support\Facades\Schema::hasTable('settings_languages'))
                                        @if($site_global_settings->settingLanguage->$language == \App\SettingLanguage::LANGUAGE_ENABLE)
                                        <option value="{{ $setting_languages_key }}" data-url="{{ route('page.locale.update', ['user_prefer_language' => $setting_languages_key]) }}" {{ __('prefer_languages.' . app()->getLocale()) == $setting_languages_key ? 'selected' : '' }}> {{ __('prefer_languages.' . $setting_languages_key) }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul id="additional_links">
                    <li><span>{{ __('frontend.footer.copyright') }} &copy; {{ empty($site_global_settings->setting_site_name) ? config('app.name', 'Laravel') : $site_global_settings->setting_site_name }} {{ date('Y') }} {{ __('frontend.footer.rights-reserved') }}</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
