<?= $this->session->flashdata("success"); ?>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <div class="pagetitle">
                <h1>Keranjang</h1>
            </div><!-- End Page Title -->
            <div class="col-lg-9 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-cart-fill me-1"></i>Keranjang Pesanan</h5>
                        <table id="tableKeranjang" class="hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Gambar</th>
                                    <th width="30%">Nama Barang</th>
                                    <th width="15%">Harga</th>
                                    <th width="10%">Qty</th>
                                    <th width="15%">Total</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-cart-check-fill me-1"></i>Checkout</h5>
                        <h5 id="jmlKeranjang2"></h5>
                        <h5 id="totalKeranjang"></h5>
                        <div class="text-center">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
                                <i class="bi bi-cart-check-fill me-1"></i> Checkout
                            </button>
                        </div>
                        <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><b><i class="bi bi-credit-card-fill me-1"></i>Pembayaran</b></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form enctype="multipart/form-data" id="inputTransaksi" class="row g-3">
                                            <input type="hidden" name="id_userr" id="id_userr" value="<?= $this->session->userdata("id_user") ?>">
                                            <input type="hidden" name="totalll" id="totalll" value="">
                                            <h5 id="jmlKeranjang3"></h5>
                                            <h5 id="totalKeranjang2"></h5>
                                            <hr>
                                            <div class="col-12">
                                                <label for="inputAddress" class="form-label">Metode Pembayaran</label>
                                                <select class="form-select" aria-label="Default select example" id="metode" name="metode" autocomplete="off">
                                                    <option selected="" disabled>Pilih Pembayaran</option>
                                                    <option value="transfer">Transfer Bank</option>
                                                    <option value="qris">Qris</option>
                                                </select>
                                            </div>
                                            <div id="metodeTransfer">
                                                <div class="col-12 mb-3">
                                                    <label for="inputAddress" class="form-label">Bank</label>
                                                    <select class="form-select" aria-label="Default select example" id="bank" name="bank" autocomplete="off">
                                                        <option selected="">Pilih Bank</option>
                                                        <?php
                                                        $getUkuran = $this->M_data->dataBank()->result();
                                                        foreach ($getUkuran as $dt) {
                                                        ?>
                                                            <option value="<?= $dt->id_rekening ?>"><?= $dt->nama_bank ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label for="inputNanme4" class="form-label">No Rekening</label>
                                                    <input type="text" class="form-control" id="no_rekening" name="no_rekening" autocomplete="off">
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputNanme4" class="form-label">Bukti Transfer</label>
                                                    <input class="form-control" type="file" id="bukti" name="bukti">
                                                </div>
                                            </div>
                                            <div id="metodeQris">
                                                <div class="col-12 mb-3">
                                                    <label for="inputAddress" class="form-label">Qris</label>
                                                    <br>
                                                    <div class="text-center">
                                                        <img src="<?= base_url("/assets/img/random/no-image.jpg") ?>" width="40%">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputNanme4" class="form-label">Bukti Pembayaran</label>
                                                    <input class="form-control" type="file" id="buktiQris" name="buktiQris">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary" id="btnBayar"><i class="bi bi-cash me-1"></i>Bayar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Modal Dialog Scrollable-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>APLIKASI PENJUALAN DAN PEMESANAN JASA CETAK PADA TOKO MELLY FOTO STUIDIO DIGITAL BATU AMPAR</span></strong>
    </div>
    <div class="credits">
        Designed by Nandang Suherly
    </div>
</footer><!-- End Footer -->