<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Donasi</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('donasi'); ?>">Data Transaksi</a></li>
        </ol>
    </nav>


    <div class="row">
        <div class="col-lg">




            <?= $this->session->flashdata('message'); ?>




            <!-- DataTales  -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <th>Nama Campaign</th>
                                    <th>Donatur</th>
                                    <th>Jumlah Donasi</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Bank</th>
                                    <th>VA Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($transaksi as $tr) : ?>
                                    <tr>
                                        <td scope="row"><?= $i ?></td>
                                        <td><?= $tr['order_id'] ?></td>
                                        <td><?= $tr['nama_campaign']; ?></td>
                                        <td><?= $tr['username']; ?></td>
                                        <td><?= "Rp " . number_format($tr['gross_amount'], 0, ',', '.'); ?></td>
                                        <td><?= date('d F Y', strtotime($tr['tanggal_transaksi'])) ?></td>
                                        <td><?= $tr['bank']; ?></td>
                                        <td><?= $tr['va_number']; ?></td>
                                        <td>
                                            <?php
                                            if ($tr['status_code'] == '200') {
                                            ?>
                                                <span class="badge bg-success text-white">Success</span>
                                            <?php
                                            } else if ($tr['status_code'] == '407') {
                                            ?>
                                                <span class="badge bg-danger text-white">Expire</span>
                                            <?php
                                            } else {
                                            ?>
                                                <span class="badge bg-warning text-white">Pending</span>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?= $tr['pdf_url'] ?>" class="btn btn-primary" target="blank">Download</a>
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