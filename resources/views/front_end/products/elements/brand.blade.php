@if($brands->isNotEmpty())
    <div class="row py-2 mx-0">
        <div class="col-md-12 col-sm-12 txt-blue mb-2">
            <strong> Sản phẩm theo thương hiệu: </strong>
        </div>
        <div class=" trademark-category-slider homeproduct item2020 homepromo owl-carousel owl-theme">
            @foreach ($brands as $item)
                <div class="col-md col-sm-12 px-2 ">
                    <a
                        href="{{ $item->link }}"
                        @if($item->rel) rel="{{ $item->rel }}"
                        @endif class="brand-slide text-white bg-red btn btn-default border d-flex justify-content-center align-items-center"
                    >
                        {!! $item->text !!}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif
<script>
    $(document).ready(function(){
        $('.homeproduct .brand-slide').matchHeight();
    })
</script>
