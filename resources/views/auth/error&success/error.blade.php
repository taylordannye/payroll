@if (session()->has('error'))
    <div class="utility-wrapper">
        <div class="error-danger" id="wrapper">
            <img src="{{ asset('storage/utilities/components/auth/pttri1ashwnml1533l9k.svg') }}" alt="error" width="30px">
            <p class="message">{{ session('error') }}</p>
            <i class="icofont-close-line" id="dismiss" title="Close"></i>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="utility-wrapper">
        @foreach ($errors->all() as $error)
            <div class="error-danger" id="wrapper">
                <img src="{{ asset('storage/utilities/components/auth/pttri1ashwnml1533l9k.svg') }}" alt="error" width="30px">
                <p class="message">{{ $error }}</p>
                <i class="icofont-close-line" id="dismiss" title="Close"></i>
            </div>
        @endforeach
    </div>
@endif
