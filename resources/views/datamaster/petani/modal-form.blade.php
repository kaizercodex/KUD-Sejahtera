<div class="modal fade" id="modalPetani" tabindex="-1" aria-labelledby="modalPetaniLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPetaniLabel">Tambah Petani</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formPetani">
                <div class="modal-body">
                    <input type="hidden" id="petaniId" name="petaniId">
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No HP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required placeholder="Contoh: 081234567890">
                        <small class="text-muted">Format: 08xxxxxxxxxx</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
