    <!-- Content Of Campaign -->

    <!-- Banner -->
    <div class="bg-verify text-center mt-8">
        <div class="container">
            <h2 class="fa-2x text-black">
                Verifikasi Akun
            </h2>
        </div>
    </div>

    <!-- MultiStep Form -->
    <div class="container py-2">
        <div class="row justify-content-center mb-50">
            <form class="form">

                <div class="progressbar">
                    <div class="progress" id="progress"></div>

                    <div class="progress-step progress-step-active" data-title="Data Diri"></div>
                    <div class="progress-step" data-title="Informasi Ketua"></div>
                    <div class="progress-step" data-title="Detail Akun"></div>
                    <div class="progress-step" data-title="Pencairan Dana"></div>
                    <div class="progress-step" data-title="Berkas"></div>
                </div>

                <div class="form-step form-step-active">
                    <div class="form-group">
                        <label for="jenis-akun">Jenis Akun
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" id="jenis-akun">
                            <option disabled selected>Pilih Salah Satu</option>
                            <option>Individu</option>
                            <option>Yayasan/NGO</option>
                            <option>Komunitas</option>
                            <option>Organisasi Mahasiswa</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Lengkap
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="nama">
                    </div>


                    <div class="form-group">
                        <label for="alamat">Alamat
                            <span class="text-danger">*</span>
                        </label>
                        <textarea cols="30" rows="0" class="form-control" for="alamat"></textarea>
                    </div>
                    <button class="btn btn-primary btn-next">Selanjutnya</button>
                </div>

                <div class="form-step">
                    <div class="form-group">
                        <label for="nama-penanggung-jawab">Nama Penanggung Jawab
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="nama-penanggung-jawab">
                    </div>

                    <div class="form-group ">
                        <label for="no-penanggung-jawab">No Hp (Whatsapp) Penanggung Jawab
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="no-penanggung-jawab">
                    </div>

                    <div class="form-group">
                        <label for="foto-ktp-pj">Foto KTP Penanggung Jawab
                            <span class="text-danger">*</span>
                        </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto-ktp-pj" id="foto-ktp-pj">
                            <label for="foto-ktp-pj" class="custom-file-label">Upload Foto</label>
                        </div>
                        <small class="text-black" style="float:right;">Format foto: jpg/jpeg/png. Maks. 2MB</small>
                    </div>
                    <br>
                    <button class="btn btn-outline-primary btn-prev">Kembali</button>
                    <button class="btn btn-primary btn-next">Selanjutnya</button>
                </div>

                <div class="form-step">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="no-pa">No Hp (Whatsapp) Pemegang Akun
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="no-pa">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ktp-pa">No KTP Pemegang Akun
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="ktp-pa">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="foto-ktp-pa">Foto KTP Pemegang Akun
                            <span class="text-danger">*</span>
                        </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto-ktp-pa" id="foto-ktp-pa">
                            <label for="foto-ktp-pa" class="custom-file-label">Upload Foto</label>
                        </div>
                        <small class="text-black" style="float:right;">Format foto: jpg/jpeg/png. Maks. 2MB</small>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="foto-selfie-pa">Foto Selfie dengan KTP
                            <span class="text-danger">*</span>
                        </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto-selfie-pa" id="foto-selfie-pa">
                            <label for="foto-selfie-pa" class="custom-file-label">Upload Foto</label>
                        </div>
                        <small class="text-black" style="float:right;">Format foto: jpg/jpeg/png. Maks. 2MB</small>
                    </div>
                    <br>
                    <button class="btn btn-outline-primary btn-prev">Kembali</button>
                    <button class="btn btn-primary btn-next">Selanjutnya</button>
                </div>

                <div class="form-step">
                    <div class="form-group">
                        <label for="bank">Bank
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-control" id="bank">
                            <option disabled selected>Pilih Bank</option>
                            <option>Bank Central Asia (BCA)</option>
                            <option>Bank Rakyat Indonesia (BRI)</option>
                            <option>Bank Mandiri</option>
                            <option>Bank Negara Indonesia (BNI)</option>
                            <option>Bank Danamon</option>
                            <option>Bank Permata</option>
                            <option>CIMB Niaga</option>
                            <option>BTPN/Jenius</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="no-rek">Nomor Rekening
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="no-rek">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama-prek">Nama Pemilik Rekening
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" for="nama-prek">
                        </div>
                    </div>


                    <button class="btn btn-outline-primary btn-prev">Kembali</button>
                    <button class="btn btn-primary btn-next">Selanjutnya</button>
                </div>

                <div class="form-step">
                    <div class="form-group">
                        <label for="berkas-p">Berkas Pendukung
                            <span class="text-danger">*</span>
                        </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="berkas-p" style="display:none;" required>
                            <label for="berkas-p" class="custom-file-label">Upload File</label>
                        </div>
                        <small class="text-danger">Format file: doc/docx/pdf. Maks. 2MB (Tidak Wajib)</small>
                    </div>
                    <div class="form-group">
                        <input style="display:none;" required>
                    </div>
                    <button class="btn btn-outline-primary btn-prev">Kembali</button>
                    <button type="submit" class="btn btn-primary">Selesai</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS FIle-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/js/stepper.js') ?>"></script>

    <script>
        $('.custom-file-input').on('change', function() {
            let filename = $(this).val().split('\\').pop();
            $(this)
                .next('.custom-file-label')
                .addClass('selected')
                .html(filename);
        });
    </script>
    </body>

    </html>