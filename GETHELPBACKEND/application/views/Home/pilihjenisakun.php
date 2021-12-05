    <!-- Content Of Campaign -->

    <!-- Banner -->
    <div class="bg-verify text-center mt-8">
        <div class="container">
            <h2 class="fa-2x text-black">
                Pilih Jenis akun anda untuk di verifikasi
            </h2>
        </div>
    </div>

    <!-- MultiStep Form -->
    <div class="container py-2">
        <div class="row justify-content-center ">
            <form action="<?= base_url('verifikasi-akun') ?>" method="POST">
                <div class="form-step form-step-active">
                    <div class="form-group">
                        <label for="jenis-akun">Jenis Akun
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" id="jenis-akun" name="jenis-akun">
                            <option disabled selected>Pilih Salah Satu</option>
                            <?php foreach ($jenis_akun as $jk) : ?>
                                <option value="<?= $jk['nama']; ?>"><?= $jk['nama'] ?></option>
                            <?php endforeach; ?>

                        </select>
                        <?= form_error('jenis-akun', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <button class="btn btn-primary btn-next" type="submit">Selanjutnya</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS FIle-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/js/stepper.js') ?>"></script>

    <script>
        $('.custom-file-input').on('change', function() {
            let filename = $(this).val().split('\\').pop();
            $(this)
                .next('.custom-file-label')
                .addClass('selected')
                .html(filename);
        });
    </script>
    </body>

    </html>