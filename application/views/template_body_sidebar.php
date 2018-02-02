<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <!-- <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url() ?>/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Admin</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div> -->
    <!-- search form -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <!-- <li class="header">MAIN NAVIGATION</li> -->
      <!-- <li><a href="<?php echo site_url() ?>/dashboard"><i class="fa fa-dashboard text-red"></i> <span>Dashboard</span></a></li> -->
      <li><a href="<?php echo site_url() ?>/booking/jadwal"><i class="fa fa-circle-o"></i> Jadwal </a></li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-folder-open "></i> <span>Data</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <!-- <li><a href="#"><i class="fa fa-circle-o"></i> Pengguna sistem </a></li> -->
          <li><a href="<?php echo site_url() ?>/unit"><i class="fa fa-circle-o"></i> Unit </a></li>
          <li><a href="<?php echo site_url() ?>/pegawai"><i class="fa fa-circle-o"></i> Pegawai </a></li>
          <li><a href="<?php echo site_url() ?>/marketing"><i class="fa fa-circle-o"></i> Marketing </a></li>
          <li><a href="<?php echo site_url() ?>/supplier"><i class="fa fa-circle-o"></i> Supplier </a></li>
          <li><a href="<?php echo site_url() ?>/sparepart"><i class="fa fa-circle-o"></i> Sparepart </a></li>
          <li><a href="<?php echo site_url() ?>/kategori_pengeluaran"><i class="fa fa-circle-o"></i> Kategori Pengeluaran </a></li>
        </ul>
      </li>
      <li class="treeview menu-open">
        <a href="#">
          <i class="fa fa-exchange"></i> <span>Transaksi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="display: block;">
          <li><a href="<?php echo site_url() ?>/booking"><i class="fa fa-circle-o"></i> Booking dan pembayaran</a></li>

          <li><a href="<?php echo site_url() ?>/pembayaran"><i class="fa fa-circle-o"></i> Kwitansi</a></li>
          <li><a href="<?php echo site_url() ?>/spj"><i class="fa fa-circle-o"></i> SPJ</a></li>
          <li><a href="<?php echo site_url() ?>/pengeluaran"><i class="fa fa-circle-o"></i> Pengeluaran / operasional</a></li>
          <li><a href="<?php echo site_url() ?>/faktur_pembelian"><i class="fa fa-circle-o"></i> Pembelian sparepart</a></li>
            <li><a href="<?php echo site_url() ?>/pemakaian_sparepart"><i class="fa fa-circle-o"></i> Pemakaian Sparepart</a></li>
        </ul>
      </li>
      <li><a href="<?php echo site_url() ?>/laporan"><i class="fa fa-book"></i> Laporan </a></li>


    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
