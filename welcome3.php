<?php
  session_start();

require("connection.php");

  $prolific_id = $_SESSION["prolific_id"];
  $quiz_date = date('Y-m-d H:i:s');

 
    $quiz_number = 3; 
    $sql = "SELECT * FROM quiz_history WHERE prolific_id = '".$prolific_id."' AND quiz_number = '".$quiz_number."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
     
      $error_message = "Error: You have already taken this quiz. Please choose another quiz.";
      header("Location: quizztaken.php");
      //header("Location: home.php?error_message=" . urlencode($error_message));
      exit();
    }


$questions = array(
  array("What is the largest continent in size?", "Asia", array("Asia", "Africa", "Europe", "North America")),
  array("Which famous inventor invented the telephone?", "Alexander Graham Bell", array("Thomas Edison", "Benjamin Franklin", "Alexander Graham Bell", "Nikola Tesla")),
  array("What is the longest river in the world?", "Nile river", array("Nile River", "Amazon river", "Congo river", "Yellow river")),
  array("How many sides does a hexagon have?", "6", array("5", "6", "7", "8"))
);
$total_questions = count($questions);
$correct_answers = 0;
$balance = 0;
$user_answers = array();


$sql = "SELECT wallet FROM users WHERE prolific_id = '".$prolific_id."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$balance = $row["wallet"];
} else {
echo "Error: User not found";
}

if (isset($_POST['submit'])) {


//$sql = "SELECT * FROM quiz_taken WHERE prolific_id = '".$prolific_id."' AND quiz_day = '".$quiz_day."'";

//$result = $conn->query($sql);
//if ($result->num_rows > 0) {
 

//  $error_message = "Error: You have already taken the quiz for today. Please try again tomorrow for the next quiz.";
 //header("Location: new_page.php?error_message=" . urlencode($error_message));
 //exit();
//} else {
 
$error_messages = array();

for ($i = 0; $i < $total_questions; $i++) {
  $question_id = $i + 1;
  if (empty($_POST['question_'.$question_id])) {
    $error_messages[] = 'Please answer question '.$question_id;
  }
}
if (empty($error_messages)) {
  
  for ($i = 0; $i < $total_questions; $i++) {
    $question_id = $i + 1;
    $answer = $_POST['question_'.$question_id];
    if (strcasecmp($answer, $questions[$i][1]) === 0) {
          $correct_answers++;
      $balance += 0.20;
      $user_answers[] = true;
    } else {
      $user_answers[] = false;
    }
    $sql = "INSERT INTO user_answers (prolific_id, question_id, answer)
            VALUES ('$prolific_id', '$question_id', '$answer')";
    if ($conn->query($sql) === FALSE) {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  $sql = "UPDATE users SET wallet = $balance WHERE prolific_id = '".$prolific_id."'";
  if ($conn->query($sql) === FALSE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $balance = $conn->query("SELECT wallet FROM users WHERE prolific_id = '".$prolific_id."'")->fetch_assoc()["wallet"];
  
$sql = "INSERT INTO quiz_history (prolific_id, quiz_number, submitted_at) VALUES ('$prolific_id', '$quiz_number', NOW())";
if ($conn->query($sql) !== TRUE) {
echo "Error: " . $sql . "<br>" . $conn->error;
}


$result_message = "Congratulations! You answered $correct_answers of $total_questions questions correctly and earned ".($correct_answers*0.20)." GBP. Your new balance is $balance GBP.";
echo "<div class='result'><p>$result_message</p>";
echo "</ul></div></div>";
} else {

echo "<div class='error'><ul>";
foreach ($error_messages as $message) {
echo "<li>".$message."</li>";
}
echo "</ul></div>";
}
}
$conn->close();
?>

<style>

body {
  background-color: #f2f2f2;
}


.quiz-container {
  background-color: white;
  border-radius: 10px;
  padding: 20px;
  margin: 20px auto;
  max-width: 600px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.quiz-question {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}


.quiz-option {
  font-size: 16px;
  margin-bottom: 5px;
}


.quiz-submit {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 20px;
}

.correct {
  color: green;
  font-weight: bold;
}

.incorrect {
  color: red;
  font-weight: bold;
}

.error-message {
      display: inline-block;
      padding: 10px;
      background-color: #FF0000;
      color: #FFFFFF;
      font-size: 18px;
      border-radius: 5px;
      margin-bottom: 10px;
  }
.result {
background-color: #E8F5E9;
border: 2px solid #2E7D32;
padding: 10px;
margin: 10px;
}

.result p {
font-size: 18px;
font-weight: bold;
margin-bottom: 10px;
}

.answers {
margin-top: 20px;
}
.answers h3 {
font-size: 16px;
font-weight: bold;
margin-bottom: 10px;

}

.answers ul {
list-style: none;
margin: 0;
padding: 0;
}

.answers li {
margin-bottom: 5px;
}

.correct {
color: black;
font-weight: bold;
}

.incorrect {
color: black;
font-weight: bold;
}
.error {
background-color: #FFEBEE;
border: 2px solid #C62828;
padding: 10px;
margin: 10px;
}
.error ul {
list-style: none;
margin: 0;
padding: 0;
}

.error li {
color: #C62828;
font-weight: bold;
}
.question {
  font-weight: bold;
  font-family: "Times New Roman", Times, serif;
  font-size: 19px;
}
</style>



<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Quizzle Day 3</title>
   <link rel="stylesheet" type="text/css" href="quiz.css">

</head>
<body>
  <style>


body {
  background-color: #f2f2f2;
}


.quiz-container {
  background-color: white;
  border-radius: 10px;
  padding: 20px;
  margin: 20px auto;
  max-width: 600px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}


.quiz-question {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}


.quiz-option {
  font-size: 16px;
  margin-bottom: 5px;
}


.quiz-submit {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 20px;
}


.correct {
  color: green;
  font-weight: bold;
}

.incorrect {
  color: red;
  font-weight: bold;
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
  <li>
    <a href="Login.php">
      <img src="shutdown.png" alt="Logout" style="width: 40px; height: 40px;">
      Logout
    </a>
  </li>
  <li>
    <a href="home.php">
      <img src="homepage.png" alt="Home" style="width: 40px; height: 40px;">
      Home
    </a>
  </li>
  <li>
    <a href="#" onMouseOver="showWalletBalance()" onMouseOut="hideWalletBalance()">
      <img src="wallet.png" alt="Wallet" style="width: 40px; height: 40px;">
      <?php echo $balance; ?>
    </a>
    <div id="wallet-balance" style="display:none; position:absolute; top:80px; right:0px; background-color:#f1f1f1; padding:5px;">
      Your current balance is <?php echo $wallet_balance; ?>
    </div>
  </li>
</ul>
</nav>
  <h2 style="text-align: center; color: orange">Quizzle - Day 3</h2>


  </div>
  <form method="post">
  <?php
    for($i = 0; $i < $total_questions; $i++) {
      $question_id = $i + 1;
      echo "<p>".$questions[$i][0]."</p>";
      $answers = $questions[$i][2];
      shuffle($answers);
      foreach ($answers as $answer) {
        $disabled = isset($_POST["submit"]) ? "disabled" : "";
        echo "<input type='radio' name='question_".$question_id."' value='".$answer."' required $disabled> ".$answer."<br>";
      }
      if(isset($_POST["submit"])) {
        if($user_answers[$i]) {
          echo "<p style='color:green'>Your answer: ".$_POST["question_".$question_id]." (Correct)</p>";
        } else {
          echo "<p style='color:red'>Your answer: ".$_POST["question_".$question_id]." (Incorrect)</p>";
          echo "<p style='color:green'>Correct answer: ".$questions[$i][1]."</p>";
        }




      }
      echo "<br>";
    }
  ?>
  <input type="submit" name="submit" value="Submit" style="background-color: green;
  color: aliceblue;
  height: 50px;
  width: 100px;
  border: none;
  cursor: pointer;
  border-radius: 3px;" >
  <input type="button" onclick="location.href='home.php'" value="Back to Homepage" style="background-color: orange;
    color: aliceblue;
    height: 50px;
    width: 150px;
    border: none;
    cursor: pointer;
    border-radius: 3px;">
</form>
<script>

var answerOptions = document.getElementsByClassName('answer-option');
for (var i = 0; i < answerOptions.length; i++) {
  answerOptions[i].disabled = true;
}
</script>

</body>
</html>
