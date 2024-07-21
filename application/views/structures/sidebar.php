 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link collapsed" href="<?= base_url("/Admin/pages?p=" . base64_encode("dashboard")) ?>">
                 <i class="bi bi-grid"></i>
                 <span>Dashboard</span>
             </a>
         </li><!-- End Dashboard Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" data-bs-target="#data-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-database"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="data-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="<?= base_url("/Admin/pages?p=" . base64_encode("data_pengguna")) ?>">
                         <i class="bi bi-circle"></i><span>Data Pengguna</span>
                     </a>
                 </li>
                 <li>
                     <a href="<?= base_url("/Admin/pages?p=" . base64_encode("data_barang")) ?>">
                         <i class="bi bi-circle"></i><span>Data Barang</span>
                     </a>
                 </li>
             </ul>
         </li><!-- End Tables Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" href="<?= base_url("/Admin/pages?p=" . base64_encode("transaksi")) ?>">
                 <i class="bi bi-cart-check"></i>
                 <span>Transaksi</span>
             </a>
         </li><!-- End Dashboard Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" data-bs-target="#config-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-gear"></i><span>Konfigurasi</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="config-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="<?= base_url("/Admin/pages?p=" . base64_encode("config_cetak")) ?>">
                         <i class="bi bi-circle"></i><span>Ukuran Cetak</span>
                     </a>
                 </li>
             </ul>
         </li><!-- End Tables Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" data-bs-target="#print-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-file-earmark-bar-graph"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="print-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="<?= base_url("/Admin/pages?p=" . base64_encode("laporan_transaksi")) ?>">
                         <i class="bi bi-circle"></i><span>Transaksi</span>
                     </a>
                 </li>
                 <!-- <li>
                     <a href="tables-general.html">
                         <i class="bi bi-circle"></i><span>Penjualan ATK</span>
                     </a>
                 </li>
                 <li>
                     <a href="tables-data.html">
                         <i class="bi bi-circle"></i><span>Penjualan Frame</span>
                     </a>
                 </li> -->
             </ul>
         </li><!-- End Tables Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" href="<?= base_url('Auth/authLogout') ?>">
                 <i class="bi bi-door-open"></i>
                 <span>Logout</span>
             </a>
         </li><!-- End Dashboard Nav -->
     </ul>

 </aside><!-- End Sidebar-->