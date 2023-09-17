<header>
    <div class="logo">
        <a href="" class="logo-desktop-bynd a-decoration-none">
            <div class="flex-flow-logo">
                <img src="{{ asset('storage/assets/images/1zuz3a9bwqa0b2k6cnno.png') }}" alt="Logo"
                    title="{{ config('app.name') }}">
                <div class="site-brand auth-client">
                    <h5>{{ config('app.name') }} <span>Account</span></h5>
                </div>
            </div>
        </a>
        <a href="" class="logo-mobile-tab-alternative">
            <img src="{{ asset('storage/assets/images/1zuz3a9bwqa0b2k6cnno.png') }}"
                alt="Logo" width="40px" title="{{ config('app.name') }}">
        </a>
    </div>
    <div class="actions">
        <button class="btn lang-btn" id="lang-btn"><img
                src="{{ asset('storage/utilities/components/auth/2shy6ikkqb31nxrcrvck.png') }}"
                alt="Translator" width="18px">&nbsp;{{ app()->getLocale() }}</button>
    </div>
</header>
