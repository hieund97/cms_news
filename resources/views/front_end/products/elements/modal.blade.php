<div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <iframe
                        id="video-iframe"
                        allowfullscreen="allowfullscreen"
                        frameborder="0"
                        class="iframe-video"
                        height="500"
                        width="900"
                        src=""
                    ></iframe>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.close').on('click', function () {
                $('#video-iframe').attr('src', '')
            })
        })
    </script>
@endpush
