    <!-- Breadcrumb Halaman -->
    <section class="section-gap-bottom">
        <div class="container">
            <div class="web-version">
                <div class="row">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url() ?>">Beranda</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('campaign') ?>">Campaign</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                        </ol>
                    </nav>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h5>
                            <strong><?= $title ?></strong>
                        </h5>
                    </div>
                </div>
            </div>

            <!-- Content Of Campaign Bagikan Makanan -->

            <div class="row">
                <div class="web-version">
                    <div class="col-md-8">
                        <div id="carouselExampleIndicators my-4" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100 img-donasi-slider" src="<?= base_url('assets/img/donasithumb/') . $detail['gambar'] ?>" alt="<?= $title; ?>">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                        <hr>
                        <div class="campaign-description mt-3">
                            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link info active" id="deskripsi-tab" data-toggle="tab" href="#deskripsi" role="tab" aria-controls="deskripsi" aria-selected="true">
                                        <b>
                                            <i class="fa fa-pencil-alt text-black" style="margin-right:5px;"></i>Deskripsi
                                        </b>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link info" id="update-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="false">
                                        <b>
                                            <i class="fa fa-bullhorn" style="margin-right:5px;"></i>
                                            Update (<?= $jumlahupdate; ?>)
                                        </b>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="deskripsi" role="tabpanel" aria-labelledby="deskripsi-tab">
                                    <i class="pull-right py-1"><?= date('d F Y', strtotime($detail['tanggal_dibuat'])) ?></i>
                                    <br>
                                    <div class="tab-pane active py-3" role="tabpanel" id="tab-description">
                                        <?= $detail['cerita']; ?>
                                        <p>&nbsp;</p>
                                        <div class="alert alert-secondary" role="alert" style="font-size:0.9em">
                                            <strong>Pernyataan:</strong> Informasi dan opini yang tertulis di halaman penggalangan
                                            dana ini adalah milik penggalang dana dan tidak mewakili GetHelp. Jika ada masalah
                                            atau kecurigaan
                                            <a href="<?= base_url('campaign/report/') . $detail['slug'] ?>" style="text-decoration:none;">
                                                <b>Laporkan Campaign Ini</b>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade mb-50" id="update" role="tabpanel" aria-labelledby="update-tab">
                                    <div style="margin-top: 20px;">
                                        <h6>Jumlah yang telah dicairkan :
                                            <b><?= "Rp " . number_format($detail['jumlah_dicairkan'], 0, ',', '.');  ?></b>
                                        </h6>
                                    </div>

                                    <div class="row mt-4" style="max-height: 800px;overflow-y: auto;">
                                        <hr>
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <?php foreach ($update as $u) : ?>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h6>Penyaluran bantuan.</h6>
                                                        <?= $u['keterangan']; ?>
                                                        <p>
                                                            <img class="img-responsive" src="<?= base_url('assets/img/buktitransfer/') . $u['gambar'] ?>" id="imageresource">
                                                        </p>
                                                    </div>
                                                    <div class="card-footer">
                                                        By: Staff GetHelp - <?= date('d F Y', strtotime($u['tanggal'])) ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div style="position: sticky;top: 70px;">
                            <div class="single-blog campaign-detail-donation">
                                <div>
                                    <h3 class="font-weight-bold"><?= "Rp " . number_format($detail['donasi_terkumpul'], 0, ',', '.'); ?></h3>
                                    <p class="font-weight-bold">Terkumpul dari target <?= "Rp " . number_format($detail['target_donasi'], 0, ',', '.'); ?></p>
                                </div>
                                <div class="causes_content">
                                    <div class="progress cause-progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: <?= (int)$detail['donasi_terkumpul'] / (int)$detail['target_donasi'] * 100 ?>%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="info-additional">
                                    <ul>
                                        <li class="float-left" data-toggle="tooltip" data-original-title="Jumlah donasi">
                                            <span class="font-weight-bold"><?= $jumlahdonatur ?></span>
                                            <br>
                                            <span class="text-muted">Donasi</span>
                                        </li>
                                        <li class="float-left" data-toggle="tooltip" data-original-title="Penggalangan dana akan berakhir pada" style="border-left: 1px solid #989bac;">
                                            <span class="font-weight-bold"><?= $detail['hari_tersisa'] ?></span>
                                            <br>
                                            <span class="text-muted">hari lagi</span>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <a href="<?= base_url('donate/') . $detail['slug'] ?>" class="btn btn-primary btn-block">Donasi
                                    <i class="far fa-handshake ml-1" aria-hidden="true" style="font-size:19px;"></i>
                                </a>
                                <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#socialMediaModal" style="border:1px solid #000;background:#fff;">Bagikan
                                    <i class="fa fa-share ml-1" aria-hidden="true"></i>
                                </button>
                                <div class="fundraiser">
                                    Penggalang:
                                    <strong>
                                        <a href="" style="text-decoration:none;" data-toggle="modal" data-target="#penggalangDana"><?= $detail['dibuat'] ?></a>
                                    </strong>
                                    <div class="clearfix"></div>
                                </div>
                                <div>
                                    <h6>
                                        <b>Donasi</b>
                                    </h6>
                                </div>
                                <?php
                                function time_ago($timestamp)
                                {
                                    $time_ago = strtotime($timestamp);
                                    $current_time = time();
                                    $time_difference = $current_time - $time_ago;
                                    $seconds = $time_difference;
                                    $minutes      = round($seconds / 60);        // value 60 is seconds  
                                    $hours        = round($seconds / 3600);       //value 3600 is 60 minutes * 60 sec  
                                    $days         = round($seconds / 86400);      //86400 = 24 * 60 * 60;  
                                    $weeks        = round($seconds / 604800);     // 7*24*60*60;  
                                    $months       = round($seconds / 2629440);    //((365+365+365+365+366)/5/12)*24*60*60  
                                    $years        = round($seconds / 31553280);   //(365+365+365+365+366)/5 * 24 * 60 * 60  
                                    if ($seconds <= 60) {
                                        return "sekarang";
                                    } else if ($minutes <= 60) {
                                        if ($minutes == 1) {
                                            return "1 menit yang lalu";
                                        } else {
                                            return "$minutes menit yang lalu";
                                        }
                                    } else if ($hours <= 24) {
                                        if ($hours == 1) {
                                            return "1 jam yang lalu";
                                        } else {
                                            return "$hours jam yang lalu";
                                        }
                                    } else if ($days <= 7) {
                                        if ($days == 1) {
                                            return "kemarin";
                                        } else {
                                            return "$days hari yang lalu";
                                        }
                                    } else if ($weeks <= 4.3) {  //4.3 == 52/12
                                        if ($weeks == 1) {
                                            return "1 minggu yang lalu";
                                        } else {
                                            return "$weeks weeks ago";
                                        }
                                    } else if ($months <= 12) {
                                        if ($months == 1) {
                                            return "1 bulan yang lalu";
                                        } else {
                                            return "$months bulan yang lalu";
                                        }
                                    } else {
                                        if ($years == 1) {
                                            return "1 tahun yang lalu";
                                        } else {
                                            return "$years tahun yang lalu";
                                        }
                                    }
                                }
                                ?>
                                <?php foreach ($donatur as $d) : ?>
                                    <div class="row list-donors">
                                        <div class="col-md-3">
                                            <div class="image">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-9 donor-info">
                                            <strong class="font-weight-bold"><?= "Rp " . number_format($d['gross_amount'], 0, ',', '.'); ?></strong>
                                            <div style="font-size:0.8em">
                                                <span class="text-black">Oleh</span>
                                                <em class="text-black">#KawanPeduliGetHelp</em>
                                                <span class="text-black" style="margin-left:0.1em;margin-right:0.1em">•</span>
                                                <span class="text-black">
                                                    <?= time_ago($d['transaction_time']) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <button type="button" class="btn btn-outline-dark btn-block" data-toggle="modal" data-target="#listDonorsModal" id="list-donors">Lihat Semua Donasi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Version -->
            <div class="mobile-version">
                <div class="col-md-12">
                    <div id="carouselExampleCaptionsMobile" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="<?= base_url('assets/img/donasithumb/') . $detail['gambar'] ?>" class="d-block w-100 img-donasi-slider" alt="gambar <?= $title; ?>">
                                <div class="carousel-caption">
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptionsMobile" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptionsMobile" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="campaign-detail-box">
                    <div class="info-campaign-detail" style="margin:0px; padding: 10px;">
                        <h3 class="title-campaign"><?= $title; ?>
                            <span class="badge badge-info kat-sosial pull-right" style="padding: 5px;margin-top:10px;margin-bottom:5px;"><?= $detail['cnama'] ?></span>
                        </h3>
                        <span class="font-weight-bold"><?= "Rp " . number_format($detail['donasi_terkumpul'], 0, ',', '.'); ?></span>
                        <div class="collected-text">
                            <span class="font-weight-bold target-fund">Terkumpul dari target <?= "Rp " . number_format($detail['target_donasi'], 0, ',', '.'); ?></span>
                            <div style="color: #989bac; font-size: 11px; text-align: right; width: 100%;">
                                <strong>
                                    <a href="" style="text-decoration:none;font-size:12px;" data-toggle="modal" data-target="#penggalangDana"><?= $detail['dibuat']; ?></a>
                                </strong>
                            </div>
                        </div>
                        <div style="color: #989bac;margin: 10px 0px;">
                            <div class="clearfix"></div>
                        </div>
                        <div class="info-additional">
                            <ul>
                                <li class="float-left" data-toggle="tooltip" data-original-title="Jumlah donasi">
                                    <strong class="font-weight-bold" style="font-size:1.1em"><?= $jumlahdonatur ?></strong>
                                    <br>
                                    <span class="text-muted">Donasi</span>
                                </li>
                                <li class="float-left" data-toggle="tooltip" data-original-title="Penggalangan dana akan berakhir pada" style="border-left: 1px solid #989bac;">
                                    <strong class="font-weight-bold" style="font-size:1.1em"><?= $detail['hari_tersisa']; ?></strong>
                                    <br>
                                    <span class="text-muted">hari lagi</span>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div style="margin: 5px;">
                        </div>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#socialMediaModal" style="width: 40%;border:1px solid #000;background:#fff;">Bagikan
                                <i class="fa fa-share ml-1" aria-hidden="true"></i>
                            </button>
                            <a href="<?= base_url('donate/') . $detail['slug'] ?>" class="btn btn-primary" style="width: 58%;">Donasi
                                <i class="far fa-handshake ml-1" aria-hidden="true" style="font-size:19px;"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="campaign-detail-box">
                    <ul class="nav nav-pills nav-pills-rose">
                        <li class="nav-item" style="width: 33.3%;">
                            <a class="nav-link active" href="#description-mobile" data-toggle="tab" style="background: transparent; font-size: 12px;border-right: 1px solid #007bff;">
                                <b>
                                    <i class="fa fa-pencil-alt"></i> Deskripsi</b>
                            </a>
                        </li>
                        <li class="nav-item" style="width: 33.3%;">
                            <a class="nav-link" href="#update-mobile" data-toggle="tab" style="background: transparent; font-size: 12px;border-right: 1px solid #007bff;">
                                <b>
                                    <i class="fa fa-bullhorn"></i> Update (<?= $jumlahupdate ?>)</b>
                            </a>
                        </li>
                        <li class="nav-item" style="width: 33.3%;">
                            <a class="nav-link" href="#donation-mobile" data-toggle="tab" style="background: transparent; font-size: 12px;">
                                <b>
                                    <i class="fa fa-info-circle"></i> Donasi</b>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content tab-space" style="padding: 10px;">
                        <div class="tab-pane active" id="description-mobile">
                            <i class="pull-right mt-1 text-14">><?= date('d F Y', strtotime($detail['tanggal_dibuat'])) ?></i>
                            <div class="tab-pane active py-3" role="tabpanel" id="tab-description" style="word-break: break-word;">
                                <p>&nbsp;</p>
                                <?= $detail['cerita']; ?>
                                <p>&nbsp;</p>
                                <div class="alert alert-secondary" role="alert" style="font-size:0.8em">
                                    <strong>Pernyataan:</strong> Informasi dan opini yang tertulis di halaman penggalangan dana
                                    ini adalah milik penggalang dana dan tidak mewakili GetHelp. Jika ada masalah atau
                                    kecurigaan
                                    <a href="<?= base_url('campaign/report/') . $detail['slug'] ?>" style="text-decoration:none;">
                                        <b>Laporkan Campaign Ini</b>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade mb-50" id="update-mobile">
                            <div style="margin-top: 20px;">
                                <h6>Jumlah yang telah dicairkan :
                                    <b><?= "Rp " . number_format($detail['jumlah_dicairkan'], 0, ',', '.'); ?></b>
                                </h6>
                            </div>

                            <div class="row mt-4" style="max-height: 500px;overflow-y: auto;">
                                <div class="col-md-12" style="margin-bottom: 10px;">
                                    <?php foreach ($update as $u) : ?>
                                        <div class="card">
                                            <div class="card-body">
                                                <h6>Penyaluran bantuan.</h6>
                                                <?= $u['keterangan']; ?>
                                                <p>
                                                    <img class="img-responsive" src="<?= base_url('assets/img/buktitransfer/') .  $u['gambar'] ?>" id="imageresource">
                                                </p>
                                            </div>
                                            <div class="card-footer">
                                                By: Staff GetHelp - <?= date('d F Y', strtotime($u['tanggal'])) ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="donation-mobile">
                            <?php foreach ($donatur as $d) : ?>
                                <div style="display: flex;flex-direction: row; margin-bottom: 15px;">
                                    <i class="fa fa-user" aria-hidden="true" style="padding: 5px;width: 15px;height: 15px;margin-right: 15px;"></i>
                                    <div>
                                        <span style="font-size:0.9em">
                                            <em class="text-black">#KawanPeduliGetHelp</em>
                                        </span>
                                        <br>
                                        <span style="color:#000;font-size: 12px;">
                                            <b><?= "Rp " . number_format($d['gross_amount'], 0, ',', '.'); ?></b>
                                        </span>
                                        <span class="text-black" style="margin-left:0.1em;margin-right:0.1em">•</span>
                                        <span class="text-black" style="font-size:10px;">
                                            <?= time_ago($d['transaction_time']) ?>
                                        </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <button type="button" class="btn btn-outline-dark btn-block" data-toggle="modal" data-target="#listDonorsModal" id="list-donors">Lihat Semua Donasi</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-6">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section_title font-weight-bold text-center mb-2 d-flex justify-content-between align-items-center">
                            <span>Doa-doa #OrangPeduli</span>
                            <span>
                                <a href="" style="font-weight:600;" data-toggle="modal" data-target="#listDoaModal" id="list-doa">Lihat lainnya</a>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <?php foreach ($donatur as $d) : ?>
                        <div class="col-md-3 col-sm-6 mb-2">
                            <div class="d-flex flex-row user-info">
                                <img class="rounded-circle" src="<?= base_url('assets/img/users/profile/default.png') ?>" width="40" height="40">
                                <div class="d-flex flex-column justify-content-start ml-2">
                                    <span class="d-block font-weight-bold name">#KawanPeduliGetHelp</span>
                                    <span class="text-14 text-black-50"> <?= time_ago($d['transaction_time']) ?></span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <p class="text-15"><?= $d['doa']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
        </div>
    </section>

    <div class="modal fade" id="socialMediaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Bagikan tautan ke media sosial</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" style="color:red;">&times;</span>
                        <span class="sr-only">Tutup</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div id="social-links">
                            <img src="https://mostqr.com/myqr/?url=<?= base_url('campaign/') . $detail['slug'] ?>" style="padding-left: 0;padding-right: 0;margin-left: auto;margin-right: auto;display: block; width: 200px;">
                            <ul class="d-flex align-items-center justify-content-between" style="font-size: 40px; padding-left: 10px;padding-right: 10px;margin-left: auto;margin-right: auto;list-style-type:none;">
                                <li>
                                    <a href="https://web.facebook.com/sharer/sharer.php?u=<?= base_url('campaign/') . $detail['slug'] ?>" target="_blank" class="social-button" id="facebook" data-slug="<?= $detail['slug'] ?>">
                                        <i class="fab fa-facebook-square"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://wa.me/?text=Saya mengajak Anda untuk berdonasi di <?= base_url('campaign/') . $detail['slug'] ?>" target="_blank" class="social-button" id="wa" data-slug="<?= $detail['slug'] ?>">
                                        <i class="fab fa-whatsapp-square"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://t.me/share/url?text=Saya mengajak Anda untuk berdonasi &url= <?= base_url('campaign/') . $detail['slug'] ?>" target="_blank" class="social-button" id="telegram" data-slug=" <?= $detail['slug'] ?>">
                                        <i class="fab fa-telegram"></i>
                                    </a>
                                </li>
                            </ul>
                            <input type="text" class="form-control" name="" id="campaign-slug-text" value="<?= base_url('campaign/') . $detail['slug'] ?>" style="font-size:14px;color:#000;" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default-gethelp btn-block p-1" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="listDonorsModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Daftar Donasi: Bagikan Makanan Untuk Mereka</h5>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="single-blog" style="height: 350px;overflow-y: auto; background: #fff;">
                            <div>
                                <?php foreach ($donaturmodal as $d) : ?>
                                    <div style="display: flex;flex-direction: row; margin-bottom: 15px;">
                                        <i class="fa fa-user mr-3" aria-hidden="true" style="padding: 5px;width: 15px;height: 15px;"></i>
                                        <div>
                                            <span>
                                                <em class="text-black">#KawanPeduliGetHelp</em>
                                            </span>
                                            <br>
                                            <span class="text-black">
                                                Doa :
                                            </span>
                                            "<?= $d['doa']; ?>"
                                            <br>
                                            <span style="color:#000;font-size: 12px;">
                                                <b><?= "Rp " . number_format($d['gross_amount'], 0, ',', '.'); ?></b>
                                            </span>
                                            <span class="text-black" style="margin-left:0.1em;margin-right:0.1em">•</span>
                                            <span class="text-black" style="font-size:11px;">
                                                <?= time_ago($d['transaction_time']) ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-close-gethelp btn-block p-1" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="listDoaModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Doa-doa #Orang Peduli</h5>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="single-blog" style="height: 350px;overflow-y: auto; background: #fff;">
                            <div>
                                <?php foreach ($donatur as $d) : ?>
                                    <div class="mb-4">
                                        <div class="d-flex flex-row user-info">
                                            <img class="rounded-circle" src="<?= base_url('assets/img/users/profile/default.png') ?>" width="40" height="40">
                                            <div class="d-flex flex-column justify-content-start ml-2">
                                                <span class="d-block font-weight-bold name"><?= $d['oleh']; ?></span>
                                                <span class="text-14 text-black-50"><?= time_ago($d['transaction_time']) ?></span>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <p class="text-14"><?= $d['doa']; ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-close-gethelp btn-block p-1" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="penggalangDana" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Informasi Lengkap Penggalang Dana</h5>
                    <button type="button" class="close" data-dismiss="modal">
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
                    <button type="button" class="btn btn-close-gethelp btn-block p-1" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- End Campaign Bagikan Makanan-->