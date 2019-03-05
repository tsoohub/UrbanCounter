@extends('default')

@section('content')
    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <a href="/home"><i class="fa fa-home"></i>&nbsp;Home</a>
                        <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
                        <span class="current">Gallery</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($sections) && array_key_exists('gallery-section-1', $sections))
        @php $gallerySection = $sections['gallery-section-1'] ?? ""; @endphp
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="portfolioFilter clearfix">
                            <a href="#" data-filter="*" class="current">All Photos</a>
                            <a href="#" data-filter=".kitchen">Kitchen</a>
                            <a href="#" data-filter=".bathroom">Bathroom </a>
                            <a href="#" data-filter=".commercial">Commercial</a>
                            <a href="#" data-filter=".custom">Custom</a>
                        </div>
                    </div>
                </div>
                <div class="demo-gallery">
                    @if (isset($gallerySection) && array_key_exists('posts', $gallerySection))
                        <ul id="lightgallery" class="list-unstyled row portfolioContainer">
                            @php $posts = $gallerySection['posts'] @endphp
                            @foreach ($posts as $post)
                                @php $img = 'data' . trim($post['image'] ?? '');
                                     $postMetas = '';
                                @endphp
                                @if (isset($post['postMetas']))
                                    @foreach ($post['postMetas'] as $meta)
                                        @php $postMetas .= trim($meta['value'] ?? "") . " " @endphp
                                    @endforeach
                                    @foreach ($post['postMetas'] as $meta)
                                        @if($meta["name"] == "zoom") @php $dataZoom = $meta["value"]; @endphp @endif
                                        @if($meta["name"] == "type") @php $dataType = $meta["value"]; @endphp @endif
                                        @if($meta["name"] == "title") @php $dataTitle = $meta["value"]; @endphp @endif
                                    @endforeach
                                @endif
                                <li class="col-xs-12 col-sm-6 col-md-4 col-lg-3 {{$dataType}}"
                                    data-responsive="data{{$dataZoom}} 375, data{{$dataZoom}} 480, data{{$dataZoom}} 800"
                                    data-src=" data{{$dataZoom}}"
                                    data-sub-html="<h4>{{$dataTitle}}</h4>">
                                    <a href="">
                                        <img class="img-responsive" src=" {{asset($img)}}" alt="Thumb-1">
                                        <div class="demo-gallery-poster">
                                            <img src="{{asset('data/zoom.png')}}" class="demo-image">
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <h3 style="margin-top: 75px;margin-bottom: 110px;">Gallery Section Not Found!</h3>
                    @endif
                </div>
            </div>
        </div>
    @endif

@endsection
