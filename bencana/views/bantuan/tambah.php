<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3><?= $title ?></h3>
                <div>
                    <a href="<?= base_url('bantuan') ?>" class="btn btn-secondary">Kembali <i class="bx bx-arrow-back"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url('bantuan/'. ($this->uri->segment(2) == 'edit' ? 'update' : 'insert')) ?>" method="post" enctype="multipart/form-data">
                    <?php if ($this->uri->segment(2) == 'edit') { ?>
                        <input type="hidden" name="id" value="<?= $bantuan->id ?>">
                    <?php } ?>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="jenis_logistik">Jenis Logistik</label>
                                <input type="text" name="jenis_logistik" value="<?= $this->uri->segment(2) == 'edit' ? $bantuan->jenis_logistik : '' ?>" id="jenis_logistik" required class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="spesifikasi">Spesifikasi</label>
                                <input type="text" name="spesifikasi" value="<?= $this->uri->segment(2) == 'edit' ? $bantuan->spesifikasi : '' ?>" id="spesifikasi" required class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" value="<?= $this->uri->segment(2) == 'edit' ? $bantuan->jumlah : '' ?>" id="jumlah" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="satuan">Satuan</label>
                                <input type="text" name="satuan" value="<?= $this->uri->segment(2) == 'edit' ? $bantuan->satuan : '' ?>" id="satuan" required class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="jenis_bantuan">Jenis Bantuan</label>
                                <select name="jenis_bantuan" id="jenis_bantuan" class="form-control">
                                <option value="Bantuan Non Pangan" <?= $this->uri->segment(2) == 'edit' && $bantuan->jenis_bantuan == 'Bantuan Non Pangan' ? 'selected' : '' ?>>Bantuan Non Pangan</option>
                                <option value="Bantuan Pangan" <?= $this->uri->segment(2) == 'edit' && $bantuan->jenis_bantuan == 'Bantuan Pangan' ? 'selected' : '' ?>>Bantuan Pangan</option>
                                <option value="Bantuan Sandang" <?= $this->uri->segment(2) == 'edit' && $bantuan->jenis_bantuan == 'Bantuan Sandang' ? 'selected' : '' ?>>Bantuan Sandang</option>
                                <option value="Bantuan Air" <?= $this->uri->segment(2) == 'edit' && $bantuan->jenis_bantuan == 'Bantuan Air' ? 'selected' : '' ?>>Bantuan Air</option>
                                </select>
                                <!-- <input type="text" name="jenis_bantuan" value="<?= $this->uri->segment(2) == 'edit' ? $bantuan->jenis_bantuan : '' ?>" id="jenis_bantuan" required class="form-control"> -->
                            </div>
                            <div class="form-group mb-3">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" required class="form-control"><?= $this->uri->segment(2) == 'edit' ? $bantuan->keterangan : '' ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary"><?= $this->uri->segment(2) == 'edit' ? 'Update' : 'Tambah' ?></button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>