        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin') ?>">
                <div class="sidebar-brand-icon ">
                    <img src="<?= base_url('assets/img/profile/') ?>default.jpeg" width="60%" style="border-radius: 50%;">
                </div>
                <div class="sidebar-brand-text mx-3">GetHelp Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <?php if ($title == 'Dashboard') : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link" href="<?= base_url('admin') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
                </li>


                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Admin
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <?php if ($title == 'My Profile' || $title == 'Edit Profile' || $title == 'Change Password') : ?>
                    <li class="nav-item active">
                    <?php else : ?>
                    <li class="nav-item">
                    <?php endif; ?>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-users-cog"></i>
                        <span>Admin Management</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Admin Management</h6>
                            <a class="collapse-item" href="<?= base_url('admin/profile') ?>">My Profile</a>
                            <a class="collapse-item" href="<?= base_url('admin/edit') ?>">Edit Profile</a>
                            <a class="collapse-item" href="<?= base_url('admin/changepassword') ?>">Change Password</a>

                        </div>
                    </li>


                    <!-- Nav Item - Utilities Collapse Menu -->
                    <?php if ($title == 'Data Campaign Yang Sedang Berjalan' || $title == 'Data Laporan Yang Masuk' || $title == 'Data Campaign telah selesai' || $title == 'Detail Pending Campaign' || $title == 'Request Donasi') : ?>
                        <li class="nav-item active">
                        <?php else : ?>
                        <li class="nav-item">
                        <?php endif; ?>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                            <i class="fas fa-fw fa-house-user"></i>
                            <span>Campaign Management</span>
                        </a>
                        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Campaign Management</h6>
                                <a class="collapse-item" href="<?= base_url('donasi') ?>">Data Donasi</a>
                                <a class="collapse-item" href="<?= base_url('donasi/report') ?>">Data Laporan Masuk</a>
                                <a class="collapse-item" href="<?= base_url('donasi/selesai') ?>">Data Donasi Telah Selesai</a>
                                <a class="collapse-item" href="<?= base_url('donasi/pending') ?>">Pengajuan Donasi</a>
                            </div>
                        </div>
                        </li>

                        <!-- Divider -->
                        <hr class="sidebar-divider">

                        <!-- Heading -->
                        <div class="sidebar-heading">
                            Other
                        </div>

                        <!-- Nav Item - Tables -->
                        <?php if ($title == 'Daftar Users') : ?>
                            <li class="nav-item active">
                            <?php else : ?>
                            <li class="nav-item">
                            <?php endif; ?>
                            <a class="nav-link" href="<?= base_url('users') ?>">
                                <i class="fas fa-fw fa-users"></i>
                                <span>Users Management</span></a>
                            </li>

                            <!-- Divider -->
                            <hr class="sidebar-divider d-none d-md-block">

                            <!-- Sidebar Toggler (Sidebar) -->
                            <div class="text-center d-none d-md-inline">
                                <button class="rounded-circle border-0" id="sidebarToggle"></button>
                            </div>

                            <!-- Sidebar Message -->
                            <div class="sidebar-card">
                                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                    <span>Logout</span>
                                    <i class="fas fa-fw fa-sign-out-alt"></i>
                                </a>

                            </div>

        </ul>
        <!-- End of Sidebar -->