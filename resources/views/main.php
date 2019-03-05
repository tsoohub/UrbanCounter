<?php
$stoneList =  (new App\Http\Controllers\PostsController())->getPostBySectionId(7);
$metaData = (new App\Http\Controllers\PostsController()) ->getPostsMeta();
$sinkList =  (new App\Http\Controllers\PostsController())->getPostBySectionId(8);
?>
<div class="stones baguetteBoxOne " data-ref="container-1">
    <div class="controls stone-control clearfix bg" >
        <img src="data/bg/light.png" alt="light" class="bg-img"/>
        <h1>Stones</h1>
        <div class="select">
                <span>
                    Color
                </span>
            <div class="buttons">
                <button type="button" class="control" data-toggle=".white">White</button>
                <button type="button" class="control" data-toggle=".brown">Brown</button>
                <button type="button" class="control" data-toggle=".black">Black</button>
                <button type="button" class="control" data-toggle=".beige">Beige</button>
                <button type="button" class="control" data-toggle=".gray">Gray</button>
                <button type="button" class="control" data-toggle=".taupe">Taupe</button>
                <button type="button" class="control" data-toggle=".cream">Cream</button>
            </div>
        </div>
        <div class="select">
                <span>
                    Style
                </span>
            <div class="buttons">
                <button type="button" class="control" data-toggle=".contemporary">Contemporary</button>
                <button type="button" class="control" data-toggle=".limestone">Limestone</button>
                <button type="button" class="control" data-toggle=".natural">Natural</button>
                <button type="button" class="control" data-toggle=".marble">Marble</button>
            </div>
        </div>
        <div class="select">
                <span>
                    Order
                </span>
            <div class="buttons">
                <button type="button" class="control" data-sort="default:asc">Ascending</button>
                <button type="button" class="control" data-sort="default:desc">Descending</button>
            </div>
        </div>
        <div class="search" style="float:right;padding-top: 18px;" >
            <form>
                <input type="search" id="input" >
            </form>
        </div>
    </div>
    <div  class="mix-container targets clearfix " id="projects">
        <?php
        if ($stoneList['success'] && $metaData['success']) {
            $stones = $stoneList['content'];
            $metas = $metaData['content'];
            foreach ($stones as $stone) {
                echo '<div class="mix ';
                foreach ($metas as $meta){
                    if($stone['id'] == $meta['postID']){
                        echo $meta['value'];
                    }
                }
                echo ' col-lg-2 col-md-3 col-sm-4 col-xs-6">';
                echo '<div class="title">';
                echo $stone['title'];
                echo '</div>';
                if($stone['image'] != NULL){
                    echo '<a class="img" href="data'.$stone['image'].'"  data-caption="'.$stone['title'].'">';
                }else{
                    echo '<a class="img" href="data/570x570.png"  data-caption="'.$stone['title'].'">';
                }
                if($stone['image'] != NULL){
                    echo '<img src="data'.$stone['image'].'" alt="'.$stone['title'].'"/>';
                }else{
                    echo '<img src="data/285x285.png" alt="'.$stone['title'].'"/>';
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
    <div class="loadMore">
        <a href="stone">View All</a>
    </div>
</div>
<div class="stones sink bg baguetteBoxOne"  data-ref="container-2">
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
                <input type="search" id="input" >
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
    <div class="loadMore">
        <a href="sinks">View All</a>
    </div>
</div>
