<!DOCTYPE html><html lang="en">
{{-- Include the default header --}}@include('header')
<body>
{{--Include Main Menu--}}@if(isset($menus) && array_key_exists('urban-main-menu', $menus))@include('menu', ['mainMenu' => $menus['urban-main-menu']])@endif{{-- Main content --}}
    @yield('content')
    {{-- Include the footer --}}@if(isset($menus) && array_key_exists('urban-footer-menu', $menus))@include('footer', ['mainMenu' => $menus['urban-footer-menu']])@endif
    <div class="chatButton">Click to Chat Live!</div>
</body>
</html>
