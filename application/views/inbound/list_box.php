<style>
   .border{
	height: 700px;   
   }
</style>
<div class="border">
	<div class="col-lg-12">
<div class="panel panel-default">
<!-- Default panel contents -->
<div class="panel-heading">Inbound List</div>
<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Tanggal Inbound</th>
	  <th scope="col">Nama Barang</th>
	  <th scope="col">Qty</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $nourut = 1;
      foreach ($rows as $row) {
			
			$date = $row->tgl_inbound;
			$newDate = date("d-m-Y", strtotime($date));
    ?>
    <tr>
      <th scope="row"><?php echo $nourut++; ?></th>
      <td><?php echo $newDate; ?></td>
	  <td><?php echo $row->nama_barang; ?></td>
      <td><?php echo $row->qty_barang; ?></td>
      <td>
	  <?php if ($row->nama_barang != ''){ ?>
        <a href="<?php echo base_url() ?>inbound/edit/<?php echo $row->id_inbound; ?>">Ubah</a>
	  <?php } ?>
        <a href="<?php echo base_url() ?>inbound/delete/<?php echo $row->id_inbound; ?>">Hapus</a>
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