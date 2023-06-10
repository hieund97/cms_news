@extends('front_end.layouts.app')
@section('breadcrumbs')
{{Breadcrumbs::view('breadcrumbs::json-ld', 'fe.product',$product)}}
@stop
@section('content')
    <section class="container pb-2">
        {{ Breadcrumbs::render('fe.product',$product) }}
            @include('front_end.products.elements.review')
        <div class="row">
            <div class="col-lg-8">
                @include('front_end.products.elements.review-list',['reviews'=>$reviews])
            </div>
        </div>
    </section>
@endsection
