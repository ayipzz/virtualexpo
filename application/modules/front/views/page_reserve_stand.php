<style type="text/css">
	body {
		background-color: #f1f2f3;
	}
</style>
<div class="jumbotron jmb-reserve">
	<div class="container-fluid">
		<ol class="breadcrumb">
	  		<li><a href="<?php echo site_url();?>">Home</a></li>
	  		<li class="active">Reserve Stand</li>
		</ol>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-sm-5">
			<div class="thumbnail stand_detail">
      			<img src="<?php echo $stand_detail[0]['event_standimage']; ?>" alt="<?php echo $stand_detail[0]['event_name']; ?>">
      			<div class="caption">
        			<h3><?php echo $stand_detail[0]['event_name']; ?></h3>
        			<p><b>Stand ID :</b> <?php echo $stand_id; ?></p>
        			<p><b>Price :</b> <?php echo $stand_detail[0]['event_price']; ?></p>
        			<p><b>Date :</b> <?php echo $stand_detail[0]['event_startdate']; ?> -  <?php echo $stand_detail[0]['event_enddate']; ?></p>
        			<p><b>Location :</b> <?php echo $stand_detail[0]['event_location']; ?></p>
        			<p><b>Description :</b> <?php echo $stand_detail[0]['event_description']; ?></p>
      			</div>
    		</div>
		</div>
		<div class="col-md-8 col-sm-7">
			<?php
			if($this->session->userdata("c_id")=="")
			{
			?>
			<div class="panel panel-default">
				<div class="panel-heading">
					If you already have account, please signin.
				</div>
				<form class="form-horizontal" method="POST" action="<?php echo site_url('company_login'); ?>">
				<div class="panel-body">
					<input type="hidden" name="source_form" value="reserve_stand" />
		  			<div class="form-group">
		    			<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
		    			<div class="col-sm-10">
		      				<input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email" required>
		    			</div>
		  			</div>
		  			<div class="form-group">
		    			<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
		    			<div class="col-sm-10">
		      				<input type="password" class="form-control" name="password" id="inputPassword3" placeholder="Password" required>
		    			</div>
		  			</div>
		  			<?php echo $this->session->flashdata('login_err'); ?>
		  		</div>
		  		<div class="panel-footer">
		  			<div class="form-group">
		    			<div class="col-sm-offset-2 col-sm-10">
		      				<button type="submit" class="btn btn-primary">Sign in</button>
		    			</div>
		  			</div>
		  		</div>
		  		</form>
			</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				Or if you dont have account, fill the input below.
			</div>
			<form class="form-horizontal" method="POST" action="<?php echo site_url('company_register'); ?>" enctype="multipart/form-data">
				<div class="panel-body">
					<input type="hidden" name="source_form" value="reserve_stand" />
		  			<div class="form-group">
		    			<label for="inputName3" class="col-sm-2 control-label">Name</label>
		    			<div class="col-sm-10">
		      				<input type="text" class="form-control" id="inputName3" name="company_name" placeholder="Name" required>
		    			</div>
		  			</div>
		  			
		  			<div class="form-group">
		    			<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
		    			<div class="col-sm-10">
		      				<input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email" required>
		    			</div>
		  			</div>
		  			<div class="form-group">
		    			<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
		    			<div class="col-sm-10">
		      				<input type="password" class="form-control" name="password" id="inputPassword3" placeholder="Password" required>
		    			</div>
		  			</div>
		  			<div class="form-group">
		    			<label for="inputTelp3" class="col-sm-2 control-label">Telp</label>
		    			<div class="col-sm-10">
		      				<input type="number" class="form-control" name="telp" id="inputTelp3" placeholder="Telp" required>
		    			</div>
		  			</div>
		  			<div class="form-group">
		    			<label for="inputAddress3" class="col-sm-2 control-label">Address</label>
		    			<div class="col-sm-10">
		      				<textarea class="form-control" name="address" id="inputAddress3" placeholder="Address" required></textarea>
		    			</div>
		  			</div>
		  			<div class="form-group">
		    			<label for="inputLogo3" class="col-sm-2 control-label">Logo</label>
		    			<div class="col-sm-10">
		      				<input type="file" name="logo" id="inputLogo3" class="form-controll" />
		    			</div>
		  			</div>
		  			<?php echo $this->session->flashdata('signup_err'); ?>
		  		</div>
		  		<div class="panel-footer">
		  			<div class="form-group">
		    			<div class="col-sm-offset-2 col-sm-10">
		      				<button type="submit" class="btn btn-primary">Sign Up</button>
		    			</div>
		  			</div>
		  		</div>
		  	</form>

		<?php } else {

				echo '<h4>Halo, '.$this->session->userdata("c_name").'</h4>';
				echo 'Horeee,, one step again for finishing this reservation<br />';
				echo 'Please, upload marketing document<br /><br />';
				echo '
					<form action="'.site_url('put_reserve_stand').'" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="c_id" value="'.$this->session->userdata("c_id").'" />
					<input type="hidden" name="event_id" value="'.$event_id.'" />
					<input type="hidden" name="stand_id" value="svg_'.$stand_id.'" />
					<input type="hidden" name="stand_price" value="'.$stand_detail[0]['event_price'].'" />
					<input type="file" name="marketing_doc" class="form-control" /><br />
					*<i>doc,docx,pdf,ppt,pptx,zip,rar</i><br />
					'.$this->session->flashdata('reserve_stand_msg').'<br />
					<input type="submit" class="btn btn-primary" value="Upload Document" />
					</form>
				';
			} 
		?>
		</div>
	</div>
</div>