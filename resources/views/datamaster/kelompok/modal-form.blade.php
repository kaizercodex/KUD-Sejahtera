<div class="modal fade" id="modalKelompok" tabindex="-1" aria-labelledby="modalKelompokLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKelompokLabel">Tambah Kelompok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formKelompok">
                <div class="modal-body">
                    <input type="hidden" id="kelompokId" name="kelompokId">
                    
                    <div class="mb-3">
                        <label for="nama_kelompok" class="form-label">Nama Kelompok <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_kelompok" name="nama_kelompok" required>
                    </div>

                    <div class="mb-3">
                        <label for="ketua_kelompok" class="form-label">Ketua Kelompok <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="ketua_kelompok" name="ketua_kelompok" required>
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
