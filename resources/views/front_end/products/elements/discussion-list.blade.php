<div id="discussion" class="ml-4">
    @if(!empty($discussions))
        @foreach($discussions as $discussion)
            <div>
                <span class="font-weight-bold text-capitalize">{{$discussion->full_name}}</span>
                <p style="text-indent: 10px">{{ $discussion->body }}</p>
            </div>
        @endforeach
    @endif
</div>
