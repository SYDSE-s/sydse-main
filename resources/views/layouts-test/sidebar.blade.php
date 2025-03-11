<link rel="stylesheet" href="{{ asset('css/dashboard/sidebar.css') }}">

<div id="sidebar" class="sidebar open position-relative">
    <img src="{{ asset('icon/logo-horizontal.svg') }}" class="sb-not-collapsed"
        style="margin-bottom: 50px; height: 60px; align-self: flex-start;">
    <img src="{{ asset('icon/logo-vertikal.svg') }}" class="sb-collapsed"
        style="margin-bottom: 50px; padding-inline: 10px; height: 60px;">
    <ul class="list-unstyled sb-not-collapsed">
        <li class="sidebar-item {{ Route::currentRouteName() == 'dashboard' ? 'item-active' : '' }}"><a
                href="/dashboard" class="sidebar-link h5"><img src="{{ asset('icon/home.png') }}">Dashboard</a></li>
        <li
            class="sidebar-item {{ in_array(Route::currentRouteName(), ['manage-product', 'add-product-v', 'edit-product-v']) ? 'item-active' : '' }}">
            <a href="/manage-product" class="sidebar-link h5"><img src="{{ asset('icon/add-product.png') }}">Manage
                Product</a>
        </li>
        <li class="sidebar-item "><a href="#" class="sidebar-link h5"><img
                    src="{{ asset('icon/business-profile.png') }}">Business Profile</a></li>
        <li class="sidebar-item "><a href="#" class="sidebar-link h5"><img
                    src="{{ asset('icon/analytic.png') }}">Analisis</a></li>
        <li class="sidebar-item "><a href="#" class="sidebar-link h5"><img
                    src="{{ asset('icon/cashier.png') }}">Kasir</a></li>
    </ul>
    <ul class="list-unstyled sb-collapsed">
        <li class="sidebar-item {{ Route::currentRouteName() == 'dashboard' ? 'item-active' : '' }}"><a href="#"
                class="sidebar-link"><img src="{{ asset('icon/home.png') }}"></a>
        </li>
        <li class="sidebar-item "><a href="#" class="sidebar-link"><img
                    src="{{ asset('icon/add-product.png') }}"></a></li>
        <li class="sidebar-item "><a href="#" class="sidebar-link"><img
                    src="{{ asset('icon/business-profile.png') }}"></a></li>
        <li class="sidebar-item "><a href="#" class="sidebar-link"><img
                    src="{{ asset('icon/analytic.png') }}"></a></li>
        <li class="sidebar-item "><a href="#" class="sidebar-link"><img
                    src="{{ asset('icon/cashier.png') }}"></a></li>
    </ul>
    <button class="sb-not-collapsed sidebar-item mt-auto btn btn-danger">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <a class="sidebar-link text-white" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <img src="{{ asset('icon/logout.png') }}" style="height: 15px;">
            {{ __('Logout') }}
        </a>

    </button>
    <div class="sb-collapsed sidebar-item mt-auto">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <a class="sidebar-link btn btn-danger text-white py-3" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <img src="{{ asset('icon/logout.png') }}" style="height: 15px;">
        </a>

    </div>
    <button id="toggleBtn" class="btn toggle-btn position-absolute start-100" style="z-index: 100;">&#x262D;</button>
</div>


<script>
    let sidebar = document.getElementById("sidebar");
    let itemCollapsed = document.querySelectorAll(".sb-collapsed");
    let itemNotCollapsed = document.querySelectorAll(".sb-not-collapsed");
    let sidebarLogo = document.querySelector(".sidebar-logo");
    let content = document.getElementById("content");

    itemCollapsed.forEach(item => {
        item.style.display = "none"
    });

    document.getElementById("toggleBtn").addEventListener("click", function() {

        if (sidebar.classList.contains("open")) {
            sidebar.classList.remove("open");
            itemCollapsed.forEach(item => {
                item.style.display = "block"
            });
            itemNotCollapsed.forEach(item => {
                item.style.display = "none"
            });
            sidebar.style.padding = '15px 0px'

        } else {
            sidebar.classList.add("open");
            itemCollapsed.forEach(item => {
                item.style.display = "none"
            });
            itemNotCollapsed.forEach(item => {
                item.style.display = "block"
            });
            sidebar.style.padding = '15px'
        }
    });
</script>
