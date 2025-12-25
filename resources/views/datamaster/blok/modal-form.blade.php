<div class="modal fade" id="modalBlok" tabindex="-1" aria-labelledby="modalBlokLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBlokLabel">Tambah Blok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formBlok">
                <div class="modal-body">
                    <input type="hidden" id="blokId" name="blokId">
                    
                    <div class="mb-3">
                        <label for="kode_blok" class="form-label">Kode Blok <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="kode_blok" name="kode_blok" required>
                    </div>

                    <div class="mb-3">
                        <label for="kelompok_id" class="form-label">Kelompok <span class="text-danger">*</span></label>
                        <select class="form-select" id="kelompok_id" name="kelompok_id" required>
                            <option value="">Pilih Kelompok</option>
                        </select>
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
