<li class="aticle-box px-1">
    <a
        href="{{$item->link}}" @if($item->rel) rel={{ $item->rel }} @endif @if($item->target) target={{ $item->target }} @endif 
        class="article-items "
        data-s="0"
    >
        <div>
            
            <img
                width="210" height="210"
                class="lazyOwl"
                alt="{{ $item->title }}"
                src="{{get_image_url($item->image,'default')}}"
            >
            <div class="description-content">

                <p class="text-dark font-size-14px px-2 overflow-hidden mb-0 product-slide-h3">{{$item->title}}</p>
                
            </div>
        </div>

    </a>
</li>
