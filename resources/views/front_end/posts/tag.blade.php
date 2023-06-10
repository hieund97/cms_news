@extends('front_end.layouts.app')
@section('breadcrumbs')
    {{Breadcrumbs::view('breadcrumbs::json-ld', 'fe.post', $post)}}
@stop
@section('content')
    <section id="news-page" class="container pb-2">
        {{ Breadcrumbs::render('fe.post.tag',$tag) }}
        <div class="d-block mb-3">
            <div class="bg-color-blue d-inline-block">
                <h1 class="mb-1 h5 font-weight-bold text-uppercase bg-color-blue text-light px-2 py-1">{{ $tag->title }}</h1>
            </div>
        </div>
        <div class="d-flex">
            @foreach($productTypes as $cat)
                <a
                    href="{{ $cat->link }}"
                    class="rounded mr-2 text-decoration-none d-inline-block px-3 text-color-blue border-color-blue-new"
                >
                    {{$cat->text}}
                </a>
            @endforeach
        </div>
        <div class="bg-white overflow-hidden">
            <div class="row mt-3 py-2 px-2">
                <div class="col-md-12 col-lg-6 d-none d-sm-none d-md-block d-lg-block">
                    @if(!empty($featurePost))
                        <div class="border post-top" style="min-height: 100%">
                            <div class="overflow-hidden">
                                <a
                                    href="{{route('fe.post',['slug'=>$featurePost->slug,'id'=>$featurePost->id])}}"
                                    class="d-flex w-100"
                                >
                                    <img
                                        src="{{ get_image_url($featurePost->thumbnail,'full_featured') }}"
                                        class="w-100 d-block"
                                        alt="{{$featurePost->title}}"
                                    >
                                </a>
                            </div>
                            <div>
                                <h2 class="h5">
                                    <a
                                        href="{{route('fe.post',['slug'=>$featurePost->slug,'id'=>$featurePost->id])}}"
                                        class="d-flex mt-2 text-decoration-none text-dark font-weight-bold"
                                    >{{$featurePost->title}}</a>
                                </h2>
                            </div>

                        </div>
                    @endif
                </div>
                <div class="col-md-12 col-lg-6 mt-3 mt-md-4 mt-lg-0">
                    <div class="row post-top">
                        <div class="col-md-6 border-right border-left">
                            @foreach($newPosts as $post)
                                @if($loop->index == 0)
                                    <div class="">
                                        <a
                                            href="{{route('fe.post',['slug'=>$post->slug,'id'=>$post->id])}}"
                                            class="d-flex w-100"
                                        >
                                            <img
                                                src="{{$post->thumbnail}}"
                                                class="w-100 d-block"
                                                alt="{{$post->title}}"
                                            >
                                        </a>
                                        <h3 class="h5">
                                            <a
                                                href="{{route('fe.post',['slug'=>$post->slug,'id'=>$post->id])}}"
                                                class="d-flex mt-2 text-decoration-none text-dark font-weight-bold"
                                            >{{$post->title}}</a>
                                        </h3>
                                    </div>
                                @else
                                    <a
                                        href="{{route('fe.post',['slug'=>$post->slug,'id'=>$post->id])}}"
                                        class="d-flex mt-2 text-decoration-none text-dark border-top title-top-center-no-image"
                                    >{{$post->title}}</a>
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0 mt-lg-0">
                            <div>
                                <p class="mb-1 h5 font-weight-bold text-uppercase bg-color-blue text-light px-2 py-1">Sự
                                                                                                                      kiện</p>
                                @foreach($eventPosts as $post)
                                    <div class=" border-bottom py-2">
                                        <a
                                            href="{{route('fe.post',['slug'=>$post->slug,'id'=>$post->id])}}"
                                            class="text-decoration-none mb-1 text-dark"
                                        >{{$post->title}}</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white mt-4 px-2 py-2 second-list-content">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="overflow-hidden">
                        <div id="new-list-items">

                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <a
                                rel="nofollow"
                                href="javascript:void(0)"
                                class=" btn-show-more-list-news rounded text-decoration-none btn-show-more-list-news-action"
                            >Xem thêm
                            </a>

                            {{--                            <a href="#" class="btn-show-more-list-news rounded text-decoration-none font-weight-bold h4">Xem thêm</a>--}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 mt-3 mt-md-4 mt-lg-0">
                    @if($tag->banner)
                        <div  class="mb-2">
                            <img
                                class="w-100"
                                src="{{ get_image_url($tag->banner,'default') }}"
                                alt="{{ $tag->title }} banner"
                            >
                        </div>
                    @endif
                    <div class="mt-md-4 mt-lg-0">
                        <p class="mb-1 h6 font-weight-bold text-uppercase bg-color-blue text-light px-2 py-1">Bài viết
                                                                                                              nổi
                                                                                                              bật</p>
                        @foreach($featurePosts as $post)
                            <div class=" border-bottom py-2">
                                <a
                                    href="{{route('fe.post',['slug'=>$post->slug,'id'=>$post->id])}}"
                                    class="text-decoration-none mb-1 text-dark"
                                >{{$post->title}}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($tag->description))
            <div class="d-inline-block position-relative bg-white mt-4 mb-5 px-3 py-3 border-top-danger border-bottom-danger third-list-content">
                <div id="description_show_more" class="mt-4 font-weight-normal overflow-hidden">
                    {!! $tag->description  !!}
                </div>
                <p class="show-more d-none">
                    <a rel="nofollow" id="xem-them-bai-viet" href="javascript:void(0)" class="readmore">Đọc thêm</a>
                </p>
            </div>
        @endif
    </section>
@endsection
@include('front_end.partials.js.show_more')
@push('scripts')
    <script>

        $(document).ready(function () {
            $('.title-top-center-no-image').matchHeight();
        $('.post-top').matchHeight();
        })

    </script>
    @if(!empty($newPosts))
        @include('front_end.partials.script-post-category',['url'=>route('fe.post.tag.getPostTag',['id'=>$tag->id]), 'newsPost' => $newPosts->pluck('id')])
    @endif
    @include('front_end.partials.script-post-category',['url'=>route('fe.post.tag.getPostTag',['id'=>$tag->id]), 'newsPost' => []])
@endpush
