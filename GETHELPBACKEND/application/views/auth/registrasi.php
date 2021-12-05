<div class="container infinity-container">

    <div class="row">

        <div class="col-md-1 infinity-left-space"></div>

        <!-- FORM BEGIN -->
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 text-center infinity-form">
            <!-- Company Logo -->
            <div class="text-center mb-3 mt-2">

                <a href="<?= base_url(); ?>">
                    <img src="<?= base_url('assets/img/logo.png') ?>" style="width: 50%;">
                </a>

            </div>
            <div class="text-center mb-4">

                <h4>Daftar Akun Baru</h4>
            </div>
            <!-- Form -->
            <?= $this->session->flashdata('message'); ?>
            <form class="px-3" method="POST" action="<?= base_url('auth/registration') ?>">
                <!-- Input Box -->
                <div class="form-input">
                    <span><i class="fa fa-address-card"></i></span>

                    <input type="text" id="name" name="name" placeholder="Nama lengkap anda" value="<?= set_value('name'); ?>">
                    <?= form_error('name', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class=" form-input">
                    <span><i class="fa fa-envelope"></i></span>
                    <input type="text" id="email" name="email" placeholder="Masukkan alamat email anda" value="<?= set_value('email');  ?>">
                    <?= form_error('email', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-input">
                    <span><i class="fa fa-lock"></i></span>
                    <input type="password" id="password" name="password" placeholder="Password">
                    <div class="toggle" id="toggle" onclick="showHide();"><i class="fa fa-eye" id="ikon"></i></div>
                    <?= form_error('password', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <!-- Login Button -->
                <div class="mb-5">
                    <button type="submit" class="btn btn-block">Daftar akun</button>
                </div>

                <div class="text-center mb-2">
                    <div class="text-center mb-3 font-weight-bold text-dark">atau daftar dengan</div>

                    <!-- Google Button -->


                    <?= $login_button; ?>

                </div>
                <hr class="my-2 text-dark">
                <div class="text-center mb-4 text-dark ">Sudah punya akun?
                    <a class="font-weight-bold" href="<?= base_url('auth') ?>">Login disini</a>
                </div>
            </form>
        </div>
        <!-- FORM END -->

        <div class="col-md-1 infinity-right-space"></div>
    </div>
</div>