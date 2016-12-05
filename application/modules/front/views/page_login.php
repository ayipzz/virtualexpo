<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					If you already have account, please signin.
				</div>
				<form class="form-horizontal" method="POST" action="<?php echo site_url('company_login'); ?>">
				<div class="panel-body">
					<input type="hidden" name="source_form" value="login" />
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
		</div>
	</div>
</div>