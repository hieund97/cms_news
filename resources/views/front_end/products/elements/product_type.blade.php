
@if($productTypes->isNotEmpty())
<div class="row py-2 mx-0">
    <div class="col-md-12 col-sm-12 txt-blue mb-2">
        <strong> Phân loại sản phẩm: </strong>
    </div>
    <div class="py-2 text-slider homeproduct item2020 homepromo owl-carousel owl-theme">
        @foreach ($productTypes as $item)
            <div class="px-1">
                <a href="{{ $item->link }}" @if($item->rel) rel="{{ $item->rel }}" @endif class="link-slider txt-blue btn btn-default border d-flex justify-content-center align-items-center">
                    {!! $item->text !!}
                </a>
            </div>
        @endforeach
    </div>

</div>
@endif
<script>
    $(document).ready(function(){
        $('.homeproduct .link-slider').matchHeight();
    })
</script>
