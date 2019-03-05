@extends('default')
<!-- Stones Main Content -->
@section('content')

<!-- Stones Section -->
@if(isset($sections) && array_key_exists('urban-sink-main', $sections))
    @php $stonesSection = $sections['urban-sink-main'] ?? "" @endphp
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
                    <button type="button" class="control" data-sort="default:asc">Ascending</button>
                    <button type="button" class="control" data-sort="default:desc">Descending</button>
                </div>
            </div>
            <div class="search" style="float:right;padding-top: 18px;" >
                <form>
                    <input type="search" id="input" />
                </form>
            </div>
        </div>
        <div  class="mix-container new cast targets clearfix" >

            @if (isset($stonesSection['posts']))
            @php $stones = $stonesSection['posts'] @endphp
            @foreach ($stones as $stone)
            <div class="mix @if (isset($stone['postMetas']))@foreach ($stone['postMetas'] as $meta) {{$meta['value'] ?? ""}} @endforeach @endif col-lg-3 col-md-3 col-sm-4 col-xs-6">
            <div class="title">{{ $stone['title'] ?? '' }}</div>
            <a class="img" href="detail/{{$stone['id']}}">
                <img src="{{asset('data'.$stone['image'] ?? 'data/285x285.png' )}}" alt="{{$stone['title']}}"/>
            </a>
        </div>
        @endforeach
        @endif
    </div>
    </div>
@endif

@endsection


