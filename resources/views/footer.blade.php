<div id="go-top" style="display: block;"><span class="fa fa-arrow-up"></span></div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chat live</h4>
            </div>
            <div class="modal-body">
                <p id="error">
                    Operator not online ~!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- SCRIPT -->
<script type="text/javascript" src="{{ asset('js/jquery-1.10.2.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/revolution/jquery.themepunch.plugins.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/revolution/jquery.themepunch.revolution.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/baguetteBox.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/highlight.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/moment.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('lib/lightgallery/lightgallery.js')}}"></script>
<script type="text/javascript" src="{{ asset('lib/lightgallery/js/picturefill.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('lib/lightgallery/js/lightgallery.js')}}"></script>
<script type="text/javascript" src="{{ asset('lib/lightgallery/js/lg-pager.js')}}"></script>
<script type="text/javascript" src="{{ asset('lib/lightgallery/js/lg-autoplay.js')}}"></script>
<script type="text/javascript" src="{{ asset('lib/lightgallery/js/lg-fullscreen.js')}}"></script>
<script type="text/javascript" src="{{ asset('lib/lightgallery/js/lg-zoom.js')}}"></script>
<script type="text/javascript" src="{{ asset('lib/lightgallery/js/lg-hash.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/mixitup.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/filter.js')}}"></script>
<script type="text/javascript" src="https://isotope.metafizzy.co/v1/jquery.isotope.min.js"></script>
<script type="text/javascript" src="{{ asset('lib/swiper/js/swiper.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/custom.js')}}"></script>
<footer><div class="footer clearfix"><div class="copyright fleft">© <?php echo date("Y"); ?> Urbancountertops. All rights reserved</div><ul class="nav-footer fright">@if(isset($mainMenu) && property_exists($mainMenu, 'menuItems'))@foreach ($mainMenu->menuItems as $menu)<li><a href="{{$menu['url']}}">{{$menu['title']}}</a></li>@endforeach @endif</ul></div></footer>
<script>
    $("#search-input").keyup(function(){var config={controls:{scope:'local'}};var containerStone=document.querySelectorAll('div[data-ref="container-1"]');var mixerStone=mixitup(containerStone,config);var inputText;var $matching=$();inputText=$("#search-input").val().toLowerCase();if((inputText.length)>0){$('.mix').each(function(){$this=$("this");if($(this).children('.title').text().toLowerCase().match(inputText)){$matching=$matching.add(this)}
    else{$matching=$matching.not(this)}});mixerStone.filter($matching)}else{mixerStone.filter('all')}});
    /*
* simpleGal -v0.0.1
* A simple image gallery plugin.
* https://github.com/steverydz/simpleGal
*
* Made by Steve Rydz
* Under MIT License
*/
    !function(a){a.fn.extend({simpleGal:function(b){var c={mainImage:".placeholder"};return b=a.extend(c,b),this.each(function(){var c=a(this).find("a"),d=a(this).siblings().find(b.mainImage);c.on("click",function(b){b.preventDefault();var c=a(this).attr("href");d.attr("src",c)})})}})}(jQuery);

    jQuery(document).ready(function () {
        jQuery('.thumbnails').simpleGal({
            mainImage: '.custom'
        });
    });
</script>
