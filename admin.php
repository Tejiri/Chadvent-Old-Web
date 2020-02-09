<?php include("databasehelper.php") ?>



<?php
$connection = mysqli_connect("localhost", "root", "", "chadvent");
$query1 = "select * from userdetails";
$result = mysqli_query($connection, $query1);
$fulldatabase = mysqli_fetch_all($result);
?>


<?php


if (isset($_POST['insert'])) {
	$totalsavings2 = "₦" . "0";
	$lasttransaction2 = "₦" . "0";
	insert(

		$_POST['username'],
		$_POST['password'],
		$_POST['firstname'],
		$_POST['lastname'],
		$_POST['position'],
		$_POST['membershipstatus'],
		$totalsavings2,
		$_POST['loanaccount'],
		$lasttransaction2,
		$_POST['loanapplicationstatus'],
		$_POST['phonenumber'],
		$_POST['email'],
		$_POST['address'],
		$_POST['gender'],
		$_POST['occupation'],
	);
//	header("Location: admin.php");
}



if (isset($_POST['update'])) {
	if (isset($_GET['id'])) {
		update(
			$_GET['id'],
			$_POST['username'],
			$_POST['password'],
			$_POST['firstname'],
			$_POST['lastname'],
			$_POST['position'],
			$_POST['membershipstatus'],
			//$_POST['totalsavings'],
			$_POST['loanaccount'],
			//$_POST['lasttransaction'],
			$_POST['loanapplicationstatus'],
			$_POST['phonenumber'],
			$_POST['email'],
			$_POST['address'],
			$_POST['gender'],
			$_POST['occupation'],
		);
		header("Refresh:0");
	}
}


if (isset($_POST['credit'])) {
	if (isset($_GET['id'])) {
		credit($_POST['username'], $_POST['creditamount'], $_POST['creditdate']);
		header("Refresh:0");
	}
}

if (isset($_POST['debit'])) {
	if (isset($_GET['id'])) {
		debit($_POST['username'], $_POST['debitamount'], $_POST['debitdate']);
		header("Refresh:0");
	}
}

if (isset($_POST['delete'])) {
	delete($_GET['id']);
	header("Location: admin.php");
}

if (isset($_POST['clear'])) {

	header("Location: admin.php");
}

if (isset($_POST['editnews'])) {
	editNews($_POST['news']);
	header("Refresh:0");
}
?>


<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Administrative Dashboard</title>
	<meta name="description" content="Sticky Table Headers Revisited: Creating functional and flexible sticky table headers" />
	<meta name="keywords" content="Sticky Table Headers Revisited" />
	<meta name="author" content="Codrops" />
	<link rel="shortcut icon" href="resources/adminresources/css/favicon.ico">
	<link rel="stylesheet" type="text/css" href="resources/adminresources/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="resources/adminresources/css/demo.css" />
	<link rel="stylesheet" type="text/css" href="resources/adminresources/css/component.css" />
	<!--[if IE]>
  		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

	<style>
		[type="date"] {
			background: #fff url(https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/calendar_2.png) 100% 50% no-repeat;
		}

		[type="date"]::-webkit-inner-spin-button {
			display: none;
		}

		[type="date"]::-webkit-calendar-picker-indicator {
			opacity: 0;
		}
	</style>
</head>


<body>

	<div class="container">

		<header style="background-color: black; color: white;">
			<h1>Administrative Dashboard</h1>

		</header>
		<div style="text-align: center; margin-top: 50px;">
			<form action="logout.php" method="post">
				<input type="submit" value="Logout" style="width: 100px; height: 50px;">
			</form>
		</div>

		<div class="component">

			<table class="overflow-y">
				<thead>
					<tr>
						<th>Username</th>
						<th>Password</th>
						<th>Firstname</th>
						<th>Lastname</th>
						<th>Position</th>
						<th>Membership Status</th>
						<th>Loan Account</th>
						<th>Loan Application Status</th>
						<th>Phone Number</th>
						<th>Email</th>
						<th>Address</th>
						<th>Gender</th>
						<th>Occupation</th>
						<th>Edit/Credit/Debit</th>
						<th>Delete</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($fulldatabase as $key => $value) {
						$nextArray = $fulldatabase[$key]; ?>
						<form action="admin.php?id=<?php echo $nextArray[0]; ?>" method="post">
							<tr>
								<th><?php echo $nextArray[1] ?></th>
								<td><?php echo $nextArray[2] ?></td>
								<td><?php echo $nextArray[3] ?></td>
								<td><?php echo $nextArray[4] ?></td>
								<td><?php echo $nextArray[5] ?></td>
								<td><?php echo $nextArray[6] ?></td>
								<td><?php echo $nextArray[8] ?></td>
								<td><?php echo $nextArray[10] ?></td>
								<td><?php echo $nextArray[11] ?></td>
								<td><?php echo $nextArray[12] ?></td>
								<td><?php echo $nextArray[13] ?></td>
								<td><?php echo $nextArray[14] ?></td>
								<td><?php echo $nextArray[15] ?></td>
								<td>
									<input type="submit" value="Edit/Credit/Debit" name="edit">
								</td>
								<td>
									<input type="submit" value="Delete" name="delete">
								</td>


							</tr>

						</form>

					<?php   }
					if (isset($_GET['id'])) {
						$id = $_GET['id'];
						$query = "select * from userdetails where id='$id'";
						$result = mysqli_query($connection, $query);
						$memberdetails = mysqli_fetch_assoc($result);
						$username = $memberdetails['username'];
						$password = $memberdetails['password'];
						$firstname = $memberdetails['firstname'];
						$lastname = $memberdetails['lastname'];
						$position = $memberdetails['position'];
						$membershipstatus = $memberdetails['membership_status'];
						$totalsavings = $memberdetails['total_savings'];
						$loanaccount = $memberdetails['loan_account'];
						$lasttransaction = $memberdetails['last_transaction'];
						$loanapplicationstatus = $memberdetails['loan_application_status'];
						$phonenumber = $memberdetails['phonenumber'];
						$email = $memberdetails['email'];
						$address = $memberdetails['address'];
						$gender = $memberdetails['gender'];
						$occupation = $memberdetails['occupation'];
						$tablename = $username . "_statement";
						$querystatement = "select* from $tablename";
					}




					?>



				</tbody>

			</table>


		</div>

		<header style="background-color: #2ea879; color: white; height: 100px">
			<h1>Edit <?php
						if (isset($_GET['id'])) {
							echo ($firstname . " " . $lastname . "(" . $username . ")");
						} else {
						}

						?> membership details OR add new member</h1>

		</header>
		<div id="editform" style="align-content: center; text-align: center;">
			<form action="" method="post">
				<table>

					<tbody>
						<tr>
							<td>username: <br /><input type="text" name="username" id="" value="<?php
																								if (isset($_GET['id'])) {
																									echo $username;
																								}
																								?>"></td>
							<td>Password:<br /><input type="text" name="password" id="" value="<?php
																								if (isset($_GET['id'])) {
																									echo $password;
																								}
																								?>"></td>
							<td>Firstname:<br /><input type="text" name="firstname" id="" value="<?php
																									if (isset($_GET['id'])) {
																										echo $firstname;
																									}
																									?>"></td>
						</tr>

						<tr>
							<td>Lastname:<br /><input type="text" name="lastname" id="" value="<?php
																								if (isset($_GET['id'])) {
																									echo $lastname;
																								}
																								?>"></td>
							<td>Position:<br /><input type="text" name="position" id="" value="<?php
																								if (isset($_GET['id'])) {
																									echo $position;
																								} ?>"></td>
							<td>Membership Status:<br /><input type="text" name="membershipstatus" id="" value="<?php
																												if (isset($_GET['id'])) {
																													echo $membershipstatus;
																												} ?>"></td>
						</tr>

						<tr>
							<td>Total Savings:<br /><input type="text" name="totalsavings" id="" value="<?php
																										if (isset($_GET['id'])) {
																											echo $totalsavings;
																										}
																										?>" disabled></td>
							<td>Loan Account:<br /><input type="text" name="loanaccount" id="" value="<?php
																										if (isset($_GET['id'])) {
																											echo $loanaccount;
																										}
																										?>"></td>
							<td>Last Transaction:<br /><input type="text" name="lasttransaction" id="" value="<?php
																												if (isset($_GET['id'])) {
																													echo $lasttransaction;
																												}
																												?>" disabled></td>
						</tr>
						<tr>
							<td>Loan Application Status:<br /><input type="text" name="loanapplicationstatus" id="" value="<?php
																															if (isset($_GET['id'])) {
																																echo $loanapplicationstatus;
																															}
																															?>"></td>
							<td>Phone Number:<br /><input type="text" name="phonenumber" id="" value="<?php
																										if (isset($_GET['id'])) {
																											echo $phonenumber;
																										}
																										?>"></td>
							<td>Email:<br /><input type="text" name="email" id="" value="<?php
																							if (isset($_GET['id'])) {
																								echo $email;
																							}
																							?>"></td>
						</tr>
						<tr>
							<td>Address:<br /><input type="text" name="address" id="" value="<?php
																								if (isset($_GET['id'])) {
																									echo $address;
																								}
																								?>"></td>
							<td>Gender:<br /><input type="text" name="gender" id="" value="<?php
																							if (isset($_GET['id'])) {
																								echo $gender;
																							}
																							?>"></td>
							<td>Occupation:<br /><input type="text" name="occupation" id="" value="<?php
																									if (isset($_GET['id'])) {
																										echo $occupation;
																									}
																									?>"></td>
						</tr>

					</tbody>
				</table>
				<input type="submit" value="Update details" name="update">
				<input type="submit" value="Add New Member" name="insert">
				<input type="submit" value="Clear Form" name="clear">





				<p>Credit Account:</p> <input type="number" name="creditamount" placeholder="Enter credit amount" id=""> <input type="date" name="creditdate" id=""> <input type="submit" value="Credit Account" name="credit">
				<p>Debit Account:</p> <input type="number" name="debitamount" id="" placeholder="Enter Debit amount"> <input type="date" name="debitdate" id=""> <input type="submit" value="Debit Account" name="debit">
				<br />
				<br />

			</form>
		</div>

		<header style="background-color: #2ea879; color: white; height: 100px">
			<h1>Edit news section </h1>
		</header>

		<?php $array = getnews() ?>



		<div style="text-align: center; margin-top: 50px;">
			<p style="font-size: 20px; margin-bottom: 10px; color: black;">Currently displaying on members profile: <?php echo $array['news'] ?></p>

			<form action="" method="post">
			<textarea name="news" id="" cols="30" rows="10" style="width: 500px;"></textarea>
				<br />
				<br />
				<input type="submit" value="Edit news" style="margin-bottom: 50px;" name="editnews">
			</form>

	


		</div>

	</div><!-- /container -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
	<script src="resources/adminresources/js/jquery.stickyheader.js"></script>

</body>

</html>