<!-- Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buat informasi kepada semua member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form id="form-add">
                <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input id="title" class="form-control" type="text" name="title" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Konten</label>
                            <textarea id="description" class="form-control" rows="3" name="description" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Sebarkan Info</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h6 id="title"></h6>
                <p id="description"></p>
            </div>
        </div>
    </div>
</div>
