<div class="page-wrapper">
    <div class="page-content">

        <form action="<?= base_url('pengungsi/' . ($this->uri->segment(2) == 'edit' ? 'update' : 'insert')) ?>" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Pilih Shelter</h3>
                    <div>
                        <a href="<?= base_url('pengungsi/list/' . $id_bencana) ?>" class="btn btn-secondary">Kembali <i class="bx bx-arrow-back"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($this->uri->segment(2) == 'edit') { ?>
                        <input type="hidden" name="id" value="<?= $pengungsi->id ?>">
                    <?php } ?>
                    <input type="hidden" name="id_bencana" value="<?= $id_bencana ?>">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="id_shelter">Nama</label>
                                <select name="id_shelter" id="id_shelter" class="form-control">
                                    <option value="">Pilih Shelter</option>
                                    <?php foreach ($shelter as $key => $value) { ?>
                                        <option value="<?= $value->id ?>" <?= $this->uri->segment(2) == 'edit' ? ($value->id == $pengungsi->id_shelter ? 'selected' : '') : '' ?>><?= $value->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Jumlah Pengungsi (Kelompok Produktif)</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class=" col-md-4">
                            <div class="form-group mb-3">
                                <label for="laki_laki">Laki-laki </label>
                                <input type="number" name="laki_laki" value="<?= $this->uri->segment(2) == 'edit' ? $pengungsi->laki_laki : '' ?>" id="laki_laki" required autocomplete="off" class="form-control">
                            </div>
                        </div>
                        <div class=" col-md-4">
                            <div class="form-group mb-3">
                                <label for="perempuan">Perempuan </label>
                                <input type="number" name="perempuan" value="<?= $this->uri->segment(2) == 'edit' ? $pengungsi->perempuan : '' ?>" id="perempuan" required autocomplete="off" class="form-control">
                            </div>
                        </div>
                        <div class=" col-md-4">
                            <div class="form-group mb-3">
                                <label for="rumah_tangga">Rumah Tangga </label>
                                <input type="number" name="rumah_tangga" value="<?= $this->uri->segment(2) == 'edit' ? $pengungsi->rumah_tangga : '' ?>" id="rumah_tangga" required autocomplete="off" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Jumlah Pengungsi (Kelompok Rentan)</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class=" col-md-4">
                            <div class="form-group mb-3">
                                <label for="anak">Anak-anak </label>
                                <input type="number" name="anak" value="<?= $this->uri->segment(2) == 'edit' ? $pengungsi->anak : '' ?>" id="anak" required autocomplete="off" class="form-control">
                            </div>
                        </div>
                        <div class=" col-md-4">
                            <div class="form-group mb-3">
                                <label for="bayi">Bayi </label>
                                <input type="number" name="bayi" value="<?= $this->uri->segment(2) == 'edit' ? $pengungsi->bayi : '' ?>" id="bayi" required autocomplete="off" class="form-control">
                            </div>
                        </div>
                        <div class=" col-md-4">
                            <div class="form-group mb-3">
                                <label for="bumil">Ibu Hamil/Menyusui </label>
                                <input type="number" name="bumil" value="<?= $this->uri->segment(2) == 'edit' ? $pengungsi->bumil : '' ?>" id="bumil" required autocomplete="off" class="form-control">
                            </div>
                        </div>
                        <div class=" col-md-4">
                            <div class="form-group mb-3">
                                <label for="cacat">Cacat </label>
                                <input type="number" name="cacat" value="<?= $this->uri->segment(2) == 'edit' ? $pengungsi->cacat : '' ?>" id="cacat" required autocomplete="off" class="form-control">
                            </div>
                        </div>
                        <div class=" col-md-4">
                            <div class="form-group mb-3">
                                <label for="lansia">Lansia </label>
                                <input type="number" name="lansia" value="<?= $this->uri->segment(2) == 'edit' ? $pengungsi->lansia : '' ?>" id="lansia" required autocomplete="off" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Selain Kebutuhan Dasar</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class=" col-12">
                            <div class="form-group mb-3">
                                <label for="pengendalian_penyakit">Pengendalian Penyakit </label>
                                <textarea name="pengendalian_penyakit" id="pengendalian_penyakit" class="form-control"><?= $this->uri->segment(2) == 'edit' ? $pengungsi->pengendalian_penyakit : '' ?></textarea>
                            </div>
                        </div>
                        <div class=" col-12">
                            <div class="form-group mb-3">
                                <label for="kebutuhan_lainnya">Permintaan Khusus </label>
                                <textarea name="kebutuhan_lainnya" id="kebutuhan_lainnya" class="form-control"><?= $this->uri->segment(2) == 'edit' ? $pengungsi->kebutuhan_lainnya : '' ?></textarea>
                            </div>
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