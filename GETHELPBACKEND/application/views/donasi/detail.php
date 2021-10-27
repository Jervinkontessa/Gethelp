<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Donasi</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('donasi'); ?>">List Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Data</li>
        </ol>
    </nav>

    <div class="row">
        <div class=" mx-auto">

            <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 27rem; ">
                <img class="card-img-top" src="<?= base_url('assets/img/donasithumb/') . $donasi['gambar'] ?>" alt="Card image cap" width="30%">
                <div class="card-body">
                    <h5 class=" pb-2 text-dark" style="font-size: 16px;">

                        <?= $donasi['nama_campaign']; ?>
                        <span class="badge badge-secondary " style="float: right; font-size: 10px;"><?= $donasi['cnama']; ?></span>
                    </h5>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?= (int)$donasi['donasi_terkumpul'] / (int)$donasi['target_donasi'] * 100 ?>%"></div>
                    </div>

                    <p style="font-size: 0.7em;">
                        <span class=" font-weight-bold text-success"><?= "Rp " . number_format($donasi['donasi_terkumpul'], 0, ',', '.'); ?></span>
                        <span class="text-muted">Terkumpul dari </span>
                        <?= "Rp " . number_format($donasi['target_donasi'], 0, ',', '.'); ?>
                    </p>
                    <p class="card-text font-weight-bold" style=""><?= $donasi['nama']; ?>
                        <img src="<?= base_url('assets/img/verified.png') ?>" alt="" style="width: 10px !important; height: 10px !important;">
                    </p>

                    <div class="pt-2 align-items-center d-flex justify-content-center">
                        <a href="#" class="btn btn-primary text-right">Donasi Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->