<div class="container infinity-container">

    <div class="row">

        <div class="col-md-1 infinity-left-space"></div>

        <!-- FORM BEGIN -->
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 text-center infinity-form">
            <!-- Company Logo -->
            <div class="text-center mb-3 mt-2">

                <a href="<?= base_url() ?>">
                    <img src="<?= base_url('assets/img/logo.png') ?>" style="width: 50%;">
                </a>

            </div>
            <div class="text-center mb-4">

                <h4>Buat Password baru</h4>
            </div>
            <!-- Form -->
            <?= $this->session->flashdata('message'); ?>
            <form class="px-3" method="POST" action="<?= base_url('auth/changepassword') ?>">
                <!-- Input Box -->
                <div class="form-input">
                    <span><i class="fa fa-lock"></i></span>
                    <input type="password" id="password1" name="password1" placeholder="Silahkan Masukkan Password Baru Anda">
                    <div class="toggle" id="toggle" onclick="showHide();"><i class="fa fa-eye" id="ikon"></i></div>
                    <?= form_error('password', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-input">
                    <span><i class="fa fa-lock"></i></span>
                    <input type="password" id="password2" name="password2" placeholder="Ulangi Password">
                    <div class="toggle" id="toggle" onclick="showHide();"><i class="fa fa-eye" id="ikon"></i></div>
                    <?= form_error('password2', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <!-- Login Button -->
                <div class="mb-5">
                    <button type="submit" class="btn btn-block">Ganti Password</button>
                </div>




            </form>
        </div>
        <!-- FORM END -->

        <div class="col-md-1 infinity-right-space"></div>
    </div>
</div>