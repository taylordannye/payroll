<header>
    <div class="logo">
        <a href="" class="logo-desktop-bynd a-decoration-none">
            <div class="flex-flow-logo">
                <img src="{{ asset('storage/assets/images/1zuz3a9bwqa0b2k6cnno.png') }}" alt="Logo"
                    title="{{ config('app.name') }}">
            </div>
        </a>
        <a href="" class="logo-mobile-tab-alternative">
            <img src="{{ asset('storage/assets/images/1zuz3a9bwqa0b2k6cnno.png') }}" alt="Logo" width="40px"
                title="{{ config('app.name') }}">
        </a>
        <div class="user-greeting-status">
            <h1>Good Morning,</h1>
            <p>{{ auth()->user()->email }}</p>
        </div>
    </div>
    <nav>
        <div class="search-engine">
            <form action="#" method="POST" autocomplete="off">
                @csrf
                <div class="search-background">
                    <input type="search" name="query" id="search" placeholder="Search employees files & more.">
                    <div class="btn-search-engine-group">
                        <button type="submit"><i class="icofont-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </nav>
    <div class="actions">
        <div id="plugin" class="hamburger" onclick="toggleMenu()">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <div class="message message-hyperlink m-dash">
            <img src="{{ asset('storage/utilities/components/auth/lsbhl0ji40fb6rd36pcb.png') }}" id="usermessage utilizer-img" alt="messages">
            <p>Messages</p>
        </div>
        <div class="user-profile profile-hyperlink m-dash">
            <img src="{{ asset('storage/utilities/components/auth/5dcyql4mvwahfpcxw8gr.png') }}" id="userProfile utilizer-img" alt="profile">
            <p>Profile</p>
        </div>
        <div class="user-logout logout-hyperlink m-dash">
            <img src="{{ asset('storage/utilities/components/auth/icons8-refresh.svg') }}" id="refresh utilizer-img" alt="refresh">
            <p>Refresh Page</p>
        </div>
        <button class="btn lang-btn" id="lang-btn"><img
                src="{{ asset('storage/utilities/components/auth/2shy6ikkqb31nxrcrvck.png') }}"
                alt="Translator" width="18px">&nbsp;{{ app()->getLocale() }}</button>
    </div>
</header>
