<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3><?= $title ?> untuk korban <?= $kriteria ?></h3>
            </div>
            <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 1%;">No</th>
                                    <th>Jenis Bantuan</th>
                                    <th>Kuantiti</th>
                                    <th>Jenis Bantuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bantuan as $key => $value) { ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value->jenis_logistik ?></td>
                                        <td>
                                            <?= $value->qt ?> <?= $value->satuan ?>
                                        </td>
                                        <td><?= $value->jenis_bantuan ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>