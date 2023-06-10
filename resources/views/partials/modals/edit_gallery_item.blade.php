<div id="edit-gallery-item" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title"><i class="til_img"></i><strong>{{ __("Update photo's description") }}</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body with-padding">
                <p><input type="text" class="form-control" id="gallery-item-description" placeholder="{{ __("Photo's description") }}..."></p>
            </div>

            <div class="modal-footer">
                <button class="float-left btn btn-danger" id="delete-gallery-item" href="#">{{ __('Delete this photo') }}</button>
                <button class="float-right btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                <button class="float-right btn btn-primary" id="update-gallery-item">{{ __('Update') }}</button>
                <input type="hidden" id="btn-gallery-list">
                <input type="hidden" id="btn-gallery-item">
                <input type="hidden" id="btn-gallery-data">
            </div>
        </div>
    </div>
</div>