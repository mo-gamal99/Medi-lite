
<a href="" class="logo logo-light ">
    <span class="logo-sm">
        <img
            src="{{ $settings->logo ? asset('storage/' . $settings->logo) : asset('assets/images/logo.jpg') }}"
            alt="logo" height="60" width="100%">
    </span>

    <span class="logo-lg">
        <img
            src="{{ $settings->logo ? asset('storage/' . $settings->logo) : asset('assets/images/logo.jpg') }}"
            alt="logo" height="70px" width="100%" style="object-fit: contain;navbar-brand-box">
    </span>
</a>


{{-- <a href="{{route('dashboard.index')}}" class="logo logo-light">
    <span class="logo-sm">
        <img src="{{ asset('storage/' . $settings->logo) }}" alt="" height="40" width="40">
    </span>
    <span class="logo-lg">
        <img src="{{ asset('storage/' . $settings->logo) }}" alt="" height="50" width="100%">
    </span>
</a> --}}
