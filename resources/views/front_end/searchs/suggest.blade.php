@if($products->isNotEmpty())
<ul class="search_suggest_data">
        <li style="display:block"></li>
        @foreach ($products as $product)
        <li class="@if($loop->index%2==0) odd @else even @endif first last">
                <a class="search_suggest_data_image"
                        href="{{ Route('fe.product',["slug"=>$product->slug,"id"=>$product->id]) }}">
                        <img src="{{ (!empty($product->productMedias[0])) ? get_image_url($product->productMedias[0]->url, 'default'):asset(config('admin.image_not_found')) }}"
                                alt="{{ $product->name }}" />
                </a>
                <div class="search_suggest_data_description">
                        <div class="search-title">
                                <a class="search_suggest_data_title m-0"
                                        href="{{ Route('fe.product',["slug"=>$product->slug,"id"=>$product->id]) }}">{{ $product->name }}

                                </a>
                        </div>
                        <div class="search_suggest_data_price">
                                <span>@money($product->getRealPriceAttribute())</span>
                                @if($product->isSale())
                                <span class="is-sale-price">@money($product->price)
                                </span>
                                @endif
                        </div>
                </div>
        </li>
        @endforeach
</ul>
@endif
@if($posts->isNotEmpty())
Tin tức
<ul class="search_suggest_data">
        <li style="display:block"></li>
        @foreach ($posts as $post)
        <li class="@if($loop->index%2==0) odd @else even @endif first last">
                <a class="search_suggest_data_image"
                        href="{{ route('fe.post',["slug"=>$post->slug,'id'=>$post->id]) }}">
                        <img src="{{ get_image_url($post->thumbnail,'featured') }}" alt="{{ $post->title }}" /></a>
                <div class="search_suggest_data_description">
                        <a class="search_suggest_data_title m-0"
                                href="{{ route('fe.post',["slug"=>$post->slug,'id'=>$post->id]) }}">{{ $post->title }}
                        </a>
                </div>
        </li>
        @endforeach
<ul>
@endif