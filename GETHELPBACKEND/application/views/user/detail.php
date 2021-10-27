<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Users</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('users'); ?>">List Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Data</li>
        </ol>
    </nav>

    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-7 col-md-12">
                    <div class="card user-card-full" style="width: 40rem;;">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25"> <img src="<?= base_url('assets/img/users/profile/') . $users['image'] ?>" class="img-radius" alt="User-Profile-Image"> </div>
                                    <h6 class="f-w-600 text-capitalize" style="font-size: 20px;">
                                        <?= $users['nama']; ?>
                                        <?php
                                        if ($users['verifikasi'] != 1) {
                                        ?>

                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?= base_url('assets/img/verified.png') ?>" alt="verified akun" style="width: 18px !important; height: 18px !important;">
                                        <?php } ?>
                                    </h6>
                                    <p class="text-capitalize"><?= $users['jenis_akun']; ?></p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information User</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <h6 class="text-muted f-w-400"><?= $users['email']; ?></h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Phone</p>
                                            <h6 class="text-muted f-w-400"><?= $users['phone']; ?></h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Alamat</p>
                                            <?php
                                            if ($users['alamat']  != '') {
                                            ?>
                                                <h6 class="text-muted f-w-400 text-capitalize"><?= $users['alamat']; ?></h6>
                                            <?php
                                            } else {
                                            ?>
                                                <h6 class="text-muted f-w-400 text-capitalize">Belum Ada Alamat</h6>
                                            <?php } ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Tanggal Dibuat</p>
                                            <h6 class="text-muted f-w-400 text-capitalize"><?= date('d F Y', strtotime($users['tanggal_dibuat'])) ?></h6>
                                        </div>
                                    </div>
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Document User</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">KTP</p>
                                            <?php
                                            if ($users['ktp'] != '') {
                                            ?>
                                                <a href="<?= base_url('users/download/')  . $users['ktp']  ?>">
                                                    <h6 class="text-white f-w-400 btn btn-primary">Download</h6>
                                                </a>
                                            <?php } else {
                                            ?>
                                                <h6 class="text-muted f-w-400 text-capitalize">Belum upload ktp</h6>
                                            <?php } ?>

                                        </div>

                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Selfie KTP</p>
                                            <?php
                                            if ($users['selfie_ktp'] != '') {
                                            ?>
                                                <a href="<?= base_url('users/downloadselfie/') . $users['selfie_ktp']  ?>">
                                                    <h6 class="text-white f-w-400 btn btn-primary">Download</h6>
                                                </a>
                                            <?php } else {
                                            ?>
                                                <h6 class="text-muted f-w-400 text-capitalize">Belum upload foto selfie ktp</h6>
                                            <?php } ?>
                                        </div>
                                        <?php
                                        if ($users['jenis_akun'] != 'Yayasan') {
                                        ?>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="col-sm-6">
                                                <p class="m-b-10 f-w-600">NPWP</p>
                                                <?php
                                                if ($users['npwp'] != '') {
                                                ?>
                                                    <a href="<?= base_url('users/downloadnpwp/') . $users['npwp'] ?>">
                                                        <h6 class="text-white f-w-400 btn btn-primary">Download</h6>
                                                    </a>
                                                <?php } else {
                                                ?>
                                                    <h6 class="text-muted f-w-400 text-capitalize">Belum upload npwp</h6>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->