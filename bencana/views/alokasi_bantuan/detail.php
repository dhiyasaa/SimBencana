<div class="page-wrapper">
    <div class="page-content">

    <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Detail Alokasi Bantuan</h3>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td>Bencana</td>
                        <td>: <?= $bencana->jenis_bencana ?> <?= $bencana->tanggal_kejadian ?></td>
                    </tr>
                    <tr>
                        <td>Shelter</td>
                        <td>: <?= $shelter->nama ?></td>
                    </tr>
                </table>
            </div>

        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Kebutuhan Dasar</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datatables">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Jenis Logistik</th>
                                <th>Spesifikasi</th>
                                <th>Satuan</th>
                                <th>Jenis Bantuan</th>
                                <th>Keterangan</th>
                                <th>Kebutuhan</th>
                                <th>Alokasi</th>
                                <th>Diterima</th>
                                <th>Kekurangan</th>
                                <th>Foto Bukti</th>
                                <th>Disetujui</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bantuan as $k => $v) { 
                                $kekurangan = $v->jumlah - $v->diterima; ?>
                                <tr>
                                    <td><?= $k + 1 ?></td>
                                    <td><?= $v->jenis_logistik ?></td>
                                    <td><?= $v->spesifikasi ?></td>
                                    <td><?= $v->satuan ?></td>
                                    <td><?= $v->jenis_bantuan ?></td>
                                    <td><?= $v->keterangan ?></td>
                                    <td>
                                    <?= $v->jumlah ?>
                                    </td>
                                    <td>
                                    <?= $v->alokasi ?>
                                    </td>
                                    <td>
                                    <?= $v->diterima ?>
                                    </td>
                                    <td><?= $kekurangan ?></td>
                                    <td>
                                        <?php if (!empty($v->foto_bukti)) { ?>
                                            <img src="<?= base_url('assets/uploads/' . $v->foto_bukti) ?>" alt="Foto Bukti" style="width: 100px; height: auto;">
                                        <?php } else { ?>
                                            <span>Tidak Ada Foto</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?= $v->disetujui ? '✓' : '✗' ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3>Selain Kebutuhan Dasar</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datatables">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Pengendalian Penyakit</th>
                                <th>Permintaan Khusus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bantuan_lainnya as $k => $v) { ?>
                                <tr>
                                    <td><?= $k + 1 ?></td>
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