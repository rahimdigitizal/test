<header class="header_in">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12">
                <div id="logo">
                    <a href="index.html" title="Sparker - Directory and listings template">
                        @if(empty($site_global_settings->setting_site_logo))
                        <h1 class="mb-0 site-logo">
                            <a href="{{ route('page.home') }}" class=" mb-0 text-dark" >
                                @foreach(explode(' ', empty($site_global_settings->setting_site_name) ? config('app.name', 'Laravel') : $site_global_settings->setting_site_name) as $key => $word)
                                    @if($key/2 == 0)
                                        {{ $word }}
                                    @else
                                        <span class="text-primary">{{ $word }}</span>
                                    @endif
                                @endforeach
                            </a>
                        </h1>
                        @else
                        <h1 class="mb-0 mt-1 site-logo">
                            <a href="{{ route('page.home') }}" class="text-black mb-0">
                                <img src="{{ Storage::disk('public')->url('setting/' . $site_global_settings->setting_site_logo) }}" width="165" height="35" alt="">
                            </a>
                        </h1>
                        @endif
                        {{-- <img src="{{ asset('frontend_new/img/logo.svg') }}" width="165" height="35" alt="" class="logo_normal">
                        <img src="{{ asset('frontend_new/img/logo_sticky.svg') }}" width="165" height="35" alt="" class="logo_sticky"> --}}
                    </a>
                </div>
            </div>
            <div class="col-lg-9 col-12">
                <!-- /top_menu -->
                <a href="#menu" class="btn_mobile">
                    <div class="hamburger hamburger--spin" id="hamburger">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
                <nav id="menu" class="main-menu">
                    <ul>
                        <li><span><a href="{{ route('page.home') }}">{{ __('frontend.header.home') }}</a></span></li>
                        <li><span><a href="{{ route('page.categories') }}">{{ __('frontend.header.listings') }}</a></span></li>
                        @if($site_global_settings->setting_page_about_enable == \App\Setting::ABOUT_PAGE_ENABLED)
                        <li><span><a href="{{ route('page.about') }}">{{ __('frontend.header.about') }}</a></span></li>
                        @endif
                        <li><span><a href="{{ route('page.blog') }}">{{ __('frontend.header.blog') }}</a></span></li>
                        <li><span><a href="{{ route('page.contact') }}">{{ __('frontend.header.contact') }}</a></span></li>
                        @guest
                            <li class="ml-xl-3 login"><span><a href="{{ route('login') }}"><span class="border-left pl-xl-4"></span>{{ __('frontend.header.login') }}</a></span></li>
                            @if (Route::has('register'))
                                <li><span><a href="{{ route('register') }}">{{ __('frontend.header.register') }}</a></span></li>
                            @endif
                        @else
                            <li class="has-children"><span>
                                <a href="#">{{ Auth::user()->name }}</a></span>
                                <ul class="dropdown">
                                    <li>
                                        @if(Auth::user()->isAdmin())
                                            <a href="{{ route('admin.index') }}">{{ __('frontend.header.dashboard') }}</a>
                                        @else
                                            <a href="{{ route('user.index') }}">{{ __('frontend.header.dashboard') }}</a>
                                        @endif
                                    </li>
                                    <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('auth.logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                        <li><span>
                            @guest
                                <a href="{{ route('page.pricing') }}" class="cta"><span class="btn_add"><i class="fas fa-plus mr-1"></i> {{ __('frontend.header.list-business') }}</span></a>
                            @else
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.items.create') }}" class="cta"><span class="btn_add"><i class="fas fa-plus mr-1"></i> {{ __('frontend.header.list-business') }}</span></a>
                                @else
                                    @if(Auth::user()->hasPaidSubscription())
                                        <a href="{{ route('user.items.create') }}" class="cta"><span class="btn_add"><i class="fas fa-plus mr-1"></i> {{ __('frontend.header.list-business') }}</span></a>
                                    @else
                                        <a href="{{ route('page.pricing') }}" class="cta"><span class="btn_add"><i class="fas fa-plus mr-1"></i> {{ __('frontend.header.list-business') }}</span></a>
                                    @endif
                                @endif
                            @endguest
                        </span>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</header>
