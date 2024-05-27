<?php
if ($this->session->userdata("logged_in") == true) {
    $btn = "";
    $form = "disabled";
} else {
    $btn = "disabled";
    $form = "";
}
?>
<?= $this->session->flashdata("success"); ?>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <div class="pagetitle">
                <h1>Home</h1>
            </div><!-- End Page Title -->
            <div class="col-lg-9 mb-4">
                <!-- Slides only carousel -->
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?= base_url('/assets/img/bg/bg-1.jpg') ?>" class="d-block w-100" alt="..." style="height: 300px;">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('/assets/img/bg/bg-2.jpg') ?>" class="d-block w-100" alt="..." style="height: 300px;">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('/assets/img/bg/bg-3.jpeg') ?>" class="d-block w-100" alt="..." style="height: 300px;">
                        </div>
                    </div>
                </div><!-- End Slides only carousel-->
            </div>
            <div class="col-lg-3 mb-4">
                <!-- Slides only carousel -->
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?= base_url('/assets/img/bg/bgg-1.jpeg') ?>" class="d-block w-100" alt="..." style="height: 300px;">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('/assets/img/bg/bgg-2.jpg') ?>" class="d-block w-100" alt="..." style="height: 300px;">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('/assets/img/bg/bgg-3.jpeg') ?>" class="d-block w-100" alt="..." style="height: 300px;">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('/assets/img/bg/bgg-4.jpg') ?>" class="d-block w-100" alt="..." style="height: 300px;">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url('/assets/img/bg/bgg-5.jpg') ?>" class="d-block w-100" alt="..." style="height: 300px;">
                        </div>
                    </div>
                </div><!-- End Slides only carousel-->
            </div>
            <div class="pagetitle">
                <h1>Produk Terlaris</h1>
            </div><!-- End Page Title -->
            <div class="col-lg-12">
                <div class="row">
                    <?php
                    $get = $this->M_data->dataTerlaris()->result();
                    foreach ($get as $dt) {
                    ?>
                        <div class="col-lg-2">
                            <div class="card">
                                <form action="<?= base_url('/User/inputBarang') ?>" method="post">
                                    <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $this->session->userdata('id_user') ?>">
                                    <input type="hidden" class="form-control" id="id_barang" name="id_barang" value="<?= $dt->id_barang ?>">
                                    <img src="<?= base_url('/assets/img/barang/' . $dt->image) ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= (str_word_count($dt->nm_barang) > 5) ? substr($dt->nm_barang, 0, 20) . "..." : $dt->nm_barang ?></h5>
                                        <!-- <p class="card-text"><?= $dt->deskripsi ?></p> -->
                                        <div class="row p-0">
                                            <div class="col-lg-8">
                                                <p style="text-align: left; font-size: 18px; font-weight: bold; color: #0d6efd;"><b>Rp. <?= number_format($dt->harga, 0, ',', '.')  ?></b></p>
                                            </div>
                                            <div class="col-lg-4">
                                                <p style="text-align: right; font-size: 11px; font-weight: bold;">Stok <?= $dt->stok ?></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <input type="number" class="form-control input-spinner" name="qtyBrg" id="qtyBrg" value="1" min="1" max="<?= $dt->stok ?>">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary" <?= $btn ?>><i class="bi bi-cart-plus-fill me-1"></i> Keranjang</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="pagetitle">
                <h1>Layanan & Produk</h1>
            </div><!-- End Page Title -->
            <div class="col-lg-12 mb-4">
                <!-- Default Tabs -->
                <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#cetak-tab" type="button" role="tab" aria-controls="home" aria-selected="true">Cetak Foto</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#frame-tab" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Frame</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#atk-tab" type="button" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">ATK</button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="myTabjustifiedContent">
                    <div class="tab-pane fade show active" id="cetak-tab" role="tabpanel" aria-labelledby="home-tab">
                        <form enctype="multipart/form-data" id="cetakFoto">
                            <input class="form-control" type="hidden" id="id_user" name="id_user" value="<?= $this->session->userdata('id_user') ?>">
                            <input class="form-control" type="hidden" id="totall" name="totall">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="card">
                                        <img src="<?= base_url('/assets/img/random/upload-image.jpg') ?>" class="card-img-top" alt="...">
                                        <div class="card-body row g-3">
                                            <h5 class="card-title">Upload Image</h5>
                                            <input class="form-control" type="file" id="foto" name="foto">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="card">
                                        <div class="card-body row g-3">
                                            <h5 class="card-title"><i class="bi bi-list me-1"></i>Form Pesanan Cetak Foto</h5>
                                            <!-- Vertical Form -->
                                            <div class="col-12">
                                                <label for="inputNanme4" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" <?= $form ?>>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputPassword4" class="form-label">No Telpon</label>
                                                <input type="number" class="form-control" id="no_telp" name="no_telp" autocomplete="off" <?= $form ?>>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmail4" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" autocomplete="off" <?= $form ?>>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputAddress" class="form-label">Ukuran</label>
                                                <select class="form-select" aria-label="Default select example" id="ukuran_foto" name="ukuran_foto" autocomplete="off">
                                                    <option selected=""></option>
                                                    <?php
                                                    $getUkuran = $this->M_data->dataUkuran()->result();
                                                    foreach ($getUkuran as $dt) {
                                                    ?>
                                                        <option value="<?= $dt->id_ukuran ?>"><?= $dt->ukuran . " - Rp. " . number_format($dt->harga, 0, ',', '.') ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputPassword4" class="form-label">Qty</label>
                                                <input type="number" class="form-control" id="qty" name="qty" autocomplete="off">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmail4" class="form-label">Total</label>
                                                <input type="text" class="form-control" id="total" name="total" disabled>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary" <?= $btn ?>><i class="bi bi-cart-plus-fill me-1"></i> Keranjang</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="frame-tab" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <?php
                            $get = $this->M_data->dataFrame()->result();
                            foreach ($get as $dt) {
                            ?>
                                <div class="col-lg-2">
                                    <div class="card">
                                        <img src="<?= base_url('/assets/img/barang/' . $dt->image) ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <form action="<?= base_url('/User/inputBarang') ?>" method="post">
                                                <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $this->session->userdata('id_user') ?>">
                                                <input type="hidden" class="form-control" id="id_barang" name="id_barang" value="<?= $dt->id_barang ?>">
                                                <h5 class="card-title"><?= (str_word_count($dt->nm_barang) > 5) ? substr($dt->nm_barang, 0, 20) . "..." : $dt->nm_barang ?></h5>
                                                <!-- <p class="card-text"><?= $dt->deskripsi ?></p> -->
                                                <div class="row p-0">
                                                    <div class="col-lg-8">
                                                        <p style="text-align: left; font-size: 18px; font-weight: bold; color: #0d6efd;"><b>Rp. <?= number_format($dt->harga, 0, ',', '.')  ?></b></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p style="text-align: right; font-size: 11px; font-weight: bold;">Stok <?= $dt->stok ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <input type="number" class="form-control input-spinner" name="qtyBrg" id="qtyBrg" value="1" min="1" max="<?= $dt->stok ?>">
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary" <?= $btn ?>><i class="bi bi-cart-plus-fill me-1"></i> Keranjang</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="atk-tab" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="row">
                            <?php
                            $get = $this->M_data->dataAtk()->result();
                            foreach ($get as $dt) {
                            ?>
                                <div class="col-lg-2">
                                    <div class="card">
                                        <form action="<?= base_url('/User/inputBarang') ?>" method="post">
                                            <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $this->session->userdata('id_user') ?>">
                                            <input type="hidden" class="form-control" id="id_barang" name="id_barang" value="<?= $dt->id_barang ?>">
                                            <img src="<?= base_url('/assets/img/barang/' . $dt->image) ?>" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= (str_word_count($dt->nm_barang) > 5) ? substr($dt->nm_barang, 0, 20) . "..." : $dt->nm_barang ?></h5>
                                                <!-- <p class="card-text"><?= $dt->deskripsi ?></p> -->
                                                <div class="row p-0">
                                                    <div class="col-lg-8">
                                                        <p style="text-align: left; font-size: 18px; font-weight: bold; color: #0d6efd;"><b>Rp. <?= number_format($dt->harga, 0, ',', '.')  ?></b></p>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <p style="text-align: right; font-size: 11px; font-weight: bold;">Stok <?= $dt->stok ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mb-3">
                                                    <input type="number" class="form-control input-spinner" name="qtyBrg" id="qtyBrg" value="1" min="1" max="<?= $dt->stok ?>">
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary" <?= $btn ?>><i class="bi bi-cart-plus-fill me-1"></i> Keranjang</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div><!-- End Default Tabs -->
            </div>

        </div>
    </section>

</main><!-- End #main -->
<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>APLIKASI PENJUALAN DAN PEMESANAN JASA CETAK PADA TOKO MELLY FOTO STUIDIO DIGITAL BATU AMPAR</span></strong>
    </div>
    <div class="credits">
        Designed by Nandang Suherly
    </div>
</footer><!-- End Footer -->