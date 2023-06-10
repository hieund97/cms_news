@extends('layouts.app')

@section('page-title', !empty($post) ? __('Edit post: :title', ['title' => $post->title]) : __('Create Post'))

@section('preview-page')
    @if(!empty($post))
        <li class="nav-item d-none d-sm-inline-block">
            <a
                target="_blank"
                href="{{ route('fe.post',["slug"=>$post->slug,'id'=>$post->id]) }}"
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
                href="{{ route('fe.post',["slug"=>$post->slug,'id'=>$post->id]) }}"
            >Lấy link Url
            </a>
        </li>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <form
                class="row"
                action="{{ empty($post) ? route('posts.store') : route('posts.update', ['post' => $post->id]) }}"
                method="post"
            >
                @csrf
                @if (!empty($post)) @method('PUT') @endif
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">{{ __('Title') }}</label>
                                        <span class="text-danger">(*)</span>
                                        <input
                                            id="title"
                                            type="text"
                                            name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title') ?: (!empty($post) ? $post->title : '') }}"
                                            required
                                        />
                                        @error('title')
                                        <span class="error invalid-feedback" style="display: block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="slug">{{ __('Slug') }}</label>
                                        <input
                                            id="slug"
                                            name="slug"
                                            class="form-control @error('slug') is-invalid @enderror"
                                            value="{{ old('slug') ?: (!empty($post) ? $post->slug : '') }}"
                                        />
                                        @error('slug')
                                        <span
                                            class="error invalid-feedback" style="display: block"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="excerpt">{{ __('Excerpt') }}</label>
                                        <span
                                            class="text-danger"
                                        >(*)
                                        </span>
                                        <textarea
                                            id="excerpt" name="excerpt"
                                            class="form-control @error('excerpt') is-invalid @enderror" rows="5"
                                            placeholder="Enter ..."
                                        >{{ old('excerpt') ?: (!empty($post) ? $post->excerpt : '') }}</textarea>
                                        @error('excerpt')
                                        <span class="error invalid-feedback" style="display: block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="content">{{ __('content') }}</label>
                                        <span
                                            class="text-danger"
                                        >(*)
                                        </span>
                                        <div style="height: 34px;">
                                            <span class="editor-action-item" style="">
                                                <a
                                                    href="#" class="btn_gallery btn btn-primary" data-result="content"
                                                    data-multiple="true" data-action="media-insert-ckeditor"
                                                >
                                                    <i class="far fa-image"></i>
                                                    Thêm tập tin
                                                </a>
                                            </span>
                                        </div>
                                        <textarea
                                            id="content" name="content"
                                            class="form-control @error('content') is-invalid @enderror" rows="5"
                                            placeholder="Enter ..."
                                        >{{ old('content') ?: (!empty($post) ? $post->content : '') }}</textarea>
                                        @error('content')
                                        <span class="error invalid-feedback" style="display: block" role="alert">
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
                                            class="form-control select2bs4 @error('post_tags') is-invalid @enderror"
                                            id="categories"
                                            name="post_tags[]"
                                            multiple
                                        >
                                            <option value="">{{ __('Select Tag') }}</option>
                                            @include('partials.forms.post_tag_options', ['selected' => old('post_tags', !empty($post) && $post->postTags->isNotEmpty() ? $post->postTags->pluck('id')->toArray() : [])])
                                        </select>
                                        @error('post_tags')
                                        <span class="error invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    @include('partials.forms.seo', ['model' => !empty($post) ? $post:null])
                                </div>
                            </div>
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
                            <a href="{{ route('posts.index') }}" class="btn btn-danger">
                                <i class="fas fa-ban fa-fw"></i>
                                {{ __('Cancel') }}
                            </a>
                            @if(!empty($post->id))
                            <a
                                href="{{route('item_relates.index',['model'=>\App\Models\Post::class,'model_id'=>$post->id])}}"
                                class="btn btn-success btn-sm"
                                target="_blank"

                            >
                                {{ __('Related_products') }}
                            </a>
                            @endif

                        </div>
                    </div>
                    <div class="card image-box">
                        <div class="card-header">
                            <h3 class="card-title">
                                {{ __('Thumbnail') }} (
                                <span class="text-danger">*</span>
                                                      )
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-danger mb-2">
                                        {{ __('Recommend Size: :size', ['size' => '963x500']) }}
                                    </div>

                                    <div class="form-group">
                                        <div class="preview-image-wrapper img-fluid">
                                            <img
                                                class="preview_image"
                                                src="{{ old('thumbnail') ?: (!empty($post) ? $post->thumbnail : '/preview-icon.png') }}"
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
                                            </span>
                                            <input
                                                name="thumbnail" type="hidden"
                                                class="image-data form-control @error('thumbnail') is-invalid @enderror"
                                                value="{{ old('thumbnail') ?: (!empty($post) ? $post->thumbnail : '') }}"
                                            >
                                        </div>
                                        @error('thumbnail')
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
                                {{ __('Category') }} (
                                <span class="text-danger">*</span>
                                                     )
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        @include('partials.forms.category', ['selected' => old('categories') ?: (!empty($post) ? $post->categories->pluck('id')->toArray() : null)])

                                        @error('categories')
                                        <span class="error invalid-feedback" style="display: block" role="alert">
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
                                                src="{{ old('banner') ?: (!empty($post) ? $post->banner : '/preview-icon.png') }}"
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
                                                value="{{ old('banner') ?: (!empty($post) ? $post->banner : '') }}"
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
                                        <div
                                            class="input-group-append"
                                            data-target="#publishedat"
                                            data-toggle="datetimepicker"
                                        >
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
                                            @foreach(\App\Models\Post::STATUS as $status => $label)
                                                <option
                                                    value="{{ $status }}"
                                                    @if(old('status') == $status || (!empty($post) && $post->status == $status)) selected @endif>
                                                    {{ __("post.status.$label") }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('status')
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
                                        <div class="custom-control custom-switch">
                                            <input
                                                type="checkbox"
                                                class="custom-control-input"
                                                id="is_video"
                                                name="is_video"
                                                value="1"
                                                @if(!empty($post) && $post->is_video) checked @endif
                                            >
                                            <label
                                                class="custom-control-label"
                                                for="is_video"
                                            >{{ __('Is Video?') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input
                                                type="checkbox"
                                                class="custom-control-input"
                                                id="is_home_featured"
                                                name="is_home_featured"
                                                value="1"
                                                @if(!empty($post) && $post->is_home_featured) checked @endif
                                            >
                                            <label
                                                class="custom-control-label"
                                                for="is_home_featured"
                                            >{{ __('Is home featured?') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input
                                                type="checkbox"
                                                class="custom-control-input"
                                                id="is_featured"
                                                name="is_featured"
                                                value="1"
                                                @if(!empty($post) && $post->is_featured) checked @endif
                                            >
                                            <label
                                                class="custom-control-label"
                                                for="is_featured"
                                            >{{ __('Is featured?') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input
                                                type="checkbox"
                                                class="custom-control-input"
                                                id="is_experience"
                                                name="is_experience"
                                                value="1"
                                                @if(!empty($post) && $post->is_experience) checked @endif
                                            >
                                            <label
                                                class="custom-control-label"
                                                for="is_experience"
                                            >{{ __('Is Experience?') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input
                                                type="checkbox"
                                                class="custom-control-input"
                                                id="is_event"
                                                name="is_event"
                                                value="1"
                                                @if(!empty($post) && $post->is_event) checked @endif
                                            >
                                            <label
                                                class="custom-control-label"
                                                for="is_event"
                                            >{{ __('Is Event?') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="original-select">
                        <div class="card-header">
                            <h3 class="card-title">
                                {{ __('Product') }}
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @php
                                        if (!empty(old('products'))) {
                                            $products = collect(old('products'))->map(fn($product) => ['value' => $product, 'label' => "ID: $product"])->toArray();
                                        } elseif (!empty($post) && !empty($post->products)) {
                                            $products = $post->products->map(fn($product) => ['value' => $product->id, 'label' => $product->name.' - '.number_format($product->price)])->toArray();
                                        }
                                    @endphp

                                    @include('partials.modals.choose-products', [
                                        'label' => __('Product'),
                                        'name' => 'products',
                                        'data' => $products ?? [],
                                        'dataUrl' => route('products.accessories', ['type' => 'all']),
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-footer clearfix">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@include('partials.forms.slug', [
    'fromElement' => '#title',
    'toElement' => '#slug',
])

@include('partials.js.rv_media',['buttonMoreImages'=>[]])

@push('styles')
    <link rel="stylesheet" href="{{ asset('tokenfield/css/bootstrap-tokenfield.min.css') }}">
@endpush

@push('scripts')
    @include('partials.editors.summernote',['editors'=>['content'],'buttons'=>[]])
    <script src="{{ asset('tokenfield/bootstrap-tokenfield.min.js') }}"></script>
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#publishedat').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        })

    </script>

@endpush
