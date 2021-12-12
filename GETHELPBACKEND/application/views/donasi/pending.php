<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Donasi</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('donasi/pending'); ?>">List Data</a></li>
        </ol>
    </nav>


    <div class="row">
        <div class="col-lg">

            <?= form_error('namacampaign', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= form_error('tanggalberakhir', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= form_error('targetdonasi', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= form_error('cerita', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= form_error('category', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('error_msg'); ?>


            <?= $this->session->flashdata('message'); ?>



            <!-- DataTales  -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Campaign</th>
                                    <th>Di Buat oleh</th>
                                    <th>Tanggal dibuat</th>
                                    <th>Tanggal Berakhir</th>
                                    <th>Donasi Terkumpul</th>
                                    <th>Target Dana</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($donasi as $d) : ?>
                                    <tr>
                                        <td scope="row"><?= $i ?></td>
                                        <td><?= $d['nama_campaign'] ?></td>
                                        <td><?= $d['nama'] ?></td>
                                        <td><?= date('d F Y', strtotime($d['tanggal_dibuat'])) ?></td>
                                        <td><?= date('d F Y', strtotime($d['tanggal_berakhir'])) ?></td>
                                        <td><?= "Rp " . number_format($d['donasi_terkumpul'], 0, ',', '.'); ?></td>

                                        <td><?= "Rp " . number_format($d['target_donasi'], 0, ',', '.'); ?></td>
                                        <td class="text-center">
                                            <a class="text-warning" href="<?= base_url('donasi/pendingdetail/') . $d['slug'] ?>"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->