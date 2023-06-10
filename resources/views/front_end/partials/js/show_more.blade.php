@push('scripts')
<script>
    $(document).ready(function () {

        function descriptionShowMore(){
            if ($('#description_show_more').height() > 500) {
                $('.show-more').removeClass('d-none')
                $('.show-more').prev().css('height', 500)
                $('.show-more').on('click', function (e) {
                    e.preventDefault()
                    $(this).prev().css('height', '')
                    $(this).remove()
                })
            }
        }
        //descriptionShowMore();
    });
</script>
@endpush
