<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3><?= $title ?> untuk korban <?= $kriteria ?></h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('dasar_perkiraan/update/') ?>" method="post">
                    <input type="hidden" name="kriteria" value="<?= $kriteria ?>">
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 1%;">No</th>
                                    <th>Jenis Bantuan</th>
                                    <th>Jumlah Dibutuhkan</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bantuan as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value->jenis_logistik ?></td>
                                        <td>
                                            <?php
                                            $total = 0;
                                            foreach ($perkiraan as $key2 => $value2) {
                                                if ($value2->id_bantuan == $value->id) {
                                                    $total = $value2->qt;
                                                }
                                            } 
                                            ?>
                                            <input type="number" step="0.1" name="jumlah[]" value="<?= $total ?>" id="" class="form-control">
                                            <input type="hidden" name="id_bantuan[]" value="<?= $value->id ?>">
                                        </td>
                                        <td><?= $value->satuan ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="form-group mt-3">
                            <button class="btn btn-primary col-12">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>