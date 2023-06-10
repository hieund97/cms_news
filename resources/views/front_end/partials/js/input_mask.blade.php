@if(!empty($ids))
<script>
    $(document).ready(function () {
        @foreach($ids as $id)
        $('#{{$id}}').inputmask({"mask": "(999) 999-9999"});
        @endforeach
    })
</script>
    @endif
