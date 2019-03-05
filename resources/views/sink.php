<!DOCTYPE html>
<html lang="en">
<?php include_once 'header.blade.php' ?>
<body>
<?php include_once 'menu.blade.php' ?>
<?php
    $sinkList =  (new App\Http\Controllers\PostsController())->getPostBySectionId(8);
    $metaData = (new App\Http\Controllers\PostsController()) ->getPostsMeta();
?>

<div class="stones bg baguetteBoxOne"  data-ref="container-4">
    <img src="data/bg/light.png" alt="light" class="bg-img"/>
    <div class="controls">
        <h1>Sinks</h1>
        <div class="sinks buttons">
            <button type="button" class="control" data-toggle=".kitchen">Kitchen</button>
            <button type="button" class="control" data-toggle=".bathroom">Bathroom</button>
            <button type="button" class="control" data-toggle=".bar">Bar</button>
        </div>
        <div class="select">
                <span>
                    Order
                </span>
            <div class="buttons">
                <button type="button" class="control" data-toggle=".new">New</button>
                <button type="button" class="control" data-toggle=".alphabetical">Alphabetical</button>
                <button type="button" class="control" data-toggle=".cast">cast iron</button>
                <button type="button" class="control" data-toggle=".stainless">stainless steel</button>
            </div>
        </div>
        <div class="search" style="float:right;padding-top: 18px;" >
            <form>
                <input type="search" id="input" />
            </form>
        </div>
    </div>
    <div  class="mix-container new cast targets clearfix">
        <?php
        if ($sinkList['success'] && $metaData['success']) {
            $sinks = $sinkList['content'];
            $metas = $metaData['content'];
            foreach ($sinks as $sink) {
                echo '<div class="mix ';
                foreach ($metas as $meta){
                    if($sink['id'] == $meta['postID']){
                        echo $meta['value'];
                    }
                }
                echo ' col-md-3 col-lg-2 col-sm-4 col-xs-6">';
                echo '<div class="title">';
                echo $sink['title'];
                echo '</div>';
                if($sink['image'] !=NULL){
                    echo '<a class="img" href="data'.$sink['image'].'"  data-caption="'.$sink['title'].'">';
                    echo '<img src="data'.$sink['image'].'" alt="'.$sink['title'].'"/>';
                }else{
                    echo '<a class="img" href="data/570x570.png"  data-caption="'.$sink['title'].'">';
                    echo '<img src="data/285x285.png" alt="'.$sink['title'].'"/>';
                }
                echo '</a>';
                echo '</div>';
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
    </div>
</div>
<?php include_once 'footer.blade.php' ?>
<script>
    var containerEl4 = document.querySelector('[data-ref="container-4"]');
    var config = {
        controls: {
            scope: 'local'
        }
    };
    var mixer4 = mixitup(containerEl4, config);
    $(document).ready(function(){
        $('.stones .select span').click(function(event){
            event.stopPropagation();
            $(this).closest('.select').find('.buttons').slideToggle();
            $(this).closest('.select').toggleClass('active');

            if($(this).closest('.select').find('button').hasClass('mixitup-control-active')){
                $(this).closest('.select').addClass('choosing');
            }else {
                $(this).closest('.select').removeClass('choosing');
            }
        });
        $('.buttons').click(function(event){
            event.stopPropagation();
        });
        $(".showup").on("click", function (event) {
            event.stopPropagation();
        });
    });
</script>
</body>
</html>
