<script>
    function removeCart(url)
    {
        Swal.fire({
            title: '{{ __('Are you sure remove item to cart?') }}',
            //text: "{!! __("You won't be able to revert this!") !!}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#dd3333',
            confirmButtonText: '{{ __('Yes, delete it!') }}',
            cancelButtonText: '{{ __('Cancel') }}',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: url, 
                    type: 'DELETE', 
                    success: function(result) {
                        Swal.fire('{{ __('Deleted!') }}', '{{ __('Your file has been deleted.') }}', 'success').
                            then((result) => {
                               location.reload();
                            });
                    }, error: function(error) {
                        console.log(error);

                        Swal.fire('{{ __('Error!') }}', '{{ __('An error occurred, please try again later!') }}',
                            'error');
                    },
                });
            }
        });
    }
</script>
