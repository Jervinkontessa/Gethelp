<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <h2>GetHelp</h2>
                <p>
                    Kami sebagai jembatan berbagi kebaikan untuk masyarakat dalam berdonasi maupun galang dana
                </p>
            </div>
            <div class="col-md-4 col-sm-12">
                <h2>Tentang</h2>
                <ul class="list-unstyled link-list">
                    <li>
                        <a href="<?= base_url('about') ?>">GetHelp</a>
                    </li>
                    <li>
                        <a href="<?= base_url('terms') ?>">Syarat & Ketentuan</a>
                    </li>
                    <li>
                        <a href="<?= base_url('kebijakan-privasi') ?>">Kebijakan Privasi</a>
                    </li>
                    <li>
                    <li>
                        <a href="<?= base_url('kontak'); ?>">Hubungi Kami</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 col-sm-12 map-img">
                <h2>Follow Kami</h2>
                <address class="md-margin-bottom-40">
                    <span>
                        <a href="https://www.instagram.com/gethelpstartup/" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/channel/UC1Uqyy0d80yjfJChNPlaLAQ" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </span>
                </address>
            </div>
        </div>
    </div>
</footer>

<div class="copy">
    <div class="container">
        <p>&copy; GetHelp Indonesia 2021</p>
    </div>
</div>

<!-- Bootstrap JS FIle-->
<?php if ($js == 'reportjs') { ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        $('.custom-file-input').on('change', function() {
            let filename = $(this).val().split('\\').pop();
            $(this)
                .next('.custom-file-label')
                .addClass('selected')
                .html(filename);
        });
    </script>
<?php } else { ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="<?= base_url('assets/js/main.js') ?>"></script>
<?php }; ?>
</body>

</html>