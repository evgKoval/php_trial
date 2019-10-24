<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Create/Edit post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title_input">Title</label>
                    <input name="title" type="text" class="form-control" id="title_input" placeholder="Enter title's post...">
                </div>
                <div class="form-group">
                    <label for="title_input">Full text</label>
                    <textarea name="post_text" type="text" class="form-control" id="text_input" placeholder="Enter text's post" rows="6"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnSubmit" class="btn btn-primary">Sumbit</button>
            </div>
        </div>
    </div>
</div>