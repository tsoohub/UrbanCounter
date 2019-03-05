@extends('default')

<!-- Stones Main Content -->
@section('content')

    <!-- Header -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <a href="/home"><i class="fa fa-home"></i>&nbsp;Home</a>
                        <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
                        <span class="current">Testimonials</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Comments -->
    @if(isset($sections) && array_key_exists('urban-testimonials-featured', $sections))
        @php $testimonials = $sections['urban-testimonials-featured']; @endphp
        <div id="comment" class="comment">
            <h1 class="heading worker-hd">
                Testimonials
            </h1>
            <div class="swiper-container-comment">
                <div class="swiper-wrapper">
                    @if(isset($testimonials) && array_key_exists('posts', $testimonials))
                        @foreach($testimonials['posts'] as $testimonial)
                            <div class="swiper-slide">
                                <div class="text">
                                    <p>{{$testimonial['content'] ?? ""}}</p>
                                </div>
                                <div class="customer">
                                    <div class="name">{{$testimonial['title'] ?? "No Name"}}
                                        @if(isset($testimonial) && array_key_exists('postMetas', $testimonial))
                                            @foreach($testimonial['postMetas'] as $testMeta)
                                                <div class="position">{{$testMeta['value'] ?? ""}}</div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- Testimonials -->
    @if(isset($sections) && array_key_exists('urban-testimonials-list', $sections))
        @php $testimonials = $sections['urban-testimonials-list']; @endphp
        <div class="col-xs-12">
            <div class="row bg-white">
                <h2 class="text-center p-top-20 text-jade"> See what our customers have to say! </h2>
            </div>
        </div>
        @if(isset($testimonials) && array_key_exists('posts', $testimonials))
            <div class="col-12 asd clearfix" style="background:#fff;">
                @foreach($testimonials['posts'] as $testimonial)
                    <div class="col-sm-12 col-md-4 col-xs-12">
                        <div class="comment-second">
                            <div class="text"><p>{{$testimonial['content'] ?? ""}}</p></div>
                            <div class="customer">
                                <div class="name">{{$testimonial['title'] ?? ""}}
                                    <div class="position">
                                        @if(isset($testimonial) && array_key_exists('postMetas', $testimonial))
                                            @foreach($testimonial['postMetas'] as $testMeta)
                                                {{$testMeta['value'] ?? "CEO"}}
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif

@endsection
