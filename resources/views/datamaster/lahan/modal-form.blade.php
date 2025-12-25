<div class="modal fade" id="modalLahan" tabindex="-1" aria-labelledby="modalLahanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLahanLabel">Tambah Lahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formLahan">
                <div class="modal-body">
                    <input type="hidden" id="lahanId" name="lahanId">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="peserta_id" class="form-label">Peserta Plasma <span class="text-danger">*</span></label>
                                <select class="form-select" id="peserta_id" name="peserta_id" required>
                                    <option value="">Pilih Peserta</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="petani_id" class="form-label">Petani <span class="text-danger">*</span></label>
                                <select class="form-select" id="petani_id" name="petani_id" required>
                                    <option value="">Pilih Petani</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_shm" class="form-label">No SHM <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="no_shm" name="no_shm" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_shm" class="form-label">Tanggal SHM <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_shm" name="tanggal_shm" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat_jaminan" class="form-label">Alamat Jaminan <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="alamat_jaminan" name="alamat_jaminan" rows="3" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="luas_jumlah" class="form-label">Luas Jumlah (m²) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="luas_jumlah" name="luas_jumlah" min="1" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="blok_id" class="form-label">Blok <span class="text-danger">*</span></label>
                                <select class="form-select" id="blok_id" name="blok_id" required>
                                    <option value="">Pilih Blok</option>
                                </select>
                            </div>
                        </div>
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
