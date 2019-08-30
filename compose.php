<?php
session_start();
if( !isset($_SESSION["email"]) && !isset($_SESSION["pswd"]) ){
  header('location:login.php');
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
    <title>Kirim Email - ICT Mail</title>
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
                    <ul class="navbar-nav mr-auto mt-md-0" style="float: right;text-align: right !important;">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        
                    </ul>
                    <ul class="navbar-nav my-lg-0">
	                    <span style="color:white;margin-top: 15px;margin-right: 15px;">Saat ini login sebagai <code><?php echo $_SESSION['email'];?></code></span>
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
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                      <h3 class="text-themecolor m-b-0 m-t-0">Kirim Email</h3>
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                          <li class="breadcrumb-item active">Kirim Email</li>
                      </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">
                                <h1>Kirim Email</h1><hr>
                                <form method="post" class="form-horizontal" action="sendmail.php" enctype="multipart/form-data">
                                  <div class="form-group row">
                                      <label class="col-md-2">Tujuan</label>
                                      <div class="col-md-10">
                                        <input type="email" class="form-control" name="tujuan" autocomplete="off" required placeholder="contoh: namaemail@domain.com">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">Judul Pesan</label>
                                        <div class="col-md-10">
                                          <input type="text" class="form-control form-control-line" name="judulpesan" autocomplete="off" required placeholder="contoh: Halo Dunia!">
                                        </div>
                                      </div>
                                    <div class="form-group row">
                                    <label class="col-md-2">Isi Pesan</label>
                                    <div class="col-md-10">
                                      <textarea name="isipesan" class="form-control ckeditor" id="ckeditor"></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                      <label class="col-md-2">Lampiran</label>
                                      <div class="col-md-10">
                                        <input type="file" class="form-control" name="file">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2">Kunci</label>
                                        <div class="col-md-10">
                                          <input type="password" class="form-control" name="kunci" autocomplete="off" required placeholder="contoh: kriptografi">
                                        </div>
                                      </div>
                                    <div class="form-group row">
                                        <label class="col-md-2"></label>
                                        <div class="col-md-10">
                                          <input type="submit" class="btn btn-success" name="kirimemail" value="Kirim Pesan Email">
                                          <input type="reset" class="btn btn-danger" value="Reset Form">
                                          <a href="index.php" class="btn btn-info">Kembali</a>
                                        </div>
                                      </div>
                               </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/plugins/jquery/jquery.min.js"></script>
    <script src="./assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="./assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="./assets/plugins/ckeditor/ckeditor.js"></script>
    <script src="./assets/js/jquery.slimscroll.js"></script>
    <script src="./assets/js/waves.js"></script>
    <script src="./assets/js/sidebarmenu.js"></script>
    <script src="./assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="./assets/js/custom.min.js"></script>
</body>
</html>
