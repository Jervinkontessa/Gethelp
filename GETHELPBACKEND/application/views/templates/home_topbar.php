  <!-- Navbar-->
  <input type="checkbox" id="check">
  <nav class="navigasi">
      <div class="icon">
          <a href="<?= base_url(); ?>">
              <img src="<?= base_url('assets/') ?>img/logo.png" alt="logo" style="width:100px;height:50px;margin-left:20px;">
          </a>
      </div>
      <form action="<?= base_url('campaign') ?>" method="get">
          <div class="search_box mt-2">

              <input type="search" placeholder="Cari donasi" name="cari" autocomplete="off">
              <span class="fa fa-search"></span>

          </div>
      </form>
      <ol>
          <li>
              <a href="<?= base_url('campaign') ?>">Donasi</a>
          </li>
          <li>
              <a href="<?= base_url('panduan-galang-dana') ?>">Galang Dana</a>
          </li>
          <?php if ($user == null) { ?>
              <li>
                  <a href="<?= base_url('auth') ?>" id="login">Login</a>
              </li>
          <?php } else { ?>
              <ul class="navbar-nav">
                  <li class="nav-item">
                      <button style="color:#000;background-color:transparent;border:none;font-size: 17px;padding-top: 1px;" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <?= $user['nama']; ?>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="<?= base_url('usersprofile') ?>">Dashboard</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="<?= base_url('userlogout'); ?>">Keluar</a>
                      </div>
                  </li>
              </ul>
          <?php } ?>

      </ol>
      <label for="check" class="bar">
          <span class="fa fa-bars" id="bars"></span>
          <span class="fa fa-times" id="times"></span>
      </label>
  </nav>