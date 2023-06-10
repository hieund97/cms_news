<div class="mt-3">
    <div class="d-flex">
        <p class="mb-0 mr-3">Xếp theo: </p>
        <div class="form-check mr-2">
            <input class="form-check-input" type="radio" name="type_filter" id="post_search_filter_1" onclick="window.location=('{{route('fe.post.search',['q'=>request()->get('q')])}}');" value="option1" {{\Route::current()->getName() == 'fe.post.search'?'checked':''}}>
            <label class="form-check-label" for="post_search_filter_1">
                Liên quan nhất
            </label>
        </div>
        <div class="form-check mr-2">
            <input class="form-check-input" type="radio" name="type_filter" id="post_search_filter_2" onclick="window.location=('{{route('fe.post.search',['q'=>request()->get('q'),'sort_type'=>config('order-search-config.post_config.latest')])}}');" value="option1" {{\Route::current()->getName() == 'fe.post.search' && request()->get('sort_type') == config('order-search-config.post_config.latest')?'checked':''}}>
            <label class="form-check-label" for="post_search_filter_2">
                Mới nhất
            </label>
        </div>
        <div class="form-check mr-2">
            <input class="form-check-input" type="radio" name="type_filter" id="post_search_filter_3" onclick="window.location=('{{route('fe.post.search',['q'=>request()->get('q'),'sort_type'=>config('order-search-config.post_config.oldest')])}}');" value="option1" {{\Route::current()->getName() == 'fe.post.search' && request()->get('sort_type') == config('order-search-config.post_config.oldest')?'checked':''}}>
            <label class="form-check-label" for="post_search_filter_3">
                Cũ nhất
            </label>
        </div>
    </div>
</div>
