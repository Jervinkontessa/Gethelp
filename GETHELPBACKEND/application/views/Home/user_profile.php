<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard ~ GetHelp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

    <link rel="shortcut icon" href="<?= base_url('assets/img/profile/') ?>default.jpeg">
    <!-- Custom CSS File-->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/user-profil.css">
    <!-- Custom JS FIle-->
    <script src="<?= base_url('assets') ?>/js/uidev.js"></script>
    <!-- Responsive CSS File-->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/responsive.css">



</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?= base_url() ?>">
            <img src="<?= base_url('assets') ?>/img/logo.png" alt="logo" style="width:90px;height:45px">
        </a>


        <ul class="navbar-nav mr-auto"></ul>
        <div class="btn-group" style="float:right;">
            <button type="button" style="color:#000;background-color:transparent;border:none;" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= $user['nama']; ?>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="<?= base_url('home') ?>">Beranda</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url('userlogout'); ?>">Keluar</a>
            </div>
        </div>
        </div>
    </nav>



    <div class="container">

        <div class="row gutters-sm mt-100">

            <div class="col-md-12">
                <?php
                if ($user['verifikasi'] == 0) {
                ?>
                    <div class="alert alert-info mb-4" role="alert">
                        Akun Anda belum terverifikasi, kirim dokumen verifikasi untuk dapat mulai membuat program penggalangan dana.
                        <a href="<?= base_url('verifikasi-akun') ?>">Klik disini</a>
                    </div>
                <?php } elseif ($user['verifikasi'] == 2) {  ?>
                    <div class="alert alert-success mb-4" role="alert">
                        Akun Anda dalam proses verifikasi silahkan cek email kamu, Terima kasih telah melakukan verifikasi akun anda.
                    </div>
                <?php } else { ?>

                <?php } ?>
                <?php if (null != $this->session->flashdata('error_msg')) { ?>
                    <div class="alert alert-danger mb-2" role="alert">
                        <?= $this->session->flashdata('error_msg'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } else { ?>
                <?php } ?>
                <?php if (null != $this->session->flashdata('error_msg2')) { ?>
                    <div class="alert alert-danger mb-2" role="alert">
                        <?= $this->session->flashdata('error_msg2'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } else { ?>
                <?php } ?>

                <?php if (null != $this->session->flashdata('message2')) { ?>
                    <div class="alert alert-success mb-2" role="alert">
                        <?= $this->session->flashdata('message2'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } else { ?>
                <?php } ?>

                <?php if (null != $this->session->flashdata('message')) { ?>
                    <div class="alert alert-success mb-4" role="alert">
                        <?= $this->session->flashdata('message'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } else { ?>
                <?php } ?>


            </div>


            <div class="col-md-4 d-none d-md-block">

                <div class="card">
                    <div class="card-body">
                        <nav class="nav flex-column nav-pills nav-gap-y-1">
                            <a href="#dashboard" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded active">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home mr-2">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>Dashboard
                            </a>
                            <a href="#profile" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>Profil
                            </a>
                            <a href="#account" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings mr-2">
                                    <circle cx="12" cy="12" r="3"></circle>
                                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                </svg>Pengaturan
                            </a>
                            <a href="#campaign" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag mr-2">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>Program Campaign
                            </a>
                            <a href="#my-donate" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-history mr-2">
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                    <path d="M2 13.24a9.67 9.67 0 0 0 2.71 5.83 10.2 10.2 0 0 0 14.32 0 9.89 9.89 0 0 0 0-14.14 10.2 10.2 0 0 0-13.52-.7C5.24 4.44 2.26 7.74 2 8"></path>
                                    <path d="M6 9H1V4"></path>
                                </svg>Riwayat Donasi
                            </a>
                        </nav>
                    </div>
                </div>
            </div>


            <div class="col-md-8 mb-5">
                <div class="card">
                    <div class="card-header border-bottom mb-3 d-flex d-md-none">
                        <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                            <li class="nav-item">
                                <a href="#dashboard" data-toggle="tab" class="nav-link has-icon active">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home mr-2">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#profile" data-toggle="tab" class="nav-link has-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#account" data-toggle="tab" class="nav-link has-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                                        <circle cx="12" cy="12" r="3"></circle>
                                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                    </svg>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#campaign" data-toggle="tab" class="nav-link has-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#my-donate" data-toggle="tab" class="nav-link has-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-history">
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                        <path d="M2 13.24a9.67 9.67 0 0 0 2.71 5.83 10.2 10.2 0 0 0 14.32 0 9.89 9.89 0 0 0 0-14.14 10.2 10.2 0 0 0-13.52-.7C5.24 4.44 2.26 7.74 2 8"></path>
                                        <path d="M6 9H1V4"></path>
                                    </svg>
                                </a>
                            </li>

                    </div>

                    <div class="card-body tab-content">

                        <div class="tab-pane active" id="dashboard">
                            <h6>Selamat Datang <?= $user['nama']; ?></h6>
                            <hr>
                            <form>
                                <div class="form-group">
                                    <label class="d-block mb-0">Terima kasih telah menjadi bagian dari #GetHelp</label>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="verifikasi-akun">
                            <h6>Verifikasi Akun</h6>
                            <hr>
                            <form>
                                <div class="form-group">
                                    <label class="d-block mb-0"></label>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="profile">
                            <h6>Informasi Profil Anda</h6>
                            <hr>
                            <form action="<?= base_url('usersprofile') ?>" method="POST" enctype="multipart/form-data">
                                <div class="media align-items-center">
                                    <?php if ($user['image'] != '') { ?>
                                        <img src="<?= base_url('assets/img/users/profile/') . $user['image'] ?>" alt="profile user" class="d-block ui-w-80 rounded-circle img-preview">
                                    <?php } else { ?>
                                        <img src="<?= base_url('assets/img/users/profile/default.png') ?>" alt="profile user" class="d-block ui-w-80 rounded-circle img-preview">
                                    <?php }; ?>
                                    <div class="form-group mr-auto">
                                        <div class="media-body ml-4">
                                            <label class="btn btn-outline-primary">
                                                Ganti Foto
                                                <input type="hidden" id="oldimage" name="oldimage" value="<?= $user['image']; ?>">
                                                <input type="file" class="account-settings-fileinput custom-file-input" name="image" id="image">
                                            </label> &nbsp;
                                            <div class="text-black small mt-1">File: jpg, png, jpeg. Maks ukuran file. 1MB</div>
                                        </div>
                                    </div>
                                    <?php if ($user['verifikasi'] != 0) { ?>
                                        <span class="badge bg-success text-white mr-4">Terverifikasi</span>
                                    <?php } else { ?>
                                    <?php }; ?>
                                </div>

                                <hr class="border-grey mt-2">

                                <div class="form-group">
                                    <label for="userName">Username</label>
                                    <input type="text" class="form-control" id="userName" placeholder="Username" name="username" value="<?= $user['nama']; ?>">
                                    <?= form_error('username', ' <small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?= $user['email']; ?> " readonly>

                                </div>
                                <?php if ($biodata != null) { ?>
                                    <div class="form-group">
                                        <label for="phone">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Nomor telepon" value="<?= $biodata['phone']; ?>">
                                        <?= form_error('phone', ' <small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="bio">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat anda" value="<?= $biodata['alamat']; ?>">
                                        <?= form_error('alamat', ' <small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group">
                                        <label for="phone">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Nomor telepon" readonly>
                                        <?= form_error('phone', ' <small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="bio">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat anda" readonly>
                                        <?= form_error('alamat', ' <small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                <?php } ?>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>

                        <div class="tab-pane" id="account">
                            <h6>Pengaturan Akun</h6>
                            <hr>
                            <?php if ($user['password'] != '') { ?>
                                <form action="<?= base_url('usersprofile/newpassword') ?>" method="POST">
                                    <div class="form-group">
                                        <label class="d-block">Ubah Password</label>
                                        <input type="text" class="form-control" placeholder="Password sekarang" id="passsekarang" name="passsekarang">
                                        <?= form_error('passsekarang', ' <small class="text-danger pl-3">', '</small>'); ?>
                                        <input type="text" class="form-control mt-3" placeholder="Password baru" id="passbaru" name="passbaru">
                                        <?= form_error('passbaru', ' <small class="text-danger pl-3">', '</small>'); ?>
                                        <input type="text" class="form-control mt-3" placeholder="Konfirmasi password baru" id="repeatpass" name="repeatpass">
                                        <?= form_error('repeatpass', ' <small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Simpan perubahan</button>&nbsp;
                                    </div>
                                </form>
                            <?php } else { ?>
                                <form action="<?= base_url('usersprofile/newpassword') ?>" method="post">
                                    <div class="form-group">
                                        <label class="d-block">Buat Password</label>
                                        <input type="text" class="form-control mt-3" placeholder="Password baru" id="password1" name="password1">
                                        <?= form_error('password1', ' <small class="text-danger pl-3">', '</small>'); ?>
                                        <input type="text" class="form-control mt-3" placeholder="Konfirmasi password" id="password2" name="password2">
                                        <?= form_error('password2', ' <small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Simpan</button>&nbsp;
                                    </div>
                                </form>
                            <?php }; ?>
                            <hr>
                            <form action="<?= base_url('usersprofile/hapusakun') ?>" method="POST">
                                <div class="form-group">
                                    <label for="username">Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="Masukkan Email Anda Untuk Konfirmasi Hapus Akun" name="email" required>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="d-block text-danger">Hapus Akun</label>
                                    <p class="text-muted font-size-sm">Setelah Anda menghapus akun Anda, maka anda tidak bisa login dengan akun anda ini dan tidak bisa dikembalikan lagi. Harap dipertimbangkan dengan baik.</p>
                                </div>

                                <button class="btn btn-danger" type="submit" onClick="return confirm('anda yakin mau hapus akun ini?')">Hapus</button>

                            </form>
                        </div>

                        <div class="tab-pane" id="campaign">
                            <h6>Daftar Campaign</h6>


                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" style="min-height: 10px !important;">
                                        <thead>
                                            <th>#</th>
                                            <th style="width: 25%;">Nama Campaign</th>
                                            <th>Total Donasi</th>
                                            <th>Target Donasi</th>
                                            <th style="width: 15%;">Status</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php if (null != $campaignuser) { ?>
                                                <?php foreach ($campaignuser as $d) : ?>
                                                    <tr>

                                                        <td><?= $i ?></td>
                                                        <td><?= $d['nama_campaign']; ?></td>
                                                        <td><?= "Rp " . number_format($d['donasi_terkumpul'], 0, ',', '.'); ?></td>
                                                        <td><?= "Rp " . number_format($d['target_donasi'], 0, ',', '.'); ?></td>
                                                        <td>
                                                            <?php if ($d['status'] == 0) { ?>
                                                                <span class="badge bg-success text-white">Telah Berakhir</span>
                                                            <?php } elseif ($d['status'] == 1) { ?>
                                                                <span class="badge bg-primary text-white">Sedang Berjalan</span>
                                                            <?php } elseif ($d['status'] == 2) { ?>
                                                                <span class="badge bg-warning text-white">Sedang Dievaluasi</span>
                                                            <?php } else { ?>
                                                                <span class="badge bg-danger text-white">Ditolak</span>
                                                            <?php } ?>
                                                        </td>

                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php endforeach; ?>
                                            <?php } else { ?>
                                                <tr>
                                                    <td class="text-center" colspan="6">Belum ada Program/Campaign</td>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="my-donate">
                            <h6>Donasi Saya Yang Berhasil</h6>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" style="min-height: 10px !important;">
                                        <thead>
                                            <th>#</th>
                                            <th style="width: 25%;">Campaign</th>
                                            <th>Pembayaran</th>
                                            <th>Waktu</th>
                                            <th style="width: 20%;">Jumlah</th>
                                            <th>Status</th>

                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php if (null != $donasiuser) { ?>
                                                <?php foreach ($donasiuser as $d) : ?>
                                                    <tr>

                                                        <td><?= $i ?></td>
                                                        <td><?= $d['nama_campaign']; ?></td>
                                                        <td><?= $d['payment_type']; ?></td>
                                                        <td><?= $d['transaction_time'] ?></td>
                                                        <td><?= "Rp " . number_format($d['gross_amount'], 0, ',', '.'); ?></td>
                                                        <td class="text-center">

                                                            <span class="badge bg-success text-white">Berhasil</span>

                                                        </td>

                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php endforeach; ?>
                                            <?php } else { ?>
                                                <tr>
                                                    <td class="text-center" colspan="6">Belum ada Donasi</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.account-settings-fileinput').on('change', function() {

            const sampul = document.querySelector('#image')
            const imgpreview = document.querySelector('.img-preview')
            let filename = $(this).val().split('\\').pop();


            const filesampul = new FileReader();
            filesampul.readAsDataURL(sampul.files[0]);

            filesampul.onload = function(e) {
                imgpreview.src = e.target.result;
            }

        });
    </script>


    <!-- Bootstrap JS FIle-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?= base_url('assets'); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>


    <script src="<?= base_url('assets') ?>/js/main.js"></script>


</body>

</html>