<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="<?= base_url('/User') ?>" class="logo d-flex align-items-center">
            <img src="<?= base_url('/assets/img/logo.png') ?>" alt="">
            <span class="d-none d-lg-block">Toko Melly</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <!-- <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div>End Search Bar -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <?php
            if ($this->session->userdata("logged_in") == true) {
            ?>
                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="<?= base_url("/User/pages?p=" . base64_encode("keranjang")) ?>">
                        <i class="bi bi-cart"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                </li><!-- End Notification Nav -->
            <?php
            }
            ?>

            <li class="nav-item dropdown pe-3">

                <?php
                if ($this->session->userdata("logged_in") == true) {
                ?>
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url('/assets/img/profile-img.jpg') ?>" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= ucwords($this->session->userdata('name')) ?></span>
                    </a><!-- End Profile Iamge Icon -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?= ucwords($this->session->userdata('name')) ?></h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-card-checklist"></i>
                                <span>Pesanan Saya</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('/Auth/authLogout') ?>">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                <?php
                } else {
                ?>
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="<?= base_url('/Auth') ?>">
                        <img src="<?= base_url('/assets/img/product-5.jpg') ?>" alt="Profile" class="rounded-circle">
                        <span>Login Disini</span>
                    </a>
                <?php
                }
                ?>

            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->