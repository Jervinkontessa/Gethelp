<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
<script type="text/javascript">
    const password = document.getElementById('password');
    const ikon = document.getElementById('ikon');
    const hide = ['fa', 'fa-eye-slash'];
    const show = ['fa', 'fa-eye'];

    console.log(show);

    function showHide() {
        if (password.type === 'password') {
            password.setAttribute('type', 'text');
            show.forEach(element => {
                ikon.classList.remove(element);
            });
            hide.forEach(element => {
                ikon.classList.add(element);
            });

        } else {
            password.setAttribute('type', 'password');

            hide.forEach(element => {
                ikon.classList.remove(element);
            });
            show.forEach(element => {
                ikon.classList.add(element);
            });
        }
    }
</script>

</body>

</html>