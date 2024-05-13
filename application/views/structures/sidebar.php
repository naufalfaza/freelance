 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

     <ul class="sidebar-nav" id="sidebar-nav">

         <li class="nav-item">
             <a class="nav-link " href="index.html">
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
                     <a href="tables-general.html">
                         <i class="bi bi-circle"></i><span>Data Pengguna</span>
                     </a>
                 </li>
                 <li>
                     <a href="tables-data.html">
                         <i class="bi bi-circle"></i><span>Data Barang</span>
                     </a>
                 </li>
             </ul>
         </li><!-- End Tables Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" data-bs-target="#trans-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-cart-check"></i><span>Transaksi</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="trans-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="tables-general.html">
                         <i class="bi bi-circle"></i><span>Cetak Foto</span>
                     </a>
                 </li>
                 <li>
                     <a href="tables-data.html">
                         <i class="bi bi-circle"></i><span>Penjualan ATK</span>
                     </a>
                 </li>
             </ul>
         </li><!-- End Tables Nav -->

         <li class="nav-item">
             <a class="nav-link collapsed" data-bs-target="#config-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-gear"></i><span>Configurasi</span><i class="bi bi-chevron-down ms-auto"></i>
             </a>
             <ul id="config-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                 <li>
                     <a href="tables-general.html">
                         <i class="bi bi-circle"></i><span>General Tables</span>
                     </a>
                 </li>
                 <li>
                     <a href="tables-data.html">
                         <i class="bi bi-circle"></i><span>Data Tables</span>
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
                     <a href="tables-general.html">
                         <i class="bi bi-circle"></i><span>General Tables</span>
                     </a>
                 </li>
                 <li>
                     <a href="tables-data.html">
                         <i class="bi bi-circle"></i><span>Data Tables</span>
                     </a>
                 </li>
             </ul>
         </li><!-- End Tables Nav -->

         <li class="nav-item">
             <a class="nav-link " href="<?= base_url('Auth/authLogout') ?>">
                 <i class="bi bi-door-open"></i>
                 <span>Logout</span>
             </a>
         </li><!-- End Dashboard Nav -->
     </ul>

 </aside><!-- End Sidebar-->