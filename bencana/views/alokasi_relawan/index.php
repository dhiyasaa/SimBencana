<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3><?= $title ?></h3>
                <div>
                    <a href="<?= base_url('alokasi_relawan/tambah/' . $id_bencana) ?>" class="btn btn-success">Tambah Data <i class="bx bx-plus"></i></a>
                </div>
            </div>

        </div>

        <?php foreach ($kecakapan as $key => $value) { ?>
            <?php
            $total = 0;
            $dibutuhkan = 0;
            foreach ($jumlah as $key2 => $value2) {
                if($value2->id_kecakapan_relawan == $value->id) {
                    $dibutuhkan = $value2->jumlah;
                }
            }

            if ($dibutuhkan > 0) {
                foreach ($relawan as $key => $v) {
                    if ($v->id_kecakapan != $value->id) continue;
                        $total++;
            }
            ?>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Kelompok Kecakapan <?= $value->kelompok ?> (<?= $total ?>/<?= $dibutuhkan ?>)</h3>
                    <div>
                        <button class="btn btn-danger" onclick="hapus()">Hapus Data <i class="bx bx-trash"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 1%;">Action</th>
                                    <th style="width: 1%;">No</th>
                                    <th>Nama</th>
                                    <th>Usia</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No Telp</th>
                                    <th>Institusi</th>
                                    <th>Pengalaman Kerelawanan</th>
                                    <th>Pengalaman</th>
                                    <th>Lama Ditugaskan</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Lokasi Penugasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($relawan as $key => $v) {
                                    if ($v->id_kecakapan != $value->id) continue;
                                ?>
                                    <tr id="row-<?= $v->id ?>">
                                        <td>
                                            <input class="form-check-input check-hapus" data-id="<?= $v->id ?>" type="checkbox" value="">
                                        </td>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $v->nama ?></td>
                                        <td><?= (new DateTime())->diff(new DateTime($v->tgl_lahir))->y ?> tahun</td>
                                        <td><?= $v->jenis_kelamin ?></td>
                                        <td><?= $v->no_kontak ?></td>
                                        <td><?= $v->institusi?></td>
                                        <td><?= $v->pengalaman_kerelawanan ?></td>
                                        <td><?= floor($v->pengalaman / 12) . ' tahun ' . ($v->pengalaman % 12) . ' bulan'; ?></td>
                                        <td><?= $v->lama ?> hari</td>
                                        <td><?= $v->tanggal_mulai ?></td>
                                        <td><?= $v->tanggal_selesai ?></td>
                                        <td><?= $v->lokasi_penugasan ? $v->lokasi_penugasan : 'Tidak di Shelter' ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        <?php } 
        } ?>
    </div>
</div>

<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('alokasi_relawan/hapus') ?>" method="post">
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