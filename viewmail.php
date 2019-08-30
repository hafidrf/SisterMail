<?php
session_start();
if( !isset($_SESSION["email"]) && !isset($_SESSION["pswd"]) ){
  header('location: login.php');
}
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<?php
function get_mime_type(&$structure){
  $primary_mime_type = array("TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER");
  if($structure->subtype) {return $primary_mime_type[(int) $structure->type] . '/' . $structure->subtype;}
  return "TEXT/PLAIN";
}
function get_part($stream, $msg_number, $mime_type, $structure = false, $part_number = false){
  if (!$structure) {$structure = imap_fetchstructure($stream, $msg_number);}
  if($structure)
  {   if($mime_type == get_mime_type($structure))
    {   if(!$part_number) {$part_number = "1";}
      $text = imap_fetchbody($stream, $msg_number, $part_number);
      if($structure->encoding == 3) {return imap_base64($text);}
      else if ($structure->encoding == 4) {return imap_qprint($text);}
      else {return $text;}
    }
    if ($structure->type == 1) /* multipart */
    {   while (list($index, $sub_structure) = each($structure->parts))
      {   if ($part_number) {$prefix = $part_number . '.';}
        $data = get_part($stream, $msg_number, $mime_type, $sub_structure, $prefix . ($index + 1));
        if ($data) {return $data;}
      }
    }
  }
  return false;
}

$msg_number = $_GET['msgno'];
$msg_from = $_GET['msgfrom'];
$msg_email = $_GET['msgemail'];
$msg_date = $_GET['msgdate'];
$msg_subject = $_GET['msgsubj'];
$usermail = $_SESSION['email'];
$password = $_SESSION['pswd'];

if(strpos($usermail, "@yahoo")==true || strpos($usermail, "@ymail")==true){
$hostname = '{imap.mail.yahoo.com:993/imap/ssl/novalidate-cert}INBOX';
}elseif(strpos($usermail, "@aol")==true){
  $hostname = '{imap.aol.com:993/imap/ssl}INBOX';
}else{
$hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
}

$stream = imap_open($hostname,$usermail,$password) or die('Cannot connect to mail server: ' . imap_last_error());
$emails = imap_search($stream,'FROM "'.$msg_email.'"  SUBJECT "'.$msg_subject.'" ');
/* Cek email*/
$max_emails = 16;
if($emails) {
$count = 1;
rsort($emails);
/* untuk semua email */
foreach($emails as $email_number)
{
    /* mendapatkan spesifik email */
    $overview = imap_fetch_overview($stream,$email_number,0);
    /* mendapatkan isi pesan*/
    $message = imap_fetchbody($stream,$email_number,2);
    /* mendapatkan struktur email*/
    $structure = imap_fetchstructure($stream, $email_number);
    $attachments = array();
    /* jika terdapat lampiran */
    if(isset($structure->parts) && count($structure->parts)){
      for($i = 0; $i < count($structure->parts); $i++){
          $attachments[$i] = array(
              'is_attachment' => false,
              'filename' => '',
              'name' => '',
              'attachment' => ''
          );
      if($structure->parts[$i]->ifdparameters){
          foreach($structure->parts[$i]->dparameters as $object){
              if(strtolower($object->attribute) == 'filename')
              {
                  $attachments[$i]['is_attachment'] = true;
                  $attachments[$i]['filename'] = $object->value;
              }
          }
      }
      if($structure->parts[$i]->ifparameters){
          foreach($structure->parts[$i]->parameters as $object){
              if(strtolower($object->attribute) == 'name')
              {
                  $attachments[$i]['is_attachment'] = true;
                  $attachments[$i]['name'] = $object->value;
              }
          }
      }
      if($attachments[$i]['is_attachment']){
          $attachments[$i]['attachment'] = imap_fetchbody($stream, $email_number, $i+1);
          if($structure->parts[$i]->encoding == 3){
              $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
          }
          elseif($structure->parts[$i]->encoding == 4){
              $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
          }
      }
  }
}

    /* iterate through each attachment and save it */
    foreach($attachments as $attachment){
        if($attachment['is_attachment'] == 1){
            $filename = $attachment['name'];
            if(empty($filename)) $filename = $attachment['filename'];
            if(empty($filename)) $filename = time() . ".dat";
            $fp = fopen("download/". $filename, "w+");
            fwrite($fp, $attachment['attachment']);
            fclose($fp);
        }
    }
    if($count++ >= $max_emails) break;
  }
}

$messages = get_part($stream, $msg_number, "TEXT/HTML");
if (get_magic_quotes_gpc()) {
$msg_subject = stripslashes($msg_subject);
$messages= stripslashes($messages);
}
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
    <title><?php echo $msg_subject ?> - ICT Mail</title>
    <link href="./assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">
    <link href="./assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
$(document).ready(function() {
      $('#output').hide();
      $('#form').submit(function(){
               $('#output').show();
      });
  });
</script>
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
                      <h3 class="text-themecolor m-b-0 m-t-0">Pesan Masuk</h3>
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                          <li class="breadcrumb-item active">Pesan Masuk</li>
                      </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">
                              <div class="container">
                              <?php
                              if(isset($_POST['dekrippesan'])){
                                  include "crypto/AES.php";
                                  include "crypto/RC4.php";
                                  $start_time = microtime(true);
                                  $key        = substr(md5($_POST['kunci']), 0,16);
                                  //dekrip pesan
                                  $messages = base64_decode($messages);
                                  $loop 	= (strlen($messages) % 16 == 0) ? strlen($messages)/16 : intVal(strlen($messages)/16) + 1;
                                	$plaintext = "";
                                	for ($i=0; $i<$loop; $i++) {
                                		$start    = $i * 16;
                                		$cipher	  = substr($messages, $start, 16);
                                		$rc4 	    = new rc4($key);
                                		$dekrip1  = $rc4->decrypt($cipher);
                                		$aes 	    = new AES($key);
                                		$dekrip2  = $aes->decrypt($dekrip1);
                                		$plaintext .= $dekrip2;
                                	}
                                  //dekrip attachment
                                  $file_path  = "download/$filename";
                                  $file_name  = substr($filename, 0, -4);
                                  $file_size  = filesize($file_path);
                                  $fopen      = fopen($file_path, "rb");
                                  $fread      = fread($fopen, $file_size);
                                  $rc4file    = new rc4($key);
                                  $de         = $rc4file->decrypt($fread);
                                  fclose($fopen);
                                  $fopen1     = fopen($file_path, "wb");
                                  fwrite($fopen1, $de);
                                  fclose($fopen1);
                                  $mod        = $file_size%16;
                                  $fopen2     = fopen($file_path, "rb");
                                  $plain      = "";
                                  $cache      = "cache/$file_name";
                                  $fopen3     = fopen( $cache, "wb");
                                  if($mod==0){
                                  $banyak = $file_size / 16;
                                   }else{
                                  $banyak = ($file_size - $mod) / 16;
                                  $banyak = $banyak+1;
                                  }
                                  ini_set('max_execution_time', -1);
                                  ini_set('memory_limit', -1);
                                  $aesfile        = new AES($key);
                                  for($bawah=0;$bawah<$banyak;$bawah++){
                                       $data    = fread($fopen2, 16);
                                       $plain   = $aesfile->decrypt($data);
                                      fwrite($fopen3, $plain);
                                   }
                                  $end_time = microtime(true);
                                  $waktu= round(($end_time - $start_time), 3);?>
                                  <div id="output">
                                    <div class="col-md-12">
                                      <h2>&nbsp;&nbsp;Judul Pesan : <code><?php echo $msg_subject; ?></code></h2>
                                      <table class="table">
                                  <tr>
                                    <td>Nama Pengirim</td>
                                    <td>:</td>
                                    <td><?php echo $msg_from; ?></td>
                                  </tr>
                                  <tr>
                                    <td>Email Pengirim</td>
                                    <td>:</td>
                                    <td><?php echo $msg_email; ?></td>
                                  </tr>
                                  <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td><?php echo $msg_date; ?></td>
                                  </tr>
                                  <tr>
                                    <td>Isi Pesan</td>
                                    <td>:</td>
                                    <td><?php echo $plaintext; ?></td>
                                  </tr>
                                  <tr>
                                    <td>Lampiran</td>
                                    <td>:</td>
                                    <td><a class="btn btn-success" href="<?php echo $cache; ?>"><?php echo substr($filename, 0,-4); ?></a></td>
                                  </tr>
                                    </table>
                                    </div>
                                    <p><h4>Halaman ini dieksekusi dalam waktu <?php echo $waktu ?> detik</h4></p>
                                  </div>
                                  <?php
                                }
                            if (empty($_POST)) { ?>
                              <div class="container">
                                <form action="" method="POST" class="form-horizontal">
                                  <div class="form-group row">
                                      <label class="col-md-2">Masukan Kunci</label>
                                      <div class="col-md-4">
                                        <input type="password" class="form-control" name="kunci" required placeholder="Contoh: kriptografi">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2"></label>
                                        <div class="col-md-4">
                                          <input class='btn btn-success' type='submit' name='dekrippesan' />
                                        </div>
                                      </div>
                                </form>
                              </div>
                              <?php } ?>

                              </div>
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
    <script src="./assets/js/jquery.slimscroll.js"></script>
    <script src="./assets/js/waves.js"></script>
    <script src="./assets/js/sidebarmenu.js"></script>
    <script src="./assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="./assets/js/custom.min.js"></script>
</body>
</html>
