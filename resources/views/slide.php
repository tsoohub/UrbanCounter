<?php
$sliderList = (new App\Http\Controllers\PostsController())->getPostBySectionId(6);
?>
<div class="fullwidthbanner-container responsive center" id="home-section">
    <div class="fullwidthabanner">
        <ul style="list-style: none; padding: 0">
            <?php
            if ($sliderList['success']) {
                $slider = $sliderList['content'];
                foreach ($slider as $slide) {
                    echo '<li data-transition="fade" data-slotamount="7" data-masterspeed="1500"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7">';
                    echo '<img src="data'.$slide['image'].'"  alt="video_forest"  data-bgfit="cover"  data-bgposition="center" data-bgfit="cover" data-bgrepeat="no-repeat">';
                    echo '</li>';
                }
            } else {
                $code = $menus['code'];
                switch ($code) {
                    case 400:
                        break;
                    case 404:
                        break;
                    case 500:
                        break;
                    default:
                        break;
                }
            }
            ?>
        </ul>
    </div>
</div>