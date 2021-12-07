<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Donasi</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('donasi/selesai'); ?>">List Data</a></li>
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
                                        <td><?= date('d F Y', strtotime($d['tanggal_dibuat'])) ?></td>
                                        <td><?= date('d F Y', strtotime($d['tanggal_berakhir'])) ?></td>
                                        <td><?= "Rp " . number_format($d['donasi_terkumpul'], 0, ',', '.'); ?></td>
                                        <td><?= "Rp " . number_format($d['target_donasi'], 0, ',', '.'); ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('donasi/edit/') . $d['slug'] ?>" class="text-warning"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url('donasi/delete/') . $d['slug'] ?>" class="text-danger" onClick="return confirm('anda yakin mau hapus campaign ini?')"><i class="fas fa-trash-alt"></i></a>
                                            <a href="<?= base_url('donasi/update/') . $d['slug'] ?>" class="text-darken"><i class="fas fa-plus"></i></a>
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
<!-- Modal -->
<div class="modal fade" id="uploadbuktimodal" tabindex="-1" aria-labelledby="uploadbuktimodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white font-weight-bolder" id="uploadbuktimodalLabel">Upload Bukti</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('donasi/uploadbukti') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="slug" id="slug" value="">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="image">Upload Bukti Transfer Berupa Gambar, Max Ukuran Gambar 4 MB</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>