<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3><?= $title ?></h3>
                <div>
                    <button class="btn btn-danger" onclick="hapus()">Hapus Data <i class="bx bx-trash"></i></button>
                    <a href="<?= base_url('pengungsi/tambah/'.$id_bencana) ?>" class="btn btn-success">Tambah Data <i class="bx bx-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 1%;">Action</th>
                                <th style="width: 1%;">No</th>
                                <th>Shelter</th>
                                <th>Laki-laki</th>
                                <th>Perempuan</th>
                                <th>Rumah Tangga</th>
                                <th>Anak</th>
                                <th>Bayi</th>
                                <th>Ibu Hamil/Menyusui</th>
                                <th>Cacat</th>
                                <th>Lansia</th>
                                <th>Pengendalian Penyakit</th>
                                <th>Permintaan Khusus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pengungsi as $key => $v) { ?>
                                <tr id="row-<?= $v->id ?>">
                                    <td>
                                        <a href="<?= base_url('pengungsi/edit/' . $v->id) ?>" class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <input class="form-check-input check-hapus" data-id="<?= $v->id ?>" type="checkbox" value="">
                                    </td>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $v->shelter ?></td>
                                    <td><?= $v->laki_laki ?></td>
                                    <td><?= $v->perempuan ?></td>
                                    <td><?= $v->rumah_tangga ?></td>
                                    <td><?= $v->anak ?></td>
                                    <td><?= $v->bayi ?></td>
                                    <td><?= $v->bumil ?></td>
                                    <td><?= $v->cacat ?></td>
                                    <td><?= $v->lansia ?></td>
                                    <td><?= $v->pengendalian_penyakit ?></td>
                                    <td><?= $v->kebutuhan_lainnya ?></td>
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
            <form action="<?= base_url('pengungsi/hapus') ?>" method="post">
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
</script>