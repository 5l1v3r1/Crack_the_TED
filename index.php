<?php
session_start();
include_once("config.php");
include_once("includes/functions.php");
if(!isset($_SESSION['fb_access_token'])){
	$loginUrl = $helper->getLoginUrl($homeurl, $permissions);
	$output = '<body id="page-top" class="page1">
					<div><div class="container-fluid">
					<div class="row" style="">
						<div class="col-sm-6 screen-only">
							
						</div>
						<div class="col-sm-6 color_fella screen-only" style="">
							<div class="col-sm-4 col-sm-offset-8 logo_thomso" style="">
								
							</div>
						</div>
						<div class="col-sm-4 col-sm-offset-4 card" style="min-height: 57vh;">
							<center><img src="img/mainlogo.jpg" class="img-responsive" style="width: 40vh;"/></center>
							<center class="presents" style="">presents</center>
							<center><div class="dequode_w" style="">#Crack_the_Ted</div></center>
							<center><div class="dequode_content">We are now live</div></center>
							
						</div>
						<!--<div class="col-sm-2 col-sm-offset-5 instruct"  data-toggle="modal" data-target="#myModal"><center><a >Instructions</a></center></div>-->
						<a  href="'.$loginUrl.'"><div class="col-sm-2 col-sm-offset-5 instruct"><center><img src="img/fb.png" class="img-responsive" style="width: 8%;margin-right: 4vh;display: inline-block !important;"/>Proceed with facebook</center></div></a>
					</div>
				</div></div>
</body>'; 	
}else{
	try {
  $response = $fb->get('/me?fields=id,name,email,gender,locale,picture', $_SESSION['fb_access_token']);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$apiuser = $response->getGraphUser();
	$user = new Users();
	$user_data = $user->checkUser('facebook',$apiuser['id'],$apiuser['name'],'',$apiuser['email'],$apiuser['gender'],$apiuser['locale'],"picture");
	if(!empty($user_data)){
		$output = '<body id="page-top" class="page2">
					<div><div class="container-fluid">
						<div class="row logos">
							<div class="col-lg-10 col-lg-offset-1">
								<div class="col-lg-2">
								</div>
								<div class="col-lg-2 col-lg-offset-8">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-10 col-lg-offset-1">
								<div class="col-lg-6 col-lg-offset-3 main" style="height:57vh !important;">
									<h2 class="rules">Profile Details</h2>';
		$output .= '<div class="col-lg-12 image internal_scroll"">
						<center><div class="image1"><img src="//graph.facebook.com/'.$user_data['oauth_uid'].'/picture?type=large" class="img-responsive"></div></center>';
		$_SESSION['fb_id'] =$user_data['oauth_uid'];
		$fbid1 = $_SESSION['fb_id'];
        $output .= '<center><p>Name : ' . $user_data['fname'].' '.$user_data['lname'].'</p></center>';
        $output .= '<center><p>Gender : ' . $user_data['gender'].'</p></center></div>';
        $output .= '<div class="answer">
						<form method="POST" action="username.php" class="form" id="registration_form">
							<div class="col-lg-9">';
		$output .= '<input type="text" name="username" placeholder="Username" class="input_answer" id="name1" maxlength=16 required/>
						</div>
						<div class="col-lg-3">';
		$output .= '<input type="submit" class="submit instruct1" name="submit" value="Submit">
						</div>
						</form></div></div></div></div></div></div>
</body>';
		include('db.php');
	$sql1 = "SELECT username FROM users  WHERE oauth_uid = '$fbid1'";
	$result1 = $mysqli->query($sql1);
	$row = $result1->fetch_assoc();
	if($result1->num_rows > 0 && $row["username"] != NULL){
		$_SESSION['username'] = $row["username"];
		 echo "<script> location.replace('questions.php') </script>";
	}
	else{
	}
	}else{
		$output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="#Crack_the_TED">
	<meta name="keywords" content="#Crack_the_TED, crack, ted, roorkee, iit, uttarakhand, university of roorkee, roorkee college of engineering, "/>
    <title>#Crack_the_TED</title>
	<meta property="og:url" content="http://www.tedxiitroorkee.com/" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="#Crack_the_TED" />
	<meta property="og:description" content="#Crack_the_TED 2017" />
	<meta property="og:image" content="http://www.tedxiitroorkee.com/tedx.jpg" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="icon" href="img/logo_favicon.png" type="image/x-icon" />
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="css/style1.css" type="text/css">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/vendor.min.js"></script>
	 <script type="text/javascript" src="js/jquery.alphanum.js"></script>
	  <script type="text/javascript" src="js/jquery.validate.min.js"></script>
	  <script type="text/javascript" src="js/form.js"></script>
</head>
<script type="text/javascript">
	<!--
	if (screen.width <= 699) {
	document.location = "mobile.html";
	}
	//-->
	</script>
<?php echo $output; ?>
</html>