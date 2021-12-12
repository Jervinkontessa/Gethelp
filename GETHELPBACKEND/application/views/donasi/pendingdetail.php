<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Donasi</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('donasi/pending'); ?>">List Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail pending campaign</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <div class="row pb-3 d-flex justify-content-center">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/donasithumb/') . $donasi['gambar'] ?>" class="img-thumbnail img-preview">
                        </div>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $donasi['campaign_id']; ?>" id="id">

                        <div class="form-group">
                            <label for="namacampaign">Nama Campaign</label>
                            <input type="text" class="form-control" id="namacampaign" name="namacampaign" value="<?= $donasi['nama_campaign'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="targetdonasi">Pembuat Campaign</label>
                            <input type="text" class="form-control targetdonasi" id="pembuat" name="pembuat" value="<?= $donasi['nama'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="date">Tanggal Donasi Berakhir</label>
                            <input type="date" class="form-control" id="tanggalberakhir" name="tanggalberakhir" value="<?= $donasi['tanggal_berakhir']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="targetdonasi">Target Donasi</label>
                            <input type="text" class="form-control targetdonasi" id="targetdonasi" name="targetdonasi" value="<?= "Rp " . number_format($donasi['target_donasi'], 0, ',', '.'); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="targetdonasi">Tujuan</label>
                            <input type="text" class="form-control targetdonasi" id="tujuan" name="tujuan" value="<?= $donasi['tujuan'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="targetdonasi">Penerima Donasi</label>
                            <input type="text" class="form-control targetdonasi" id="rincian" name="rincian" value="<?= $donasi['penerima_donasi'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="category">Kategori Campaign</label>
                            <select name="category" id="category" class="form-control" readonly>
                                <?php foreach ($category as $c) : ?>
                                    <?php if ($c['id'] == $donasi['category_id']) : ?>
                                        <option value="<?= $c['id'] ?>" selected><?= $c['nama']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $c['id'] ?>"><?= $c['nama']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="status">Ubah Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Terima</option>
                                <option value="2" selected>Pending</option>
                                <option value="3">Tolak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="target">Cerita</label>
                            <textarea class="form-control summernote" id="cerita" rows="3" name="cerita" readonly><?= $donasi['cerita'] ?></textarea>

                        </div>
                        <div class="form-group">
                            <label for="target">Rincian Penggunaan dana donasi</label>
                            <textarea class="form-control summernote" id="rincian" rows="3" name="rincian" readonly><?= $donasi['rincian'] ?></textarea>
                        </div>

                        <div class="form-group row justify-content-center">
                            <button type="submit" name="edit" class="btn btn-primary center-block mr-4" style="width: 80px;">Edit</button>
                            <a class="btn btn-warning" href="<?= base_url('donasi/pending'); ?>" style="width: 80px;"> Back</a>
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