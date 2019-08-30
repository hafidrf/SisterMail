<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
    <title>Login Sister Mail</title>
    <link href="./assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">
    <link href="./assets/css/colors/blue.css" id="theme" rel="stylesheet">
    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->
	
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->
	<!--[endif]-->
	<script type="text/javascript">
		function displayTime(){
		 var time = new Date();
		 var sh = time.getHours() + "";
		 var sm = time.getMinutes() + "";
		 var ss = time.getSeconds() + "";
		 document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
		}
	</script>
	<style>
		@import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
		.login-block{
		    background: #DE6262;  /* fallback for old browsers */
		background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);  /* Chrome 10-25, Safari 5.1-6 */
		background: linear-gradient(to bottom, #FFB88C, #DE6262); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
		float:left;
		width:100%;
		height: 700px;
		padding : 90px 0;
		}
		.banner-sec{background:url(https://static.pexels.com/photos/33972/pexels-photo.jpg)  no-repeat left bottom; background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;}
		.container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
		.carousel-inner{border-radius:0 10px 10px 0;}
		.carousel-caption{text-align:left; left:5%;}
		.login-sec{padding: 50px 30px; position:relative;}
		.login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
		.login-sec .copy-text i{color:#FEB58A;}
		.login-sec .copy-text a{color:#E36262;}
		.login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #DE6262;}
		.login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
		.btn-login{background: #DE6262; color:#fff; font-weight:600;}
		.banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
		.banner-text h2{color:#fff; font-weight:600;}
		.banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
		.banner-text p{color:#fff;}
	</style>
</head>

<body onload="displayTime();setInterval('displayTime()', 1000);">
    <section class="login-block">
	    <div class="container">
		<div class="row">
			<div class="col-md-4 login-sec">
			    <h2 class="text-center">Login Now</h2>
<!-- 			    <form class="login-form"> -->
				    <form class="login-form" method="post" action="auth.php">
					  <div class="form-group">
					    <label for="exampleInputEmail1" class="text-uppercase">Your E-mail</label>
					    <input name="email" type="text" class="form-control" placeholder="">
					    
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1" class="text-uppercase">Password</label>
					    <input name="pswd" type="password" class="form-control" placeholder="">
					  </div>
					  
					  
					    <div class="form-check">
					    <label class="form-check-label">
					      <input type="checkbox" class="form-check-input">
					      <small>Remember Me</small>
					    </label>
					    <button class="waves-effect waves-dark btn btn-login mr-sm-2 float-right" type="submit" name="login"><i class="mdi mdi-email"></i> Login</button>
					  </div>
					  
					</form>
	
	<div class="copy-text">Created with <i class="fa fa-heart"></i> by <a href="http://hafidrf.com">Hafidrf.com And Friends</a>
	<?php
			$day = date ("D");
			switch ($day) {
			case 'Sun' : $hari = "Minggu"; break;
			case 'Mon' : $hari = "Senin"; break;
			case 'Tue' : $hari = "Selasa"; break;
			case 'Wed' : $hari = "Rabu"; break;
			case 'Thu' : $hari = "Kamis"; break;
			case 'Fri' : $hari = "Jum'at"; break;
			case 'Sat' : $hari = "Sabtu"; break;
			default : $hari = "Ingatkan hari ini..";
			}
			// set the default timezone to use. Available since PHP 5.1
			date_default_timezone_set('Asia/Jakarta');
			// Prints something like: Monday
			$tanggal = date("d M Y");
			echo "<div>
    <a href='index.php'>
    <span>
    <span class='teal-text'>$hari, </span>$tanggal - </span>
    <span id='clock'></span>
    </a>
    </div>";?>

	</div>
			</div>
			<div class="col-md-8 banner-sec">
	            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	                 <ol class="carousel-indicators">
	                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	                  </ol>
	            <div class="carousel-inner" role="listbox">
	    <div class="carousel-item active">
	      <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
	      <div class="carousel-caption d-none d-md-block">
	        <div class="banner-text">
	            <h2>This is Heaven</h2>
	            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
	        </div>	
	  </div>
	    </div>
	    <div class="carousel-item">
	      <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
	      <div class="carousel-caption d-none d-md-block">
	        <div class="banner-text">
	            <h2>This is Heaven</h2>
	            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
	        </div>	
	    </div>
	    </div>
	    <div class="carousel-item">
	      <img class="d-block img-fluid" src="https://images.pexels.com/photos/872957/pexels-photo-872957.jpeg" alt="First slide">
	      <div class="carousel-caption d-none d-md-block">
	        <div class="banner-text">
	            <h2>This is Heaven</h2>
	            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
	        </div>	
	    </div>
	  </div>
	            </div>	   
			    
			</div>
		</div>
	</div>
	</section>
    <script src="./assets/plugins/jquery/jquery.min.js"></script>
    <script src="./assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="./assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.slimscroll.js"></script>
    <script src="./assets/js/waves.js"></script>
    <script src="./assets/js/sidebarmenu.js"></script>
    <script src="./assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="./assets/js/custom.min.js"></script>
</body>

</html>

<!--

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
    <title>Login - ICT Mail</title>
    <link href="./assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">
    <link href="./assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!--
<script type="text/javascript">
	function displayTime(){
	 var time = new Date();
	 var sh = time.getHours() + "";
	 var sm = time.getMinutes() + "";
	 var ss = time.getSeconds() + "";
	 document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
}
</script>
</head>

<body class="fix-header fix-sidebar card-no-border" onload="displayTime();setInterval('displayTime()', 1000);">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <b style="color:white;font-size:35px;">ICT</b>
                        <span style="color:white;font-size:35px">M</span><span style="color:white;">ail </span><span style="color:white;font-size:35px">A</span><span style="color:white;">pp</span></a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li><form class="form-inline my-2 my-lg-0" method="post" action="auth.php">
          <input class="form-control mr-sm-2" type="email" name="email" placeholder="Email" required autofocus autocomplete="off">
          <input class="form-control mr-sm-2" type="password" name="pswd" placeholder="Password" required >
          <button class="waves-effect waves-dark btn btn-success mr-sm-2" type="submit" name="login"><i class="mdi mdi-email"></i> Login</button>
        </form></li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                          <li> <a class="waves-effect waves-dark active" href="login.php" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Login</span></a>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Login</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Login</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">
                                <h1 style="text-align:center;color:#1e88e5;font-size:50px;">ICT Mail</h1>
                                <h2 style="text-align:center">Kirim Email Lebih Aman Menggunakan Kriptografi</h2>
                                <h4 style="text-align:center;color:silver">Harap <b style="color:#455a64">Login</b> terlebih dahulu untuk menggunakannya..</h4>
                                <center> <img src="assets/images/logo/logo-lab-ict.png" alt="" width="200px"></center>
                                <br><br>
                                <?php
                        				$day = date ("D");
                        				switch ($day) {
                        				case 'Sun' : $hari = "Minggu"; break;
                        				case 'Mon' : $hari = "Senin"; break;
                        				case 'Tue' : $hari = "Selasa"; break;
                        				case 'Wed' : $hari = "Rabu"; break;
                        				case 'Thu' : $hari = "Kamis"; break;
                        				case 'Fri' : $hari = "Jum'at"; break;
                        				case 'Sat' : $hari = "Sabtu"; break;
                        				default : $hari = "Ingatkan hari ini..";
                        				}
                        				// set the default timezone to use. Available since PHP 5.1
                        				date_default_timezone_set('Asia/Jakarta');
                        				// Prints something like: Monday
                        				$tanggal = date("d M Y");
                        				echo "<div style='float:right'>
                                <a href='index.php'>
                                <span>
                                <span class='teal-text'>$hari, </span>$tanggal - </span>
                                <span id='clock'></span>
                                </a>
                                </div>";?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                © 2017 ICT Mail - By Ryfan Aditya Indra.
            </footer>
        </div>
    </div>
    <script src="./assets/plugins/jquery/jquery.min.js"></script>
    <script src="./assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="./assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.slimscroll.js"></script>
    <script src="./assets/js/waves.js"></script>
    <script src="./assets/js/sidebarmenu.js"></script>
    <script src="./assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="./assets/js/custom.min.js"></script>
</body>
-->
-->

</html>
