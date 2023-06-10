<div id="section-icon-bar-fixed">
    <div class="icon-bar-fixed w-lg-auto w-md-auto active">
        <div class="order-2 position-relative d-flex d-lg-block d-md-block justify-content-end">
            <div class="icon-social-menu icon-social">
                @if(!empty($mainSettings['phone_company']))
                    <a
                        href="tel:{{$mainSettings['phone_company']}}"
                        class="box-icon text-decoration-none icon-social-item d-flex d-md-none d-lg-none active"
                    >
                        <span>
                            <i class="fas fa-phone"></i>
                        </span>
                    </a>
                @endif
                @if(empty($product))
                    <a
                        rel="nofollow"
                        href="javascript:void(0)"
                        class="box-icon text-decoration-none icon-social-item active"
                    >
                        <span>Chat ngay</span>
                    </a>
                @endif
                @if(!empty($mainSettings['zalo']))
                    <a
                        rel="nofollow"
                        href="https://zalo.me/{{$mainSettings['zalo']}}"
                        class="box-icon text-decoration-none icon-social-item active"
                    >
                        <span>Zalo</span>
                    </a>
                @endif
                @if(!empty($mainSettings['phone_company']))
                    <div class="icon-social-item d-none d-md-flex d-lg-flex active">
                        <div class="btn-phone">
                            <a
                                rel="nofollow"
                                href="tel:{{$mainSettings['phone_company']}}"
                                class="box-icon text-decoration-none active"
                            >
                                <span>
                                    <i class="fas fa-phone"></i>
                                </span>
                            </a>
                            <p class="mb-0 box-icon display-phone">{{$mainSettings['phone_company']}}</p>
                        </div>
                    </div>
                @endif
                @if(!empty($mainSettings['messenger']))
                    <a
                        rel="nofollow"
                        href="{{$mainSettings['messenger']}}"
                        class="box-icon text-decoration-none icon-social-item active"
                    >
                        <span>
                            <i class="fab fa-facebook-messenger"></i>
                        </span>
                    </a>
                @endif
                @if(!empty($product) && Request::url() === route('fe.product',["slug"=>$product->slug,"id"=>$product->id]))
                    <a
                        href="javascript:void(0)"
                        class="btn-buynow-fixed d-lg-none d-md-none text-uppercase icon-social-item font-weight-bold text-decoration-none buy_now add-to-card active"
                        data-value="{{$product->id}}"
                        style="margin-bottom: 24px"
                    > Mua ngay
                    </a>
                @endif
            </div>
            <div class="btn-close-open-icon">
                <div class="btn-close-icon icon-social">
                    <a rel="nofollow" href="javascript:void(0)" class="box-icon text-decoration-none">
                        <span>
                            <i class="fas fa-times"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="order-1 icon-uptop" style="display: none">
            <a rel="nofollow" href="javascript:void(0)" class="box-icon text-light rounded btn-scroll-to-top">
                <span>
                    <i class="fas fa-sort-up"></i>
                </span>
            </a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(window).scroll(function () {
            var y = $(this).scrollTop()
            if (y > 800) {
                $('.icon-uptop').fadeIn()
            } else {
                $('.icon-uptop').fadeOut()
            }
        })
    })
    $(document).on('click', '.btn-scroll-to-top', function (e) {
        e.preventDefault()
        $('html, body').animate({scrollTop: 0}, 'slow')
        return false
    })
    $(document).on('click', '.btn-close-icon', function (e) {
        e.preventDefault()
        closeIcon()
    })
    $(document).on('click', '.btn-open-icon', function (e) {
        e.preventDefault()
        openIcon()
    })

    function openIcon() {
        $('.icon-social-item').each(function (index, value) {
            $(value).addClass('active')
        })
        $('.btn-close-open-icon').html('<div class="btn-close-icon icon-social">\n' +
            '                <a rel="nofollow" href="javascript:void(0)" class="box-icon text-decoration-none">\n' +
            '                    <span><i class="fas fa-times"></i></span>\n' +
            '                </a>\n' +
            '            </div>')
        $('.icon-bar-fixed').addClass('active')
        return false
    }

    function closeIcon() {
        $('.icon-social-item').each(function (index, value) {
            $(value).removeClass('active')
        })
        $('.btn-close-open-icon').html('<div class="btn-open-icon icon-social">\n' +
            '                <a rel="nofollow" href="javascript:void(0)" class="box-icon text-decoration-none">\n' +
            '                    <span><i class="fas fa-headset"></i></span>\n' +
            '                </a>\n' +
            '            </div>')
        $('.icon-bar-fixed').removeClass('active')
        return false
    }
</script>
