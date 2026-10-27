<div class="page-wrapper">
    <div class="page-content">

        <form action="<?= base_url('alokasi_transportasi/' . ($this->uri->segment(2) == 'edit' ? 'update' : 'insert')) ?>" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Alokasikan Transportasi</h3>
                    <div>
                        <a href="<?= base_url('alokasi_transportasi') ?>" class="btn btn-secondary">Kembali <i class="bx bx-arrow-back"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($this->uri->segment(2) == 'edit') { ?>
                        <input type="hidden" name="id" value="<?= $alokasi_transportasi->id ?>">
                    <?php } ?>
                    <input type="hidden" name="id_bencana" value="<?= $id_bencana ?>">
                    <div class="row mb-3">
                        <div class="form-group">
                            <label for="id_transportasi">Transportasi: </label>
                            <select name="id_transportasi" id="id_transportasi" required class="form-control select2" onchange="gantiTransportasi()">
                                <option value="">Pilih Kendaraan</option>
                                <?php foreach ($transportasi as $t) { ?>
                                    <option value="<?= $t->id?>" <?= ($this->uri->segment(2) == 'edit' && $alokasi_transportasi->id_transportasi == $t->id)?'selected' : ''?>><?= $t->jenis_kendaraan?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group">
                            <label for="jumlah">Jumlah: </label>
                            <input type="number" name="jumlah" min="1" required autocomplete="off" id="jumlah" class="form-control">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary"><?= $this->uri->segment(2) == 'edit' ? 'Update' : 'Tambah' ?></button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        $('.select2').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

        <?php if ($this->uri->segment(2) == 'edit') { ?>
            $('#id_transportasi').val(<?= $alokasi_transportasi->id_transportasi ?>).trigger('change');
        <?php } ?>
    })

    function gantiTransportasi() {
        let id_transportasi = $('#id_transportasi').val();

        $.ajax({
            url: '<?= base_url('transportasi/get_jumlah/') ?>' + id_transportasi,
            type: 'GET',
            success: function(response) {
                $('#jumlah').attr('max', response)
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });

    }
</script>