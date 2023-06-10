@extends('front_end.layouts.app')
@if(!empty($q))
@section('breadcrumbs')
    {{Breadcrumbs::view('breadcrumbs::json-ld', 'fe.search',$q)}}
@stop
@endif
@section('content')
    <section class="container pb-2">
        @if(!empty($q))
            {{ Breadcrumbs::render('fe.search',$q) }}

            <div class="d-flex ">
                <h1>Kết quả tìm kiếm {{ $q }} :</h1>
                <div class="d-flex ml-3">
                    <div class="form-check mr-2">
                        <input class="form-check-input" type="radio" name="type_search" id="product_search" onclick="window.location=('{{route('fe.search.index',['q'=>request()->get('q')])}}');" value="option1" {{\Route::current()->getName() == 'fe.search.index'?'checked':''}}>
                        <label class="form-check-label" for="product_search">
                            Sản phẩm
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type_search" id="post_search" onclick="window.location=('{{route('fe.post.search',['q'=>request()->get('q')])}}');" value="option1" {{\Route::current()->getName() == 'fe.post.search'?'checked':''}}>
                        <label class="form-check-label" for="post_search">
                            Tin tức
                        </label>
                    </div>
                </div>
            </div>
            @if(!empty($type) )
                @if($type == 'product')
                <!-- Filter -->
                    @include('front_end.products.elements.filter')
                <!-- Hết Filter -->
                @elseif($type == 'post')
                    @include('front_end.posts.elements.filter')
                @endif
            @endif


        <!-- Sản phẩm cho danh mục-->
            <div class="row bg-white view-group mx-0 @if($type=='product')mb-2 @elseif($type=='post')mt-3 @endif" id="list-product-category">

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center mt-3">
                        <a
                            rel="nofollow"
                            href="javascript:void(0)"
                            class="btn-show-more-list-news rounded text-decoration-none font-weight-bold h4 btn-load-more-product"
                        >Xem thêm
                        </a>
                    </div>
                </div>
            </div>
            <!-- Hết Sản phẩm cho danh mục-->

        @else
            <div class="row py-2 mx-0" style="min-height: 200px">

                Không tìm thầy kết quả nào!

            </div>
        @endif

    </section>
@endsection
@push('scripts')
    @include('front_end.partials.script-product-category',['url'=>route('fe.search.get',['q'=>$q??null]),'type'=>$type??null])
    <script>
        $('#price-slide').owlCarousel(
            {
                loop: false,
                //margin:1,
                nav: true,
                lazyLoad: true,
                dots: false,
                responsive: {
                    0: {
                        items: 3,
                        slideBy: 1,
                    },
                },
            },
        );

    </script>
@endpush
