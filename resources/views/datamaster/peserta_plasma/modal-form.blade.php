<!-- Modal Peserta Plasma -->
<div class="modal fade" id="modalPesertaPlasma" tabindex="-1" aria-labelledby="modalPesertaPlasmaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPesertaPlasmaLabel">Tambah Peserta Plasma</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formPesertaPlasma" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="pesertaPlasmaId">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_reg" class="form-label">No Registrasi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="no_reg" name="no_reg" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nik_ktp" class="form-label">NIK/KTP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nik_ktp" name="nik_ktp" maxlength="16" required>
                                <small class="form-text text-muted">16 digit</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_kk" class="form-label">No KK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="no_kk" name="no_kk" maxlength="16" required>
                                <small class="form-text text-muted">16 digit</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" maxlength="16">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kelompok_id" class="form-label">Kelompok</label>
                                <select class="form-select" id="kelompok_id" name="kelompok_id">
                                    <option value="">Pilih Kelompok</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/jpeg,image/jpg,image/png">
                        <small class="form-text text-muted">Format: JPG, JPEG, PNG. Maksimal 1MB</small>
                    </div>
                    
                    <div class="mb-3" id="photoPreviewContainer" style="display: none;">
                        <label class="form-label">Preview Foto</label>
                        <div>
                            <img id="photoPreview" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; border-radius: 4px; padding: 5px;">
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
