@if (session()->has('info'))
<div class="utility-wrapper">
    <div class="info-container" id="wrapper">
        <div class="info-text">
            <i class="icofont-info-circle icon-info"></i><p>{{ session('info') }}</p>
        </div>
        <i class="icofont-close-line" id="dismiss" title="Close"></i>
    </div>
</div>
@endif
