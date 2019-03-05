@extends('default')

<!-- Stone Detail Content -->
@section('content')

    @if(isset($post->postMetas))
        @php
            $listLI = '';
            $listImg = '';
            $listImgs ='';
            $listImgD ='';
            $listValues = '';
            $count = 0;
        @endphp
        @foreach($post->postMetas as $meta)
            @if (isset($meta['name']) && strpos($meta['name'], 'img_') !== false )
                @php
                    $listLI .= '<li data-target="#project-single-carousel" data-slide-to="'.$count.'" class="'.($count === 0 ? 'active' : "").'"></li>';
                    if($count == 0){
                        $listImgD= '<img src="'.(asset("data".($meta['value'] ?? "") ?? "data/home-slide/1.png")).'" alt="Placeholder" class="custom">';
                    }
                    $listImgs .='<li>
                    <a href="'.(asset("data".($meta['value'] ?? "") ?? "data/home-slide/1.png")).'">
                    <img src="'.(asset("data".($meta['value'] ?? "") ?? "data/home-slide/1.png")).'"  alt="'.($meta['name'] ?? "").'">
                    </a>
                    </li>';


                    $listImg .= '<div class="item '.($count === 0 ? 'active' : "").'">
                        <div class="item">
                            <div class="single-item">
                                <div class="col-xs-12 col-sm-6 col-md-12 img-holder">
                                    <div style="width: 100%; text-align: center;">
                                        <img src="'.(asset("data".($meta['value'] ?? "") ?? "data/home-slide/1.png")).'"
                                             alt="'.($meta['name'] ?? "").'"
                                             style="max-width: 100%;height: 383px;" />
                                    </div>
                                </div>
                            </div>
                        </div></div>';
                    $count++;
                @endphp
            @else
                @if(!($meta['name'] === 'closeupimage' ||  $meta['name'] === 'sceneimage' || $meta['name'] === 'slabimage'))
                    @php $listValues .= '<li class="col-xs-12 col-sm-12">
                        <div class="row">
                            <div class="icon-holder">&nbsp;</div>
                            <div class="text-holder">
                                <h5 style="text-transform: uppercase">MATERIAL '.($meta['name'] ?? "").'</h5>
                                <p>'.($meta['value'] ?? "").'</p>
                            </div>
                        </div></li>';
                    @endphp
                @else
                @endif
            @endif
        @endforeach
        @if ($count === 0)
            @php
                $listImg .= '<div style="width: 100%; text-align: center;">
                <img src="'.(asset("data/285x285.png")).'" alt="No Image" style="max-width: 100%;height: 383px;" /></div>';
                $listImgD .='<img src="'.(asset("data/285x285.png")).'" alt="Placeholder" class="custom">';
                $listImgs .= '<li>
                    <a href="'.(asset("data".($meta['value'] ?? "") ?? "data/home-slide/1.png")).'">
                    <img src="'.(asset("data/285x285.png")).'" alt="No Image">
                    </a>
                    </li>';
            @endphp
        @endif
    @endif

    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <a href="/stone"><i class="fa fa-home"></i>&nbsp;Home</a>
                        <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
                        <span class="current">{{ $post->title ?? ""  }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Page -->
    <div class="container-fluid" id="project-single-area">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="center">
                <div class="main-image">
                    {!! $listImgD !!}
                </div>

                <ul class="thumbnails">
                    {!! $listImgs !!}
                </ul>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="project-info">
                <h3>{{ $post->title ?? ""  }}</h3>
                <ul class="project-info-list">
                    {!! $listValues !!}
                </ul>
                <div class="share-project">
                    <div class="title">
                        <h5>share this post</h5>
                    </div>
                    <div class="social-share">
                        <ul>
                            <li><a href="javascript:void(0);"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="button" style="margin-top: 22px;">
                <div class="col-xs-12 col-sm-6" style="padding-left: 0;"><button type="button" class="btn btn-primary" style="width: 100%; background-color: #10997e !important; height:40px;"><a href="/urban-virtual" style="color:#fff; font-weight: bold; font-size:20px;">kitchen visualizer</a></button></div>
                <div class="col-xs-12 col-sm-6"><button type="button" class="btn btn-success" style="width: 100%; background-color: #252525 !important; height:40px;"><a href="/quote" style="color:#fff; font-weight: bold; font-size:20px;">Quote</a></button></div>
            </div>
        </div>
    </div>
    <style>
        .center{
            text-align: center;
        }
        .thumbnails img, .main-image img {
            max-width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            height: auto;
            background: #fff;
            box-shadow: 1px 1px 7px rgba(0,0,0,0.1);
        }
        .main-image {
            /*max-width: 400px;*/
            width: 100%;
            margin-bottom: 0.75em;
        }
        .thumbnails li {
            display: inline;
            margin: 0 10px 0 0;
            width: 40px;
        }

        .thumbnails li img {

            width: 80px;

        }
        .thumbnails {

            padding: 0;

        }
    </style>

@endsection
