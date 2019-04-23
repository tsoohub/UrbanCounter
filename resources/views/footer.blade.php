<footer id="footer" class="footer">
    <div class="footer-four">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <span class="float-left">
                        <p>© <?php echo date("Y"); ?> Urbancountertops. All rights reserved</p></span>
                    <p class="float-right">
                        @if(isset($mainMenu) && property_exists($mainMenu, 'menuItems'))@foreach ($mainMenu->menuItems as $menu)
                                <a href="{{$menu['url']}}" target="_self">{{$menu['title']}}</a>
                        @endforeach @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<div id="go-top">
    <span class="fa fa-arrow-up"></span>
</div>
<script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('lib/revolution/jquery.themepunch.revolution.min.js')}}"></script>
<script src="{{ asset('lib/revolution/jquery.themepunch.plugins.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/jquery.masonry.min.js')}}"></script>
<script src="{{ asset('js/velocity.min.js')}}"></script>
<script src="{{ asset('js/mixitup.min.js')}}"></script>
<script src="{{ asset('js/jquery-ui.min.js')}}"></script>
<script src="{{ asset('js/jquery.blockUI.js')}}"></script>
<script src="{{ asset('js/highlight.min.js')}}"></script>
<script src="{{ asset('js/moment.js')}}"></script>
<script src="{{asset('js/socket.io.js')}}"></script>
<script src="{{ asset('lib/gallery/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{ asset('lib/gallery/isotope.pkgd.min.js')}}"></script>
<script src="{{ asset('lib/gallery/lightgallery-all.min.js')}}"></script>
<script src="{{ asset('lib/swiper/js/swiper.min.js')}}"></script>
<script src="{{ asset('js/dropzone.js')}}"></script>
<script src="{{ asset('js/icodice.js')}}"></script>

