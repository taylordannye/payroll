@if (session()->has('success'))
<div class="utility-wrapper">
    <div class="success-info" id="wrapper">
        <img src="{{ asset('storage/utilities/components/auth/zvhnkyp7wwuvmnvvlg2f.svg') }}" alt="success" width="40px">
        <p class="message">{{ session('success') }}</p>
        <i class="icofont-close-line" id="dismiss" title="Close"></i>
    </div>
</div>
@endif
