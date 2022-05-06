<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Halaman tidak ditemukan</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <!-- Bootstrap 4 CDN-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Jquery Library File-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/error.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/profile/') ?>default.jpeg">
</head>

<body style="background-color: hsl(0, 0%, 90%);">
    <div class="page_404" style="background-color: hsl(0, 0%, 90%);">
        <div class="container ">
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-center text-center">
                    <div class="col-sm-10 col-sm-offset-1  text-center">
                        <div class="four_zero_four_bg">
                            <img src="<?= base_url('assets/img/frontend/404img.png') ?>" alt="404 image">
                        </div>
                        <div class="contant_box_404">
                            <h3 class="h2">
                                Maaf, sepertinya halaman ini tidak ditemukan
                            </h3>

                            <p>Halaman yang kamu cari tidak ada di website kami atau sedang mengalami gangguan</p>

                            <a href="<?= base_url() ?>" class="link_404">Kembali ke halaman utama</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>