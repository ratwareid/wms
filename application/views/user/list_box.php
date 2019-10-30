<style>
   .border{
	height: 700px;   
   }
</style>
<div class="border">
	<div class="col-lg-12">
<div class="panel panel-default">
<!-- Default panel contents -->
<div class="panel-heading">User List</div>
<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Username</th>
	  <th scope="col">Nama Lengkap</th>
	  <th scope="col">Email</th>
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
      <td><?php echo $row->username; ?></td>
	  <td><?php echo $row->fullname; ?></td>
      <td><?php echo $row->email; ?></td>
      <td>
        <a href="<?php echo base_url() ?>user/edit/<?php echo $row->userid; ?>">Ubah</a>
        <a href="<?php echo base_url() ?>user/delete/<?php echo $row->userid; ?>">Hapus</a>
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