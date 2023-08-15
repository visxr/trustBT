<?php
session_start();

require("connection.php");

$prolific_id = $_SESSION["prolific_id"];

$sql = "SELECT wallet FROM users WHERE prolific_id = '".$prolific_id."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $wallet_balance = $row["wallet"];
} else {

  $wallet_balance = 0;
}

// Check if the user has taken Day 1 quiz
if (isset($_POST['day1_quiz']) && $_POST['day1_quiz'] == 'true' && !isset($_SESSION['day1_taken'])) {
  // Update the quiz status in the database
  $sql = "UPDATE users SET day1_taken = 1 WHERE prolific_id = '".$prolific_id."'";
  $conn->query($sql);
  // Set the session variable to indicate that the quiz has been taken
  $_SESSION['day1_taken'] = true;
}
else if (isset($_SESSION['day1_taken'])) {

  echo "You have already taken this quiz";
}

// Check if the user has taken Day 2 quiz
if (isset($_POST['day2_quiz']) && $_POST['day2_quiz'] == 'true' && !isset($_SESSION['day2_taken'])) {

  $sql = "UPDATE users SET day2_taken = 1 WHERE prolific_id = '".$prolific_id."'";
  $conn->query($sql);

  $_SESSION['day2_taken'] = true;
}

// Check if the user has taken Day 3 quiz
if (isset($_POST['day3_quiz']) && $_POST['day3_quiz'] == 'true' && !isset($_SESSION['day3_taken'])) {

  $sql = "UPDATE users SET day3_taken = 1 WHERE prolific_id = '".$prolific_id."'";
  $conn->query($sql);

  $_SESSION['day3_taken'] = true;
}

// Check if the user has taken Day 4 quiz
if (isset($_POST['day4_quiz']) && $_POST['day4_quiz'] == 'true' && !isset($_SESSION['day4_taken'])) {

  $sql = "UPDATE users SET day4_taken = 1 WHERE prolific_id = '".$prolific_id."'";
  $conn->query($sql);

  $_SESSION['day4_taken'] = true;
}

// Check if the user has taken Day 5 quiz
if (isset($_POST['day5_quiz']) && $_POST['day5_quiz'] == 'true' && !isset($_SESSION['day5_taken'])) {

$sql = "UPDATE users SET day5_taken = 1 WHERE prolific_id = '".$prolific_id."'";
$conn->query($sql);

$_SESSION['day5_taken'] = true;
}

$conn->close();
?>



<!DOCTYPE html>
<html>
  <head>


    <title class="title">Quizzle Home</title>

    <link rel="stylesheet" type="text/css" href="style.css">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-EHJmMNGdFcYm4z+cyskx3M9z0O+5g5SD75S5PO3w7ITuGQfU6YUAu6dI1p7D/N0M" crossorigin="anonymous">

  </head>
  <body>
    <style>
    .button, .aa{
      font-family: "Lucida Console", "Courier New", monospace;
      
    }

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
.imagess{
  width: 20px;
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
      
          <li><a href="Login.php"><img src="shutdown.png" alt="Logout" style="width: 40px; height: 40px;">
              Logout
          </a></li>
          <li><a href="#" onMouseOver="showProlificID()" onMouseOut="hideProlificID()"><img src="user.png" alt="Profile" style="width: 40px; height: 40px;">
              <span id="prolific-id">Prolific ID: <?php echo $prolific_id; ?></span>
          </a></li>
          <li>
      <a href="#" onMouseOver="showWalletBalance()" onMouseOut="hideWalletBalance()">
        <img src="wallet.png" alt="Wallet" style="width: 40px; height: 40px;">
        <?php echo $wallet_balance; ?>
      </a>
      <div id="wallet-balance" style="display:none; position:absolute; top:80px; right:0px; background-color:#f1f1f1; padding:5px;">
        Your current balance is <?php echo $wallet_balance; ?>
      </div>
    </li>
      </ul>

      <script>
        

        function showProlificID() {
            document.getElementById("prolific-id").innerHTML = "Prolific ID: <?php echo $prolific_id; ?>";
        }

        function hideProlificID() {
            document.getElementById("prolific-id").innerHTML = "Profile";
        }
    </script>


  </nav>


    <h2 class="quizzlehome">Quizzle - Home</h2>

  <!--<div class="wallet" style="position: absolute; top:10px; right:10px; background-color: green; color: white; display: inline-block; padding: 10px; border-radius:10px; ">
    <img src="Pictures/wallet-vector-icon.webp" alt="wallet icon" style="vertical-align: middle; height: 20px; margin-right: 5px;">
    Wallet: $<span id="wallet"><?php echo $wallet_balance; ?></span> Cents
  </div>

    <div id="prolific-id" style="position: absolute; top:60px; right:10px; background-color: lightgray; color: white; display: inline-block; padding: 10px; border-radius:10px">
      <p>Prolific Id: <?php echo $prolific_id; ?></p>
    </div>
    <div style="position: absolute; top:10px; left:10px; background-color: color; color: white; display: inline-block; padding: 10px; border-radius:10px ">
      <a href="?logout=true">Logout</a>
    </div> -->
    <p class="welcometo" style="text-align: center">Welcome to Quizzle! Click the button below to start the quiz.</p>

    <div class="aa"style="text-align: center">
      <a href="welcome.php"><button style="width: 20%;

      padding: 12px;
      font-size: 15px;
      background-color: orange;
      color: white;
      border: none;
      border-radius: 5px;
      margin-top: 5px;
      cursor: pointer;">Start Day 1</button></a>
    </div>
    <br>
    <div style="text-align: center">
      <a href="#"><button style="width: 20%;
      padding: 12px;
      font-size: 15px;
      background-color: lightgrey;
      color: white;
      border: none;
      border-radius: 5px;
      margin-top: 5px;
      cursor: pointer;">Day 2</button></a>
    </div>
    <br>
    <div style="text-align: center">
      <a href="#"><button style="width: 20%;
      padding: 12px;
      font-size: 15px;
      background-color: lightgrey;
      color: white;
      border: none;
      border-radius: 5px;
      margin-top: 5px;
      cursor: pointer;">Day 3</button></a>
    </div>
    <br>
    <div style="text-align: center">
      <a href="#"><button style="width: 20%;
      padding: 12px;
      font-size: 15px;
      background-color: lightgrey;
      color: white;
      border: none;
      border-radius: 5px;
      margin-top: 5px;
      cursor: pointer;">Day 4</button></a>
    </div>
    <br>
    <div style="text-align: center">
      <a href="#"><button style="width: 20%;
      padding: 12px;
      font-size: 15px;
      background-color: lightgrey;
      color: white;
      border: none;
      border-radius: 5px;
      margin-top: 5px;
      cursor: pointer;">Day 5</button></a>
    </div>
    <br>
    <br>
    <div class="quiz-steps" style="background-color: lightgray;
  border: 1px solid #ffeeba;
  border-radius: .25rem;
  margin-top: 1rem;
  padding: .75rem 1.25rem;">

  <p class="test"><strong>To participate:</strong></p>
  <ol class="stepss">
     <img class="imagess" src="1.png"> Read the question carefully</li><br>
     <img class="imagess" src="2.png"> Analyze the question and identify the key concepts</li><br>
     <img class="imagess" src="number-3.png"> Determine the correct answer</li><br>
     <img class="imagess" src="4.png"> Submit your answer</li><br>
  </ol>
  <p class="test"><strong>Note:</strong></p>
  <ol class="stepss">
  You can only complete 1 quiz each day, so after completing your quiz please make sure to login the next day for your next quiz.
  You can get a maximum of 0.80 GBP for each quiz (Check your current amount in the top right corner).<br>
   <strong> You will receive the total amount
    in the end of the study! </strong>
      </ol>
</div>
  </body>
</html>
