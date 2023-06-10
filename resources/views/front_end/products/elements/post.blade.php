@php
    $fPost = $posts->first();
@endphp
@if($posts->isNotEmpty())
    <div class="row py-2 bg-white mx-0 mx-0">
        <div class="col-12 p-0">
            <div class="btn btn-default bg-red d-flex text-nowrap text-white">
                BÀI VIẾT LIÊN QUAN
            </div>
            <div class="row">
                <div class="col-md-6 pt-2">
                    @if($fPost)
                        <div class="border">
                            <a
                                href="{{ route('fe.post',["slug"=>$fPost->slug,'id'=>$fPost->id]) }}"
                                class="d-flex w-100 p-1"
                                rel="nofollow"
                            >
                                <img
                                    src="{{ get_image_url($fPost->thumbnail,'featured') }}"
                                    class="w-100 d-block"
                                    alt="{{ $fPost->title }}"
                                >
                            </a>
                            <p style="font-size: 1rem">
                                <a
                                    href="{{ route('fe.post',["slug"=>$fPost->slug,'id'=>$fPost->id]) }}"
                                    class="d-flex mt-2 text-decoration-none text-dark font-weight-bold p-1"
                                    rel="nofollow"
                                >{{ $fPost->title }}</a>
                            </p>
                        </div>
                    @endif
                </div>
                <div class="col-md-6 pt-2 pl-md-0 pl-lg-0">
                    <div class="row mx-0">
                        @foreach ($posts as $post)
                            @if($post->id != $fPost->id)
                                <div class="col-md-6 border-bottom pb-1 mb-1">
                                    <div class="row">
                                        <div class="col-6 pl-0 pr-1">
                                            <a
                                                href="{{ route('fe.post',["slug"=>$post->slug,'id'=>$post->id]) }}"
                                                class="w-100"
                                                rel="nofollow"
                                            >
                                                <img
                                                    src="{{ get_image_url($post->thumbnail,'featured') }}"
                                                    class="w-100 d-block"
                                                    alt="{{ $post->title }}"
                                                >
                                            </a>
                                        </div>
                                        <div class="col-6 px-1">
                                            <span class="news-widget">
                                                <a
                                                    href="{{ route('fe.post',["slug"=>$post->slug,'id'=>$post->id]) }}"
                                                    class="text-decoration-none text-dark"
                                                    rel="nofollow"
                                                >{{ $post->title }}</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@endif
