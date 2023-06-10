<div class="row py-2 mx-0">
    <div class="col-12 filter bg-white px-0 d-lg-none d-md-none d-block">

        <div
            id="price-slide"
            class=" item2020 homepromo owl-carousel owl-theme"
            style="height: 32px; margin-bottom: 0px"
        >
            <label class="py-3 d-block text-center">Mức giá:</label>
            @foreach (config('admin.product_price_filter') as $key=>$item)
                <a
                    href="{{ getFilterUrl('price',$key) }}"
                    class="d-block py-3 text-center @if(isFilterCurrent('price',$key)) check @endif"
                >
                    {{ __($item) }}
                </a>
            @endforeach
        </div>

        <div class="d-flex align-items-center">
            <label class="mb-3 ml-3">Sắp xếp:</label>
            <div class="dropdown">
                <button
                    class="ml-3 mb-3 btn btn-secondary dropdown-toggle bg-white"
                    style="color: #393a3d"
                    type="button"
                    id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    @if(!empty(request()->sort_type)) {{__(request()->sort_type)}}   @else {{ __(config('admin.product_sort_type')[0])  }} @endif
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach (config('admin.product_sort_type') as $item)
                        <a
                            href="{{ getFilterUrl('sort_type',$item) }}"
                            class="onclick-sort dropdown-item  @if(isFilterCurrent('sort_type',$item)) check @endif"
                        >
                            <i class="icontgdd-checkbox"></i> {{ __($item) }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 filter bg-white px-0 d-lg-block d-md-block d-none">

        <div class="fl price">
            <label>Chọn mức giá:</label>
            @foreach (config('admin.product_price_filter') as $key=>$item)
                <a
                    href="{{ getFilterUrl('price',$key) }}"
                    class="@if(isFilterCurrent('price',$key)) check @endif"
                >
                    {{ __($item) }}
                </a>
            @endforeach
        </div>

        <div class="fr barpage">
            @foreach (config('admin.product_sort_type') as $item)
                <a
                    href="{{ getFilterUrl('sort_type',$item) }}"
                    class="@if(isFilterCurrent('sort_type',$item)) check @endif"
                >
                    <i class="icontgdd-checkbox"></i> {{ __($item) }}
                </a>
            @endforeach
        </div>
    </div>
</div>
