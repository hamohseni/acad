<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Gestion Academica</title>
        <!--===============================================================================================-->
        	<link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/Login/vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        	<link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        	<link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/Login/vendor/animate/animate.css">
        <!--===============================================================================================-->	
        	<link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/Login/vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        	<link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/Login/vendor/select2/select2.min.css">
        <!--===============================================================================================-->
        	<link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/Login/css/u_login.css">
        	<link rel="stylesheet" type="text/css" href="<?php echo constant('URL');?>public/Login/css/login.css">
        <!--===============================================================================================-->
    </head>
    <body>
   
        <div>
            <div class="container-login100" style="background-image: url('<?php echo constant('URL');?>public/imgs/Login/bg-01.jpg');">
                 <?php echo $this->mensaje;?>
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="<?php echo constant('URL');?>public/imgs/Login/img-01.png" alt="IMG">
                    </div>
                                        
                    <form class="login100-form validate-form"  method="post" action="<?php echo constant('URL');?>main/ingresar">
                        <span class="login100-form-title">
                            Login
                        </span>

                        <div class="wrap-input100 validate-input" data-validate = "Valid User">
                            <input class="input100" type="number" name="usuario" placeholder="User" id="usuario">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate = "Password is required">
                            <input class="input100" type="password" name="contrasena" placeholder="Password" id="contrasena">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>
                        
                        <div class="container-login100-form-btn">
                            <input class="login100-form-btn" id="submit" type="submit" name="ingresar" value="SIGN IN"></input>
                        </div>

                        <div class="text-center p-t-40 p-b-80">
                            <span class="txt1">
                                Forgot
                            </span>
                            <a class="txt2" href="#">
                                Password?
                            </a>
                        </div>
                        <!--<div class="text-center p-t-136">
                            <a class="txt2" href="#">
                                Create your Account
                                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                            </a>
                        </div>-->
                    </form>
                </div>
            </div>
        </div>
    </body>

	<!--===============================================================================================-->	
	<script src="<?php echo constant('URL');?>public/Login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    	<script src="<?php echo constant('URL');?>public/Login/vendor/bootstrap/js/popper.js"></script>
    	<script src="<?php echo constant('URL');?>public/Login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    	<script src="<?php echo constant('URL');?>public/Login/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    	<script src="<?php echo constant('URL');?>public/Login/vendor/tilt/tilt.jquery.min.js"></script>
    	<script >
    		$('.js-tilt').tilt({
    			scale: 1.1
    		})
    	</script>
    <!--===============================================================================================-->
    	<script src="<?php echo constant('URL');?>public/Login/js/main.js"></script>

</html>

