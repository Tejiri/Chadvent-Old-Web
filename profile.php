<?php include("databasehelper.php");

if ($_SESSION['username'] == "") {
	header("Location: login.php");
} else {
}

$allinfo = getDetails($_SESSION['username']);

if (isset($_POST['updateimage'])) {

	changePicture($_SESSION['username'],$_FILES['selectedimage']);
	header("Refresh:0");
}

if (isset($_POST['updatepassword'])) {
	updatePassword($_SESSION['username'],$_POST['newpassword']);
	session_unset();
    header("Location: login.php");
}
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $allinfo['firstname'] . " " . $allinfo['lastname'] . " Profile"?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content="" />
	<meta property="og:image" content="" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:description" content="" />
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="resources/profileresources/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="resources/profileresources/css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="resources/profileresources/css/bootstrap.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="resources/profileresources/css/flexslider.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="resources/profileresources/fonts/flaticon/font/flaticon.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="resources/profileresources/css/owl.carousel.min.css">
	<link rel="stylesheet" href="resources/profileresources/css/owl.theme.default.min.css">
	<!-- Theme style  -->
	<link rel="stylesheet" href="resources/profileresources/css/style.css">

	<link rel="stylesheet" href="resources/formstyle.css">

	<!-- Modernizr JS -->
	<script src="resources/profileresources/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	<style>
		table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.blueTable tbody td {
  font-size: 13px;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 2px solid #444444;
}
table.blueTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 2px solid #D0E4F5;
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  background: #D0E4F5;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 2px solid #444444;
}
table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
	</style>

</head>

<body>
	<div id="colorlib-page">
		<div class="container-wrap">
			<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
			<aside id="colorlib-aside" role="complementary" class="border js-fullheight">
				<div class="text-center">
					<div class="author-img" style="background-image: url(resources/images/<?php echo $allinfo['profile_picture']?>);"></div>
					<h1 id="colorlib-logo"><a href="index.html"><?php echo $allinfo['firstname'] . " " . $allinfo['lastname']; ?></a></h1>
					<span class="position"><?php echo $allinfo['position'] ?></span>
				</div>
				<nav id="colorlib-main-menu" role="navigation" class="navbar">
					<div id="navbar" class="collapse">
						<ul>

							<li class="active"><a href="#" data-nav-section="membershipdetails">Membership details</a></li>
							<li><a href="#" data-nav-section="biodata">Biodata</a></li>
							<li><a href="#" data-nav-section="byelaws">Bye Laws</a></li>
							<li><a href="#" data-nav-section="loanapplication">Loan Application</a></li>
							<li><a href="#" data-nav-section="accountstatement">Account Statement</a></li>	
							<li><a href="#" data-nav-section="latestnews">Latest News</a></li>		
							
							<li><a href="#" data-nav-section="updatedetails">Update my info</a></li>		
										
							<form action="logout.php" method="post">
								<input type="submit" value="Logout">
							</form>

							<?php ?>
						</ul>
					</div>
				</nav>

				<div class="colorlib-footer">
					<p><small>&copy;
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;<script>
								document.write(new Date().getFullYear());
							</script> All rights reserved | Xita
							
					<ul>
						<li><a href="#"><i class="icon-facebook2"></i></a></li>
						<li><a href="#"><i class="icon-twitter2"></i></a></li>
						<li><a href="#"><i class="icon-instagram"></i></a></li>
						<li><a href="#"><i class="icon-linkedin2"></i></a></li>
					</ul>
				</div>

			</aside>

			<div id="colorlib-main">


				<section class="colorlib-about" data-section="membershipdetails" style="padding-bottom: 0px; margin-bottom: 0px;">
					<div class="colorlib-narrow-content">
						<div class="row">
							<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
								<span class="heading-meta"><?php echo $allinfo['firstname'] . " " . $allinfo['lastname']; ?></span>
								<h2 class="colorlib-heading">MY MEMBERSHIP PROFILE</h2>
							</div>
						</div>
						<div class="row row-pt-md">
							<div class="col-md-4 text-center animate-box">
								<div class="services color-1">
									<span class="icon">
										<i class="icon-bulb"></i>
									</span>
									<div class="desc">
										<h3>MEMBERSHIP STATUS</h3>
										<p><?php echo $allinfo['membership_status'] ?></p>
									</div>
								</div>
							</div>
							<div class="col-md-4 text-center animate-box">
								<div class="services color-2">
									<span class="icon">
										<i class="icon-data"></i>
									</span>
									<div class="desc">
										<h3>SAVINGS TILL DATE</h3>
										<p><?php echo $allinfo['total_savings'] ?></p>
									</div>
								</div>
							</div>
							<div class="col-md-4 text-center animate-box">
								<div class="services color-3">
									<span class="icon">
										<i class="icon-phone3"></i>
									</span>
									<div class="desc">
										<h3>LOAN ACCOUNT</h3>
										<p>₦<?php echo $allinfo['loan_account'] ?></p>
									</div>
								</div>
							</div>
							<div class="col-md-4 text-center animate-box">
								<div class="services color-4">
									<span class="icon">
										<i class="icon-layers2"></i>
									</span>
									<div class="desc">
										<h3>LOAN APPLICATION STATUS</h3>
										<p><?php echo $allinfo['loan_application_status'] ?></p>
									</div>
								</div>
							</div>
							<div class="col-md-4 text-center animate-box">
								<div class="services color-5">
									<span class="icon">
										<i class="icon-mail"></i>
									</span>
									<div class="desc">
										<h3>LAST TRANSACTION</h3>
										<p><?php echo $allinfo['last_transaction'] ?></p>
									</div>
								</div>
							</div>
							<div class="col-md-4 text-center animate-box">
								<div class="services color-6">
									<span class="icon">
										<i class="icon-user-add"></i>
									</span>
									<div class="desc">
										<h3>Membership Count</h3>
										<p>Chadvent currently has <?php echo membershipCount()?> registered members</p>
									</div>
								</div>
							</div>

						</div>
					</div>
				</section>



				<section class="colorlib-services" data-section="biodata" style="padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">
					<div class="colorlib-narrow-content">
						<div class="row">
							<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
								<span class="heading-meta">MY PERSONAL INFORMATION</span>
								<h2 class="colorlib-heading animate-box">BIODATA</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 animate-box" data-animate-effect="fadeInLeft">
								<div class="fancy-collapse-panel">
									<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="headingOne">
												<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">PHONE NUMBER
													</a>
												</h4>
											</div>
											<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
												<div class="panel-body">
													<div class="row">
														<?php echo $allinfo['phonenumber']; ?>
													</div>
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="headingTwo">
												<h4 class="panel-title">
													<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Email
													</a>
												</h4>
											</div>
											<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
												<div class="panel-body">
													<p><?php echo $allinfo['email'] ?></p>
												</div>
											</div>
										</div>
										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="headingThree">
												<h4 class="panel-title">
													<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Address
													</a>
												</h4>
											</div>
											<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
												<div class="panel-body">
													<p><?php echo $allinfo['address'] ?></p>
												</div>
											</div>
										</div>

										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="headingFour">
												<h4 class="panel-title">
													<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Gender
													</a>
												</h4>
											</div>
											<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
												<div class="panel-body">
													<p><?php echo $allinfo['gender'] ?></p>
												</div>
											</div>
										</div>

										<div class="panel panel-default">
											<div class="panel-heading" role="tab" id="headingFive">
												<h4 class="panel-title">
													<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Occupation
													</a>
												</h4>
											</div>
											<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
												<div class="panel-body">
													<p><?php echo $allinfo['occupation'] ?></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>

				<section class="colorlib-skills" data-section="byelaws" style="padding-top: 0px; margin-top: 100px; padding-bottom: 0px; margin-bottom: 0px;">
					<div class="colorlib-narrow-content">
						<div class="row">
							<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
								<span class="heading-meta">Chadvent Byelaws</span>
								<h2 class="colorlib-heading animate-box">BYE LAWS</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 animate-box" data-animate-effect="fadeInLeft">
								<p> Download the Byelaws
									<form method="get" action="resources/BYELAWS-Final.docx">
										<button type="submit">Here</button>
									</form>
							</div>

						</div>
					</div>
				</section>

				<section class="colorlib-education" data-section="loanapplication" style="padding-top: 0px; margin-top: 100px; padding-bottom: 0px; margin-bottom: 0px;">
					<div class="colorlib-narrow-content">
						<div class="row">
							<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
								<span class="heading-meta">Loan</span>
								<h2 class="colorlib-heading animate-box">Loan Application</h2>
							</div>
						</div>
						<div class="row" style="margin-left: 0px; padding-left: 0px; padding-right: 0px;">
							<div  style="margin-left: 0px; padding-left: 0px;">
								
								<p>In order to apply for a loan, kindly download and fill out the form bellow
								Guidelines and procedures for submissions can be found in the document</p>
								<p style="color: red">*Note a minimum of 3 guarantors are required to apply for a loan</p>
								<form method="get" action="resources/loan application form.docx">
										<button type="submit">Download Loan application form</button>
									</form>
								
							</div>
						</div>

					</div>
				</section>

				<section class="colorlib-work" data-section="accountstatement" style="padding-top: 0px; margin-top: 100px; padding-bottom: 0px; margin-bottom: 0px;">
					<div class="colorlib-narrow-content">
						<div class="row">
							<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
								<span class="heading-meta">Account Statement</span>
								<h2 class="colorlib-heading animate-box">My Last ten transactions</h2>
							</div>
						</div>



						<div>
							<table class="display blueTable">
								<thead>
									<th style="text-align: center;">S/N</th>
									<th>Date</th>
									<th>Narration</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Balance</th>
								</thead>
								
								<tbody>
									<?php
									$statement = getStatement($_SESSION['username']);
									$count = 1;
									foreach ($statement as $key => $value) {
										if ($key >= count($statement)-10) {										
										$nextArray = $statement[$key]; ?>
										<tr>
											<td><?php echo $count ?></td>
											<td><?php echo $nextArray[1] ?></td>
											<td><?php echo $nextArray[2] ?></td>
											<td><?php echo $nextArray[3] ?></td>
											<td><?php echo $nextArray[4] ?></td>
											<td><?php echo $nextArray[5] ?></td>
										</tr>
									<?php $count++;	}   }

									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 animate-box">
							<p style="margin-top: 30px;"><a href="statement.php" class="btn btn-primary btn-lg btn-load-more">View full statement or print</a></p>
						</div>
					</div>
			</div>
			</section>

				<section style="width: calc(100% - 300px); float: right; padding-top: 0px; margin-top: 100px; padding-bottom: 0px; margin-bottom: 0px;" class="colorlib-experience" data-section="latestnews" style="padding-top: 0px; margin-top: 100px; padding-bottom: 0px; margin-bottom: 0px;">
					<div class="colorlib-narrow-content">
						<div class="row">
							<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
								<span class="heading-meta">News</span>
								<h2 class="colorlib-heading">Latest news</h2>
							</div>
						</div>
						<div class="row">

							<div style="background-color: #d0e4f5; height: 250px; margin-left: 0px;margin-right: 0px;">
								<div style="margin-left: 0px;margin-right: 0px; background-color: #3b82b1;">
									<h2 style="padding-top: 5px;padding-bottom: 5px;text-align: center; font-weight: bold;">Broadcast News</h2>
								</div>
								<p style="margin-left: 50px;"><marquee behavior="" direction=""><?php echo getnews()['news'] ?></marquee></p>
							</div>


						</div>
					</div>
				</section>

				

			<section style="width: calc(100% - 300px); float: right; padding-top: 0px; margin-top: 100px; padding-bottom: 0px; margin-bottom: 0px;" class="colorlib-services" data-section="updatedetails" style="padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">
					<div class="colorlib-narrow-content">
						<div class="row">
							<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
								<span class="heading-meta">UPDATE MY INFORMATION</span>
								<h2 class="colorlib-heading animate-box">Update profile</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 animate-box" data-animate-effect="fadeInLeft">
								<h4 style="font-weight: bold">Update Profile picture</h4>
								<form action="" method="post" enctype="multipart/form-data">
								<input type="file" name="selectedimage" id="" en>
								<input type="submit" value="Update picture" name="updateimage">
								</form>

								<h4 style="margin-top: 50px; font-weight: bold">Update Password</h4>
								<form action="" method="post" enctype="multipart/form-data">
								<input type="text" placeholder="Enter new password" name="newpassword" id="" en>
								<input type="submit"  value="Update my password" name="updatepassword">
								
								</form>
								
							</div>
						</div>
					</div>
				</section>

			
			<section class="colorlib-contact" data-section="contact" style="padding-top: 0px; margin-top: 100px; padding-bottom: 0px; margin-bottom: 0px;">
				<div class="colorlib-narrow-content" style="height: 500px;">
					
				</div>
			</section>

		

		</div><!-- end:colorlib-main -->
	</div><!-- end:container-wrap -->
	</div><!-- end:colorlib-page -->

	<!-- jQuery -->
	<script src="resources/profileresources/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="resources/profileresources/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="resources/profileresources/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="resources/profileresources/js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="resources/profileresources/js/jquery.flexslider-min.js"></script>
	<!-- Owl carousel -->
	<script src="resources/profileresources/js/owl.carousel.min.js"></script>
	<!-- Counters -->
	<script src="resources/profileresources/js/jquery.countTo.js"></script>


	<!-- MAIN JS -->
	<script src="resources/profileresources/js/main.js"></script>
							
</body>

</html>