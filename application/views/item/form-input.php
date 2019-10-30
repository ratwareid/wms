<style>
   .border{
	height: 700px;   
   }
</style>
<div class="border">
<div class="content-wrapper">
    <?php $this->load->view('resource/signpost'); ?>
    <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading"><?php echo $heading ?></div>
      <div class="panel-body">
          <form action="<?php echo $action; ?>" method="post">
          <input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>" />
          <div class="form-group">
            <label for="LabelName">Kode Barang</label>
            <input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="Kode Barang" value="<?php echo $kode_barang; ?>">
          </div>
          <div class="form-group">
            <label for="LabelPassword">Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>">
          </div>
          <div class="form-group">
            <label for="Label">Jenis Barang</label>
            <input type="text" class="form-control" name="jenis_barang" id="jenis_barang" placeholder="Jenis Barang" value="<?php echo $jenis_barang; ?>">
          </div>
		  <div class="form-group">
            <label for="Label">Satuan</label>
            <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="<?php echo $satuan; ?>">
          </div>
		  <div class="form-group">
            <label for="Label">Stock</label>
            <input type="text" onkeypress='validate(event)' class="form-control" name="stock" id="stock" placeholder="Stock" value="<?php echo $stock; ?>">
			<script>
				function validate(evt) {
				  var theEvent = evt || window.event;

				  // Handle paste
				  if (theEvent.type === 'paste') {
					  key = event.clipboardData.getData('text/plain');
				  } else {
				  // Handle key press
					  var key = theEvent.keyCode || theEvent.which;
					  key = String.fromCharCode(key);
				  }
				  var regex = /[0-9]|\./;
				  if( !regex.test(key) ) {
					theEvent.returnValue = false;
					if(theEvent.preventDefault) theEvent.preventDefault();
				  }
				}
			</script>
          </div>
            <button type="submit" class="btn btn-default">
                    Simpan
            </button>
            <a href="<?php echo base_url() ?>item/">
                <button type="button" class="btn btn-default">
                    Kembali
                </button>
            </a>
        </form>
          <?php if ($error != ''){ ?>
            <br/>
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">Error:</span>
              <?php echo $error; ?>
            </div>
          <?php }?>
          
        </div>
      </div>
    </div>
</div>
</div>