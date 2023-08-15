<!DOCTYPE html>
<html>
<head>
	<title>New Page</title>

</head>
<body>
	<style>
	.title, .quizzlehome{
		font-family: "Lucida Console", "Courier New", monospace;
	}
	.quizzlehome{
		text-align: center;
	}
	.welcometo{
		font-family: "Lucida Console", "Courier New", monospace;
	}
	.test{
	color:orange;
	font-family: "Lucida Console", "Courier New", monospace;
	}
	.stepss{
	color:black;
	font-family: "Lucida Console", "Courier New", monospace;
	}

	body {
	font-size: 16px;
	line-height: 1.5;
	}

	nav {
	margin-top: 20px;
	margin-bottom: 20px;
	}
	nav {
	margin-top: 20px;
	margin-bottom: 20px;
	}


	nav li a {
	color: var(--secondary-color);
	}

	nav li a:hover {
	background-color: var(--primary-color);
	color: white;
	}




	nav {
	background-color: #333;
	overflow: hidden;
	}

	nav ul {
	margin: 0;
	padding: 0;
	list-style: none;
	display: flex;
	justify-content: flex-end;
	}

	nav li {
	margin: 0;
	}

	nav li a {
	display: block;
	color: white;
	text-align: center;
	padding: 14px 16px;
	text-decoration: none;
	}

	nav li a:hover {
	background-color: #ddd;
	color: black;
	}

	</style>
	<nav>
		<ul>
			<li><a href="home.php"><img src="homepage.png" alt="Logout" style="width: 40px; height: 40px;">
					Select Quiz
			</a></li>
				<li><a href="Login.php"><img src="shutdown.png" alt="Logout" style="width: 40px; height: 40px;">
						Logout
				</a></li>

				<li>
						
						<div id="wallet-balance" style="display:none; position:absolute; top:80px; right:0px; background-color:#f1f1f1; padding:5px;">
								Your current balance is <?php echo $wallet_balance; ?>
						</div>
				</li>
		</ul>

		<script>
			function showWalletBalance() {
					document.getElementById("wallet-balance").style.display = "block";
			}

			function hideWalletBalance() {
					document.getElementById("wallet-balance").style.display = "none";
			}

			function showProlificID() {
					document.getElementById("prolific-id").innerHTML = "Prolific ID: <?php echo $prolific_id; ?>";
			}

			function hideProlificID() {
					document.getElementById("prolific-id").innerHTML = "Profile";
			}
	</script>


	</nav>
	<?php
		$error_message = "An error has occurred. It seems like you have already completed the quiz. Please come back tomorrow for the next quiz!";
		

		if(isset($_GET['error']) && !empty($_GET['error'])){
			$error_message = $_GET['error'];
		}
	?>
  <div style="border: 2px solid red; background-color: #F8D7DA; padding: 10px; margin-bottom: 20px;">
	<h2 style="color: red;">Error:</h2>
	<p style="font-size: 18px;"><?php echo $error_message; ?></p>
	<a href="home.php"><button style=" font-size: 16px;">Back to Homepage</button></a>
</div>
</body>
</html>
