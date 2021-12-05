<!-- Content Of Galang Dana -->

<!-- Banner -->
<div class="bg-verify text-center mt-8">
    <div class="container">
        <h2 class="f-2 text-black">
            Mulai Galang Dana
        </h2>
    </div>
</div>

<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <strong class="text-15">Panduan Menggalang Dana</strong>
            <div class="mt-3 ml-2">
                <div class="box box--radius box--white small-margin-bottom base-margin-top base-padding d-flex align-item-center">
                    <img class="base-margin-right mr-2" src="<?= base_url('assets') ?>/svg/checkmark.svg" alt="ic_checkmark">
                    <span class="text-15">Informasi yang lengkap dan akurat akan mempercepat proses
                        <i>review</i> galang dana Anda</span>
                </div>
                <div class="box box--radius box--white small-margin-tb base-padding d-flex align-item-center">
                    <img class="base-margin-right mr-2" src="<?= base_url('assets') ?>/svg/checkmark.svg" alt="ic_checkmark">
                    <span class="text-15">Berikan data diri penggalang dana dan penerima manfaat yang dapat dipertanggung jawabkan</span>
                </div>
                <div class="box box--radius box--white small-margin-tb base-padding d-flex align-item-center">
                    <img class="base-margin-right mr-2" src="<?= base_url('assets') ?>/svg/checkmark.svg" alt="ic_checkmark">
                    <span class="text-15">Tuliskan target donasi yang sesuai dengan rincian penggunaan dana</span>
                </div>
                <div class="box box--radius box--white small-margin-tb base-padding d-flex align-item-center">
                    <img class="base-margin-right mr-2" src="<?= base_url('assets') ?>/svg/checkmark.svg" alt="ic_checkmark">
                    <span class="text-15">Pastikan penerima manfaat, baik individu maupun lembaga, sudah memberi izin untuk dipublikasikan
                        namanya dalam penggalangan dana</span>
                </div>
            </div>
            <hr>

            <strong class="text-15">Galang Dana yang Tidak Difasilitasi</strong>
            <div class="mt-3 ml-2">
                <div class="box box--radius box--white small-margin-bottom base-margin-top base-padding d-flex align-item-center">
                    <img class="base-margin-right mr-2" src="<?= base_url('assets') ?>/svg/crossmark.svg" alt="ic_crossmark">
                    <span class="text-15">Galang dana
                        <strong>fiktif</strong> atau main main</span>
                </div>
                <div class="box box--radius box--white small-margin-tb base-padding d-flex align-item-center">
                    <img class="base-margin-right mr-2" src="<?= base_url('assets') ?>/svg/crossmark.svg" alt="ic_crossmark">
                    <span class="text-15">Galang dana untuk
                        <strong>politik praktis</strong>
                    </span>
                </div>
                <div class="box box--radius box--white small-margin-tb base-padding d-flex align-item-center">
                    <img class="base-margin-right mr-2" src="<?= base_url('assets') ?>/svg/crossmark.svg" alt="ic_crossmark">
                    <span class="text-15">Galang dana untuk
                        <strong>membayar utang</strong>
                    </span>
                </div>
                <div class="box box--radius box--white small-margin-tb base-padding d-flex align-item-center">
                    <img class="base-margin-right mr-2" src="<?= base_url('assets') ?>/svg/crossmark.svg" alt="ic_crossmark">
                    <span class="text-15">Galang dana untuk membiayai
                        <strong>terorisme dan kegiatan-kegiatan lainnya yang melanggar hukum</strong>
                    </span>
                </div>
            </div>
            <hr>
            <strong class="text-15">Proses
                <i>review</i> kami berlandaskan:</strong>
            <ol style="padding-inline-start:32px">
                <li style="padding: 5px;">Syarat & Ketentuan di platform GetHelp</li>
                <li style="padding: 5px;">Kelengkapan informasi yang Anda berikan</li>
            </ol>
            <?php if ($verifikasi ==  1) { ?>
                <div class="text-center mt-10">
                    <p>Buat campaign sekarang dengan mengklik tombol
                        <b>Galang Dana Sekarang</b>
                    <p>

                        <a href="<?= base_url('form-galang-dana') ?>" class="btn btn-primary">Galang Dana Sekarang</a>
                </div>
            <?php } elseif ($verifikasi == 0) { ?>
                <div class="text-center mt-10">
                    <p>Akun kamu belum terverifkasi
                        <b>Silahkan verifikasi akun kamu dulu</b>
                    <p>

                        <a href="<?= base_url('verifikasi-akun') ?>" class="btn btn-primary">Verifikasi Akun</a>
                </div>
        </div>
    <?php } else { ?>
        <div class="text-center mt-10">
            <p>Akun kamu Dalam Tahap Proses Verifikasi
                <b>Kamu bisa Mengalang dana jika akun kamu sudah di verifikasi</b>
            <p>

                <a href="<?= base_url() ?>" class="btn btn-primary">Kembali ke halaman utama</a>
        </div>
    <?php }; ?>
    </div>
</div>
</div>
<!-- Bootstrap JS FIle-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>