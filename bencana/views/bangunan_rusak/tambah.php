<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3><?= $title ?></h3>
                <div>
                    <a href="<?= base_url('bangunan_rusak') ?>" class="btn btn-secondary">Kembali <i class="bx bx-arrow-back"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url('bangunan_rusak/'. ($this->uri->segment(2) == 'edit' ? 'update' : 'insert')) ?>" method="post" enctype="multipart/form-data">
                    <?php if ($this->uri->segment(2) == 'edit') { ?>
                        <input type="hidden" name="id" value="<?= $bangunan_rusak->id ?>">
                    <?php } ?>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" value="<?= $this->uri->segment(2) == 'edit' ? $bangunan_rusak->tanggal : date('Y-m-d') ?>" id="tanggal" required class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="seng">Seng (Rp/Helai)</label>
                                <input type="number" name="seng" value="<?= $this->uri->segment(2) == 'edit' ? $bangunan_rusak->seng : '' ?>" id="seng" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="kayu">Kayu (Rp/Batang)</label>
                                <input type="number" name="kayu" value="<?= $this->uri->segment(2) == 'edit' ? $bangunan_rusak->kayu : '' ?>" id="kayu" required class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="dinding">Dinding (Rp/m<sup>2</sup>)</label>
                                <input type="number" name="dinding" value="<?= $this->uri->segment(2) == 'edit' ? $bangunan_rusak->dinding : '' ?>" id="dinding" required class="form-control">
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