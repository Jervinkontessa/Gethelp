<!-- Begin Page Content -->
<style>
    body {
        background-color: #f9f9fa
    }

    .padding {
        padding: 3rem !important
    }

    .user-card-full {
        overflow: hidden
    }

    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
        box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
        border: none;
        margin-bottom: 30px
    }

    .m-r-0 {
        margin-right: 0px
    }

    .m-l-0 {
        margin-left: 0px
    }

    .user-card-full .user-profile {
        border-radius: 5px 0 0 5px
    }

    .bg-c-lite-green {
        background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
        background: linear-gradient(to right, #ee5a6f, #f29263)
    }

    .user-profile {
        padding: 20px 0
    }

    .card-block {
        padding: 1.25rem
    }

    .m-b-25 {
        margin-bottom: 25px
    }

    .img-radius {
        border-radius: 5px
    }

    h6 {
        font-size: 14px
    }

    .card .card-block p {
        line-height: 25px
    }

    @media only screen and (min-width: 1400px) {
        p {
            font-size: 14px
        }
    }

    .card-block {
        padding: 1.25rem
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0
    }

    .m-b-20 {
        margin-bottom: 20px
    }

    .p-b-5 {
        padding-bottom: 5px !important
    }

    .card .card-block p {
        line-height: 25px
    }

    .m-b-10 {
        margin-bottom: 10px
    }

    .text-muted {
        color: #919aa3 !important
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0
    }

    .f-w-600 {
        font-weight: 600
    }

    .m-b-20 {
        margin-bottom: 20px
    }

    .m-t-40 {
        margin-top: 20px
    }

    .p-b-5 {
        padding-bottom: 5px !important
    }

    .m-b-10 {
        margin-bottom: 10px
    }

    .m-t-40 {
        margin-top: 20px
    }

    .user-card-full .social-link li {
        display: inline-block
    }

    .user-card-full .social-link li a {
        font-size: 20px;
        margin: 0 10px 0 0;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out
    }
</style>
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
                        <?php if ($users != '') { ?>
                            <div class="row m-l-0 m-r-0">
                                <div class="col-sm-4 bg-c-lite-green user-profile">
                                    <div class="card-block text-center text-white">

                                        <div class="m-b-25"> <img src="<?= base_url('assets/img/users/profile/') . $users['image'] ?>" class="img-radius" alt="User-Profile-Image" width="50px"> </div>
                                        <h6 class="f-w-600 text-capitalize" style="font-size: 20px;">
                                            <?= $users['nama_lengkap']; ?>
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
                                            <?php if ($yayasan != null) { ?>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Nama Organisasi</p>
                                                    <h6 class="text-muted f-w-400 text-capitalize"><?= $yayasan['nama_organisasi'] ?></h6>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Nama Penanggungjawab</p>
                                                    <h6 class="text-muted f-w-400 text-capitalize"><?= $yayasan['nama_pj'] ?></h6>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Telpon organisasi</p>
                                                    <h6 class="text-muted f-w-400 text-capitalize"><?= $yayasan['phone_org'] ?></h6>
                                                </div>
                                            <?php } else { ?>
                                            <?php } ?>
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
                                            <?php if ($users['jenis_akun'] != 'Individu' || $yayasan != null) { ?>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">Ktp pj</p>
                                                    <?php
                                                    if ($yayasan['ktp_pj'] != '') {
                                                    ?>
                                                        <a href="<?= base_url('users/downloadselfie/') . $yayasan['ktp_pj']  ?>">
                                                            <h6 class="text-white f-w-400 btn btn-primary">Download</h6>
                                                        </a>
                                                    <?php } else {
                                                    ?>
                                                        <h6 class="text-muted f-w-400 text-capitalize">Belum upload foto ktppj</h6>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                <?php } ?>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                <?php } else { ?>
                    <h1 class="text-center">Belum melakukan verifikasi</h1>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- /.container-fluid -->
</div>
</div>
<!-- End of Main Content -->