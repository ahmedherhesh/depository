<?php use Illuminate\Support\Facades\Route;
?>
<div class="sidebar bg-light">
    <span class="close-icon"><img src="{{ asset('imgs/close.svg') }}" alt=""></span>
    <a href="{{ route('home') }}" class="sidebar-banner d-flex align-items-center gap-2">
        <span class="banner-logo"><img src="{{ asset('imgs/store.svg') }}" alt=""></span>
        <h3 class="banner-title m-0">مخزن العهدة</h3>
    </a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link @if (strpos(url()->current(), '/items') != '') active @endif" aria-current="page"
                href="{{ route('items.index') }}">
                <img src="{{ asset('imgs/widgets.svg') }}" alt=""> <span> المنتجات </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (strpos(url()->current(), 'categories') != '') active @endif" href="{{ route('categories.index') }}">
                <img src="{{ asset('imgs/category.svg') }}" alt=""><span>الأقسام</span>
            </a>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link modal-btn" data-bs-toggle="modal"
                data-bs-target="#createCategoryModal">
                <img src="{{ asset('imgs/library_add.svg') }}" alt=""><span>إضافة قسم</span>
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link modal-btn" data-bs-toggle="modal" data-bs-target="#createItemModal">
                <img src="{{ asset('imgs/library_add.svg') }}" alt=""><span>إضافة منتج</span>
            </button>
        </li>
        <li class="nav-item">
            <a class="nav-link @if (strpos(url()->current(), 'deliveries') != '') active @endif" href="{{ url('deliveries') }}" >
                <img src="{{ asset('imgs/handshake.svg') }}" alt=""><span>التسليمات</span>
            </a>
        </li>
        <li class="nav-item">
            <a  class="nav-link @if (strpos(url()->current(), 'returned-items') != '') active @endif" href="{{ url('returned-items') }}">
                <img src="{{ asset('imgs/assignment_return.svg') }}" alt=""><span>المرتجعات</span>
            </a>
        </li>
        @if (in_array($user->role, ['super-admin', 'admin']))
            <li class="nav-item">
                <a class="nav-link @if (strpos(url()->current(), 'users') != '') active @endif" href="{{ url('users') }}" >
                    <img src="{{ asset('imgs/users.svg') }}" alt=""><span>المستخدمين</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (strpos(url()->current(), 'depositories') != '') active @endif" href="{{ url('depositories') }}" >
                    <img src="{{ asset('imgs/store.svg') }}" alt=""><span>المخازن</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (strpos(url()->current(), 'companies') != '') active @endif" href="{{ url('companies') }}" >
                    <img src="{{ asset('imgs/apartment.svg') }}" alt=""><span>الشركات</span>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link @if (strpos(url()->current(), 'reports') != '') active @endif" href="{{ route('reports') }}" >
                <img src="{{ asset('imgs/contract.svg') }}" alt=""><span> التقارير</span>
            </a>
        </li>
    </ul>

    <div class="dropdown mt-3 user-dropdown">
        <a class="btn dropdown-toggle p-0" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('imgs/manage_accounts.svg') }}" alt="">
            {{ $user->name }}
        </a>
        <ul class="dropdown-menu text-center" style="width:fit-content;">
            <li><a class="dropdown-item d-inline-block" href="{{ url('change-password') }}">تغيير كلمة
                    السر</a></li>
            <li><a class="dropdown-item d-inline-block" href="{{ route('logout') }}">تسجيل خروج</a>
            </li>
        </ul>
    </div>
</div>

@include('includes.modals.search-modal')
@include('includes.modals.create-category-modal')
@include('includes.modals.create-item-modal')

@if (session()->has('success'))
    <p class="alert alert-success ctm-alert fade-out text-center">{{ session()->get('success') }}</p>
@endif

@if (session()->has('failed'))
    <p class="alert alert-danger ctm-alert fade-out text-center">{{ session()->get('failed') }}</p>
@endif

@section('jquery')
    @parent
    <script>
        $('.alert-success').fadeOut(6000)
        $('.alert-danger').fadeOut(6000)
    </script>
@endsection
