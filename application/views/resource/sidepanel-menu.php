<?php
include('checkactivemenu.php');
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url().'dist/img/user2-160x160.jpg' ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata['username']; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="<?php echo $master; ?> treeview">
        <a href="#">
          <i class="fa fa-files-o"></i>
          <span>Master Data</span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url().'user'?>"><i class="fa fa-circle-o"></i>Pengguna</a></li>
          <li><a href="<?php echo base_url().'item'?>"><i class="fa fa-circle-o"></i>Barang</a></li>
        </ul>
      </li>
      <li class="<?php echo $transaksi; ?> treeview">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>Transaksi</span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url().'inbound'?>"><i class="fa fa-circle-o"></i>Barang Masuk</a></li>
          <li><a href="<?php echo base_url().'outbound'?>"><i class="fa fa-circle-o"></i>Barang Keluar</a></li>
        </ul>
      </li>
      <li class="<?php echo $laporan; ?> treeview">
        <a href="#">
          <i class="fa fa-calendar"></i>
          <span>Laporan</span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url().'inboundhis'?>"><i class="fa fa-circle-o"></i>Laporan Barang Masuk</a></li>
          <li><a href="<?php echo base_url().'outboundhis'?>"><i class="fa fa-circle-o"></i>Laporan Barang Keluar</a></li>
        </ul>
      </li>
	   
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>