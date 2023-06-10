@php
    $fPost = $posts_featured->first();
    $fExpPost = $expPosts->first();
@endphp

<div class="row py-2 bg-white mx-0 mx-0">
    <div class="col-md-9 pl-0 pr-0 pr-md-3 pr-lg-3">
        <div class="btn btn-default bg-red d-flex text-nowrap text-white">
            <a href="{{route('fe.post.index')}}" class="text-light text-decoration-none">TIN TỨC</a>
        </div>
        <div class="row">
            <div class="col-md-8 pt-2">
                <div class="border">
                    @if($fPost)
                        <a
                            href="{{ route('fe.post',["slug"=>$fPost->slug,'id'=>$fPost->id]) }}"
                            class="d-flex w-100 p-1"
                        >
                            <img
                                src="{{ get_image_url($fPost->thumbnail,'full_featured') }}"
                                class="w-100 d-block"
                                alt="{{ $fPost->title }}"
                            >
                        </a>
                        <h3 class="h5">
                            <a
                                href="{{ route('fe.post',["slug"=>$fPost->slug,'id'=>$fPost->id]) }}"
                                class="d-flex mt-2 text-decoration-none text-dark font-weight-bold p-1"
                            >
                                {{ $fPost->title }}</a>
                        </h3>
                    @endif
                </div>
            </div>
            <div class="col-md-4 pt-2 pl-lg-0 pl-md-0 pl-3">
                @foreach ($posts as $post)
                    <div class="col-md-12 border-bottom pb-1 mb-1">
                        <div class="row">
                            <div class="col-6 pl-0 pr-1">
                                <h3 class="news-widget">
                                <a
                                    href="{{ route('fe.post',["slug"=>$post->slug,'id'=>$post->id]) }}"
                                    class="w-100"
                                >
                                    <img
                                        src="{{ get_image_url($post->thumbnail,'featured') }}"
                                        class="w-100 d-block"
                                        alt="{{ $post->title }}"
                                    >
                                </a>
                            </h3>
                            </div>
                            <div class="col-6 px-1">
                                <h3 class="news-widget">
                                    <a
                                        href="{{ route('fe.post',["slug"=>$post->slug,'id'=>$post->id]) }}"
                                        class="text-decoration-none text-dark"
                                    >{{ $post->title }}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-3 px-0">
        <div class="btn btn-default bg-red d-flex text-nowrap text-white">
            <a href="https://chungauto.vn/kien-thuc-o-to-e2.html" class="text-light text-decoration-none">KINH NGHIỆM</a>
        </div>
        <div class="pt-2">
            @if($fExpPost)
                <div class="border-bottom">
                    <a href="{{ route('fe.post',["slug"=>$fExpPost->slug,'id'=>$fExpPost->id]) }}" class="d-flex w-100">
                        <img
                            src="{{ get_image_url($fExpPost->thumbnail,'featured') }}"
                            class="w-100 d-block"
                            alt="{{ $fExpPost->title }}"
                        >
                    </a>
                    <h3 class="h5">
                        <a
                            href="{{ route('fe.post',["slug"=>$fExpPost->slug,'id'=>$fExpPost->id]) }}"
                            class="d-flex mt-2 text-decoration-none text-dark font-weight-bold"
                        >{{ $fExpPost->title }}</a>
                    </h3>
                </div>
            @endif
            @foreach ($expPosts as $post)
                @if($post->id != $fExpPost->id)
                    <div class="col-md-12 border-bottom pb-1 mb-1">
                        <div class="row">
                            <div class="col-6 pl-0 py-1">
                                <a href="{{ route('fe.post',["slug"=>$post->slug,'id'=>$post->id]) }}" class="w-100">
                                    <img
                                        src="{{ get_image_url($post->thumbnail,'featured') }}"
                                        class="w-100 d-block"
                                        alt="{{ $post->title }}"
                                    >
                                </a>
                            </div>
                            <div class="col-6 px-1">
                                <h3 class="news-widget">
                                    <a
                                        href="{{ route('fe.post',["slug"=>$post->slug,'id'=>$post->id]) }}"
                                        class="text-decoration-none text-dark"
                                    >{{ $post->title }}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
