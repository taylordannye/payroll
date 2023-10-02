<header>
   <div class="top-header">
    <div class="auth-username">
        <span>{{ auth()->user()->username }}</span>
    </div>
    <div class="nav-item">
        <nav class="nav-item_nav">
            <ul>
                <li><a href="">Developer</a></li>
                <li><a href="">Help</a></li>
            </ul>
        </nav>
        <div class="nav-aus">
            <div class="user-ixx-name">
                <i class="icofont-ui-user icon"></i>
                <span>{{ auth()->user()->firstname }}&nbsp;{{ auth()->user()->surname }}</span>
                <div class="nav-aus-drop_down">
                    <nav class="aus-drop_down">
                        <ul>
                            <li><a href="">Message Center</a></li>
                            <li><a href="">Account Settings</a></li>
                            <li><a href="">Signout</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
   </div>
   <div class="bottom-header">
    <div class="brand-logo-xxm">
        <img onclick="window.location.href='{{ route('dashboard') }}'" style="cursor: pointer;" src="{{ asset('storage/assets/images/1zuz3a9bwqa0b2k6cnno.png') }}" alt="logo" width="30px">
    </div>
    <div class="nav-item">
        <nav>
            <ul>
                <li><a class="active" href="">Home</a></li>
                <li><a href="">Activity</a></li>
                <li><a href="">Pay & Get Paid</a></li>
                <li class="m-none"><a href="">Marketing for growth</a></li>
                <li class="m-none"><a href="">{{ config('app.name') }}&nbsp;Tools</a></li>
            </ul>
        </nav>
    </div>
   </div>
</header>
