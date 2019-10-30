<?php
$this->load->view('resource/ratwareid/v1/header');
$this->load->view('resource/ratwareid/v1/footer');
?>
  <center>
    
	<div class="col-sm-4 " align="left">
	  <div class="card">
		<div class="card-body">
		<center><img width="200" height="200px" src="<?php echo base_url().'dist/img/companylogo.jpeg'?>" alt="logo"></center>
		  <form method="post" action="<?php echo $action ?>">
			<div class="form-group">
			  <label for="exampleInputuserid1">Your username</label>
			  <input type="username" class="form-control" name="username" aria-describedby="usernameHelp" placeholder="Enter Username">
			  <small id="usernameHelp" class="form-text text-muted">We'll never share your data with anyone else.</small>
			</div>
			<div class="form-group" method="post" action="">
			  <label for="exampleInputPassword1">Password</label>
			  <input type="password" class="form-control" name="password" placeholder="Password">
			</div>
			<button name="submit" type="submit" value="Login" class="btn btn-primary">Login</button>
		  </form>
		  <? echo $error; ?>
		</div>
	  </div>
	</div>
    
  </center>
