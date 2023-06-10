@extends('layouts.app')

@section('page-title', __('System Settings'))

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('settings.update') }}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="card-body">
                                @foreach($options as $row)
                                    @if($row->option_type=='checkbox')
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input
                                                    type="checkbox"
                                                    name="{{$row->option_name}}"
                                                    value="1"
                                                    id="{{$row->option_name}}"
                                                    @if($row->option_value==1) checked @endif>
                                                <label for="{{$row->option_name}}">{{__($row->option_name)}}</label>
                                            </div>
                                        </div>
                                    @elseif($row->option_type=='upload')
                                        <div class="col-md-12 image-box">
                                            <label for="exampleInputEmail1">{{__($row->option_name)}}</label>

                                            <div class="form-group">
                                                <div class="preview-image-wrapper img-fluid">
                                                    <img
                                                        class="preview_image"
                                                        src="{{ (!empty($row->option_value) ? $row->option_value : '/preview-icon.png') }}"
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
                                                        name="{{$row->option_name}}" type="hidden"
                                                        class="image-data form-control"
                                                        value="{{ (!empty($row->option_value) ? $row->option_value : '') }}"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{__($row->option_name)}}</label>
                                            @if($row->option_type=='textarea')
                                                @if($row->option_name=='popup')
                                                    <div style="height: 34px;">
                                                        <span class="editor-action-item" style="">
                                                            <a
                                                                href="#"
                                                                class="btn_gallery btn btn-primary"
                                                                data-result="{{$row->option_name}}"
                                                                data-multiple="true"
                                                                data-action="media-insert-ckeditor"
                                                            >
                                                                <i class="far fa-image"></i>
                                                                Thêm tập tin
                                                            </a>
                                                        </span>
                                                    </div>
                                                @endif
                                                <textarea
                                                    name="{{$row->option_name}}"
                                                    class="form-control"
                                                    rows="5"
                                                    placeholder="Enter ..."
                                                >{{$row->option_value}}</textarea>
                                            @else
                                                <input
                                                    type="text"
                                                    name="{{$row->option_name}}"
                                                    value="{{$row->option_value}}"
                                                    class="form-control"
                                                    placeholder="{{__($row->option_name)}}"
                                                >
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@push('scripts')
    @include('partials.js.rv_media',['buttonMoreImages'=>[]])
    @include('partials.editors.summernote',['editors'=>['popup','post_description'],'buttons'=>[],'realButtons'=>[]])
    @include('partials.editors.summernote',['editors'=>['popup','policy_sell_product'],'buttons'=>[],'realButtons'=>[]])
    @include('partials.editors.summernote',['editors'=>['popup','policy_exchange'],'buttons'=>[],'realButtons'=>[]])

@endpush
