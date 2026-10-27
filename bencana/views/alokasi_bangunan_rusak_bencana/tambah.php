<div class="page-wrapper">
    <div class="page-content">

        <form action="<?= base_url('bangunan_rusak_bencana/' . ($this->uri->segment(2) == 'edit' ? 'update' : 'insert')) ?>" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Pilih Daerah</h3>
                    <div>
                        <a href="<?= base_url('bangunan_rusak_bencana/list/' . $id_bencana) ?>" class="btn btn-secondary">Kembali <i class="bx bx-arrow-back"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($this->uri->segment(2) == 'edit') { ?>
                        <input type="hidden" name="id" value="<?= $bangunan_rusak_bencana->id ?>">
                    <?php } ?>
                    <input type="hidden" name="id_bencana" value="<?= $id_bencana ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="id_wilayah">Kecamatan</label>
                                <select name="id_wilayah" id="id_wilayah" class="form-control" required>
                                    <option value="">Pilih Kecamatan</option>
                                    <?php foreach ($kecamatan as $key => $value) { ?>
                                        <option onclick="gantiKecamatan()" value="<?= $value->id ?>" <?= $this->uri->segment(2) == 'edit' ? ($value->id == $bangunan_rusak_bencana->id_kecamatan ? 'selected' : '') : '' ?>><?= $value->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="id_kelurahan">Kelurahan</label>
                                <select name="id_kelurahan" id="id_kelurahan" class="form-control" required>
                                    <option value="">Pilih Kelurahan</option>
                                    <?php if ($this->uri->segment(2) == 'edit') { ?>
                                        <?php foreach ($kelurahan as $key => $value) { ?>
                                            <option value="<?= $value->id ?>" <?= $value->id == $bangunan_rusak_bencana->id_kelurahan ? 'selected' : '' ?>><?= $value->nama ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="box-data">
                <?php if ($this->uri->segment(2) == 'edit') { ?>
                    <div class="card" id="data-box">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Data Kerusakan Bangunan</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class=" col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="nama">Nama </label>
                                        <input type="text" name="nama" value="<?= $this->uri->segment(2) == 'edit' ? $bangunan_rusak_bencana->pemilik : '' ?>" id="nama" required autocomplete="off" class="form-control">
                                    </div>
                                </div>
                                <div class=" col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="alamat">Alamat </label>
                                        <input type="text" name="alamat" value="<?= $this->uri->segment(2) == 'edit' ? $bangunan_rusak_bencana->alamat : '' ?>" id="alamat" required autocomplete="off" class="form-control">
                                    </div>
                                </div>
                                <div class=" col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="seng">Seng (Helai) </label>
                                        <input type="number" name="seng" value="<?= $this->uri->segment(2) == 'edit' ? $bangunan_rusak_bencana->seng : '' ?>" id="seng" required autocomplete="off" class="form-control">
                                    </div>
                                </div>
                                <div class=" col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="kayu">Kayu (Batang) </label>
                                        <input type="number" name="kayu" value="<?= $this->uri->segment(2) == 'edit' ? $bangunan_rusak_bencana->kayu : '' ?>" id="kayu" required autocomplete="off" class="form-control">
                                    </div>
                                </div>
                                <div class=" col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="dinding">Dinding (m<sup>2</sup>) </label>
                                        <input type="number" name="dinding" value="<?= $this->uri->segment(2) == 'edit' ? $bangunan_rusak_bencana->dinding : '' ?>" id="dinding" required autocomplete="off" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php if ($this->uri->segment(2) == 'tambah') { ?>
                <button class="btn btn-success" type="button" onclick="tambahData()">
                    <div class="bx bx-plus"></div>
                </button>
            <?php } ?>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary"><?= $this->uri->segment(2) == 'edit' ? 'Update' : 'Tambah' ?></button>
            </div>
        </form>

    </div>
</div>

<script>
    function gantiKecamatan() {
        let id_wilayah = $('#id_wilayah').val();
        $.ajax({
            url: '<?= base_url('kaji_cepat/get_kelurahan_by_kecamatan/') ?>' + id_wilayah,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var html_ = '<option value="">Pilih Kelurahan</option>';
                $.each(data, function(key, value) {
                    html_ += '<option value="' + value.id + '">' + value.nama + '</option>';
                });

                $('#id_kelurahan').html(html_);
            }
        });
    }

    var totalDataDitambah = 0

    <?php if ($this->uri->segment(2) != 'edit') { ?>

        function tambahData() {
            totalDataDitambah++;
            $('#box-data').append(`
            <div class="card" id="data-box-${totalDataDitambah}">
                <div class="card-header d-flex justify-content-between">
                    <h3>Data Kerusakan Bangunan ${totalDataDitambah}</h3>
                    <div>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusData(${totalDataDitambah})"><i class="bx bx-trash"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class=" col-lg-6">
                            <div class="form-group mb-3">
                                <label for="nama-${totalDataDitambah}">Nama </label>
                                <input type="text" name="nama[]" value="<?= $this->uri->segment(2) == 'edit' ? $bangunan_rusak_bencana->nama : '' ?>" id="nama-${totalDataDitambah}" required autocomplete="off" class="form-control">
                            </div>
                        </div>
                        <div class=" col-lg-6">
                            <div class="form-group mb-3">
                                <label for="alamat-${totalDataDitambah}">Alamat </label>
                                <input type="text" name="alamat[]" value="<?= $this->uri->segment(2) == 'edit' ? $bangunan_rusak_bencana->alamat : '' ?>" id="alamat-${totalDataDitambah}" required autocomplete="off" class="form-control">
                            </div>
                        </div>
                        <div class=" col-md-4">
                            <div class="form-group mb-3">
                                <label for="seng-${totalDataDitambah}">Seng (Helai) </label>
                                <input type="number" name="seng[]" value="<?= $this->uri->segment(2) == 'edit' ? $bangunan_rusak_bencana->seng : '' ?>" id="seng-${totalDataDitambah}" required autocomplete="off" class="form-control">
                            </div>
                        </div>
                        <div class=" col-md-4">
                            <div class="form-group mb-3">
                                <label for="kayu-${totalDataDitambah}">Kayu (Batang) </label>
                                <input type="number" name="kayu[]" value="<?= $this->uri->segment(2) == 'edit' ? $bangunan_rusak_bencana->kayu : '' ?>" id="kayu-${totalDataDitambah}" required autocomplete="off" class="form-control">
                            </div>
                        </div>
                        <div class=" col-md-4">
                            <div class="form-group mb-3">
                                <label for="dinding-${totalDataDitambah}">Dinding (m<sup>2</sup>) </label>
                                <input type="number" name="dinding[]" value="<?= $this->uri->segment(2) == 'edit' ? $bangunan_rusak_bencana->dinding : '' ?>" id="dinding-${totalDataDitambah}" required autocomplete="off" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>`)
        }

        function hapusData(id) {
            $('#data-box-' + id).remove()
        }

        document.addEventListener('DOMContentLoaded', function() {
            tambahData()
        })
    <?php } ?>
</script>