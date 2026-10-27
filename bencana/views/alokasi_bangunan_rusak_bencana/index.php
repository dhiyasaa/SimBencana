<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3><?= $title ?></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="id_wilayah">Kecamatan</label>
                            <select name="id_wilayah" id="id_wilayah" class="form-control" onchange="gantiKecamatan()">
                                <option value="">Pilih Kecamatan</option>
                                <?php foreach ($kecamatan as $key => $value) { ?>
                                    <option onclick="gantiKecamatan()" value="<?= $value->id ?>" <?= $value->id == $id_wilayah ? 'selected' : '' ?>><?= $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="id_kelurahan">Kelurahan</label>
                            <select name="id_kelurahan" id="id_kelurahan" class="form-control" onchange="gantiKelurahan()">
                                <option value="">Pilih Kelurahan</option>
                                <?php foreach ($kelurahan as $key => $value) { ?>
                                    <option value="<?= $value->id ?>" <?= $value->id == $id_kelurahan ? 'selected' : '' ?>><?= $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('alokasi_bangunana_rusak_bencana/list/' . $id_bencana) ?>" id="button-filter" class="btn btn-info col-12">Filter</a>
                <hr>
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 1%;">Action</th>
                                <th style="width: 1%;">No</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>Pemilik</th>
                                <th>Alamat</th>
                                <th>Seng (Helai)</th>
                                <th>Kayu (Batang)</th>
                                <th>Dinging (m<sup>2</sup>)</th>
                                <th>Perkiraan Kerugian</th>
                                <th>Jenis Kerusakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alokasi_bangunan_rusak_bencana as $key => $v) { ?>
                                <tr id="row-<?= $v->id ?>">
                                    <td>
                                        <button onclick="edit(<?= ($v->kerugian ?? 0) ?>, '<?= $v->jenis_kerusakan ?? '-' ?>', <?= $v->id_bangunan_rusak_bencana ?>)" class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                    </td>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $v->kecamatan ?></td>
                                    <td><?= $v->kelurahan ?></td>
                                    <td><?= $v->pemilik ?></td>
                                    <td><?= $v->alamat ?></td>
                                    <td><?= $v->seng ?></td>
                                    <td><?= $v->kayu ?></td>
                                    <td><?= $v->dinding ?></td>
                                    <td>Rp <?= number_format(($harga->seng * $v->seng + $harga->kayu * $v->kayu + $harga->dinding * $v->dinding ?? 0), 2, ',', '.') ?></td>
                                    <td><?= $v->jenis_kerusakan ?? '-' ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('alokasi_bangunan_rusak_bencana/edit') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_bangunan_rusak_bencana" id="id_bangunan_rusak_bencana">
                    <div class="form-control">
                        <label for="">Perkiraan Kerugian</label>
                        <input type="number" name="perkiraan_kerugian" id="perkiraan_kerugian" class="form-control" required>
                    </div>
                    <div class="form-control">
                        <label for="">Jenis kerusakan</label>
                        <select name="jenis_kerusakan" id="jenis_kerusakan" class="form-control">
                            <option value="Ringan">Ringan</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Berat">Berat</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function edit(perkiraan_kerugian, jenis_kerusakan, id_bangunan_rusak_bencana) {
        $('#perkiraan_kerugian').val(perkiraan_kerugian)
        $('#jenis_kerusakan').val(jenis_kerusakan)
        $('#id_bangunan_rusak_bencana').val(id_bangunan_rusak_bencana)
        $('#modalEdit').modal('show');
    }

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

    function gantiKelurahan() {
        var url = '<?= base_url('alokasi_bangunan_rusak_bencana/list/' . $id_bencana) ?>/' + $('#id_wilayah').val() + '/' + $('#id_kelurahan').val();
        $('#button-filter').attr('href', url)
    }
</script>