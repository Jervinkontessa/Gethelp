<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Donasi</a></li>
            <li class="breadcrumb-item "><a href="<?= base_url('donasi'); ?>">List Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Update</li>
        </ol>
    </nav>

    <?= $this->session->flashdata('error_msg'); ?>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $donasi['campaign_id']; ?>">

                        <label for="image">Upload bukti transfer atau gambar bukti lain</label>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="bukti" name="bukti">
                            <label class="custom-file-label" for="image">Choose file</label>
                            <?= form_error('cerita', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                            <?php if ($this->session->flashdata('error_msg')) { ?>
                                <small class="text-danger pl-3"><?= $this->session->flashdata('error_msg'); ?></small>
                            <?php } else { ?>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="target">Keterangan</label>
                            <textarea class="form-control summernote" id="cerita" rows="3" name="keterangan"></textarea>
                            <?= form_error('cerita', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                        </div>
                        <div class="form-group row justify-content-center">
                            <button type="submit" name="submit" class="btn btn-primary center-block" style="width: 80px;">Submit</button>
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