<?php
session_start();
if( !isset($_SESSION["email"]) && !isset($_SESSION["pswd"]) ){
  header('location: login.php');
}
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
    <title>Dashboard Home - ICT Mail</title>
    <link href="./assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">
    <link href="./assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
		td, th {
		    vertical-align: middle !important;
		    }
		.left, .right {
		        float:left;
		        height:100vh;
		    }
		    
		.left {
		        background: linear-gradient(to left bottom, #FFB88C, #DE6262);
		        display: inline-block;
		        white-space: nowrap;
		        width: 50px;
		        transition: width 1s ;
		    }
		
		.right {
		        background: #fff;
		        width: 350px;
		        transition: width 1s;
		        border-style:solid;
		        border-color:#ccc;
		        border-width:1px;
		    }    
		
		.left:hover {
		        width: 20%;
		    }    
		    
		.item:hover {
		        background-color:#ccc;
		        }
		        
		.left .glyphicon {
		        margin:15px;
		        width:20px;
		        color:#fff;
		    }
		    
		.right .glyphicon {
		        color:#a9a9a9;
		    }
		span.glyphicon.glyphicon-refresh{
		    font-size:17px;
		    vertical-align: middle !important;
		    }
		    
		.item {
		        height:50px;
		        overflow:hidden;
		        color:#fff;
		    }
		.title {
		        background-color:#eee;
		        border-style:solid;
		        border-color:#ccc;
		        border-width:1px;
		        box-sizing: border-box;
		    }
		.search:hover {
		        border-color:#4aa9fb;
		        border-width:1px;
		    }
		.search {
		    padding:3px 8px 3px !important;
		    }
		input[type=search] {
		    padding: 10px 0px 10px;
			border: 0px solid #fff;
			background: #eee;
			-webkit-appearance: none;
		    width:90%;
		    float:none;
		}
		input[type=search]:focus {
		    outline:none;
		    }
		.type{
		    height: 47px;;
		    }
		.date{
		    background-color:#f7f7f7
		    }
		.docdate {
		    vertical-align:bottom !important;
		    }
		.distr {
		    margin: 0 0 5px;
		    font-size: 12px;
		    }
		.ndoc {
		    margin: 0 0 5px;
		    }
		.storage {
		    margin: 0;
		    color: #aaa !important;
		    font-size: 12px;
		    }
	</style>
	<style>
		.glyphicon{
			    font-size: 18px;
		}
	</style>
</head>

<body class="fix-header fix-sidebar card-no-border" onload="displayTime();setInterval('displayTime()', 1000);">

	<div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
	    <header class="topbar" style="background: linear-gradient(to bottom, #FFB88C, #DE6262);">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light" style="height: 76px;margin-bottom: 0px;">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php" style="float: none;">
                        <b style="color:white;font-size:35px;">Sister</b>&nbsp;&nbsp;
                        <span style="color:white;font-size:35px">e-M</span><span style="color:white;">ail </span><span style="color:white;font-size:35px">A</span><span style="color:white;">pp</span></a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                              <a href="logout.php" class="waves-effect waves-dark btn btn btn-info"><i class="mdi mdi-power"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- left sidebar -->
    	<div class="left">
			<div class="item">
				<a class="" href="index.php" aria-expanded="false">
					<span class="glyphicon glyphicon-th-large">
						Dashboard
					</span>
				</a>
			</div>
			<div class="item active">
				<a class="" href="compose.php" aria-expanded="false">
					<span class="glyphicon glyphicon-pencil">
						Kirim Pesan
					</span>				
				</a>
			</div>
			<div class="item">
				<a class="" href="inbox.php" aria-expanded="false">
					<span class="glyphicon glyphicon-inbox">
						Pesan masuk
					</span>	
				</a>
			</div>
			<div class="item">
<!-- 				<a class="" href="help.php" aria-expanded="false"> -->
				<a href="#">
					<span class="glyphicon glyphicon-question-sign">
						Bantuan
					</span>	
				</a>
			</div>
			<div class="item">
<!-- 				<a class="" href="about.php" aria-expanded="false"> -->
				<a href="#">
					<span class="glyphicon glyphicon-info-sign">
						Tentang
					</span>	
				</a>
			</div>   
		</div>
		<div class="page-wrapper" style="margin-left: 100px;">
	        <div class="container-fluid">
	            <div class="row page-titles">
	                <div class="col-md-5 col-8 align-self-center">
	                  <h3 class="text-themecolor m-b-0 m-t-0" style="color: #DE6262 !important;">Dashboard</h3>
	                  <ol class="breadcrumb">
	                      <li class="breadcrumb-item"><a href="">Home</a></li>
	                      <li class="breadcrumb-item active">Dashboard</li>
	                  </ol>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-12">
	                    <div class="card">
	                        <div class="card-block">
	                            <h1 style="text-align:center">Selamat Datang <code><?php echo $_SESSION['email']; ?></code> di Sister e-Mail</h1>
	                            <h2 style="text-align:center">Kirim Email Lebih Aman Menggunakan Kriptografi</h2>
<!-- 	                            <center> <img src="assets/images/logo/logo-lab-ict.png" alt="" width="200px"></center> -->
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
	        <!--
<footer class="footer" style="left: 50px;">
		        Created with <i class="fa fa-heart"></i> by <a href="http://hafidrf.com">Hafidrf.com And Friends</a>
	        </footer>
-->
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

</html>