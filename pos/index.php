<?php
if(isset($_COOKIE["dbmail"]) && $_COOKIE["dbmail"]!="") {
	
	define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');

	switch (ENVIRONMENT)
	{
		case 'development':
			error_reporting(-1);
			ini_set('display_errors', 0);
		break;

		case 'testing':
		case 'production':
			ini_set('display_errors', 0);
			if (version_compare(PHP_VERSION, '5.3', '>='))
			{
				error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
			}
			else
			{
				error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
			}
		break;

		default:
			header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
			echo 'The application environment is not set correctly.';
			exit(1); // EXIT_ERROR
	}

		$system_path = 'system';
		$application_folder = 'application';
		$view_folder = '';
		
		// Set the current directory correctly for CLI requests
		if (defined('STDIN'))
		{
			chdir(dirname(__FILE__));
		}

		if (($_temp = realpath($system_path)) !== FALSE)
		{
			$system_path = $_temp.DIRECTORY_SEPARATOR;
		}
		else
		{
			// Ensure there's a trailing slash
			$system_path = strtr(
				rtrim($system_path, '/\\'),
				'/\\',
				DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
			).DIRECTORY_SEPARATOR;
		}

		// Is the system path correct?
		if ( ! is_dir($system_path))
		{
			header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
			echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME);
			exit(3); // EXIT_CONFIG
		}

	/*
	 * -------------------------------------------------------------------
	 *  Now that we know the path, set the main path constants
	 * -------------------------------------------------------------------
	 */
		// The name of THIS file
		define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

		// Path to the system directory
		define('BASEPATH', $system_path);

		// Path to the front controller (this file) directory
		define('FCPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

		// Name of the "system" directory
		define('SYSDIR', basename(BASEPATH));

		// The path to the "application" directory
		if (is_dir($application_folder))
		{
			if (($_temp = realpath($application_folder)) !== FALSE)
			{
				$application_folder = $_temp;
			}
			else
			{
				$application_folder = strtr(
					rtrim($application_folder, '/\\'),
					'/\\',
					DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
				);
			}
		}
		elseif (is_dir(BASEPATH.$application_folder.DIRECTORY_SEPARATOR))
		{
			$application_folder = BASEPATH.strtr(
				trim($application_folder, '/\\'),
				'/\\',
				DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
			);
		}
		else
		{
			header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
			echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
			exit(3); // EXIT_CONFIG
		}

		define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);

		// The path to the "views" directory
		if ( ! isset($view_folder[0]) && is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR))
		{
			$view_folder = APPPATH.'views';
		}
		elseif (is_dir($view_folder))
		{
			if (($_temp = realpath($view_folder)) !== FALSE)
			{
				$view_folder = $_temp;
			}
			else
			{
				$view_folder = strtr(
					rtrim($view_folder, '/\\'),
					'/\\',
					DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
				);
			}
		}
		elseif (is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR))
		{
			$view_folder = APPPATH.strtr(
				trim($view_folder, '/\\'),
				'/\\',
				DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
			);
		}
		else
		{
			header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
			echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
			exit(3); // EXIT_CONFIG
		}

		define('VIEWPATH', $view_folder.DIRECTORY_SEPARATOR);

	/*
	 * --------------------------------------------------------------------
	 * LOAD THE BOOTSTRAP FILE
	 * --------------------------------------------------------------------
	 *
	 * And away we go...
	 */
	require_once BASEPATH.'core/CodeIgniter.php';

} else { ?>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Login</title>
    <link rel="apple-touch-icon" sizes="60x60" href="assets/images/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/images/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/images/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/images/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/ico/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="assets/images/ico/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="assets/ltr/bootstrap.css">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="assets/fonts/icomoon.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/flag-icon-css/css/flag-icon.min.css">
    
    <!-- END VENDOR CSS-->
	
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="assets/ltr/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="assets/ltr/app.css">
    <link rel="stylesheet" type="text/css" href="assets/ltr/colors.css">    <!-- END ROBUST CSS-->

   
	<script src="assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    
    <style>
.body_sub {
    display: table;
    margin: 25px auto 0px;
    width: 90%;
    background-color: #fff;
    transition: top .5s cubic-bezier(.39,.58,.57,1);
    box-shadow: 0 5px 9px 1px rgba(32,32,32,.28);
    padding: 10px;
    border-radius: 10px;
}
	.login-box
	{
	display: table-cell;
    vertical-align: middle;
	}
	.email_error
{
color: red;
text-align: center;
}
.img_login {
    text-align: center;
}
.login-logo h2 {
    text-align: center;
    color: #967ADC;
}
.img_login img {
    width: 110px;
    margin-bottom: 10px;
}


@media(min-width:768px){
    .body_sub {
        width: 60%;
    }
}
@media(min-width:1024px){
    .body_sub {
        width: 33%;
    }
}
	</style>
</head>
<body class="hold-transition login-page">
  
<div class="body_sub">
<div class="login-box">
    <div class="img_login">
        <img src="https://retail.minkchatter.com/billing/assets/images/admin-logo.png">
    </div>    
    
  <div class="login-logo">
   <h2>Retail Management System</h2>
  </div>
 
  <!-- /.login-logo -->
  
    <div class="login-box-body">
        <!--p class="login-box-msg">Sign in to start your session now</p-->
		<div class="row">
		<div class="col-sm-4">
			<label class="radio-inline"><input type="radio" name="optradio" onclick="Show_admin();" checked>Admin</label>
		</div>
		<div class="col-sm-4">
			<label class="radio-inline"><input type="radio" name="optradio" onclick="Show_user();" >User</label>
		</div>
		</div>
            <form method="post" class="contact1-form">
                <div class="form-group has-feedback">
				
					<div class="row">
						<div class="col-md-3">
							<label for="email">Email :</label>
						</div>
						<div class="col-md-9">
						 <input type="email" class="form-control" value="" placeholder="Email" name="email" />
							   <p class="email_error"></p>
						</div>
						<div class="col-md-3">
							<label for="password">Password :</label>
						</div>
						<div class="col-md-9">
						 <input type="password" class="form-control" value="" placeholder="Password" name="password" />
							  <p class="password_error"></p>
						</div>
					</div>
                </div>
            
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck"></div>
                    </div>
                <!-- /.col -->
                    <div class="col-xs-4">
                      <input type="button" value="Sign In" class="btn btn-primary btn-block btn-flat log_btn">
                    </div>
                <!-- /.col -->
              </div>
            </form>   

            <form method="post" class="contact-form" style="display:none;">
                <div class="form-group has-feedback">
				<div class="row">
					<div class="col-md-3">
						<label for="admin_email">Domain :</label>
					</div>
					<div class="col-md-9">
						<input type="email" class="form-control" value="" placeholder="Admin Email" name="admin_email" />
                           <p class="admin_email_error"></p>
					</div>
					<div class="col-md-3">
						<label for="usr_email">Email :</label>
					</div>
					<div class="col-md-9">
						<input type="email" class="form-control" value="" placeholder="User Email" name="usr_email" />
                           <p class="usr_email_error"></p>
					</div>
					<div class="col-md-3">
						<label for="usr_password">Password :</label>
					</div>
					<div class="col-md-9">
						<input type="password" class="form-control" value="" placeholder="User Password" name="usr_password" />
                          <p class="password_error"></p>
					</div>
                </div>
            
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck"></div>
                    </div>
                    <div class="col-xs-4">
                      <input type="button" value="Sign In" class="btn btn-primary btn-block btn-flat usr_log_btn">
                    </div>
              </div>
            </form>   			
			<!--div class="row">
				<div class="col-xs-4">
				  <input type="button" value="Admin sign up" class="btn btn-primary btn-block btn-flat show_admin_login" style="display:none;">
				</div>
				<div class="col-xs-4">
				  <input type="button" value="User sign up" class="btn btn-primary btn-block btn-flat show_usr_login">
				</div>
			</div-->
    <!-- /.social-auth-links -->
  </div>
  </div>
  </div>

   </body>
   <script>
   function Show_admin(){
	   $(".contact1-form").show();
	   $(".contact-form").hide();
   }
   function Show_user(){
	   $(".contact-form").show();
	   $(".contact1-form").hide();
   }
	$( document ).ready(function() {
	
/* 	$(".show_usr_login").click(function(e){
		$(".contact-form").show();
		$(".contact1-form").hide();
		$(".show_admin_login").show();
		$(".show_usr_login").hide();
	});
	
	$(".show_admin_login").click(function(e){
		$(".contact1-form").show();
		$(".contact-form").hide();
		$(".show_admin_login").hide();
		$(".show_usr_login").show();
	});
	 */
    $(".usr_log_btn").click(function(e){
		e.preventDefault();	  
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		var form = $('.contact-form')[0]; // You need to use standard javascript object here			
		var formData = new FormData(form);

		if(!emailReg.test(formData.get('admin_email')) || formData.get('admin_email')==''){
			$(".admin_email_error").html('Email id not valid');

		}else if(!emailReg.test(formData.get('usr_email')) || formData.get('usr_email')==''){
			$(".usr_email_error").html('Email id not valid');

		} else {					
			$.ajax({
						url:'usr_ajax-call.php',
						data: formData,
						type: 'POST',
						dataType: "json",
						contentType: false, 
						processData: false, 
						success: function(data)
						{
							if(data=='success'){
								location.reload();
							} else {
								$(".usr_email_error").html('This email id is not registered');
							}		
						}						
					});
				
		}
   
	});
		
    $(".log_btn").click(function(e){
		e.preventDefault();	  
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		var form = $('.contact1-form')[0]; // You need to use standard javascript object here			
		var formData = new FormData(form);

		if(!emailReg.test(formData.get('email')) || formData.get('email')==''){
			$(".email_error").html('Email id not valid');

		} else {					
			$.ajax({
						url:'ajax-call.php',
						data: formData,
						type: 'POST',
						dataType: "json",
						contentType: false, 
						processData: false, 
						success: function(data)
						{
							if(data=='success'){
								location.reload();
							} else {
								$(".email_error").html('This email id is not registered');
							}		
						}						
					});
				
		}
   
	});
	
	});
   </script>
   </html>	
<?php 
}
