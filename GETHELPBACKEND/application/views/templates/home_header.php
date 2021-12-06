<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <!-- Fontawesome CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <!-- Bootstrap 4 CDN-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Jquery Library File-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Custom CSS File-->
    <?php if ($css != 'css2' && $css != 'summernote' && $css != 'donate') { ?>
        <link rel="stylesheet" href="<?= base_url('assets/css/uidev1.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/uidev2.min.css') ?>">
    <?php } elseif ($css == 'donate') { ?>
        <link rel="stylesheet" href="<?= base_url('assets/css/uidev1.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/uidev2.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/style_frontend2.css') ?>">
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-85myPC57TxX7q4qH"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <?php } elseif ($css == 'summernote') {  ?>
        <link rel="stylesheet" href="<?= base_url('assets/summernote/')  ?>summernote-bs4.css">
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css">
        <link rel="stylesheet" href="<?= base_url('assets/css/uidev1.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/uidev2.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/style_frontend.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/style_frontend2.css') ?>">
    <?php } else { ?>
        <link rel="stylesheet" href="<?= base_url('assets/css/uidev1.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/uidev2.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/style_frontend.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/style_frontend2.css') ?>">
    <?php } ?>
    <!-- Custom JS FIle-->
    <script src="<?= base_url('assets/js/uidev.js') ?>"></script>
    <!-- Responsive CSS File-->
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.min.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/profile/') ?>default.jpeg">
</head>

<body>