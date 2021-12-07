<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Donasi</a></li>
            <?php if ($donasi['status'] == 1) { ?>
                <li class="breadcrumb-item "><a href="<?= base_url('donasi'); ?>">List Data</a></li>
            <?php } else { ?>
                <li class="breadcrumb-item "><a href="<?= base_url('donasi/selesai'); ?>">List Data</a></li>
            <?php }; ?>
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
    </nav>

    <?= $this->session->flashdata('error_msg'); ?>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $donasi['campaign_id']; ?>">
                        <div class="form-group">
                            <label for="namacampaign">Nama Campaign</label>
                            <input type="text" class="form-control" id="namacampaign" name="namacampaign" value="<?= $donasi['nama_campaign'] ?>">
                            <?= form_error('namacampaign', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="date">Tanggal Donasi Berakhir</label>
                            <input type="date" class="form-control" id="tanggalberakhir" name="tanggalberakhir" value="<?= $donasi['tanggal_berakhir']; ?>">
                            <?= form_error('tanggalberakhir', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="targetdonasi">Target Donasi</label>
                            <input type="text" class="form-control targetdonasi" id="targetdonasi" name="targetdonasi" value="<?= "Rp " . number_format($donasi['target_donasi'], 0, ',', '.'); ?>">
                            <?= form_error('targetdonasi', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="targetdonasi">Jumlah dicairkan</label>
                            <input type="text" class="form-control targetdonasi" id="jumlahdicairkan" name="jumlahdicairkan" value="<?= "Rp " . number_format($donasi['jumlah_dicairkan'], 0, ',', '.'); ?>">
                            <?= form_error('jumlahdicairkan', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="category">Ganti Category Yang Sesuai</label>
                            <select name="category" id="category" class="form-control">
                                <?php foreach ($category as $c) : ?>
                                    <?php if ($c['id'] == $donasi['category_id']) : ?>
                                        <option value="<?= $c['id'] ?>" selected><?= $c['nama']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $c['id'] ?>"><?= $c['nama']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('category', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/img/donasithumb/') . $donasi['gambar'] ?>" class="img-thumbnail img-preview">
                            </div>
                            <div class="col-sm-9">
                                <label for="image">Ganti Gambar, Max Ukuran Gambar 2 MB</label>
                                <div class="custom-file">
                                    <input type="hidden" name="old_image" value="<?= $donasi['gambar'] ?>">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Ubah Status</label>
                            <select name="status" id="status" class="form-control">
                                <?php if ($donasi['status'] == '1') { ?>
                                    <option value="1" selected>Sedang Berjalan</option>
                                    <option value="0">Tidak Berjalan</option>
                                <?php } else { ?>
                                    <option value="1">Sedang Berjalan</option>
                                    <option value="0" selected>Tidak Berjalan</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="target">Ubah Cerita</label>
                            <textarea class="form-control summernote" id="cerita" rows="3" name="cerita"><?= $donasi['cerita'] ?></textarea>
                            <?= form_error('cerita', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        </div>

                        <div class="form-group row justify-content-center">
                            <button type="submit" name="edit" class="btn btn-primary center-block" style="width: 80px;">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>



<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->