<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Users</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('users'); ?>">List Data Users</a></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg">
            <?= form_error('nama', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= form_error('email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= form_error('password', '<div class="alert alert-danger" role="alert">', '</div>'); ?>



            <?= $this->session->flashdata('message'); ?>



            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama User</th>
                                    <th>jenis_akun</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Tanggal dibuat</th>
                                    <th>Dokumen</th>
                                    <th>Verifikasi</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($users as $adm) : ?>
                                    <tr>
                                        <td scope="row"><?= $i ?></td>
                                        <td><?= $adm['nama'] ?></td>
                                        <td><?= $adm['jenis_akun']; ?></td>
                                        <td><?= $adm['email'] ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($adm['phone'] != '') {
                                            ?>
                                                <?= $adm['phone']  ?>
                                            <?php
                                            } else {
                                            ?>
                                                <span class="badge bg-danger text-white">Belum memberikan nomor</span>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center"><?= date('d F Y', strtotime($adm['tanggal_dibuat'])) ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($adm['jenis_akun'] = 'Individu' && $adm['ktp'] != '' && $adm['selfie_ktp'] != '') {
                                            ?>
                                                <span class="badge bg-success text-white">Dokumen sudah di upload lengkap</span>
                                            <?php
                                            } elseif ($adm['jenis_akun'] = 'Yayasan' && $adm['ktp'] != '' && $adm['selfie_ktp'] != '' && $adm['npwp'] != '') {
                                            ?>
                                                <span class="badge bg-success text-white">Pihak Yayasan sudah mengupload lengkap</span>
                                            <?php
                                            } else {
                                            ?>
                                                <span class="badge bg-danger text-white">Dokumen Belum Lengkap</span>
                                            <?php } ?>

                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if ($adm['verifikasi'] != 1) {
                                            ?>
                                                <span class="badge bg-danger text-white">Belum Verifikasi</span>
                                            <?php
                                            } else {
                                            ?>
                                                <span class="badge bg-success text-white">Terverifikasi</span>

                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if ($adm['status'] != 1) {
                                            ?>
                                                <span class="badge bg-danger text-white">Diblokir</span>
                                            <?php
                                            } else {
                                            ?>
                                                <span class="badge bg-success text-white">Active</span>

                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">

                                            <a class="text-warning" data-toggle="modal" data-target="#editusermodal" id="ubah-btn" data-id="<?= $adm['id']; ?>" data-nama="<?= $adm['nama']; ?>" data-email="<?= $adm['email']; ?>" data-status="<?= $adm['status']; ?>" data-verifikasi="<?= $adm['verifikasi']; ?>"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url('users/delete/') ?><?= $adm['id']; ?>" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                                            <a href="<?= base_url('users/detail/') . $adm['id'] ?>" class="text-info"><i class="fas fa-eye"></i></a>
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

<div class="modal fade" id="editusermodal" tabindex="-1" aria-labelledby="editusermodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="editusermodalLabel">Ubah Status User</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url('users/ubahstatus'); ?>" method="POST">

                <div class="modal-body">
                    <input type="hidden" readonly name="user_id" class="form-control" id="user_id">

                    <div class="form-group">
                        <label for="password">Nama Users</label>
                        <input type="text" class="form-control" id="namauser" name="nama" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="emailuser" name="email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="status">Ubah Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive/Blokir</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="verifikasi">Verifikasi Akun</label>
                        <select name="verifikasi" id="verifikasi" class="form-control verifikasi">
                            <option value="1">Terverifikasi</option>
                            <option value="0">Belum Verifikasi</option>
                        </select>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>

        </div>
    </div>
</div>