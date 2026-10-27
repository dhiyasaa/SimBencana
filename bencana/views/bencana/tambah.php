<div class="page-wrapper">
    <div class="page-content">

        <form action="<?= base_url('bencana/' . ($this->uri->segment(2) == 'edit' ? 'update' : 'insert')) ?>" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Data Bencana</h3>
                    <div>
                        <a href="<?= base_url('bencana') ?>" class="btn btn-secondary">Kembali <i class="bx bx-arrow-back"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($this->uri->segment(2) == 'edit') { ?>
                        <input type="hidden" name="id" value="<?= $bencana->id ?>">
                    <?php } ?>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="jenis_bencana">Jenis Bencana</label>
                                <input type="text" name="jenis_bencana" value="<?= $this->uri->segment(2) == 'edit' ? $bencana->jenis_bencana : '' ?>" id="jenis_bencana" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="tanggal_kejadian">Tanggal Kejadian</label>
                                <input type="date" name="tanggal_kejadian" value="<?= $this->uri->segment(2) == 'edit' ? $bencana->tanggal_kejadian : date('Y-m-d') ?>" id="tanggal_kejadian" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="lokasi">Lokasi</label>
                                <input type="text" name="lokasi" value="<?= $this->uri->segment(2) == 'edit' ? $bencana->lokasi : '' ?>" id="lokasi" required class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="dokumen">Dokumen Penetapan Status Bencana</label>
                                    <input type="file" name="dokumen" id="dokumen" accept=".pdf" class="form-control" <?= $this->uri->segment(2) == 'edit' ? '' : 'required' ?>>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Tidak Tanggap Darurat" <?= $this->uri->segment(2) == 'edit' && $bencana->status == 'Tidak Tanggap Darurat' ? 'selected' : '' ?> >Tidak Tanggap Darurat</option>
                                    <option value="Tanggap Darurat" <?= $this->uri->segment(2) == 'edit' && $bencana->status == 'Tanggap Darurat' ? 'selected' : '' ?> >Tanggap Darurat</option>
                                    <option value="Rekonstruksi" <?= $this->uri->segment(2) == 'edit' && $bencana->status == 'Rekonstruksi' ? 'selected' : '' ?> >Rekonstruksi</option>
                                    <option value="Selesai" <?= $this->uri->segment(2) == 'edit' && $bencana->status == 'Selesai' ? 'selected' : '' ?> >Selesai</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Tanggal Selesai</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="selesai_tanggap_darurat">Tanggap Darurat</label>
                                <input type="date" name="selesai_tanggap_darurat" value="<?= $this->uri->segment(2) == 'edit' ? $bencana->selesai_tanggap_darurat : '' ?>" id="selesai_tanggap_darurat" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="selesai_rekontruksi">Rekontruksi</label>
                                <input type="date" name="selesai_rekontruksi" value="<?= $this->uri->segment(2) == 'edit' ? $bencana->selesai_rekontruksi : '' ?>" id="selesai_rekontruksi" class="form-control">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="" class="form-control"><?= $this->uri->segment(2) == 'edit' ? $bencana->keterangan : '' ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary"><?= $this->uri->segment(2) == 'edit' ? 'Update' : 'Tambah' ?></button>
            </div>
        </form>

    </div>
</div>