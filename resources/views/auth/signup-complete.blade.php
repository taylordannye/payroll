<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Complete your registration process - {{ config('app.name') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/style.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/auth/authorization-2.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/auth/utilities.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/fonts/icofont/icofont.min.css?v=1.0') }}">
</head>

<body class="antialiased">
    @include('utilities.loader')
    @include('utilities.popups.cancel-csp')
    <main class="auth-container contents">
        <div class="auth-wrapper">
            <div class="auth-cancel">
                <button onclick="window.location.href='#alert'"><i class="icofont-close"></i></button>
            </div>
            {{-- <div class="flex-flow-logo l-m">
                <img src="{{ asset('storage/utilities/components/auth/zfquta5n277irtsdvp3r.png') }}" alt="Logo"
                    title="{{ config('app.name') }}" width="80px">
            </div> --}}
            <form action="{{ route('signup-complete.post') }}" method="POST" autocomplete="off" class="onboarding"
                id="authentication">
                @include('auth.error&success.error')
                @include('auth.error&success.success')
                @include('auth.error&success.info')
                @csrf
                <div class="auth-heading">
                    <span>Complete your signup process</span>
                </div>
                <div class="sub-head">
                    <p>This info is required to confirm the identity of <a
                            href="maito:{{ $email }}">{{ $email }}</a>. It also helps us
                        keep the
                        {{ config('app.name') }} community safe by complying with regulations that fight fraud. </p>
                </div>
                <div class="label-group">
                    <label for="email">Email Address <span id="required">*</span></label>
                </div>
                <div class="input-group">
                    <input type="text" name="email" id="email" value="{{ $email }}" @required(true)
                        @disabled(false) style="user-select: none; pointer-events: none;">
                </div>
                <div class="label-group">
                    <label for="legal-name">Enter legal fullname <span id="required">*</span></label>
                </div>
                <div class="input-group-2 input-group">
                    <input type="text" class="space-right" name="firstname" id="firstname" placeholder="John"
                        value="{{ old('firstname') }}" @required(true)>
                    <input type="text" name="surname" id="surname" placeholder="Doe" value="{{ old('surname') }}"
                        @required(true)>
                </div>
                <div class="label-group">
                    <label for="dob">Date of birth <span id="required">*</span></label>
                </div>
                <div class="input-group">
                    <input type="date" name="dob" id="dob" value="{{ old('dob') }}" @required(true)>
                </div>
                <div class="label-group">
                    <label for="username">Username <span id="required">*</span></label>
                </div>
                <div class="input-group">
                    <input type="text" name="username" id="username" placeholder="Create a username"
                        value="{{ old('username') }}" @required(true)>
                </div>
                <div class="label-group">
                    <label for="password">Create a password <span id="required">*</span></label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder="****************"
                        @required(true)>
                </div>
                <div class="user-consentment">
                    <input type="checkbox" name="agree" id="agree" value="{{ old('agree') }}">
                    <label>Please read the terms policy associated in creating this account <a
                            href="#terms-of-use">here</a> before proceeding.</label>
                </div>
                <div class="btn-group">
                    <button type="submit" id="submit" class="submit-btn">Finalize Signup <i
                            class="icofont-long-arrow-right"></i></button>
                    <div id="loader" class="loader-wrapper">
                        <!-- Ripple Loader -->
                        <div class="ripple-loader">
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>
                {{-- <div class="terms-of-use" id="terms-of-use">
                    <div class="tou-heading">
                        <span>Terms Of Use</span>
                    </div>
                    <p id="italic"><span id="required">*</span> We verify your date of birth against your Identification so we
                        advise you'd use the right information to avoid your account from being suspended or permanently
                        shutdown for service.</p>
                    <p id="italic">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni quasi, placeat ullam dicta autem
                        veritatis nam tempore incidunt eligendi ipsa voluptate et mollitia asperiores quia odio? Beatae
                        voluptatibus facilis dolorem quas architecto hic possimus suscipit ullam asperiores, nobis
                        itaque perferendis animi rem necessitatibus veritatis a culpa quod esse eos! Sunt qui, cum quis
                        ut aliquid similique in ipsam aut. Officia doloremque quasi ex quod quae! Repellat voluptas
                        iste, in dicta aperiam nam blanditiis debitis, similique necessitatibus tenetur totam excepturi
                        placeat laboriosam voluptates, omnis tempora fugiat aspernatur deleniti porro laudantium!
                        Voluptatum temporibus praesentium pariatur? Itaque tenetur eum cum, non deleniti iste delectus
                        dolor nisi. Culpa maxime ad accusamus doloribus amet tempore et maiores repellendus dolore
                        aperiam, rem beatae? Corrupti, assumenda quo voluptatibus inventore incidunt deserunt maxime
                        nostrum tenetur modi officia, magni consequatur minus, similique voluptate impedit! Facilis
                        dicta molestiae deserunt ea ipsa cupiditate distinctio accusantium iste odio! Nemo facilis
                        exercitationem quod iure quidem quaerat minima corrupti voluptas, voluptate recusandae sapiente
                        officiis cum eligendi libero fugit dolores ea consequuntur illum a sunt porro dolore asperiores.
                        Optio velit non dolore beatae adipisci! Nemo nihil suscipit, tenetur, illum at autem animi
                        cumque nobis, iure qui eius! Maxime nulla ab reiciendis harum voluptatum non, architecto
                        expedita? Beatae, ipsam. Pariatur enim ratione quasi vel nemo sequi, assumenda delectus itaque
                        eius debitis doloremque. Laborum eaque dolores amet neque. Unde illo provident, dolor non, sequi
                        officiis voluptates qui placeat eos expedita distinctio consequuntur doloribus, beatae quas
                        molestiae laudantium quo! Atque corrupti incidunt iusto ratione error mollitia pariatur
                        dignissimos cum, rem quas dolorum rerum eaque quod enim quam velit! Hic deleniti esse et error
                        quidem rerum illo, nihil asperiores, numquam, possimus maiores quia modi a. Magni officia
                        blanditiis necessitatibus quia molestias dolor hic aspernatur. Consequatur totam in facere
                        explicabo eos tempora consequuntur, veritatis iste sequi, delectus modi doloremque consectetur,
                        nobis odio. Et earum voluptates velit doloremque soluta! Provident, exercitationem officiis!
                        Ipsam amet temporibus debitis consequuntur, iste beatae eos porro dolores, asperiores laborum
                        blanditiis doloribus? Reprehenderit illo natus ducimus error vero facilis ut cumque iure aut
                        deleniti? Nulla non cupiditate autem est officiis? Facere necessitatibus cum animi ullam
                        repellat consequuntur error vero veniam! Possimus id provident doloremque, nihil, nostrum rerum
                        accusantium voluptatibus nesciunt commodi, soluta velit. Doloremque, minima dignissimos aliquid
                        perspiciatis nesciunt ex pariatur, temporibus rerum porro veritatis accusamus inventore dolorem
                        atque sunt iusto animi odit obcaecati accusantium rem? Maiores iusto, est excepturi qui tempore
                        repellat laudantium nihil aliquid hic placeat eius eum vero maxime illo magnam, labore doloribus
                        fuga, architecto ipsam quia accusantium commodi! Deleniti suscipit numquam qui quo.</p>
                    <p id="italic">&copy; <?php echo date('Y'); ?> - {{ config('app.name') }}</p>
                </div> --}}
            </form>
        </div>
    </main>
    <script src="{{ asset('storage/utilities/auth/js/jquery.min.js') }}"></script>
    <script src="{{ asset('storage/utilities/auth/js/6urye68tv3k0oo3n20sd.js') }}"></script>
</body>

</html>
