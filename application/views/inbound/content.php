<div class="content-wrapper">
<?php $this->load->view('resource/signpost'); ?>
<?php $this->load->view('resource/search-bar'); ?>
<div class="col-lg-12">
    <a href="<?php echo base_url() ?>inbound/create">
        <button type="button" class="btn btn-default">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
            Tambah
        </button>
    </a>
</div><br/><br/>
<?php $this->load->view('inbound/list_box'); ?>
<center>
<div class="col-lg-12">
        <div class="col">
            <!--Tampilkan pagination-->
            <?php echo $pagination; ?>
        </div>
</div>
</center>
</div>

</div>

