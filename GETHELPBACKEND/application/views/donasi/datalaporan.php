<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item"><a>Donasi</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('donasi/report'); ?>">Data Laporan</a></li>
        </ol>
    </nav>


    <div class="row">
        <div class="col-lg">




            <?= $this->session->flashdata('message'); ?>




            <!-- DataTales  -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Campaign</th>
                                    <th>Pelapor</th>
                                    <th>Email</th>
                                    <th>Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($laporan as $la) : ?>
                                    <tr>
                                        <td scope="row"><?= $i ?></td>
                                        <td><?= $la['nama_campaign']; ?></td>
                                        <td><?= $la['nama']; ?></td>
                                        <td><?= $la['email']; ?></td>
                                        <td><?= $la['kategori']; ?></td>
                                        <td class="text-center">
                                            <a class="text-primary" data-toggle="modal" data-target="#detailmodal" id="btndetailreport" data-id="<?= $la['id']; ?>" data-campaign="<?= $la['nama_campaign']; ?>" data-pelapor="<?= $la['nama']; ?>" data-nohp="<?= $la['nomorhp']; ?>" data-detail="<?= $la['detail']; ?>" data-foto="<?= base_url('donasi/download/') . $la['foto_bukti']; ?>" data-email="<?= $la['email']; ?>" data-kategori="<?= $la['kategori']; ?>"><i class="fas fa-eye"></i></a>
                                            <a href="<?= base_url('donasi/reportdelete/') . $la['id'] ?>" class="text-danger" onClick="return confirm('anda yakin mau hapus report ini?')"><i class="fas fa-trash-alt"></i></a>
                                        </td>

                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="detailmodal" tabindex="-1" aria-labelledby="detailmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white font-weight-bolder" id="detailmodalLabel">Detail Laporan</h4>
                <button type="button" class="text-white close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nmc">Nama Campaign</label>
                        <input type="text" class="form-control" id="nmc" name="nmc" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Nama Pelapor</label>
                        <input type="text" class="form-control" id="namapelapor" name="nama" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Nomor hp pelapor</label>
                        <input type="text" class="form-control" id="nohppelapor" name="nohp" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="emailpelapor" name="email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Kategori Laporan</label>
                        <input type="text" class="form-control" id="kategorilaporan" name="kategori" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">detail</label>
                        <textarea class="form-control" id="detail" rows="3" name="detail" readonly></textarea>
                    </div>
                    <a id="download-btn">Download foto</a>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>