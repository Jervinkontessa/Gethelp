    <!-- Breadcrumb Halaman -->
    <section class="section-gap-bottom">
        <div class="web-version">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Donasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Content Of Campaign -->

    <!-- Banner -->
    <div class="banner-campaign bg-campaign text-justify">
        <div class="container">
            <div class="row">
                <?php if ($cariuser == '') { ?>
                    <div class="col-lg-9">
                        <h2 class="fa-2x text-black">
                            Campaign GetHelp
                        </h2>
                        <p>#GetHelp ~ Hidup Untuk Berbagi</p>
                        <p><?= 'Mendapatkan' . ' ' . $total_baris . ' ' . 'data donasi' ?></p>
                    </div><?php } else { ?>
                    <div class="col-lg-9">
                        <h3 class="text-black" style="letter-spacing:0;">
                            Daftar Donasi <?= $cariuser ?>
                        </h3>
                        <p><?= 'Mendapatkan' . ' ' . $total_baris . ' ' . 'data donasi' ?></p>
                    </div>
                <?php } ?>
                <div class="col-lg-3">
                    <div class="form-group">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <?php if (null != $this->input->get('c')) { ?>

                                    <button type="button" style="color:#007bff;background-color:#fff;border:1px solid #007bff;width: 100%;" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?= $this->input->get('c'); ?>
                                    </button>
                                <?php } else { ?>
                                    <button type="button" style="color:#007bff;background-color:#fff;border:1px solid #007bff;width: 100%;" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Pilih Kategori
                                    </button>
                                <?php } ?>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="<?= base_url('campaign/all') ?>">Semuanya</a>
                                    <?php if ($cariuser == '') { ?>
                                        <?php foreach ($category as $c) : ?>
                                            <a class="dropdown-item" href="<?= base_url('campaign?c=') . $c['nama'] ?>"><?= $c['nama']; ?></a>
                                        <?php endforeach; ?>
                                    <?php } else { ?>
                                        <?php foreach ($category as $c) : ?>
                                            <a class="dropdown-item" href="<?= base_url('campaign?c=') . $c['nama'] . '&u=' . $cariuser ?>"><?= $c['nama']; ?></a>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Campaign -->
    <div class="popular_causes_area section_padding py-3">
        <div class="container">
            <div class="row">
                <?php if (empty($campaign)) { ?>
                    <div class="col-md-12 text-center">
                        <h4>Data tidak ditemukan</h4>
                    </div>
                <?php }; ?>
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

    <!-- Pagination -->
    <div class="paginasi pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">

                    <?= $this->pagination->create_links(); ?>

                </div>
            </div>
        </div>
    </div>

    <!-- End Campaign -->