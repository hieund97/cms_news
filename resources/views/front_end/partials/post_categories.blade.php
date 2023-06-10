<div class="d-flex mb-2">
    @foreach($postCategories as $category)
        <a href="{{route('fe.post.category',['slug'=>$category->slug,'id'=>$category->id])}}"
           class="rounded mr-2 text-decoration-none d-inline-block px-3 text-color-blue border-color-blue-new">
            {{$category->title}}
        </a>
    @endforeach
</div>
