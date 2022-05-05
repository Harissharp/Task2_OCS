<!DOCTYPE html>
<html>
<head><!-- Login template found: https://bootsnipp.com/snippets/8o7X -->
	<meta charset="utf-8">
	<title>Gib John-Login</title>
	<!-- Bootstrap -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<!-- Jquery -->
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
	<div class="container">

	<div class="row" style="margin-top:20px">
	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" action="login_validate.php" method="post">
				<fieldset>
					<h2>Please Sign In</h2>
					<hr class="colorgraph">

					<div class="form-group">
	                    <input required type="input" name="u_username" id="u_username" class="form-control input-lg" placeholder="Email Address">
					</div>

					<div class="form-group">
	                    <input required type="password" name="u_password" id="u_password" class="form-control input-lg" placeholder="Password">
					</div>
					<hr class="colorgraph">
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6">
							<input type="submit" class="btn btn-lg btn-primary btn-block">
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6">
							<a href="login_teacher.php">
								<button  type="button" class="btn btn-lg btn-secondary btn-block">Teacher Login </button> 
							</a>
						</div>
					</div>
					<?php 
					session_start();

					if (isset($_SESSION['error'])) {
					  echo $_SESSION['error'];
					  unset($_SESSION['error']);# after being used it will not be needed until next time + without it would keep displaying after a purchase 
					}

					?>
				</fieldset>
			</form>
		</div>
	</div>

	</div>
</body>
</html>