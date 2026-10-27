<div class="page-wrapper">
    <div class="page-content">

        <form action="<?= base_url('alokasi_bantuan/' . ($this->uri->segment(2) == 'edit' ? 'update' : 'insert')) ?>" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Pilih Shelter</h3>
                    <div>
                        <a href="<?= base_url('alokasi_bantuan/list/' . $id_bencana) ?>" class="btn btn-secondary">Kembali <i class="bx bx-arrow-back"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <input type="hidden" name="id_bencana" value="<?= $id_bencana ?>">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="nama">Shelter</label>
                                <select name="id_shelter" id="id_shelter" class="select2 form-control" onchange="gantiShelter()">
                                    <?php foreach ($shelter as $key => $value) { ?>
                                        <option value="<?= $value->id ?>" <?= $this->uri->segment(2) == 'edit' && $id_shelter ? 'selected' : '' ?>><?= $value->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Perkiraan Kebutuhan Bantuan Bencana</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Pilih</th>
                                    <th>No</th>
                                    <th>Jenis Logistik</th>
                                    <th>Spesifikasi</th>
                                    <th>Satuan</th>
                                    <th>Jenis Bantuan</th>
                                    <th>Keterangan</th>
                                    <th>Kebutuhan</th>
                                    <th>Alokasi</th>
                                    <th>Diterima</th>
                                    <th>Foto Bukti</th>
                                    <th>Disetujui</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bantuan as $k => $v) { ?>
                                    <tr>
                                        <td>
                                            <input class="form-check-input" id="id_bantuan_<?= $v->id ?>" name="id_bantuan[]" <?= $this->uri->segment(2) == 'edit' && in_array($v->id, $alokasi_bantuan_arr) ? 'checked' : '' ?> type="checkbox" value="<?= $v->id ?>">
                                        </td>
                                        <td><?= $k + 1 ?></td>
                                        <td><?= $v->jenis_logistik ?></td>
                                        <td><?= $v->spesifikasi ?></td>
                                        <td><?= $v->satuan ?></td>
                                        <td><?= $v->jenis_bantuan ?></td>
                                        <td><?= $v->keterangan ?></td>
                                        <td>
                                            <input type="number" required step="0.1" name="jumlah_<?= $v->id ?>" value="<?= $this->uri->segment(2) == 'edit' && in_array($v->id, $alokasi_bantuan_arr) ? $alokasi_bantuan_arr_id_bantuan[$v->id]->jml : 0 ?>" id="jumlah_<?= $v->id ?>" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" required step="0.1" name="alokasi_<?= $v->id ?>" value="<?= $this->uri->segment(2) == 'edit' && in_array($v->id, $alokasi_bantuan_arr) ? $alokasi_bantuan_arr_id_bantuan[$v->id]->alokasi : 0 ?>" id="alokasi_<?= $v->id ?>" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" step="0.1" required value="<?= $this->uri->segment(2) == 'edit' && in_array($v->id, $alokasi_bantuan_arr) ? $alokasi_bantuan_arr_id_bantuan[$v->id]->diterima : 0 ?>" name="diterima_<?= $v->id ?>" value="0" id="" class="form-control">
                                        </td>
                                        <td>
                                            <input type="file" name="foto_bukti_<?= $v->id ?>" class="form-control">
                                        </td>
                                        <td>
                                        <input type="checkbox" name="disetujui_<?= $v->id ?>" value="1" <?= $this->uri->segment(2) == 'edit' && isset($alokasi_bantuan_arr_id_bantuan[$v->id]->disetujui) && $alokasi_bantuan_arr_id_bantuan[$v->id]->disetujui ? 'checked' : '' ?>>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="box-lainnya">

            </div>
            <button type="button" class="btn btn-success" onclick="tambahLainnya()">
                <i class="bx bx-plus"></i>
                Tambah Bantuan Lainnya
            </button>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary"><?= $this->uri->segment(2) == 'edit' ? 'Update' : 'Tambah' ?></button>
            </div>
        </form>

    </div>
</div>

<script>
    var lainnya_ke = 0
    document.addEventListener('DOMContentLoaded', function() {

        $('.select2').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

        <?php if ($this->uri->segment(2) == 'edit') { ?>

            <?php foreach ($alokasi_bantuan_lainnya as $key => $value) { ?>
                lainnya_ke++;
                $('#box-lainnya').append(`<div class="card" id="box-lainnya-${lainnya_ke}">
                            <div class="card-header d-flex justify-content-between">
                                <h3>Selain Kebutuhan Dasar ${lainnya_ke}</h3>
                                <div>
                                    <a type="button" class="btn btn-danger" onclick="hapusLainnya(${lainnya_ke})">
                                        <i class="bx bx-x"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="nama">Pengendalian Penyakit</label>
                                            <textarea id="pengendalian_penyakit" name="pengendalian_penyakit[]" class="form-control" required><?= $value->pengendalian_penyakit ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="kebutuhan_lainnya">Permintaan Khusus</label>
                                            <textarea id="kebutuhan_lainnya" name="kebutuhan_lainnya[]" class="form-control" required><?= $value->pengendalian_penyakit ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`);
            <?php } ?>
        <?php } else { ?>
            gantiShelter()

            tambahLainnya()
        <?php } ?>
    })

    function tambahLainnya() {
        lainnya_ke++;
        $('#box-lainnya').append(`<div class="card" id="box-lainnya-${lainnya_ke}">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Selain Kebutuhan Dasar ${lainnya_ke}</h3>
                        <div>
                            <button type="button" class="btn btn-danger" onclick="hapusLainnya(${lainnya_ke})">
                                <i class="bx bx-x"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="nama">Pengendalian Penyakit</label>
                                    <textarea id="pengendalian_penyakit_${lainnya_ke}" value="" name="pengendalian_penyakit[]" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="kebutuhan_lainnya">Permintaan Khusus</label>
                                    <textarea id="kebutuhan_lainnya_${lainnya_ke}" value="" name="kebutuhan_lainnya[]" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`)
    }

    function hapusLainnya(id) {
        $('#box-lainnya-' + id).remove()
    }

    function gantiShelter() {
        $.getJSON('<?= base_url('alokasi_bantuan/get_pengungsi/') ?>' + $('#id_shelter').val(), function(response) {
            $('#pengendalian_penyakit_1').val(response.pengungsi.pengendalian_penyakit)
            $('#kebutuhan_lainnya_1').val(response.pengungsi.kebutuhan_lainnya)

            response.bantuan.forEach(i => {
                if (i.butuh > 0) {
                    $('#id_bantuan_' + i.id).prop('checked', true);
                }
                $('#jumlah_' + i.id).val(i.butuh)
            })
        });
    }
</script>