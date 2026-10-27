<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3><?= $title ?></h3>
                <div>
                    <button class="btn btn-danger" onclick="hapus()">Hapus Data <i class="bx bx-trash"></i></button>
                    <a disabled href="<?= base_url('bangunan_rusak_bencana/tambah/' . $id_bencana) ?>" class="btn btn-success">Tambah Data <i class="bx bx-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="id_wilayah">Kecamatan</label>
                            <select name="id_wilayah" id="id_wilayah" onchange="gantiKecamatan()" class="form-control">
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
                <a href="<?= base_url('bangunana_rusak_bencana/list/' . $id_bencana) ?>" id="button-filter" class="btn btn-info col-12">Filter</a>
                <hr>
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 1%;">Action</th>
                                <th style="width: 1%;">No</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>pemilik</th>
                                <th>alamat</th>
                                <th>Jenis kerusakan</th>
                                <th>Seng (Helai)</th>
                                <th>Kayu (Batang)</th>
                                <th>Dinging (m<sup>2</sup>)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bangunan_rusak_bencana as $key => $v) { ?>
                                <tr id="row-<?= $v->id ?>">
                                    <td>
                                        <a href="<?= base_url('bangunan_rusak_bencana/edit/' . $v->id) ?>" class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <input class="form-check-input check-hapus" data-id="<?= $v->id ?>" type="checkbox" value="">
                                    </td>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $v->kecamatan ?></td>
                                    <td><?= $v->kelurahan ?></td>
                                    <td><?= $v->pemilik ?></td>
                                    <td><?= $v->alamat ?></td>
                                    <td><?= $v->jenis_kerusakan ?></td>
                                    <td><?= $v->seng ?></td>
                                    <td><?= $v->kayu ?></td>
                                    <td><?= $v->dinding ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('bangunan_rusak_bencana/hapus') ?>" method="post">
                <div class="modal-body">
                    Anda yakin ingin menghapus <span id="total-hapus"></span> data secara permanen?
                    <div id="box-hapus"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function hapus() {
        var html_hapus = ''
        var total_hapus = 0
        $('.check-hapus:checked').each(function() {
            html_hapus += `<input type="hidden" name="id[]" value="${$(this).data('id')}">`
            total_hapus++
        });
        $('#modalHapus').modal('show');
        $('#box-hapus').html(html_hapus);
        $('#total-hapus').text(total_hapus)
    }

    function gantiKecamatan() {
        let id_wilayah = $('#id_wilayah').val();
        console.log(id_wilayah)
        $.ajax({
            url: '<?= base_url('bangunan_rusak_bencana/get_kelurahan_by_kecamatan/') ?>' + id_wilayah + '/<?= $id_bencana ?>',
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
        var url = '<?= base_url('bangunan_rusak_bencana/list/' . $id_bencana) ?>/' + $('#id_wilayah').val() + '/' + $('#id_kelurahan').val();
        $('#button-filter').attr('href', url)
    }
</script>