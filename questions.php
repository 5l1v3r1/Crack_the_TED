<?php 
include('db.php');
session_start();
if(isset($_POST['submit']))
{
	$value_number =$_SESSION['value_number_yash'];
	$emailid = $_SESSION['username'];
	$get_answer=strtolower(test_input($_POST['answer']));
	$get_answer=preg_replace('/[^A-Za-z0-9\-]/','',$get_answer);
	$get_answer=str_replace(' ','-',$get_answer);
	$get_answer=str_replace('-','',$get_answer);
$result=mysqli_query($mysqli,"SELECT answer FROM quiz WHERE id='$value_number'");
$set_answer = mysqli_fetch_array($result);
if($get_answer==$set_answer['answer']){
	$value_number_new = $value_number + 1;
	$update = "UPDATE users SET number='$value_number_new' WHERE username='$emailid'";
	$result2 = mysqli_query($mysqli, $update);
}
else{
	 echo "<script>alert('Sorry! Incorrect answer') </script>";
}
}
	function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;}
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
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="icon" href="img/logo_favicon.png" type="image/x-icon" />
	<link rel="stylesheet" href="css/style.css" type="text/css">
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
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<meta property="og:url" content="http://www.tedxiitroorkee.com/" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="#Crack_the_TED" />
	<meta property="og:description" content="#Crack_the_TED 2017" />
	<meta property="og:image" content="http://www.tedxiitroorkee.com/tedx.jpg" />
</head>

<body id="page-top" class="page2">
<?php 
if(isset($_SESSION['username'])) {
    $emailid = $_SESSION['username'];
	$sql = "SELECT number FROM users WHERE username='$emailid'";
	$result = mysqli_query($mysqli, $sql);
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$value_number = $row["number"];
			$_SESSION['value_number_yash'] = $value_number; 
		}
	} else {
		echo "<script>alert('Username is not present') </script>";
	echo "<script> location.replace('index.php') </script>";
	}
	$get_question = "SELECT * FROM quiz WHERE id='$value_number'";
	$result1 = mysqli_query($mysqli, $get_question);
	if (mysqli_num_rows($result1) > 0) {
		while($row = mysqli_fetch_assoc($result1)) {
			echo '<div class="container-fluid">
					<div class="row logos">
						<div class="col-lg-10 col-lg-offset-1">
							<div class="col-lg-2">
							</div>
							<div class="col-lg-4 col-lg-offset-2">
                            <center><h1 style="color:white;">#Crack_the_TED</h1>
							</div>
							<div class="col-lg-2 col-lg-offset-2">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-10 col-lg-offset-1">
							<div class="col-lg-3 main" style="width: 22.5% !important">
								<h2 class="rules">Rules</h2>
									<ul>
									<li>Quiz has ended. But you can keep on playing. Dont forget to register on <a href="tinyurl.com/y8cx8q4l" target="_blank">tinyurl.com/y8cx8q4l</a></li>
										<li>Get Free Jabong and Flipkart coupons at level 8 and 12 worth Rs 250</li>
										<li>All the pictures correspond to a clue. Combine all the clues to get the answer. </li>
										<li>Take title as a hint too.</li>
										<li>The answers are case sensitive: All answers are in lowercase alphabets with no spaces, no special characters, no uppercase alphabets and no numeric characters.</li>
									</ul>
									<div class="col-sm-6 col-sm-offset-3 instruct"  data-toggle="modal" data-target="#myModal"><center><a >Rulebook</a></center></div>
							</div>
					<div class="col-lg-6 main middle">
						<h2 class="rules">LEVEL '. ($row["id"] - 1) .'</h2>
						<p class="question">'. $row["question"] .'</p>';
			echo '<div class="col-lg-10 col-lg-offset-1 image internal_scroll"><img src="//tedxiitroorkee.com/crack_the_ted/qimg/'.$row["image"].'" class="img-responsive" /></div>';
			echo '<div class="answer" style="background-color: rgb(228,81,85);">
								<form method="post" action="" class="form">
								<div class="col-lg-9" style="background-color: rgb(228,81,85);">
									<input type="text" name="answer" placeholder="Answer" class="input_answer" id="name">
								</div>
								<div class="col-lg-3" style="background-color: rgb(228,81,85);">
									<input type="submit" class="submit instruct1" name="submit" value="Submit">
								</div>
								</form>
						  </div>
				<div class="logout" style="position:absolute;bottom:13vh;"><a href="logout.php?logout">Logout</a></div></div>';
			$page=0;
			$rewardlink="";
			if (($row["id"])==10){$page=1; $rewardlink="goo.gl/5d4Mft";}
			if (($row["id"])==14){$page=2; $rewardlink="goo.gl/p2b2XB";}
			echo '<div hidden id="dialog-success" title="Congratulations">
				<p align=center ><img src="successimg/lvl'.($row["id"] - 2).'.jpg" height=400 width=400 ></p>
				<p align=center onclick="window.open(\'http://'.$rewardlink.'\'); return false;" target="_blank">Link - <a href="'.$rewardlink.'">'.$rewardlink.'</a></p>
				</div>';
			echo '<script>
					if('.($row["id"]).'==10||'.($row["id"]).'==14){trigger();}
					function trigger(){
					$( "#dialog-success" ).dialog({
					draggable: false,
					resizable: false,
					height: "600",
					width: 500,
					modal: true,
					buttons: {
					"Share on Facebook": function() {
					popup("https://www.facebook.com/sharer/sharer.php?app_id=1912589955670952&kid_directed_site=0&sdk=joey&u=http%3A%2F%2Fwww.tedxiitroorkee.com%2Fcrack_the_ted%2Fshare%2Flanding'.$page.'.php&display=popup&ref=plugin&src=share_button", "Win1", 600, 600);
					},
					Proceed: function() {
					$( this ).dialog( "close" );
					}
					}
					});};
						function popup(url, name, width, height)
						{
						settings=
						"toolbar=yes,location=yes,directories=yes,"+
						"status=no,menubar=no,scrollbars=yes,"+
						"resizable=yes,width="+width+",height="+height;

						MyNewWindow=window.open(url,name,settings);
						};
				</script>';
		}
	} else {
		echo '<div class="container-fluid">
					<div class="row logos">
						<div class="col-lg-10 col-lg-offset-1">
							<div class="col-lg-2">
							</div>
							<div class="col-lg-4 col-lg-offset-2">
                            <center><h1 style="color:white;">#Crack_the_TED</h1>
							</div>
							<div class="col-lg-2 col-lg-offset-2">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-10 col-lg-offset-1">
							<div class="col-lg-3 main" style="width: 22.5% !important">
								<h2 class="rules">Rules</h2>
								<ul>	
								<li>Quiz has ended. But you can keep on playing. Dont forget to register on <a href="tinyurl.com/y8cx8q4l" target="_blank">tinyurl.com/y8cx8q4l</a></li>
								<li>Get Free Jabong and Flipkart coupons at level 8 and 12 worth Rs 250</li>
										<li>All the pictures correspond to a clue. Combine all the clues to get the answer. </li>
										<li>Take title as a hint too.</li>
									<li>The answers are case sensitive: All answers are in lowercase alphabets with no spaces, no special characters, no uppercase alphabets and no numeric characters.</li>
								</ul>
								<div class="col-sm-6 col-sm-offset-3 instruct"  data-toggle="modal" data-target="#myModal"><center><a >Rulebook</a></center></div>
							</div>
						<div class="col-lg-6 main middle">
						<img class="col-lg-12" src="successimg/thank_you.jpg"></img>
						<p align="center"><a href="https://tinyurl.com/y8cx8q4l">Register Here</a></p>
						<div class="logout" style="width:100%;text-align:center;position:absolute;bottom:15vh;"><a href="logout.php?logout" style="font-size:20px; color:red;">Logout</a></div>
						</div>';
	}
} else {
    echo "<script>alert('Please Login First') </script>";
	echo "<script> location.replace('index.php') </script>";
}
?>
<?php
echo '<div class="col-lg-3 main internal_scroll" style="width: 22.5% !important">
					<h2 class="rules">Leaderboard</h2>
					';
$nikhil = "SELECT username, number FROM users ORDER BY number DESC LIMIT 20";
$nikhil1 = mysqli_query($mysqli, $nikhil);
$i = 1;
while($row = mysqli_fetch_assoc($nikhil1)) {
			$score = $row['number'] - 1;
			echo '<div class="col-lg-12 order" style="padding-left: 0px !important;">
			<div class="col-lg-1" style="text-align: left;padding-left: 0px !important;margin-top: 10px;">' . $i . '</div>';
			echo '<div class="col-lg-7" style="margin-top: 10px;">' .$row['username'] . '</div>';
			echo '<div class="col-lg-2 col-lg-offset-1" style="margin-top: 10px;">' .$score . '</div></div>';
			$i++;
		}
	echo '
				</div>
			</div>
		</div>
	</div>';
?>
						  <div class="modal fade" id="myModal" role="dialog">
							<div class="modal-dialog">
							  <div class="modal-content">
								<div class="modal-header">
								  <button type="button" class="close" data-dismiss="modal">&times;</button>
								  <h4 class="modal-title">Instructions</h4>
								</div>
								<div class="modal-body">
								  <ul>
								  <li>Quiz has ended. But you can keep on playing. Dont forget to register on <a href="tinyurl.com/y8cx8q4l" target="_blank">tinyurl.com/y8cx8q4l</a></li>
									<li>The answers are case sensitive: All answers are in lowercase alphabets with no spaces, no special characters, no uppercase alphabets and no numeric characters.</li>
									<li>If the answer is name of person, write full name as mentioned on Wikipedia.</li>
								  <li>If the answer has any number they must be spelled in lowercase alphabets, for example, if the answer to Level 0 is "TED2017", submit the answer as “tedtwozerooneseven”</li>
								  <li>There can be hints anywhere on the web page (check the source code as well). No hint is useless. If a hint is there, then it must have some significance.</li>
								  <li>Most levels will require some amount of lateral thinking combined with some help from Google.</li>
								  <li>There is no restriction on the number of attempts for a problem.</li>
								  <li>Do try your best, and be a little patient as far as hints are concerned.</li>
								  <li>Hints will be posted on our FB page. Like: <a href="https://www.facebook.com/tedxiitr/" target="_blank">https://www.facebook.com/tedxiitr/</a></li>
								  <li>Revealing answers or creating multiple accounts will lead to disqualification or permanent ban.</li> 
								  </ul>
								</div>
								<div class="modal-footer">
								  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							  </div>
							</div>
						  </div>
</body>
</html>