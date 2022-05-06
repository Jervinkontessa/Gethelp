    <!-- Content of Laporkan Campaign -->

    <!-- Banner -->
    <div class="banner bg-kontak text-center">
        <div class="container">
            <h2 class="fa-2x text-black">
                Laporkan Campaign Ini
            </h2>
            <p style="font-size:20px;"><?= $detail['nama_campaign']; ?></p>
        </div>
    </div>

    <!-- Form Laporkan Campaign -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="needs-validation" method="POST" enctype="multipart/form-data" action="<?= base_url('campaign/report/') . $detail['slug']; ?>">
                    <?php if (empty($user)) { ?>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama') ?>">
                            <?= form_error('nama', ' <small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat-email">Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>">
                                    <?= form_error('email', ' <small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nohp">Nomor Handphone
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="nohp" name="nohp" value="<?= set_value('nohp') ?>">
                                    <?= form_error('nohp', ' <small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama') ?>">
                            <?= form_error('nama', ' <small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat-email">Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                                    <?= form_error('email', ' <small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nohp">Nomor Handphone
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="nohp" name="nohp" value="<?= set_value('nohp') ?>">
                                    <?= form_error('nohp', ' <small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="kategori-laporan">Kategori Laporan
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" id="kategori" name="kategori">
                            <option selected disabled>Pilih Kategori Laporan</option>
                            <option value="Informasi Palsu">Informasi Palsu</option>
                            <option value="Penyalahgunaan Dana Bantuan">Penyalahgunaan Dana Bantuan</option>
                            <option value="Spamming">Spamming</option>
                            <option value="Target pendanaan tidak sesuai">Target pendanaan tidak sesuai</option>
                            <option value="Tidak ada izin dengan penerima manfaat/bantuan">Tidak ada izin dengan penerima manfaat/bantuan</option>
                        </select>
                        <?= form_error('kategori', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label>Detail Laporan
                            <span class="text-danger">*</span>
                        </label>
                        <textarea cols="30" rows="5" class="form-control" placeholder="Tulis detail dari laporan Anda" id="keterangan" name="keterangan"><?= set_value('keterangan') ?></textarea>
                        <?= form_error('keterangan', ' <small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group mb-4">
                        <label for="foto-laporan">Lampirkan Foto Sebagai Pendukung Laporan Anda
                            <span class="text-danger">*</span>
                        </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="fotolaporan" id="fotolaporan">
                            <label for="foto-laporan" class="custom-file-label">Upload Foto</label>
                        </div>
                        <?= form_error('fotolaporan', ' <small class="text-danger pl-3">', '</small>'); ?>
                        <?php if ($this->session->flashdata('error_msg')) { ?>
                            <small class="text-danger pl-3"><?= $this->session->flashdata('error_msg'); ?></small>
                        <?php } else { ?>
                        <?php } ?>
                        <small class="text-black">Format foto: jpg/jpeg/png. Maks. 1MB</small>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- End Content Of Contact -->