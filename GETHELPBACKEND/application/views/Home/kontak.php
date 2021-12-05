    <!-- Content Of Contact -->

    <!-- Banner -->
    <div class="banner bg-kontak text-center">
        <div class="container">
            <h2 class="fa-2x text-black">
                Kontak GetHelp
            </h2>
            <p>#GetHelp ~ Hidup Untuk Berbagi</p>
        </div>
    </div>

    <!-- Informasi GetHelp -->
    <div class="bg-white">
        <div class="container py-5">
            <div class="row text-center">
                <div class="col-md-3">
                    <p class="icon">
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                    </p>
                    <p class="font-weight-bold mt-0 mb-1">Alamat</p>
                    <p class="text mb-4">Jl. Baji Iman No.50
                        <br> Makassar, Sulawesi Selatan
                    </p>

                </div>
                <div class="col-md-3">
                    <p class="icon">
                        <i class="fas fa-envelope fa-2x"></i>
                    </p>
                    <p class="font-weight-bold mt-0 mb-1">Email</p>
                    <p class="text mb-4">gethelp.startup@gmail.com</p>
                </div>

                <!-- Peta Lokasi GetHelp -->
                <div class="col-md-6 lokasi">
                    <h5 class="text-black mb-3">Lokasi GetHelp</h5>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.584459046501!2d119.41179461412783!3d-5.170342953648839!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbf1d7ccb85ff0b%3A0x7c4ae89738f4b85f!2sJl.%20Baji%20Iman%20No.5%2C%20Bongaya%2C%20Kec.%20Tamalate%2C%20Kota%20Makassar%2C%20Sulawesi%20Selatan%2090131!5e0!3m2!1sid!2sid!4v1636356251487!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Forum Contact -->

    <div class="form-kontak">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <?php if (null != $this->session->flashdata('message')) { ?>
                        <div class="alert alert-success mb-4" role="alert">
                            <?= $this->session->flashdata('message'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } else { ?>
                    <?php } ?>
                    <p class="mb-5 text-lg">
                        Punya pertanyaan lain atau saran untuk website?
                    </p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form class="needs-validation" action="<?= base_url('home/kontak'); ?>" method="POST">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?php echo set_value('nama'); ?>">
                                    <?= form_error('nama', ' <small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="no-hp">No Handphone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Nomor Handphone" value="<?php echo set_value('phone'); ?>">
                                    <?= form_error('phone', ' <small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
                            <?= form_error('email', ' <small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Topik pertanyaan Anda</label>
                            <select class="form-control" name="category" id="category">
                                <option value="">Pilih Salah Satu</option>
                                <option value="Penggalangan Dana">Penggalangan Dana</option>
                                <option value="Donasi">Donasi</option>
                                <option value="Umum">Umum</option>
                            </select>
                            <?= form_error('category', ' <small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Detail pertanyaan Anda</label>
                            <textarea name="pertanyaan" id="pertanyaan" cols="30" rows="0" class="form-control" placeholder="Pertanyaan atau saran"><?php echo set_value('pertanyaan'); ?></textarea>
                            <?= form_error('pertanyaan', ' <small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Content Of Contact -->