<footer>
    <div>
        <div class="my-4 container overflow-hidden">
            <div class="row">
                <div class="col-md-3 col-6 mb-3 mb-md-3 mb-lg-0">
                    <a class="d-block w-100 h6 text-decoration-none border-bottom mb-2 pb-1 text-color-blue font-weight-bold" href="#">
                        CHUNGAUTO.VN
                    </a>
                    @if(!empty($mainFooters["company"]))
                        <ul class="subf2 m-0 px-1">
                            @foreach ($mainFooters["company"] as $item)
                                <li class="pt-1">
                                    <a href="{{ $item->link }}">
                                        {{ $item->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="pt-1">
                        @if(!empty($mainSettings["dmca"]))
                           {!! $mainSettings["dmca"] !!}
                        @endif
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-3 mb-md-3 mb-lg-0">
                    <a class="d-block w-100 h6 text-decoration-none border-bottom mb-2 pb-1 text-color-blue font-weight-bold" href="#">
                        KHÁCH HÀNG
                    </a>
                    @if(!empty($mainFooters["customer"]))
                        <ul class="subf2 m-0 px-1">
                            @foreach ($mainFooters["customer"] as $item)
                                <li class="pt-1">
                                    <a href="{{ $item->link }}">
                                        {{ $item->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>
                <div class="col-md-3 col-12 border-right mb-3 mb-md-3 mb-lg-0">
                    <a class="d-block w-100 h6 text-decoration-none border-bottom mb-2 pb-1 text-color-blue font-weight-bold" href="#">
                        CỞ SỞ
                    </a>
                    <ul class="subf2 m-0 px-1">
                        @foreach ($mainBranches as $item)
                        <li class="text-color-blue">
                            <span class="font-weight-bold h5">∙ </span><span class="font-weight-bold"> [{{ $item->title }}]</span> : {{ $item->address }} | {{ $item->hotline }}
                        </li>
                        @endforeach
                        <li class="text-color-blue">
                           <span class="font-weight-bold">Hỗ trợ khiếu nại đơn hàng :</span> <a class="text-color-blue" href="tel:{{$mainSettings["hotline"] }}">{{ $mainSettings["hotline"] }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 mb-3 mb-md-3 mb-lg-0">
                    <p class="h6 font-weight-bold text-color-blue text-center"><a class="text-color-blue" href="tel:{{$mainSettings["phone_company"] }}">{{ $mainSettings["phone_company"] }}</a></p>
                    <p class="font-weight-bold text-color-blue text-center">{{ $mainSettings["site_name"] }}
                    </p>
                    <p class=" text-color-blue text-center">{{ $mainSettings["address_company"] }}</p>
                    <p class="text-color-blue text-center"><a class="text-color-blue" href="mailto:{{ $mainSettings["admin_email"] }}">{{ $mainSettings["admin_email"] }}</a></p>
                    <div id="box-footer-icon-social" class="d-flex align-items-center justify-content-center">
                        <a  rel="nofollow" target="_blank" href="{{ $mainSettings["facebook_url"] }}">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a rel="nofollow" target="_blank" href="{{ $mainSettings["youtube_url"] }}">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a rel="nofollow" target="_blank" href="{{ $mainSettings["twitter_url"] }}">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a rel="nofollow" target="_blank" href="{{ $mainSettings["instagram_url"] }}">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <img class=" d-block d-md-none d-lg-none" style="width: 27%" src="/theme/front_end/images/thong-bao-website-voi-bo-cong-thuong_grande.png" alt="">
                    </div>
                    <div class="size d-none d-sm-none d-md-block d-lg-block ">
                        <img class="w-100 pb-4 px-4" src="/theme/front_end/images/thong-bao-website-voi-bo-cong-thuong_grande.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4 py-2 bg-footer-bottom d-flex flex-column flex-md-row flex-lg-row justify-content-center align-items-center">
        <p class="text-light text-center mb-0">Copyright Nội thất oto | <a class="text-decoration-none text-light" href="{{ route("fe.home") }}">chungauto.vn</a></p>
        <div class="icon-footer-payment ml-lg-5 ml-md-3 mt-3 mt-md-0 mt-lg-0">
            <a class="text-decoration-none  d-inline-flex rounder" href="/" rel="nofollow">
                <i class="fab fa-cc-paypal fa-3x"></i>
            </a>
            <a class="text-decoration-none d-inline-flex rounder" href="/" rel="nofollow">
                <i class="fab fa-cc-visa fa-3x"></i>
            </a>
            <a class="text-decoration-none  d-inline-flex rounder" href="/"  rel="nofollow">
                <i class="fab fa-cc-mastercard fa-3x"></i>
            </a>
        </div>
    </div>
</footer>
