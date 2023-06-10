<script>
    @if(!empty($url))
    let currentPage = {{request()->has('page')?request()->get('page'):1}};
    let ready = true
    let totalPage
    let isInputPage = {{request()->has('page')?'true':'false'}};

    function loadPostItem(page) {
        if (!page) {
            page = 1
        }
        if (ready == true) {
            ready = false
            $.ajax({
                async: false,
                url: '{{$url}}',
                data: {
                    page: page,
                    ids: {{ json_encode($newsPost) }}
                },
                type: 'get',
                success: function (data) {
                    $('#new-list-items').append(data.view)
                    totalPage = data.totalPage
                    $('#list-post_video').owlCarousel({
                        loop: true,
                        margin: 10,
                        nav: true,
                        responsive: {
                            0: {
                                items: 1,
                                nav: false
                            },
                            600: {
                                items: 1
                            },
                            1000: {
                                items: 2
                            }
                        }
                    })

                },
                error: function (xhr) {
                    console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText)
                },
                complete: function () {
                    if (totalPage == currentPage) {
                        $('.btn-show-more-list-news-action').remove()
                    } else {
                        $('.btn-show-more-list-news-action').removeAttr('disabled').text('Xem thêm')
                    }
                    if (isInputPage) {
                        var pathName = window.location.pathname
                       // window.history.pushState({}, '', pathName + '?page=' + currentPage)
                    }
                    ready = true
                }
            })
        }
    }

    for (i = 1; i <= currentPage; i++) {
        loadPostItem(i)
    }
    $(document).on('click', '.btn-show-more-list-news-action', function (e) {
        e.preventDefault()
        $(this).attr('disabled', 'disabled').text('Đang tải ...')
        isInputPage = true
        currentPage++
        loadPostItem(currentPage)
    })
    @endif
</script>
<script>
    $('#list-post_video').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            600: {
                items: 1
            },
            1000: {
                items: 2
            }
        }
    })
</script>
