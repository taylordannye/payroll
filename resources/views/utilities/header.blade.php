<header>
    <div class="logo">
        <a href="" class="logo-desktop-bynd a-decoration-none">
            <div class="flex-flow-logo">
                <img src="{{ asset('storage/assets/images/1zuz3a9bwqa0b2k6cnno.png') }}" alt="Logo"
                    title="{{ config('app.name') }}">
                <div class="site-brand">
                    <h5>{{ config('app.name') }}</h5>
                </div>
            </div>
        </a>
        <a href="" class="logo-mobile-tab-alternative">
            <img src="{{ asset('storage/assets/images/1zuz3a9bwqa0b2k6cnno.png') }}"
                alt="Logo" width="40px" title="{{ config('app.name') }}">
        </a>
    </div>
    <nav>
        <ul class="menu">
            <li><a href="" id="link1">Home</a></li>
            <li><a href="" id="link2">HR Faculty & Support</a> <i id="dropdown-icon-header"
                    class="icofont-caret-down"></i>
                <div class="dropdown__menu">
                    <ul>
                        <li><a href=""></a></li>
                        <li><a href=""></a></li>
                        <li><a href=""></a></li>
                    </ul>
                </div>
            </li>
            <li><a href="" id="link3">We're Hiring</a> <i id="dropdown-icon-header"
                    class="icofont-caret-down"></i>
                <div class="dropdown__menu">
                    <ul>
                        <li><a href="">Apply for a job</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="" id="link4">About</a>
            </li>
            <div class="btn-links-mobile-s-display mobile tablet">
                <button class="btn login-btn"
                    onclick="window.location.href=>{{ trans('global.header.btns.login') }}</button>
                <button class="btn
                    signup-btn" onclick="window.location.href=''">Get Started</button>
            </div>
        </ul>
    </nav>
    <div class="actions">
        <div id="plugin" class="hamburger" onclick="toggleMenu()">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <button class="btn login-btn desktops-only" onclick="window.location.href='{{ route('signin') }}'">Sign In</button>
        <button class="btn signup-btn desktops-only" onclick="window.location.href='{{ route('signup') }}'">Create an account</button>
        <button class="btn lang-btn" id="lang-btn"><i
                class="icofont-world"></i>&nbsp;{{ app()->getLocale() }}</button>
    </div>
</header>
