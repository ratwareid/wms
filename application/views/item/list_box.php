<style>
   .border{
	height: 700px;   
   }
</style>
<div class="border">
	<div class="col-lg-12">
<div class="panel panel-default">
<!-- Default panel contents -->
<div class="panel-heading">Item List</div>
<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Kode Barang</th>
	  <th scope="col">Nama Barang</th>
	  <th scope="col">Jenis Barang</th>
	  <th scope="col">Satuan</th>
	  <th scope="col">Stok</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $nourut = 1;
      foreach ($rows as $row) {
    ?>
    <tr>
      <th scope="row"><?php echo $nourut++; ?></th>
      <td><?php echo $row->kode_barang; ?></td>
	  <td><?php echo $row->nama_barang; ?></td>
      <td><?php echo $row->jenis_barang; ?></td>
	  <td><?php echo $row->satuan; ?></td>
	  <td><?php echo $row->stock; ?></td>
      <td>
        <a href="<?php echo base_url() ?>item/edit/<?php echo $row->id_barang; ?>">Ubah</a>
        <a href="<?php echo base_url() ?>item/delete/<?php echo $row->id_barang; ?>">Hapus</a>
      </td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>
</div>
</div><!-- /.col-lg-6 -->
</div>

</div>