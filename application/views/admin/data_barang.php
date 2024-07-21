<main id="main" class="main">

    <div class="pagetitle">
        <h1>Master Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Data Barang</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="form-group row">
                        <div class="col-lg-10">
                            <div class="card-title">Data Seluruh Barang</div>
                        </div>
                        <div class="col-lg-2">
                            <!-- Basic Modal -->
                            <button type="button" class="btn btn-outline-success col-lg-12 " data-bs-toggle="modal" data-bs-target="#basicModal">
                                <i class="bi bi-plus"></i> Tambah Baru
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <table id="tableBarang" class="hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="15%" class="text-center">Gambar</th>
                                    <th width="30%">Nama</th>
                                    <th width="10%" class="text-center">Jenis</th>
                                    <th width="15%" class="text-center">Harga</th>
                                    <th width="10%" class="text-center">Stok</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                        </table>
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

<div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Tambah Data Barang</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <form enctype="multipart/form-data" id="tambahBarang">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-lg-4">Foto Barang</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="file" id="foto" name="foto">
                                </div>
                                <div class="col-lg-12">
                                    <hr>
                                </div>
                                <label class="col-lg-4">Nama Barang</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="nm_barang" id="nm_barang">
                                </div>
                                <div class="col-lg-12"><br></div>
                                <label class="col-lg-4">Jenis Barang</label>
                                <div class="col-lg-8">
                                    <select class="form-select" id="jenis" name="jenis">
                                        <option value=""></option>
                                        <option value="ATK">ATK</option>
                                        <option value="FRAME">Frame</option>
                                    </select>
                                </div>
                                <div class="col-lg-12"><br></div>
                                <label class="col-lg-4">Harga Barang</label>
                                <div class="col-lg-8">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="text" class="form-control" name="harga" id="harga">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="col-lg-12"><br></div>
                                <label class="col-lg-4">Diskon Barang</label>
                                <div class="col-lg-8">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" aria-describedby="basic-addon2" name="diskon" id="diskon">
                                        <span class="input-group-text" id="basic-addon2">%</span>
                                    </div>
                                </div>
                                <div class="col-lg-12"><br></div>
                                <label class="col-lg-4">Stok Barang</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="stok" id="stok">
                                </div>
                                <div class="col-lg-12"><br></div>
                                <label class="col-lg-4">Satuan Barang</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="satuan" id="satuan">
                                </div>
                                <div class="col-lg-12"><br></div>
                                <label class="col-lg-4">Desksrpsi Barang</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <hr>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-outline-primary col-12"><i class="bi bi-save me-1"></i> Simpan Data Barang</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Basic Modal-->