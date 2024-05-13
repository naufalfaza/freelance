<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="<?= base_url('Auth') ?>" class="logo d-flex align-items-center w-auto">
                                <img src="<?= base_url('/assets/img/logo.png') ?>" alt="">
                                <span class="d-none d-lg-block">Studio Apps</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Registrasi</h5>
                                    <p class="text-center small">Isi informasi pribadi anda pada form dibawah</p>
                                </div>

                                <form class="row g-3 needs-validation" novalidate>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Nama Lengkap</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="name" class="form-control" id="name" required autocomplete="off">
                                            <div class="invalid-feedback">Please enter your username.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Email</label>
                                        <div class="input-group has-validation">
                                            <input type="email" name="email" class="form-control" id="email" required autocomplete="off">
                                            <div class="invalid-feedback">Please enter your username.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Username</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="username" class="form-control" id="username" required autocomplete="off">
                                            <div class="invalid-feedback">Please enter your username.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" required autocomplete="off">
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="button" id="btnRegis">Registrasi Akun</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Sudah punya akun? <a href="<?= base_url('Auth/pages?p=' . base64_encode('login')) ?>">Login yuks</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="credits">
                            Designed by Nandang Suherly
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->