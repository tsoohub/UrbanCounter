@extends('default')
<!-- Stones Main Content -->
@section('content')
    <!-- Slide Section -->
    @if(isset($sections) && array_key_exists('urban-slide-main', $sections))
    @php $slideSection = $sections['urban-slide-main'] @endphp
    <div class="fullwidthbanner-container responsive center" id="home-section">
        <div class="fullwidthabanner">
            <ul style="list-style: none; padding: 0">
                @if (isset($slideSection['posts']))
                @php $slides = $slideSection['posts'] @endphp
                @foreach ($slides as $slide)
                <li data-transition="fade" data-slotamount="7" data-masterspeed="1500"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7">
                    <img src="data/{{$slide['image']}}"  alt="video_forest"  data-bgfit="cover"  data-bgposition="center" data-bgfit="cover" data-bgrepeat="no-repeat">
                </li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
    @endif
    @if(isset($sections) && array_key_exists('urban-stone-main', $sections))
		@php $stonesSection = $sections['urban-stone-main'] ?? "" @endphp
        <div class="stones baguetteBoxOne " data-ref="container-1">
            <div class="controls stone-control clearfix bg" >
                <img src="data/bg/light.png" alt="light" class="bg-img"/>
                <h1>{{ $stonesSection['name'] ?? "" }}</h1>
                <div class="check">
                    <label class="checkbox-container">
                        <span class="check-title">Close Up</span>
                        <input type="checkbox" class="filter-check-box close-up-check" >
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="check">
                    <label class="checkbox-container">
                        <span class="check-title">Scene</span>
                        <input type="checkbox" class="filter-check-box scene-check" >
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="check">
                    <label class="checkbox-container">
                        <span class="check-title">Slab</span>
                        <input type="checkbox" class="filter-check-box slab-check" >
                        <span class="checkmark"></span>
                    </label>
                </div>
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
                            Type
                        </span>
                    <div class="buttons">
                        <button type="button" class="control" data-toggle=".granite">Granite</button>
                        <button type="button" class="control" data-toggle=".marble">Marble</button>
                        <button type="button" class="control" data-toggle=".quartz">Quartz</button>
                        <button type="button" class="control" data-toggle=".quartzite">Quartzite</button>
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
                <div class="search" >
                    <form>
                        <input type="search" id="search-input" >
                    </form>
                </div>
            </div>
            <div class="mix-container targets clearfix " id="projects">
                @if (isset($stonesSection['posts']))
                    @php $stones = $stonesSection['posts'] @endphp
                    @foreach ($stones as $stone)
                        <div class="mix
                            @if (isset($stone['postMetas']))
                        @foreach ($stone['postMetas'] as $meta) {{ $meta['value'] ?? "" }} @endforeach
                        @endif
                            col-lg-2 col-md-3 col-sm-4 col-xs-6">
                            <div class="title">{{ $stone['title'] ?? '' }}</div>
                            <div class="images-container">
                                <a class="img main-image" href="detail/{{$stone['id']}}">
                                    <img src="{{asset('data'.$stone['image'] ?? 'data/285x285.png' )}}" alt="{{$stone['title']}}"/>
                                </a>
                                @php
                                    $closeupImageUrl = "/572x428.png";
                                    $sceneImageUrl = "/572x428.png";
                                    $slabImageUrl = "/572x428.png";
                                @endphp
                                @foreach ($stone['postMetas'] as $meta)
                                    @if($meta["name"] == "closeupimage") @php $closeupImageUrl = $meta["value"]; @endphp @endif
                                    @if($meta["name"] == "sceneimage") @php $sceneImageUrl = $meta["value"]; @endphp @endif
                                    @if($meta["name"] == "slabimage") @php $slabImageUrl = $meta["value"]; @endphp @endif
                                @endforeach
                                <a class="img close-up-image" href="detail/{{$stone['id']}}" style="display:none">
                                    <img src="{{asset('data'.$closeupImageUrl )}}" alt="{{$stone['title']}}"/>
                                </a>
                                <a class="img scene-image" href="detail/{{$stone['id']}}" style="display:none">
                                    <img src="{{asset('data'.$sceneImageUrl )}}" alt="{{$stone['title']}}"/>
                                </a>
                                <a class="img slab-image" href="detail/{{$stone['id']}}" style="display:none">
                                    <img src="{{asset('data'.$slabImageUrl )}}" alt="{{$stone['title']}}"/>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @endif
@endsection
