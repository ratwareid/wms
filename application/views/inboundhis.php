<?php
if ($this->session->userdata('logged')<>1) {
    redirect(site_url('auth'));
}

//header
$this->load->view('resource/header_admin');
$this->load->view('resource/sidepanel-header');
$this->load->view('resource/sidepanel-menu');
?>

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
                  <div class="form-group">
                     <label>Tanggal Mulai:</label>
                     <div class="input-group date">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="datepicker2" class="form-control pull-right" id="datepicker2" value="<?php echo $datepicker2; ?>">
                     </div>
                     <!-- /.input group -->
                  </div>
				  <div class="form-group">
                     <label>Tanggal Akhir:</label>
                     <div class="input-group date">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="datepicker3" class="form-control pull-right" id="datepicker3" value="<?php echo $datepicker3; ?>">
                     </div>
                     <!-- /.input group -->
                  </div>
                  <div class="form-group">
                     <label for="sel1">List Barang:</label>
                     <select class="form-control" required id="id_barang" name="id_barang">
					 <option value="all" selected>All</option>
                     <?php                                
                        foreach ($listbarang as $row) {
							echo "<option value='".$row->id_barang."'>".$row->nama_barang."</option>";
                        }
                          echo"
                        </select>"
                        ?>
                  </div>
                
                  <button type="submit" class="btn btn-default">
                  Print
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




<?php
//footer
$this->load->view('resource/copyright');
$this->load->view('resource/sidebar_setting');
$this->load->view('resource/footer_admin');
?>
