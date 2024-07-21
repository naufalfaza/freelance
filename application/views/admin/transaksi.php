<main id="main" class="main">

    <div class="pagetitle">
        <h1>Transaksi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Transaksi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <div class="card-title">Data Transaksi</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <!-- Default Tabs -->
                        <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#proses-tab" type="button" role="tab" aria-controls="home" aria-selected="true">Diproses</button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#selesai-tab" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Selesai</button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#batal-tab" type="button" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">Dibatalkan</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                            <div class="tab-pane fade show active" id="proses-tab" role="tabpanel" aria-labelledby="home-tab">
                                <table id="tableProses" class="hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="10%">No Transaksi</th>
                                            <th width="15%">Tanggal</th>
                                            <th width="35%">Nama Pembeli</th>
                                            <th width="15%">Total</th>
                                            <th width="10%">Status</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="selesai-tab" role="tabpanel" aria-labelledby="profile-tab">
                                <table id="tableSelesai" class="hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="10%">No Transaksi</th>
                                            <th width="15%">Tanggal</th>
                                            <th width="35%">Nama Pembeli</th>
                                            <th width="15%">Total</th>
                                            <th width="10%">Status</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="batal-tab" role="tabpanel" aria-labelledby="contact-tab">
                                <table id="tableBatal" class="hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="10%">No Transaksi</th>
                                            <th width="15%">Tanggal</th>
                                            <th width="35%">Nama Pembeli</th>
                                            <th width="15%">Total</th>
                                            <th width="10%">Status</th>
                                            <th width="10%">Keterangan</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div><!-- End Default Tabs -->
                    </div>
                </div>
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