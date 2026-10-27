<div class="page-wrapper">
    <div class="page-content">

        <form action="<?= base_url('alokasi_relawan/' . ($this->uri->segment(2) == 'edit' ? 'update' : 'insert')) ?>" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Tambah Alokasi Relawan</h3>
                    <div>
                        <a href="<?= base_url('alokasi_relawan') ?>" class="btn btn-secondary">Kembali <i class="bx bx-arrow-back"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($this->uri->segment(2) == 'edit') { ?>
                        <input type="hidden" name="id" value="<?= $alokasi_relawan->id ?>">
                    <?php } ?>
                    <input type="hidden" name="id_bencana" value="<?= $id_bencana ?>">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="id_kecakapan">Kecakapan</label>
                            <select name="id_kecakapan" id="id_kecakapan" required class="form-control">
                                <option value="">Pilih Kecakapan</option>
                                <?php foreach ($kecakapan as $item) { ?>
                                    <option value="<?= $item->id ?>"><?= $item->kelompok ?></option>
                                <?php } ?>
                            </select>
                        </div>                    
                            <div class="form-group mb-3">
                                <label for="id_relawan">Relawan</label>
                                <select name="id_relawan" id="id_relawan" required class="form-control">
                                    <option value="">Pilih Relawan</option>
                                    <!-- Data relawan akan dimuat dengan AJAX -->
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" required placeholder="Pilih tanggal" value="<?= $this->uri->segment(2) == 'edit' ? $alokasi_relawan->tanggal_mulai : '' ?>" id="tanggal_mulai" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="lama">Lama Penugasan (hari)</label>
                                <input type="number" name="lama" required value="<?= $this->uri->segment(2) == 'edit' ? $alokasi_relawan->lama : '' ?>" id="lama" class="form-control">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="id_shelter">Lokasi Penugasan (Shelter) </label>
                            <select name="id_shelter" id="id_shelter" class="form-control">
                                <option value="">Tidak di Shelter</option>
                                <?php foreach ($shelters as $shelter) { ?>
                                    <option value="<?= $shelter->id ?>"><?= $shelter->nama ?></option>
                                <?php } ?>
                            </select>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        $('.select2').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

        <?php if ($this->uri->segment(2) == 'edit') { ?>
            $('#id_relawan').val(<?= $alokasi_relawan->id_relawan ?>).trigger('change');
        <?php } ?>
    })

    $('#id_kecakapan').change(function () {
    const id_kecakapan = $(this).val(); // Ambil nilai kecakapan yang dipilih

    // Kosongkan dropdown "Pilih Relawan" setiap kali kecakapan diubah
    $('#id_relawan').html('<option value="">Pilih Relawan</option>');

    if (!id_kecakapan) {
        console.log('Kecakapan tidak dipilih');
        return;
    }

    console.log('Mengambil data untuk ID Kecakapan:', id_kecakapan);

    // Lakukan AJAX request
    $.ajax({
        url: '<?= base_url("relawan/get_by_kecakapan") ?>/' + id_kecakapan, // Endpoint API
        method: 'GET',
        success: function (response) {
            console.log('Respons server:', response); // Debugging respons

            try {
                const result = JSON.parse(response); // Parsing JSON respons

                if (result.status === 'success') {
                    let options = '<option value="">Pilih Relawan</option>';
                    result.data.forEach(item => {
                        options += `<option value="${item.id}">${item.nama}</option>`;
                    });

                    // Update dropdown dengan data relawan
                    $('#id_relawan').html(options);
                } else {
                    alert(result.message || 'Tidak ada relawan ditemukan.');
                }
            } catch (error) {
                console.error('Error parsing JSON:', error);
                alert('Kesalahan saat memproses data dari server.');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error pada AJAX:', error);
            alert('Terjadi kesalahan saat mengambil data.');
        }
    });
});


</script>


