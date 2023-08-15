<!DOCTYPE html>
<html>
<head>
	<title>Quiz Taken</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<style>
.button, .aa{
  font-family: "Lucida Console", "Courier New", monospace;
  
}

.title, .quizzlehome, .taken{
  font-family: "Lucida Console", "Courier New", monospace;
}
.tittle{
  font-family: "Lucida Console", "Courier New", monospace;
  text-align: center;
  margin-right: 600px;
  color: orange;
  width: 100px;
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
nav li.title {
  text-align: center; 
}
</style>
<nav>
  <ul>
  <!--  <li><a href="last_results.php"><img src="research.png" alt="Last Results" style="width: 40px; height: 40px;"><span style=font-family: "Lucida Console", "Courier New", monospace;>Last Results</span>
  </a></li> -->
  <li><a class="tittle">Quizzle</a></li>
      <li><a href="Login.php"><img src="shutdown.png" alt="Logout" style="width: 40px; height: 40px;">
          Logout
      </a></li>
      <!--<li><a href="#" onMouseOver="showProlificID()" onMouseOut="hideProlificID()"><img src="user.png" alt="Profile" style="width: 40px; height: 40px;">
          <span id="prolific-id">Prolific ID: <?php echo $prolific_id; ?></span>
      </a></li> -->
      <!-- <li>
          <a href="#" onMouseOver="showWalletBalance()" onMouseOut="hideWalletBalance()">
              <img src="wallet.png" alt="Wallet" style="width: 40px; height: 40px;">
              Wallet
          </a>
          <div id="wallet-balance" style="display:none; position:absolute; top:80px; right:0px; background-color:#f1f1f1; padding:5px;">
              Your current balance is <?php echo $wallet_balance; ?>
          </div>
      </li> -->


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
<div>
		<h1 class="taken">Quiz Taken</h1>
		<p class="taken">Sorry, it seems like you have already taken this quiz. You can only submit each quiz once. Please check back tomorrow to answer the next quiz.</p>
		<a href="home.php"><button style="width: 20%;

    padding: 12px;
    font-size: 15px;
    background-color: orange;
    color: white;
    border: none;
    border-radius: 5px;
    margin-top: 5px;
    cursor: pointer;">Select other Quiz</button></a>
  </div>
	</div>
</body>
</html>
