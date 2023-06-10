@extends('layouts.app')

@section('page-title', !empty($product) ? __('Edit Product: :name', ['name' => $product->name]) : __('Create Product'))

@section('preview-page')
    @if(!empty($product))
        <li class="nav-item d-none d-sm-inline-block">
            <a
                target="_blank"
                href="{{ route('fe.product',["slug"=>$product->slug,'id'=>$product->id]) }}"
                data-toggle="tooltip"
                class="nav-link"
                href="xxx"
            >Xem bài viết
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a
                data-toggle="tooltip"
                title="Copy to Clipboard"
                class="copy_text nav-link"
                href="{{ route('fe.product',["slug"=>$product->slug,'id'=>$product->id]) }}"
            >Lấy link Url
            </a>
        </li>
    @endif
@endsection

@section('content')
    <form
        action="{{ !empty($product) ? route('products.update', ['product' => $product->id]) : route('products.store') }}"
        method="post"
        class="row"
        enctype="multipart/form-data"
        autocomplete="off"
    >
        @csrf
        @if (!empty($product)) @method('PUT') @endif

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">
                                    {{ __('Product Name') }} (
                                    <span class="text-danger">*</span>
                                                             )
                                </label>

                                <input
                                    id="name"
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name"
                                    placeholder="{{ __('Enter product name') }}"
                                    value="{{ old('name') ?: (!empty($product) ? $product->name : '') }}"
                                    required
                                >

                                @error('name')
                                <span class="error invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="slug">
                                    {{ __('Slug') }} (
                                    <span class="text-danger">*</span>
                                                     )
                                </label>

                                <input
                                    id="slug"
                                    type="text"
                                    class="form-control @error('slug') is-invalid @enderror"
                                    name="slug"
                                    value="{{ old('slug') ?: (!empty($product) ? $product->slug : '') }}"
                                    required
                                >

                                @error('slug')
                                <span class="error invalid-feedback d-block" role="alert">
                                    <strong>{!! $message !!}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="price">
                                    {{ __('Price') }} (
                                    <span class="text-danger">*</span>
                                                      )
                                </label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">VND</span>
                                    </div>

                                    <input
                                        id="price"
                                        type="text"
                                        class="form-control @error('price') is-invalid @enderror"
                                        name="price"
                                        placeholder="{{ __('Enter product price') }}"
                                        value="{{ old('price') ?: (!empty($product) ? $product->price : '') }}"
                                        required
                                        number-mask
                                    >

                                </div>

                                @error('price')
                                <span class="error invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card collapsed-card">
                                <div class="card-header" data-card-widget="collapse">
                                    <h3 class="card-title">{{ __('Sale') }}</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="sale_price">{{ __('Sale Price') }}</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">VND</span>
                                                    </div>

                                                    <input
                                                        id="sale_price"
                                                        type="text"
                                                        class="form-control @error('sale_price') is-invalid @enderror"
                                                        name="sale_price"
                                                        placeholder="{{ __('Enter sale price') }}"
                                                        value="{{ old('sale_price') ?: (!empty($product) ? $product->sale_price : '') }}"
                                                        number-mask
                                                    >

                                                    <div class="input-group-append">
                                                        <button
                                                            id="btn-advanced-sale-price" class="btn btn-info"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#collapseAdvancedSalePrice"
                                                            aria-expanded="true"
                                                            aria-controls="collapseAdvancedSalePrice"
                                                        >
                                                            @if (!empty(old('sale_time')) || empty($product) || (!empty($product) && !empty($product->sale_from) && !empty($product->sale_to)))
                                                                {{ __('With Time') }}
                                                                <i class="fas fa-chevron-up fa-sm fa-fw"></i>
                                                            @else
                                                                {{ __('No Sale Time') }}
                                                                <i class="fas fa-chevron-down fa-sm fa-fw"></i>
                                                            @endif
                                                        </button>
                                                    </div>
                                                </div>

                                                @error('sale_price')
                                                <span class="error invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="collapse @if (!empty(old('sale_time')) || empty($product) || (!empty($product) && !empty($product->sale_from) && !empty($product->sale_to))) show @endif"
                                        id="collapseAdvancedSalePrice"
                                    >
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    @php
                                                        $saleErrors = \Illuminate\Support\Arr::flatten(\Illuminate\Support\Arr::except($errors->get('sale_*'), 'sale_price'));
                                                    @endphp

                                                    <label for="sale_time">{{ __('Sale Time') }}</label>

                                                    <input
                                                        id="sale_time"
                                                        type="text"
                                                        class="datetimerange form-control @if(!empty($saleErrors)) is-invalid @endif"
                                                        name="sale_time"
                                                        autocomplete="off"
                                                        value="{{ old('sale_time') ?: (!empty($product) && !empty($product->sale_from) && !empty($product->sale_to) ? $product->sale_from.' - '.$product->sale_to : '') }}"
                                                    >

                                                    @if(!empty($saleErrors))
                                                        <span class="error invalid-feedback d-block" role="alert">
                                                            @foreach($saleErrors as $message)
                                                                <strong>{{ $message }}</strong>
                                                                <br>
                                                            @endforeach
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline">
                                                        <input
                                                            type="checkbox"
                                                            id="hide_sale_time"
                                                            name="hide_sale_time"
                                                            value="1"
                                                            @if(old('hide_sale_time') || (!empty($product) && $product->hide_sale_time)) checked @endif>
                                                        <label for="hide_sale_time">
                                                            {{ __('Hide sale time?') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label for="serial">
                                    {{ __('Product Serial') }}{{-- (<span class="text-danger">*</span>)--}}
                                </label>

                                <input
                                    id="serial"
                                    type="text"
                                    class="form-control @error('serial') is-invalid @enderror"
                                    name="serial"
                                    placeholder="{{ __('Enter product serial') }}"
                                    value="{{ old('serial') ?: (!empty($product) ? $product->serial : '') }}"
                                >

                                @error('serial')
                                <span class="error invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="form-group">
                                <label for="skus">
                                    {{ __('Sku') }}
                                </label>

                                <input
                                    id="serial"
                                    type="text"
                                    class="form-control @error('skus') is-invalid @enderror"
                                    name="skus"
                                    placeholder="{{ __('Enter product sku') }}"
                                    value="{{ old('skus') ?: (!empty($product) ? $product->skus : '') }}"
                                >

                                @error('skus')
                                <span class="error invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('Tags') }}</label>
                                <select
                                    class="form-control select2bs4 @error('product_tags') is-invalid @enderror"
                                    id="categories"
                                    name="product_tags[]"
                                    multiple
                                >
                                    <option value="">{{ __('Select Tag') }}</option>
                                    @include('partials.forms.product_tag_options', ['selected' => old('product_tags', !empty($product) && $product->productTags->isNotEmpty() ? $product->productTags->pluck('id')->toArray() : [])])
                                </select>
                                @error('product_tags')
                                <span class="error invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    @include('products.forms.picture',['product'=> !empty($product) ? $product : []])
                </div>
            </div>

            <div class="card">
                <div class="card-header" data-card-widget="collapse">
                    <h3 class="card-title">{{ __('Content') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="technical_specification">
                                    <span
                                        id="technical_specification_label"
                                    >{{ __('Technical Specification') }}</span>
                                </label>

                                <textarea
                                    id="technical_specification"
                                    name="technical_specification"
                                    class="form-control @error('technical_specification') is-invalid @enderror"
                                    rows="5"
                                    {{--required--}}
                                >{{ old('technical_specification') ?: (!empty($product) ? $product->technical_specification : '') }}</textarea>

                                @error('technical_specification')
                                <span class="error invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row" id="description-form">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">
                                    {{ __('Description') }} (
                                    <span class="text-danger">*</span>
                                                            )
                                </label>
                                <div style="height: 34px;">
                                    <span class="editor-action-item" style="">
                                        <a
                                            href="#" class="btn_gallery btn btn-primary" data-result="description"
                                            data-multiple="true" data-action="media-insert-ckeditor"
                                        >
                                            <i class="far fa-image"></i>
                                            Thêm tập tin
                                        </a>
                                    </span>
                                </div>
                                <textarea
                                    id="description"
                                    name="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="5"
                                    required
                                >{{ old('description') ?: (!empty($product) ? $product->description : '') }}</textarea>

                                @error('description')
                                <span class="error invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" data-card-widget="collapse">
                    <h3 class="card-title">{{ __('Images And Videos') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    @include('products.forms.real_images',['product'=> !empty($product) ? $product : []])

                    <div class="row">
                        <div class="col-12 mt-4">
                            @include('partials.forms.key-value-field', [
                                'label' => __('Videos'),
                                'name' => 'videos',
                                'keys' => ['title' => __('Enter video title'), 'url' => __('Enter Youtube URL')],
                                'data' => old('videos') ?: (!empty($product) ? $product->videos->map(fn($video) => ['title' => $video->title, 'url' => $video->full_url])->toArray() : []),
                            ])
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" data-card-widget="collapse">
                    <h3 class="card-title">{{ __('Relates, Gifts,Similar') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @php
                                if (!empty(old('relates'))) {
                                    $relates = collect(old('relates'))->map(fn($relate) => ['value' => $relate, 'label' => "ID: $relate"])->toArray();
                                } elseif (!empty($product) && !empty($product->relates)) {
                                    $relates = $product->relates->map(fn($relate) => ['value' => $relate->id, 'label' => $relate->name])->toArray();
                                }
                            @endphp

                            @include('partials.modals.choose-products', [
                                'label' => __('Relates'),
                                'name' => 'relates',
                                'data' => $relates ?? [],
                                'dataUrl' => route('products.accessories', ['type' => 'all']),
                            ])
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @include('partials.forms.list-field', [
                                'label' => __('Include In Box'),
                                'data' => (!empty(old('include_in_box'))) ? old('include_in_box') : (!empty($product) ? $product->include_in_box : []),
                                'name' => 'include_in_box',
                                'placeHolder' => __('Enter accessories include in box here')
                            ])
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            @php
                                if (!empty(old('similars'))) {
                                    $similars = collect(old('similars'))->map(fn($similar) => ['value' => $similar, 'label' => "ID: $similar"])->toArray();
                                } elseif (!empty($product) && !empty($product->relates)) {
                                    $similars = $product->similars->map(fn($similar) => ['value' => $similar->id, 'label' => $similar->name])->toArray();
                                }
                            @endphp

                            @include('partials.modals.choose-products', [
                                'label' => __('Similar_products'),
                                'name' => 'similars',
                                'data' => $similars ?? [],
                                'dataUrl' => route('products.accessories', ['type' => 'all']),
                            ])
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @include('partials.forms.seo', ['model' => !empty($product) ? $product:null])
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Actions') }}</h3>
                </div>

                <div class="card-body">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-save fa-fw"></i>
                        {{ __('Save') }}
                    </button>

                    <a href="{{ route('products.index') }}" class="btn btn-danger">
                        <i class="fas fa-ban fa-fw"></i>
                        {{ __('Cancel') }}
                    </a>
                </div>
            </div>

            @if (empty($product) || !$product->is_default)
                <div class="card">
                    <div class="card-header" data-card-widget="collapse">
                        <h3 class="card-title">{{ __('Options') }}</h3>
                        <div class="card-tools">

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input
                                            type="checkbox"
                                            name="show_on_top"
                                            value="1"
                                            id="show_on_top"
                                            @if (old('show_on_top') || old('show_on_top')==null || ($product->show_on_top ?? false)) checked @endif>
                                        <label for="show_on_top">{{ __('Show on top?') }}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input
                                            type="checkbox" name="pin_to_top" value="1" id="pin_to_top"
                                            @if (old('pin_to_top') || ($product->pin_to_top ?? false)) checked @endif>
                                        <label for="pin_to_top">{{ __('Pin to top?') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Category') }}</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">

                                <select
                                    class="form-control select2bs4 @error('product_category_id') is-invalid @enderror"
                                    id="product_category_id"
                                    name="product_category_id"
                                    required
                                >
                                    <option value="">{{ __('Select Category') }}</option>
                                    @include('partials.forms.product_category_options', ['disableParents' => true,'selected' => old('product_category_id') ?: ($product->product_category_id ?? null)])
                                </select>

                                @error('product_category_id')
                                <span class="error invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Published At') }}</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group date" id="publishedat" data-target-input="nearest">
                                <input
                                    type="text"
                                    name="published_at"
                                    autocomplete="off"
                                    class="form-control datetimepicker-input"
                                    data-target="#publishedat"
                                    value="{{ old('published_at') ?: (!empty($product) && !empty($product->published_at) ? $product->published_at : '') }}"
                                >
                                <div class="input-group-append" data-target="#publishedat" data-toggle="datetimepicker">
                                    <div class="input-group-text">
                                        <i class="far fa-clock"></i>
                                    </div>
                                </div>
                                @error('published_at')
                                <span class="error invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" id="original-select" style="display: none;">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Original Product') }}{{-- (<span class="text-danger">*</span>)--}}
                    </h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @php
                                if (!empty(old('parent_id'))) {
                                    $parents = [['value' => old('parent_id'), 'label' => 'ID: ' . old('parent_id')]];
                                } elseif (!empty($product) && !empty($product->parent)) {
                                    $parents = [['value' => $product->parent->id, 'label' => $product->parent->name]];
                                }
                            @endphp

                            @include('partials.modals.choose-products', [
                                'label' => __('Original Product'),
                                'name' => 'parent_id',
                                'data' => $parents ?? [],
                                'dataUrl' => route('products.accessories', ['type' => 'all', 'hide_children' => 1]),
                                'required' => true,
                                'single' => true,
                                'hide_label' => true,
                            ])
                        </div>
                    </div>
                </div>
            </div>
            <div class="card image-box">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Banner post') }}
                    </h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="preview-image-wrapper img-fluid">
                                    <img
                                        class="preview_image"
                                        src="{{ old('banner') ?: (!empty($product->banner) ? $product->banner : '/preview-icon.png') }}"
                                    >
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <span class="input-group-btn">
                                        <a
                                            data-result="image" data-action="select-image"
                                            class="btn_gallery btn btn-primary text-white"
                                        >
                                            <i class="fa fa-picture-o"></i> {{__('Choose')}}
                                        </a>
                                        <a class="btn_remove_image btn btn-primary text-white" > <i class="fa fa-trash-alt"></i></a>
                                    </span>
                                    <input
                                        name="banner" type="hidden"
                                        class="image-data form-control @error('banner') is-invalid @enderror"
                                        value="{{ old('banner') ?: (!empty($product) ? $product->banner : '') }}"
                                    >
                                </div>
                                @error('banner')
                                <span class="error invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Status') }} (
                        <span class="text-danger">*</span>
                                           )
                    </h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select
                                    name="status"
                                    id="status"
                                    class="form-control select2bs4 @error('status') is-invalid @enderror"
                                    required
                                >
                                    @foreach(config('admin.product_status') as $status => $label)
                                        <option
                                            value="{{ $status }}"
                                            @if(old('status') == $status || (!empty($product) && $product->status == $status)) selected @endif>
                                            {{ __("products.status.$label") }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('status')
                                <span class="error invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status_note_color">{{ __('Status Note Background') }}</label>

                                <select
                                    name="status_note_color"
                                    id="status_note_color"
                                    class="selectpicker form-control @error('status_note_color') is-invalid @enderror"
                                >
                                    @foreach(['#E8F4FD'=>'#006699','#FFF3E6' => '#9F815C' , '#F24423' => '#FFFFFF', '#FAA530' => '#FFFFFF' , '#226F7B' => '#FFFFFF'] as $background => $color)
                                        <option
                                            @if (old('status_note_color', $product->status_note_color ?? '') == ($background . ',' . $color)) selected
                                            @endif value="{{ $background . ',' . $color }}"
                                            data-content="<span class='badge' style='background: {{ $background }}; color: {{ $color }};'>{{ __('Status Note Content Here') }}</span>"
                                        >
                                            {{ __('Status Note Content Here') }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('status_note_color')
                                <span class="error invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group" id="status_note_gr">
                                <label for="status_note">{{ __('Status Note') }}</label>
                                <textarea
                                    name="status_note"
                                    id="status_note"
                                    rows="5"
                                    class="form-control @error('status_note') is-invalid @enderror"
                                >{{ old('status_note') ?: (!empty($product) ? $product->status_note : '') }}</textarea>
                                @error('status_note')
                                <span class="error invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card image-box">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Feature Image') }}
                    </h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-danger mb-2">
                                {{ __('Recommend Size: :size', ['size' => '720x333']) }}
                            </div>

                            <div class="form-group">
                                <div class="preview-image-wrapper img-fluid">
                                    <img
                                        class="preview_image"
                                        src="{{ old('feature_img') ?: (!empty($product->feature_img) ? $product->feature_img : '/preview-icon.png') }}"
                                    >
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <span class="input-group-btn">
                                        <a
                                            data-result="image" data-action="select-image"
                                            class="btn_gallery btn btn-primary text-white"
                                        >
                                            <i class="fa fa-picture-o"></i> {{__('Choose')}}
                                        </a>
                                        <a class="btn_remove_image btn btn-primary text-white" > <i class="fa fa-trash-alt"></i></a>
                                    </span>
                                    <input
                                        name="feature_img" type="hidden"
                                        class="image-data form-control @error('feature_img') is-invalid @enderror"
                                        value="{{ old('feature_img') ?: (!empty($product) ? $product->feature_img : '') }}"
                                    >
                                </div>
                                @error('feature_img')
                                <span class="error invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Warranty') }}
                    </h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input
                                    id="warranty"
                                    type="text"
                                    class="form-control @error('warranty') is-invalid @enderror"
                                    name="warranty"
                                    value="{{ old('warranty') ?: (!empty($product) ? $product->warranty : '') }}"
                                >

                                @error('warranty')
                                <span class="error invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" id="original-select">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            @php
                                if (!empty(old('posts'))) {
                                    $posts = collect(old('posts'))->map(fn($post) => ['value' => $post, 'label' => "ID: $post"])->toArray();
                                } elseif (!empty($product) && !empty($product->posts)) {
                                    $posts = $product->posts->map(fn($posts) => ['value' => $posts->id, 'label' => $posts->title])->toArray();
                                }
                            @endphp

                            @include('partials.modals.choose-post', [
                                'label' => __('Posts'),
                                'name' => 'posts',
                                'data' => $posts ?? [],
                                'dataUrl' => route('getPostForProduct', ['type' => 'all']),
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-footer">
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@push('footer')
    <div
        class="modal fade" id="featureModal" tabindex="-1" role="dialog" aria-labelledby="featureModalTitle"
        aria-hidden="true"
    >
        <form id="fillFeaturesForm">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="featureModalTitle">{{ __('Quick Fill Features') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fillFeaturesInput"></label>

                            <textarea
                                id="fillFeaturesInput"
                                name="fillFeaturesInput" class="form-control"
                                rows="10" placeholder="Mỗi tính năng là 1 dòng"
                            ></textarea>

                            <span class="form-text">
                                Nhập vào tính năng nổi bật là một dòng
                            </span>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endpush
@push('footer')
    @include('partials.modals.edit_gallery_item')
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('theme/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('tokenfield/css/bootstrap-tokenfield.min.css') }}">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"
    >
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <style>
        .card-header {
            cursor: pointer;
        }

        .card-header .card-title {
            font-weight: bold;
        }
    </style>
@endpush

@push('scripts')

    @include('partials.js.rv_media',['buttonMoreImages'=>['btn_picture','btn_real_images']])
    @include('partials.editors.summernote',['editors'=>['technical_specification', 'description'],'buttons'=>[],'realButtons'=>[]])
    @include('partials.forms.slug', ['fromElement' => '#name', 'toElement' => '#slug'])

    <script src="{{ asset('jquery.mask.min.js') }}"></script>
    <script src="{{ asset('tokenfield/bootstrap-tokenfield.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


    <script>

        $(document).ready(function () {
            $('input[number-mask]').attr('type', 'text').mask('00,000,000,000', {reverse: true})

            //Chọn ngày tháng
            $('input[name="date_preorder"]').daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: false
            })
            $('input[name="date_preorder"]').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY'))
            })

            $('input[name="date_preorder"]').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('')
            })

            //Chọn ngày bán
            $('input[name="date_of_sale"]').daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: false
            })
            $('input[name="date_of_sale"]').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY'))
            })

            $('input[name="date_of_sale"]').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('')
            })

            // Thêm nhanh tính năng nổi bật
            $('#fillFeaturesForm').submit(function (e) {
                e.preventDefault()
                var text = $('#fillFeaturesInput').val()
                var ul = $('#product_feature_add').find('ul').attr('id')
                var button = $('#product_feature_add').find('button')
                var random = ul.replace('list-values-features', '')
                var lines = text.split('\n')
                $.each(lines, function (index, line) {
                    if (line.trim() !== '') {
                        $('#input-value-features' + random).val(line)
                        button.trigger('click')
                    }
                })
                $('#featureModal').modal('hide')
            })
        })

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('.datetimerange').daterangepicker({
            autoUpdateInput: false,
            timePicker: true,
            timePickerIncrement: 5,
            timePicker24Hour: true,
            timePickerSeconds: true,
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
            }
        }).on('click', function (e) {
            e.preventDefault()
            $(this).attr('autocomplete', 'off')
        })
        $('.datetimerange').on('apply.daterangepicker', function (ev, picker) {
            $(this)
                .val(picker.startDate.format('YYYY-MM-DD HH:mm:ss') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm:ss'))
        })

        $('.datetimerange').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('')
        })

        $('#publishedat').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        })

        $('.invalid-feedback').closest('.collapsed-card').CardWidget('toggle')

        if (!$('#collapseAdvancedSalePrice').hasClass('show')) {
            $('input[name="sale_time"]').val(null)
        }

        function validateYoutubeUrl(url) {
            if (!url) {
                alert('{{ __('Youtube URL is require.') }}')
                return false
            }

            let regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/
            let match = url.match(regExp)
            if (!match || match[2].length !== 11) {
                alert('{{ __('Your url you enter is not a valid supported url.') }}')
                return false
            }

            return true
        }

        $('#collapseAdvancedPrice').on('show.bs.collapse', function () {
            $('#btn-advanced-price i').removeClass('fa-chevron-down').addClass('fa-chevron-up')
        }).on('hide.bs.collapse', function () {
            $('#btn-advanced-price i').removeClass('fa-chevron-up').addClass('fa-chevron-down')
        })

        $('#collapseAdvancedSalePrice').on('show.bs.collapse', function () {
            $('#btn-advanced-sale-price').html('{{ __('With Time') }} <i class="fas fa-chevron-up fa-sm fa-fw"></i>')
        }).on('hide.bs.collapse', function () {
            $('#btn-advanced-sale-price')
                .html('{{ __('No Sale Time') }} <i class="fas fa-chevron-down fa-sm fa-fw"></i>')
            $('input[name="sale_time"]').val(null)
            $('input[name="hide_sale_time"]').prop('checked', false)
        })

        if ($('select[name="product_category_id"]').find(':selected').data('type') == '3') {
            $('#original-select').show()
            $('#condition-select').show()
            $('form').append('<input type="hidden" name="is_old" value="1">')
        }

        $('select[name="product_category_id"]').change(function () {
            if ($(this).find(':selected').data('type') == '3') {
                $('#original-select').show()
                $('#condition-select').show()
                $('form').append('<input type="hidden" name="is_old" value="1">')
                $('#note-form').hide()
                $('#description-form').hide()
                $('#source-form').hide()
                $('#date-preorder-form').hide()
                $('#day-order-form').hide()
                $('#technical_specification_label').text('{{ __('Thông số kỹ thuật') }}')
            } else {
                $('#original-select').hide()
                $('#condition-select').hide()
                $('input[name="is_old"]').remove()
                $('#note-form').show()
                $('#description-form').show()
                $('#source-form').show()
                $('#date-preorder-form').show()
                $('#day-order-form').show()
                $('#technical_specification_label').text('{{ __('Technical Specification') }}')
            }
        })

    </script>

@endpush
