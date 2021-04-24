<!DOCTYPE html>
<html dir="ltr" lang="en">
@include('admin.partials.head')
<body>
    @include('admin.inc.preloader')
    <div id="main-wrapper">
        @include('admin.partials.header')
        @include('admin.partials.aside_bar')
        <div class="page-wrapper">
            @include('admin.inc.breadcrumb')
            <div class="container-fluid">
                @yield('content')
            </div>
            @include('admin.partials.footer')
        </div>
    </div>
    @include('admin.inc.customizer')
    <div class="chat-windows"></div>
    @include('admin.partials.scripts')
</body>
</html>