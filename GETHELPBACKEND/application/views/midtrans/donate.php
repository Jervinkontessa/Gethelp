    <!-- Content of Donate -->
    <section class="section-gap-bottom" style="padding-top: 100px;">
      <div class="container">
        <div class="row justify-content-center">
          <?php if (null != $this->session->flashdata('message')) { ?>
            <div class="alert alert-success mb-4" role="alert">
              <?= $this->session->flashdata('message'); ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php } else { ?>
          <?php } ?>
          <div class="col-md-6" id="content-donation">

            <form class="form-horizontal box-payment-donation" role="form" id="form-donation payment-form" method="post" action="<?php echo base_url('donate/') . $detail['slug'] ?>">
              <div class="mb-4">
                <a data-toggle="collapse" data-parent="#accordion" href="#detail-campaign" style="text-decoration:none;">
                  <h6 class="panel-title" style="font-size: 12px;">
                    <b class="text-15"><?= $detail['nama_campaign']; ?></b>
                    <small class="pull-right text-14">Lihat Detail</small>
                  </h6>
                </a>
                <div id="detail-campaign" class="panel-collapse collapse">
                  <div class="panel-body" style="padding:0px;">
                    <span class="campaign-mobile-outerbox" style="border-bottom:none !important;border-radius: 12px;box-shadow: rgb(49 53 59 / 12%) 0px 1px 6px 0px;background: #fff;padding: 5px;">
                      <img class="thumb-list" loading="lazy" src="<?= base_url('assets/img/donasithumb/') . $detail['gambar'] ?>" alt="Bagikan Makanan Untuk Mereka">
                      <div class="info-campaign">
                        <h3 class="title-list-campaign">
                          <span id="campaign-title"><?= $detail['nama_campaign']; ?></span>
                          <span class="badge badge-secondary pull-right" style="padding: 5px;"></span>
                        </h3>
                        <a href="" class="user" data-toggle="modal" data-target="#penggalangDana">
                          <?= $detail['dibuat']; ?> &nbsp;
                        </a>
                        <div class="progress" data-toggle="tooltip" data-bs-tooltip="" style="height: 5px;">
                          <div class="progress-bar progress-bar-striped progress-bar-animated" aria-valuenow="7" aria-valuemin="0" aria-valuemax="100" style="width: <?= (int)$detail['donasi_terkumpul'] / (int)$detail['target_donasi'] * 100 ?>%;">&nbsp;</div>
                        </div>
                        <div class="collected-text">
                          Terkumpul
                          <span class="target-fund">
                            <?= "Rp " . number_format($detail['target_donasi'], 0, ',', '.'); ?>
                          </span>
                        </div>
                        <div class="collected" style="display: flex;height: 17px;">
                          <span class="nominal-list text-black">
                            <?= "Rp " . number_format($detail['donasi_terkumpul'], 0, ',', '.'); ?></span>
                          <span class="day-left">
                            <?= $detail['hari_tersisa'] ?> hari lagi</span>
                        </div>
                        <span class="text-14">Minimal donasi untuk program ini: Rp 10.000</span>
                      </div>
                    </span>
                  </div>
                </div>

                <div class="form-group mt-4">
                  <label for="nominal">Masukkan Nominal Donasi
                    <span class="text-danger">*</span>
                  </label>
                  <div class="form-group mb-3">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Rp</div>
                      <input type="text" name="nominal" id="nominal" class="form-control" placeholder="Masukkan nominal donasi" value="<?= set_value('nominal') ?>">

                    </div>
                  </div>
                  <?= form_error('nominal', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
              <?php if ($user != '') { ?>
                <div class="form-group">
                  <label for="nama-lengkap">Nama Lengkap
                    <span class="text-danger">*</span>
                  </label>
                  <input type="text" class="form-control" id="nama-lengkap" value="<?= $user['nama']; ?>" readonly name="nama-lengkap">
                </div>
                <div class="form-group">
                  <label for="alamat-email">Nomor telepon
                    <span class="text-danger">*</span>
                  </label>
                  <input type="text" class="form-control" id="nomor" value="<?= set_value('nomor') ?>" name="nomor">
                  <?= form_error('nomor', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <label for="alamat-email">Email
                    <span class="text-danger">*</span>
                  </label>
                  <input type="email" class="form-control" id="alamat-email" value="<?= $user['email']; ?>" readonly name="alamat-email">
                </div>
              <?php } else { ?>
                <div class="form-group mt-5" style="text-align:center;">
                  <span class="control-label text-14">
                    <a href="<?= base_url('auth') ?>" style="text-decoration:none;">
                      <b>Masuk</b>
                    </a> atau lengkapi data dibawah ini
                  </span>
                </div>
                <div class="form-group">
                  <label for="nama-lengkap">Nama Lengkap
                    <span class="text-danger">*</span>
                  </label>
                  <input type="text" class="form-control" id="nama-lengkap" value="<?= set_value('nama-lengkap') ?>" name="nama-lengkap">
                  <?= form_error('nama-lengkap', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <label for="nomor">Nomor telepon
                    <span class="text-danger">*</span>
                  </label>
                  <input type="text" class="form-control" id="nomor" value="<?= set_value('nomor') ?>" name="nomor">
                  <?= form_error('nomor', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <label for="alamat-email">Email
                    <span class="text-danger">*</span>
                  </label>
                  <input type="email" class="form-control" id="alamat-email" value="<?= set_value('alamat-email') ?>" name="alamat-email">
                  <?= form_error('alamat-email', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
              <?php }; ?>
              <div class="form-group mb-2">
                <span>Beri Pesan atau Komentar</span>
                <div class="custom-control custom-switch pull-right">
                  <input type="checkbox" class="custom-control-input" id="myChoose" name="myChoose">
                  <label class="custom-control-label" for="myChoose"></label>
                </div>
              </div>

              <div class="form-group" id="show-or-hide-by-choose">
                <textarea cols="30" rows="5" class="form-control" for="doa" placeholder="Pesan atau Doa (Opsional)" id="doa" name="doa"></textarea>
              </div>

              <div class="form-group mb-4" style="margin-top:35px;">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="persetujuan" name="persetujuan">
                  <label class="custom-control-label text-15" for="persetujuan">
                    Ya, Saya telah membaca dan menyetujui
                    <a href="<?= base_url('terms') ?>" target="_blank" class="font-weight-bold" style="text-decoration:none;">Syarat & Ketentuan</a> dari GetHelp
                  </label>
                </div>
                <?= form_error('persetujuan', ' <small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <button class="btn btn-primary btn-block next-btn" id="donasi" data-slug="<?= $detail['slug']; ?>" data-mindonation="10000">Donasi</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <div class="modal fade" id="penggalangDana" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Informasi Lengkap Penggalang Dana</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="close">
              <span aria-hidden="true" style="color:red;">&times;</span>
              <span class="sr-only">Tutup</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-md-12 text-15">
              <p>Nama: <?= $biodata['nama_lengkap'] ?></p>
              <p>Email: <?= $biodata['email'] ?></p>
              <p>Nomor Hp (Whatsapp): <?= $biodata['phone'] ?></p>
              <p>Alamat: <?= $biodata['alamat'] ?></p>
              <a href="<?= base_url('campaign?u=') . $biodata['nama'] ?>" class="font-weight-bold" style="text-decoration:none;">
                Lihat daftar donasi <?= $detail['dibuat']; ?>
              </a>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" type="submit" class="btn btn-close-gethelp btn-block p-1" data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>