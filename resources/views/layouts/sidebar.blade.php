{{-- sidebar btn --}}
<button class="btn btn-outline-primary fixed-bottom ms-3 start-0" type="button" data-bs-toggle="offcanvas"
    data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"
    style="width: max-content; margin-bottom: 64px;">Menu</button>
{{-- sidebar off canvas --}}
<div class="offcanvas offcanvas-start text-bg-dark" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
    aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header" style="border-bottom: 1px solid rgb(113, 113, 113); padding-bottom: 20px;">
        <div class="offcanvas-title">
            <h5 id="offcanvasWithBothOptionsLabel"><i>Partguyuban Umkm Soloraya</i></h5>
            {{-- <p><i>Partguyuban Umkm Soloraya</i></p> --}}
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-between">
        <ul class="nav nav-tabs flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('member-data') }}">Member Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('request-verification') }}">Request Verification</a>
            </li>
        </ul>
        <p>This Website are still on Development progress, a better UI is coming soon >_<</p>
    </div>
</div>
