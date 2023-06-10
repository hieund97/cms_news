@php 
$listPost = \App\Models\Post::where('is_video',true)->take(6)->get();
@endphp 

<div class="py-3 px-3 bg-dark my-2 mx-0 my-lg-3 mx-lg-0 border-top border-bottom">
    <div class="d-flex justify-content-between flex-lg-row flex-md-row flex-column">
        <p class="h4 mb-0 text-light">Video nổi bật</p>
        <a rel="nofolow,noindex" href="{{ $mainSettings["youtube_url"] }}" class="mb-0 text-decoration-none text-warning">Xem thêm video tại ChungAuto >></a>
    </div>
    <div class="px-3 py-2 px-md-2 py-md-2 px-lg-5 py-lg-4">
        <div id="list-post_video" class="owl-custom owl-carousel owl-theme position-relative">
            @foreach($listPost as $post)
            <div class="item">
                <div class="video-wrapper-youtube">
                    <a href="{{route('fe.post',['slug'=>$post->slug,'id'=>$post->id])}}">
                        <img class="w-100" src="{{get_image_url($post->thumbnail,'featured')}}" alt="">
                    </a>
                </div>
                <p class="mb-0 mt-3 text-light">{{$post->title}}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
