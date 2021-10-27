<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center mb-4">
                                    <h1 class="h4 mb-4 text-primary ">Login Page</h1>
                                    <img src="<?= base_url('assets/img/')  ?>gethelplogo.png" width="38%">
                                </div>
                                <?= $this->session->flashdata('message'); ?>
                                <form class="user" method="POST" action="<?= base_url('auth');  ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email');  ?>">
                                        <?= form_error('email', ' <small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', ' <small class="text-danger pl-3">', '</small>'); ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block font-weight-bold">
                                        Login
                                    </button>

                                </form>
                                <hr>
                                <div class="text-center text-primary">
                                    <h6 class="font-weight-bold">~Hidup Untuk Saling Bantu~</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>