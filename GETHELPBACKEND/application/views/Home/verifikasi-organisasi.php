    <!-- Content Of Campaign -->

    <!-- Banner -->
    <div class="bg-verify text-center mt-8">
        <div class="container">
            <h2 class="fa-2x text-black">
                Verifikasi Akun
            </h2>
        </div>
    </div>

    <!-- MultiStep Form -->
    <div class="container py-2">
        <div class="row justify-content-center mb-50">
            <form class="form" action="<?= base_url('verifikasi-akun-organisasi') ?>" enctype="multipart/form-data" method="POST">

                <div class="progressbar">
                    <div class="progress" id="progress"></div>

                    <div class="progress-step progress-step-active" data-title="Data Diri"></div>
                    <div class="progress-step" data-title="Informasi organisasi"></div>
                    <div class="progress-step" data-title="Detail Akun"></div>
                    <div class="progress-step" data-title="Pencairan Dana"></div>
                    <div class="progress-step" data-title="Berkas"></div>
                </div>


                <div class="form-step form-step-active">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>">
                        <?= form_error('nama', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>


                    <div class="form-group">
                        <label for="alamat">Alamat
                            <span class="text-danger">*</span>
                        </label>
                        <textarea cols="30" rows="0" class="form-control" for="alamat" name="alamat"><?= set_value('alamat'); ?></textarea>
                        <?= form_error('alamat', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <button class="btn btn-primary btn-next" type="button">Selanjutnya</button>
                </div>

                <div class="form-step">
                    <div class="form-group">
                        <label for="nama-penanggung-jawab">Nama Organisasi/yayasan/komunitas
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="namaorg" name="namaorg" value="<?= set_value('namaorg'); ?>">
                        <?= form_error('namaorg', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama-penanggung-jawab">Nama Penanggung Jawab
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="namapj" name="namapj" value="<?= set_value('namapj'); ?>">
                        <?= form_error('namapj', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group ">
                        <label for="no-penanggung-jawab">No Hp (Whatsapp) Penanggung Jawab
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="nopj" name="nopj" value="<?= set_value('nopj'); ?>">
                        <?= form_error('nopj', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="foto-ktp-pj">Foto KTP Penanggung Jawab
                            <span class="text-danger">*</span>
                        </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="ktppj" id="ktppj">
                            <label for="ktppj" class="custom-file-label">Upload Foto</label>
                        </div>
                        <?= form_error('ktppj', ' <small class="text-danger pl-3">', '</small>'); ?>
                        <?php if ($this->session->flashdata('error_msg3')) { ?>
                            <small class="text-danger pl-3"><?= $this->session->flashdata('error_msg3'); ?></small>
                        <?php } else { ?>
                        <?php } ?>
                        <small class="text-black" style="float:right;">Format foto: jpg/jpeg/png. Maks. 1MB</small>
                    </div>
                    <br>
                    <button class="btn btn-outline-primary btn-prev" type="button">Kembali</button>
                    <button class="btn btn-primary btn-next" type="button">Selanjutnya</button>
                </div>

                <div class="form-step">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="no-pa">No Hp (Whatsapp) Pemegang Akun
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="nohp" name="nohp" value="<?= set_value('nohp'); ?>">
                            <?= form_error('nohp', ' <small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ktp-pa">No KTP Pemegang Akun
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="noktp" name="noktp" value="<?= set_value('noktp'); ?>">
                            <?= form_error('noktp', ' <small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="foto-ktp-pa">Foto KTP Pemegang Akun
                            <span class="text-danger">*</span>
                        </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="ktp" id="ktp">
                            <label for="ktp" class="custom-file-label">Upload Foto</label>
                        </div>
                        <?= form_error('ktp', ' <small class="text-danger pl-3">', '</small>'); ?>
                        <?php if ($this->session->flashdata('error_msg')) { ?>
                            <small class="text-danger pl-3"><?= $this->session->flashdata('error_msg'); ?></small>
                        <?php } else { ?>
                        <?php } ?>
                        <small class="text-black" style="float:right;">Format foto: jpg/jpeg/png. Maks. 1MB</small>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="foto-selfie-pa">Foto Selfie dengan KTP
                            <span class="text-danger">*</span>
                        </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="selfie" id="selfie">
                            <label for="foto-selfie-pa" class="custom-file-label">Upload Foto</label>
                        </div>
                        <?= form_error('selfie', ' <small class="text-danger pl-3">', '</small>'); ?>
                        <?php if ($this->session->flashdata('error_msg2')) { ?>
                            <small class="text-danger pl-3"><?= $this->session->flashdata('error_msg2'); ?></small>
                        <?php } else { ?>
                        <?php } ?>
                        <small class="text-black" style="float:right;">Format foto: jpg/jpeg/png. Maks. 1sMB</small>
                    </div>
                    <br>
                    <button class="btn btn-outline-primary btn-prev" type="button">Kembali</button>
                    <button class="btn btn-primary btn-next" type="button">Selanjutnya</button>
                </div>

                <div class="form-step">
                    <div class="form-group">
                        <label for="bank">Bank
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" id="bank" name="bank">
                            <option disabled selected>Pilih Bank</option>
                            <option value="BCA">Bank Central Asia (BCA)</option>
                            <option value="BRI">Bank Rakyat Indonesia (BRI)</option>
                            <option value="Mandiri">Bank Mandiri</option>
                            <option value="BNI">Bank Negara Indonesia (BNI)</option>
                            <option value="Danamon">Bank Danamon</option>
                            <option value="Permata">Bank Permata</option>
                            <option value="Cimb Niaga">CIMB Niaga</option>
                            <option value="Jenius">BTPN/Jenius</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        <?= form_error('bank', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="no-rek">Nomor Rekening
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="no-rek" name="no-rek" value="<?= set_value('no-rek'); ?>">
                            <?= form_error('no-rek', ' <small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama-prek">Nama Pemilik Rekening
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" for="nama-prek" id="nama-prek" name="nama-prek" value="<?= set_value('nama-prek'); ?>">
                            <?= form_error('nama-prek', ' <small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>


                    <button class="btn btn-outline-primary btn-prev" type="button">Kembali</button>
                    <button class="btn btn-primary btn-next" type="button">Selanjutnya</button>
                </div>

                <div class="form-step">
                    <div class="form-group">
                        <label for="berkas-p">Berkas Pendukung
                            <span class="text-danger">*</span>
                        </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="berkas" name="berkas">
                            <label for="berkas" class="custom-file-label">Upload File</label>
                        </div>
                        <?php if ($this->session->flashdata('error_msg4')) { ?>
                            <small class="text-danger pl-3"><?= $this->session->flashdata('error_msg4'); ?></small>
                        <?php } else { ?>
                        <?php } ?>
                        <small class="text-dark">Format file: pdf/jpg/png/jpeg. Maks. 1MB (Tidak Wajib/optional)</small>
                    </div>
                    <div class="form-group">
                        <input style="display:none;">
                    </div>
                    <button class="btn btn-outline-primary btn-prev" type="button">Kembali</button>
                    <button type="submit" class="btn btn-primary">Selesai</button>
                </div>
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