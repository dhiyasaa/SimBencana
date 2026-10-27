<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3><?= $title ?></h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 1%;">Action</th>
                                <th style="width: 1%;">No</th>
                                <th>Jenis</th>
                                <th>Tanggal Kejadian</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bencana as $key => $v) { ?>
                                <tr id="row-<?= $v->id ?>">
                                    <td>
                                        <a href="<?= base_url('alokasi_bantuan/list/' . $v->id) ?>" class="btn btn-sm btn-info">
                                            <i class="bx bx-list-ol"></i>
                                        </a>
                                    </td>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $v->jenis_bencana ?></td>
                                    <td><?= $v->tanggal_kejadian ?></td>
                                    <td><?= $v->lokasi ?></td>
                                    <td><?= $v->status ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>