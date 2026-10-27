<div class="page-wrapper">
    <div class="page-content">
        <div class="mb-3" style="overflow: auto">
            <button class="btn btn-secondary btn-trigger" onclick="tampil('relawan')" id="relawan">Relawan</button>
            <button class="btn btn-secondary btn-trigger" onclick="tampil('bantuan')" id="bantuan">Bantuan</button>
            <button class="btn btn-secondary btn-trigger" onclick="tampil('transportasi')" id="transportasi">Transportasi</button>
            <!-- <button class="btn btn-secondary btn-trigger" onclick="tampil('bangunan_rusak')" id="bangunan_rusak">Bangunan Rusak</button>
            <button class="btn btn-secondary btn-trigger" onclick="tampil('pengungsi')" id="pengungsi">Pengungsi</button>
            <button class="btn btn-secondary btn-trigger" onclick="tampil('korban_jiwa')" id="korban_jiwa">Korban Jiwa</button> -->
        </div>
        <div class="card box-body" style="display: none;" id="box-relawan">
            <div class="card-header">Persediaan Relawan</div>
            <div class="card-body">
                <center>
                    <h3>Detail Relawan</h3>
                </center>
                <div class="chart-container1">
                    <canvas id="chart-relawan"></canvas>
                </div>
            </div>
        </div>

        <div class="card box-body" style="display: none;" id="box-bantuan">
            <div class="card-header">Persediaan Bantuan</div>
            <div class="card-body">
                <?php foreach ($bantuan as $key => $value) { ?>
                    <button class="btn btn-default btn-trigger-bantuan" onclick="tampilBantuan('<?= $key ?>')" id="btn-bantuan-<?= $key ?>"><?= $value->jenis_bantuan ?></button>
                <?php } ?>
                <?php foreach ($bantuan as $key => $value) { ?>
                    <div class="box-sub-bantuan" id="box-bantuan-<?= $key ?>" style="display: none;">
                        <center>
                            <h3>Detail Persediaan <?= $value->jenis_bantuan ?></h3>
                        </center>
                        <div class="chart-container1">
                            <canvas id="chart-bantuan-<?= $key ?>"></canvas>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="card box-body" style="display: none;" id="box-transportasi">
            <div class="card-header">Persediaan Transportasi</div>
            <div class="card-body">
                <center>
                    <h3>Detail Persediaan Kendaraan</h3>
                </center>
                <div class="chart-container1">
                    <canvas id="chart-transportasi"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        tampil('relawan');

        // Relawan Chart
        new Chart(document.getElementById("chart-relawan"), {
            type: 'horizontalBar',
            data: {
                labels: [
                    <?php foreach ($relawan_kecakapan as $value) { ?> '<?= $value->kelompok ?>',
                    <?php } ?>
                ],
                datasets: [{
                    label: "Jumlah Relawan",
                    backgroundColor: '#0d6efd',
                    data: [
                        <?php foreach ($relawan_kecakapan as $value) { ?> '<?= $value->jml ?>',
                        <?php } ?>
                    ]
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 2 // Ensure only whole numbers are shown
                        }
                    }]
                },
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Jumlah Relawan Berdasarkan Kecakapan"
                }
            }
        });

        // bantuan chart
        <?php foreach ($bantuan as $key => $value) { ?>
            new Chart(document.getElementById("chart-bantuan-<?= $key ?>"), {
                type: 'horizontalBar',
                data: {
                    labels: [
                        <?php foreach ($value->data as $key2 => $value2) { ?> '<?= $value2->jenis_logistik ?>',
                        <?php } ?>
                    ],
                    datasets: [{
                        label: "Jumlah Bantuan",
                        backgroundColor: '#0d6efd',
                        data: [
                            <?php foreach ($value->data as $key2 => $value2) { ?> '<?= $value2->jumlah ?>',
                            <?php } ?>
                        ]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                    }
                }
            });
        <?php } ?>

        new Chart(document.getElementById("chart-transportasi"), {
            type: 'horizontalBar',
            data: {
                labels: [
                    <?php foreach ($transportasi as $key => $value) { ?> '<?= $value->jenis_kendaraan ?>',
                    <?php } ?>
                ],
                datasets: [{
                    label: "Jumlah Transportasi",
                    backgroundColor: '#0d6efd',
                    data: [
                        <?php foreach ($transportasi as $key => $value) { ?> '<?= $value->jumlah ?>',
                        <?php } ?>
                    ]
                }]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 50 // Ensure only whole numbers are shown
                        }
                    }]
                },
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Jumlah Transportasi Berdasarkan Jenis"
                }
            }
        });
    });

    function tampil(menu) {
        $('.box-body').hide()
        $('.btn-trigger').removeClass('btn-primary')
        $('#' + menu).addClass('btn-primary')
        $('#box-' + menu).show()

        if (menu == 'bantuan') {
            tampilBantuan(0)
        }
    }

    function tampilBantuan(menu) {
        $('.box-sub-bantuan').hide()
        $('.btn-trigger-bantuan').removeClass('btn-primary')
        $('#btn-bantuan-' + menu).addClass('btn-primary')
        $('#box-bantuan-' + menu).show()
    } 
</script>