@foreach($posts as $post)
    @php
        $time = \Carbon\Carbon::parse($post->published_at)->diffForHumans(now());
       if(strpos($time,'giờ') !== false ||strpos($time,'1 ngày') !== false||strpos($time,'2 ngày') !== false||strpos($time,'3 ngày') !== false) {
           $timePush = \Carbon\Carbon::parse($post->published_at)->diffForHumans(now());
       } else {
           $timePush = \Carbon\Carbon::parse($post->published_at)->format('d/m/Y');
       }
    @endphp
    <div class="col-12 mt-2 pb-3 border-bottom">
        <div class="row">
            <div class="col-md-3 col-6">
                <div>
                    <a href="{{route('fe.post',['slug'=>$post->slug,'id'=>$post->id])}}">
                        <img class="w-100" src="{{get_image_url($post->thumbnail,'featured')}}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-md-9 mt-md-0 mt-lg-0 col-6">
                <div class="d-flex justify-content-between flex-column h-100">
                    <h3 class="h6">
                        <a
                            href="{{route('fe.post',['slug'=>$post->slug,'id'=>$post->id])}}"
                            class="font-weight-bold text-decoration-none text-dark"
                        >{{$post->title}}</a>
                    </h3>
                    <div class="d-flex align-items-center justify-content-between">
                        @foreach($post->categories as $category)
                            <span
                                class="text-decoration-none font-weight-bold text-gray rounded"
                            >{{ $category->title }}
                            </span>
                        @endforeach
                        <div class="">
                            <p class="h-100 mb-0 text-gray-show-more-news font-weight-bold">{{ $timePush }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
