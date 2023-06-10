@if(!empty($url))
    <script>
        let currentPage = {{request()->has('page')?request()->get('page'):1}};
        let ready = true
        let totalPage
        let isInputPage = {{request()->has('page')?'true':'false'}};

        let price = '{{ request("price") }}'
        let sort_type = '{{ request("sort_type") }}'
        let q = '{{ request("q") }}'
        let type = '{{$type}}';

        function loadProductItem(page) {
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
                        price: price,
                        sort_type: sort_type,
                        q: q,
                        type:type
                    },
                    type: 'get',
                    success: function (data) {
                        $('#list-product-category').append(data.view)

                        totalPage = data.totalPage


                    },
                    error: function (xhr) {
                        console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText)
                    },
                    complete: function () {
                        if (totalPage == currentPage) {
                            $('.btn-load-more-product').remove()
                        } else {
                            $('.btn-load-more-product').removeAttr('disabled').text('Xem thêm')
                        }
                        if (isInputPage) {

                            var pathName = window.location.pathname
                            if (price) {
                                if (pathName.indexOf('?') > -1) {
                                    pathName = pathName + '&price=' + price
                                } else {
                                    pathName = pathName + '?price=' + price
                                }
                            }
                            if (sort_type) {
                                if (pathName.indexOf('?') > -1) {
                                    pathName = pathName + '&sort_type=' + sort_type
                                } else {
                                    pathName = pathName + '?sort_type=' + sort_type
                                }
                            }
                            if (q) {
                                if (pathName.indexOf('?') > -1) {
                                    pathName = pathName + '&q=' + q
                                } else {
                                    pathName = pathName + '?q=' + q
                                }
                            }

                            /* if (pathName.indexOf("?") > -1) {
                                     pathName = pathName + '&page=' + currentPage;
                                 } else {
                                     pathName = pathName + '?page=' + currentPage;
                                 }
                             */

                          //  window.history.pushState({}, '', pathName)
                        }
                        ready = true

                    }
                })
            }
        }

        for (i = 1; i <= currentPage; i++) {
            loadProductItem(i)
        }
        $(document).on('click', '.btn-load-more-product', function (e) {
            e.preventDefault()
            $(this).attr('disabled', 'disabled').text('Đang tải ...')
            isInputPage = true
            currentPage++
            loadProductItem(currentPage)
        })

    </script>
@endif
