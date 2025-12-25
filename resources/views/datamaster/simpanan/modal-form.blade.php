<!-- Modal Simpanan -->
<div class="modal fade" id="modalSimpanan" tabindex="-1" aria-labelledby="modalSimpananLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSimpananLabel">Tambah Simpanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formSimpanan">
                <div class="modal-body">
                    <input type="hidden" id="simpananId">
                    
                    <div class="mb-3">
                        <label for="peserta_id" class="form-label">Peserta <span class="text-danger">*</span></label>
                        <select class="form-select" id="peserta_id" name="peserta_id" required>
                            <option value="">Pilih Peserta</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis Simpanan <span class="text-danger">*</span></label>
                        <select class="form-select" id="jenis" name="jenis" required>
                            <option value="">Pilih Jenis</option>
                            <option value="Simpanan Pokok">Simpanan Pokok</option>
                            <option value="Simpanan Wajib">Simpanan Wajib</option>
                            <option value="Simpanan Sukarela">Simpanan Sukarela</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nominal" name="nominal" required placeholder="Masukkan nominal (hanya angka)">
                        <small class="form-text text-muted">Hanya angka, tanpa koma atau titik</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
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
