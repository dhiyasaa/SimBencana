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
                                <th style="width: 1%;">Detail</th>
                                <th style="width: 1%;">Edit</th>
                                <th style="width: 1%;">No</th>
                                <th>Kriteria Penerima</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="">
                                <td>
                                    <form action="<?= base_url('dasar_perkiraan/list') ?>" method="post">
                                        <input type="hidden" name="kriteria" value="Perempuan">
                                        <button href="<?= base_url('dasar_perkiraan/list/Perempuan') ?>" class="btn btn-sm btn-info">
                                            <i class="bx bx-list-ol"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="<?= base_url('dasar_perkiraan/edit') ?>" method="post">
                                        <input type="hidden" name="kriteria" value="Perempuan">
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>1</td>
                                <td>Perempuan</td>
                            </tr>
                            <tr id="">
                                <td>
                                    <form action="<?= base_url('dasar_perkiraan/list') ?>" method="post">
                                        <input type="hidden" name="kriteria" value="Laki-laki">
                                        <button href="<?= base_url('dasar_perkiraan/list/Laki-laki') ?>" class="btn btn-sm btn-info">
                                            <i class="bx bx-list-ol"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="<?= base_url('dasar_perkiraan/edit') ?>" method="post">
                                        <input type="hidden" name="kriteria" value="Laki-laki">
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>2</td>
                                <td>Laki-laki</td>
                            </tr>
                            <tr id="">
                                <td>
                                    <form action="<?= base_url('dasar_perkiraan/list') ?>" method="post">
                                        <input type="hidden" name="kriteria" value="Rumah Tangga">
                                        <button href="<?= base_url('dasar_perkiraan/list/Rumah Tangga') ?>" class="btn btn-sm btn-info">
                                            <i class="bx bx-list-ol"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="<?= base_url('dasar_perkiraan/edit') ?>" method="post">
                                        <input type="hidden" name="kriteria" value="Rumah Tangga">
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>3</td>
                                <td>Rumah Tangga</td>
                            </tr>
                            <tr id="">
                                <td>
                                    <form action="<?= base_url('dasar_perkiraan/list') ?>" method="post">
                                        <input type="hidden" name="kriteria" value="Bayi">
                                        <button href="<?= base_url('dasar_perkiraan/list/Bayi') ?>" class="btn btn-sm btn-info">
                                            <i class="bx bx-list-ol"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="<?= base_url('dasar_perkiraan/edit') ?>" method="post">
                                        <input type="hidden" name="kriteria" value="Bayi">
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>4</td>
                                <td>Bayi</td>
                            </tr>
                            <tr id="">
                                <td>
                                    <form action="<?= base_url('dasar_perkiraan/list') ?>" method="post">
                                        <input type="hidden" name="kriteria" value="Anak-anak">
                                        <button href="<?= base_url('dasar_perkiraan/list/Anak-anak') ?>" class="btn btn-sm btn-info">
                                            <i class="bx bx-list-ol"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="<?= base_url('dasar_perkiraan/edit') ?>" method="post">
                                        <input type="hidden" name="kriteria" value="Anak-anak">
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>5</td>
                                <td>Anak-anak</td>
                            </tr>
                            <tr id="">
                                <td>
                                    <form action="<?= base_url('dasar_perkiraan/list') ?>" method="post">
                                        <input type="hidden" name="kriteria" value="Ibu Hamil/Menyusui">
                                        <button href="<?= base_url('dasar_perkiraan/list/Ibu Hamil%2FMenyusui') ?>" class="btn btn-sm btn-info">
                                            <i class="bx bx-list-ol"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="<?= base_url('dasar_perkiraan/edit') ?>" method="post">
                                        <input type="hidden" name="kriteria" value="Ibu Hamil/Menyusui">
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>6</td>
                                <td>Ibu Hamil/Menyusui</td>
                            </tr>
                            <tr id="">
                                <td>
                                    <form action="<?= base_url('dasar_perkiraan/list') ?>" method="post">
                                        <input type="hidden" name="kriteria" value="Cacat">
                                        <button href="<?= base_url('dasar_perkiraan/list/Cacat') ?>" class="btn btn-sm btn-info">
                                            <i class="bx bx-list-ol"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="<?= base_url('dasar_perkiraan/edit') ?>" method="post">
                                        <input type="hidden" name="kriteria" value="Cacat">
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>7</td>
                                <td>Cacat</td>
                            </tr>
                            <tr id="">
                                <td>
                                    <form action="<?= base_url('dasar_perkiraan/list') ?>" method="post">
                                        <input type="hidden" name="kriteria" value="Lansia">
                                        <button href="<?= base_url('dasar_perkiraan/list/Lansia') ?>" class="btn btn-sm btn-info">
                                            <i class="bx bx-list-ol"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="<?= base_url('dasar_perkiraan/edit') ?>" method="post">
                                        <input type="hidden" name="kriteria" value="Lansia">
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>8</td>
                                <td>Lansia</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>