    <!-- Content Of Galang Dana -->

    <!-- Banner -->
    <div class="bg-verify text-center mt-8">
        <div class="container">
            <h2 class="f-2 text-black">
                Galang Dana
            </h2>
        </div>
    </div>

    <!-- MultiStep Form -->
    <div class="container py-2">
        <div class="row justify-content-center mb-50">
            <form class="form" action="<?= base_url('form-galang-dana') ?>" method="POST" enctype="multipart/form-data">

                <div class="progressbar">
                    <div class="progress" id="progress"></div>

                    <div class="progress-step progress-step-active" data-title="Data Diri"></div>
                    <div class="progress-step" data-title="Detail"></div>
                    <div class="progress-step" data-title="Foto"></div>
                    <div class="progress-step" data-title="Deskripsi"></div>
                    <div class="progress-step" data-title="Konfirmasi"></div>
                </div>

                <div class="form-step form-step-active">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama') ?>">
                        <?= form_error('nama', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="alamat-email">Email
                            <span class="text-danger">*</span>
                        </label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" disabled>
                    </div>
                    <button type="button" class="btn btn-primary btn-next w-100 mb-2">Selanjutnya</button>
                    <a href="<?= base_url() ?>" class="btn btn-danger w-100">Batal Galang Dana</a>
                </div>

                <div class="form-step">
                    <div class="form-group">
                        <label for="kategori">Kategori yang paling tepat untuk penggalangan dana ini
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" id="kategori" name="kategori">
                            <option disabled selected>Pilih Kategori yang Sesuai</option>
                            <?php foreach ($category as $c) : ?>
                                <?php if ($c['id'] == set_value('kategori')) : ?>
                                    <option value="<?= $c['id'] ?>" selected><?= $c['nama']; ?></option>
                                <?php else : ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['nama']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('kategori', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul untuk penggalangan dana ini
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="judul" placeholder="Contoh: Bantu warga pulih dari bencana" name="judul" value="<?= set_value('judul') ?>">
                        <?= form_error('judul', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="targetdonasi" class="text-15">Target Donasi
                            <span class="text-danger">*</span>
                        </label>
                        <div class="form-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp</div>
                                <input type="text" name="targetdonasi" id="targetdonasi" class="form-control" placeholder="0" value="<?= set_value('targetdonasi') ?>">
                            </div>
                            <?= form_error('targetdonasi', ' <small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date">Batas waktu penggalangan dana
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" data-provide="datepicker" id="date" name="date" placeholder="Pilih Tanggal" value="<?= set_value('date') ?>">
                        <?= form_error('date', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="alert alert-info" role="alert">
                        Target donasi dan batas waktu dapat diubah sewaktu-waktu jika diperlukan
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="tujuan">Tujuan Galang Dana
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="tujuan" placeholder="Contoh: Membantu tetangga yang rumahnya kebakaran" name="tujuan" value="<?= set_value('tujuan') ?>">
                        <?= form_error('tujuan', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="penerima">Penerima Donasi
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="penerima" placeholder="Contoh: Pak Agung dan Keluarganya" name="penerima" value="<?= set_value('penerima') ?>">
                        <?= form_error('penerima', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group mb-5">
                        <label for="rincian">Rincian penggunaan dana jika dana donasi terkumpul
                            <span class="text-danger">*</span>
                        </label>
                        <textarea cols="30" rows="5" class="form-control" for="rincian" placeholder="Tulis sedetail mungkin. Contoh: Pembelian 5 sak semen, ongkos untuk 5 tukang bangunan" id="rincian" name="rincian"><?= set_value('rincian') ?></textarea>
                        <?= form_error('rincian', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="btns-group mb-2">
                        <button class="btn btn-outline-primary btn-prev" type="button">Kembali</button>
                        <button class="btn btn-primary btn-next" type="button">Selanjutnya</button>
                    </div>
                    <a href="<?= base_url() ?>" class="btn btn-danger w-100">Batal Galang Dana</a>
                </div>

                <div class="form-step">
                    <div class="form-group mb-5">
                        <label for="foto-gd">Pilih salah satu foto utama untuk penggalangan danamu</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumbnail" id="thumbnail">
                            <label for="thumbnail" class="custom-file-label">Upload Foto</label>
                        </div>
                        <?= form_error('thumbnail', ' <small class="text-danger pl-3">', '</small>'); ?>
                        <?php if ($this->session->flashdata('error_msg')) { ?>
                            <small class="text-danger pl-3"><?= $this->session->flashdata('error_msg'); ?></small>
                        <?php } else { ?>
                        <?php } ?>
                        <small class="text-black">Format foto: jpg/jpeg/png. Maks. 2MB</small>
                    </div>
                    <div class="btns-group mb-2">
                        <button class="btn btn-outline-primary btn-prev" type="button">Kembali</button>
                        <button class="btn btn-primary btn-next" type="button">Selanjutnya</button>
                    </div>
                    <a href="<?= base_url() ?>" class="btn btn-danger w-100">Batal Galang Dana</a>
                </div>

                <div class="form-step">
                    <div class="form-group mb-5">
                        <label for="cerita">Ceritakan tentang diri anda, alasan penggalangan dana, rencana penggunaan dana
                            <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" for="cerita" id="cerita" name="cerita"><?= set_value('cerita') ?></textarea>
                        <?= form_error('cerita', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="btns-group mb-2">
                        <button class="btn btn-outline-primary btn-prev" type="button">Kembali</button>
                        <button class="btn btn-primary btn-next" type="button">Selanjutnya</button>
                    </div>
                    <a href="<?= base_url() ?>" class="btn btn-danger w-100">Batal Galang Dana</a>
                </div>

                <div class="form-step">

                    <div class="alert alert-info mb-5" role="alert">
                        <strong>Komitmen GetHelp</strong>
                        <br>
                        <p>GetHelp berkomitmen untuk memastikan dana donasi benar-benar diterima oleh penerima manfaat, baik
                            dengan menverifikasi, mendampingi, hingga kunjungan langsung ke lapangan jika diperlukan.</p>
                        <p>Jika penerima manfaat tidak memiliki rekening, GetHelp akan membantu penyaluran donasi melalui yayasan
                            atau komunitas terpercaya yang menjadi partner GetHelp.</p>
                        <p>Dengan klik "Setuju", Anda menjamin
                            <b>kebenaran</b> dari informasi yang diberikan dan menyetujui untuk
                            <b>patuh</b> dengan segala ketentuan, tindakan, dan keputusan dari GetHelp.
                        </p>
                    </div>

                    <div class="form-group mb-5">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="persetujuan" name="persetujuan" value="setuju">
                            <label class="custom-control-label" for="persetujuan">
                                Saya setuju dengan
                                <a href="<?= base_url('terms') ?>" target="_blank" style="text-decoration:none;">Syarat & Ketentuan</a> donasi di GetHelp, termasuk biaya administrasi platform sebesar 2%
                                dari total donasi yang terkumpul
                            </label>
                            <?= form_error('persetujuan', ' <small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input style="display:none;">
                    </div>
                    <div class="btns-group mb-2">
                        <button class="btn btn-outline-primary btn-prev" type="button">Kembali</button>
                        <button type="submit" class="btn btn-primary">Selesai</button>
                    </div>
                    <a href="<?= base_url() ?>" class="btn btn-danger w-100">Batal Galang Dana</a>
                </div>
            </form>

        </div>
    </div>

    <!-- Bootstrap JS FIle-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('assets/summernote/') . 'summernote-bs4.js' ?>"></script>
    <script src="<?= base_url('assets') ?>/js/stepper.js"></script>

    <script>
        $('.custom-file-input').on('change', function() {
            let filename = $(this).val().split('\\').pop();
            $(this)
                .next('.custom-file-label')
                .addClass('selected')
                .html(filename);
        });
    </script>


    <script type="text/javascript">
        $('#date').datepicker({
            format: "yyyy-mm-dd",
            weekStart: 0,
            startDate: "1920-01-01",
            todayBtn: "linked",
            language: "id",
            autoclose: true,
            todayHighlight: true
        });
    </script>
    <script>
        var rupiah = document.getElementById('targetdonasi');
        rupiah.addEventListener('keyup', function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, '');
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#cerita').summernote({

                height: 200,
                disableDragAndDrop: true,
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather', ],
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen']],
                ],
            });
        });

        $(document).ready(function() {
            $('#rincian').summernote({

                height: 200,
                disableDragAndDrop: true,
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather', ],
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen']],
                ],
            });
        });
    </script>
    </body>

    </html>