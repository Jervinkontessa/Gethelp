  <!-- Slider -->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
          <div class="carousel-item active">
              <img class="d-block w-100 img-donasi-slider" src="<?= base_url('assets/img/frontend/') ?>slide1.png" srcset="<?= base_url('assets/img/frontend/') ?>slide1_480.jpg 480w,
              <?= base_url('assets/img/frontend/') ?>slide1_720.jpg 720w,
              <?= base_url('assets/img/frontend/') ?>slide1_1080.jpg 1080w" size="100vw" alt="GetHelp">
          </div>
          <div class="carousel-item">
              <img class="d-block w-100 img-donasi-slider" src="<?= base_url('assets/img/frontend/') ?>slide2.png" srcset="<?= base_url('assets/img/frontend/') ?>slide2_480.jpg 480w,
              <?= base_url('assets/img/frontend/') ?>slide2_720.jpg 720w,
              <?= base_url('assets/img/frontend/') ?>slide2_1080.jpg 1080w" size="100vw" alt="GetHelp">
          </div>
          <div class="carousel-item">
              <img class="d-block w-100 img-donasi-slider" src="<?= base_url('assets/img/frontend/') ?>slide3.jpg" srcset="<?= base_url('assets/img/frontend/') ?>slide3_480.jpg 480w,
              <?= base_url('assets/img/frontend/') ?>slide3_720.jpg 720w,
              <?= base_url('assets/img/frontend/') ?>slide3_1080.jpg 1080w" size="100vw" alt="GetHelp">
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
  <div class="container">
      <div class="row">
          <div class="col mt-4 font-weight-bold" style="font-size:20px;">
              Kategori Favorit GetHelp
          </div>
      </div>
  </div>


  <!-- Kategori Donasi -->
  <div class="container add-tionn">
      <div class="row">
          <?php foreach ($cfavorit as $cf) : ?>
              <div class="col">
                  <div class="widget-box-inner">
                      <div class="round">
                          <a class="inner" href="<?= base_url('campaign?c=') . $cf['nama'] ?>">
                              <i class="<?= $cf['icon'] ?>"></i>
                              <p><?= $cf['nama'] ?></p>
                          </a>
                      </div>

                  </div>
              </div>
          <?php endforeach; ?>
          <div class="col">
              <div class="widget-box-inner">
                  <div class="round">
                      <a class="inner" href="<?= base_url('campaign') ?>">
                          <i class="fa fa-th-large"></i>
                          <p>Lainnya</p>
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- List donasi aktif -->
  <div class="popular_causes_area section_padding">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-12">
                  <div class="section_title font-weight-bold text-center mb-2 d-flex justify-content-between align-items-center">
                      <span>Pilihan GetHelp</span>
                      <span>
                          <a href="<?= base_url('campaign') ?>">Lihat lainnya>></a>
                      </span>
                  </div>
              </div>
          </div>


          <div class="row">
              <?php foreach ($campaign as $c) : ?>
                  <div class="col-md-4 col-sm-6">
                      <div class="causes_active owl-carousel">
                          <div class="single_cause">
                              <div class="thumb">
                                  <a href="<?= base_url('campaign/') . $c['slug']; ?>">
                                      <img src="<?= base_url('assets/img/donasithumb/') . $c['gambar'] ?>" alt="gambar campaign">
                                  </a>
                              </div>
                              <div class="causes_content">
                                  <div class="details">
                                      <span class="badge badge-info kat-sosial pull-right"><?= $c['cnama'] ?></span>
                                      <a href="<?= base_url('campaign/') . $c['slug'] ?>">
                                          <h4>#<?= $c['nama_campaign'] ?></h4>
                                      </a>
                                  </div>
                                  <div class="progress cause-progress">
                                      <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?= (int)$c['donasi_terkumpul'] / (int)$c['target_donasi'] * 100 ?>%">
                                      </div>
                                  </div>
                                  <div class="balance justify-content-between align-items-center">
                                      <span>Terkumpul <?= "Rp " . number_format($c['donasi_terkumpul'], 0, ',', '.') ?> dari
                                          <span class="text-primary"><?= "Rp " . number_format($c['target_donasi'], 0, ',', '.') ?></span>
                                      </span>
                                      <br>
                                      <br>
                                      <span class="donatur">
                                          <?= $c['nama']; ?>

                                          <img src="<?= base_url('assets/img/') ?>verified.png" alt="Donatur Terverifikasi" style="width:15px;height:15px;">
                                      </span>
                                  </div>
                                  <a class="btn btn-primary btn-donasi" href="<?= base_url('donate/') . $c['slug']; ?>">Donasi</a>
                              </div>
                          </div>
                      </div>
                  </div>
              <?php endforeach; ?>
          </div>

      </div>
  </div>
  <!-- list donasi aktif_end  -->

  <!-- Doa-doa Donatur -->
  <div class="container mt-3 mb-3">
      <div class="row justify-content-center">
          <div class="col-lg-12">
              <div class="section_title font-weight-bold text-center mb-2 d-flex justify-content-between align-items-center">
                  <span>Doa-doa #OrangPeduli</span>
                  <span>
                      <a href="" style="font-weight:600;" data-toggle="modal" data-target="#listDoaModal" id="list-doa">Lihat lainnya>></a>
                  </span>
              </div>
          </div>
      </div>

      <div class="row mt-3">
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
                        return "$weeks minggu yang lalu";
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
          <?php foreach ($doa as $d) : ?>
              <div class="col-md-4 col-sm-6 mb-2">
                  <div class="d-flex flex-row user-info">
                      <img class="rounded-circle" src="<?= base_url('assets/img/users/profile/default.png') ?>" width="40" height="40" alt="gambar-user">
                      <div class="d-flex flex-column justify-content-start ml-2">
                          <span class="d-block font-weight-bold name">#KawanPeduliGetHelp</span>
                          <div>
                              <a href="<?= base_url('campaign/') . $d['slug'] ?>" class="text-10"><?= $d['nama_campaign']; ?></a>
                              <span class="text-black text-15" style="margin-left:0.1em;margin-right:0.1em">•</span>
                              <span class="text-14"><?= time_ago($d['transaction_time']) ?></span>
                          </div>
                      </div>
                  </div>
                  <div class="mt-2">
                      <span class="text-15"><?= $d['doa']; ?></span>
                  </div>
              </div>
          <?php endforeach; ?>
      </div>
  </div>

  <!-- End of Doa-doa donatur -->

  <section class="section-gap ">
      <div class="container ">
          <div class="row d-flex justify-content-center mb-4 ">

              <div class="col-md-6 mb-2 ">
                  <div class="card border border-secondary ">
                      <div class="card-body d-flex ">
                          <div class="mx-2 my-3 " style="width:20% ">
                              <i class="far fa-handshake fa-4x " aria-hidden="true "></i>
                          </div>
                          <div class="mx-3 ">
                              <p style="margin-bottom:20px;font-size:16px; ">
                                  <b>Mau bantu mereka yang membutuhkan? Yuk donasi</b>
                              </p>
                              <a class="btn btn-outline-primary " href="<?= base_url('campaign') ?>">Donasi Sekarang</a>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-md-6 mb-2 ">
                  <div class="card border border-secondary ">
                      <div class="card-body d-flex ">
                          <div class="mx-2 my-3 " style="width:20% ">
                              <i class="fas fa-archive fa-4x " aria-hidden="true "></i>
                          </div>
                          <div class="mx-3 ">
                              <p style="margin-bottom:20px;font-size:16px; ">
                                  <b>Jadi relawan GetHelp dan galang dana bagi yang membutuhkan</b>
                              </p>
                              <a class="btn btn-outline-primary " href="<?= base_url('panduan-galang-dana') ?>">Galang Dana</a>
                          </div>
                      </div>
                  </div>
              </div>

          </div>
      </div>
  </section>
  <div class="container">
      <div class="row justify-content-between align-items-center mb-4 mt-3">
          <div class="col-12 text-center">
              <h3>Bagaimana cara berdonasi di gethelp?</h3>
          </div>
      </div>
      <div class="row justify-content-center mb-5">
          <div class="col-md-6 col-md-offset-3">
              <div class="embed-responsive" style="width:100%;height:350px;margin:0 auto;">
                  <iframe class="w-100 embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/HV_P2qYckVo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
          </div>
      </div>
  </div>
  <div class="container ">
      <div class="row justify-content-between align-items-center border border-primary site-section mb-5 ">
          <div class="col-12 ">
              <div class="row mx-3 my-3 ">
                  <div class="col-md-12 ">
                      <div class="heading-20219 ">
                          <h2 class="title text-black text-cursive ">Kenapa Memilih
                              <img src="<?= base_url('assets/img/logo.png') ?> " alt="GetHelp " style="width:170px;height:100px;margin-bottom:-20px; ">
                          </h2>
                          <p class="text-black mt-1 ">#GetHelp Hidup Untuk Berbagi</p>
                      </div>
                  </div>
              </div>
              <div class="row mx-3 ">
                  <div class="col-md-6 mb-4 ">
                      <div class="feature-29012 d-flex ">
                          <div class="number mr-4 ">
                              <span>1</span>
                          </div>
                          <div>
                              <h3 class="text-primary ">Donasi yang Telah Terseleksi</h3>
                              <p>Selektif, hanya galang dana yang real yang dapat dilakukan di GetHelp, bukan asal-asalan</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6 mb-2 ">
                      <div class="feature-29012 d-flex ">
                          <div class="number mr-4 ">
                              <span>2</span>
                          </div>
                          <div>
                              <h3 class="text-primary ">Praktis</h3>
                              <p>Berbagi dengan yang lain dari manapun dan kapanpun, cukup dengan HP pun bisa</p>
                          </div>
                      </div>
                  </div>

                  <div class="col-md-6 mb-2 ">
                      <div class="feature-29012 d-flex ">
                          <div class="number mr-4 ">
                              <span>3</span>
                          </div>
                          <div>
                              <h3 class="text-primary ">Tepat Sasaran</h3>
                              <p>Program penggalangan dana di GetHelp dapat dipertanggungjawabkan kebenarannya</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6 mb-3 ">
                      <div class="feature-29012 d-flex ">
                          <div class="number mr-4 ">
                              <span>4</span>
                          </div>
                          <div>
                              <h3 class="text-primary ">Transparan</h3>
                              <p>Penyaluran dana dilakukan secara transparan</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  </div>

  <!-- Modal Doa-doa Donatur -->
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
                              <?php foreach ($doamodal as $d) : ?>
                                  <div class="mb-4">
                                      <div class="d-flex flex-row user-info">
                                          <img class="rounded-circle" src="<?= base_url('assets/img/users/profile/default.png') ?>" width="40" height="40">
                                          <div class="d-flex flex-column justify-content-start ml-2">
                                              <span class="d-block font-weight-bold name">#KawanPeduliGetHelp</span>
                                              <div>
                                                  <a href="<?= base_url('campaign/') . $d['slug'] ?>" class="text-14"><?= $d['nama_campaign']; ?></a>
                                                  <span class="text-black text-14" style="margin-left:0.1em;margin-right:0.1em">•</span>
                                                  <span class="text-14"><?= time_ago($d['transaction_time']) ?></span>
                                              </div>
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