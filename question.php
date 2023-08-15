<?php
session_start();
require("connection.php");

$prolific_id = $_SESSION["prolific_id"];
$quiz_date = date('Y-m-d H:i:s');

// Check if the user has already taken the quiz
$quiz_number = 5; 
$sql = "SELECT * FROM quiz_history WHERE prolific_id = '".$prolific_id."' AND quiz_number = '".$quiz_number."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  $error_message = "Error: You have already taken this quiz. Please choose another quiz.";
  header("Location: quizztaken.php");
  //header("Location: home.php?error_message=" . urlencode($error_message));
  exit();
}

$questions = array(
  array("1. I believe that there could be negative consequences when using FaceAuthy", "Answer 1"),
  array("2. I feel I must be cautious when using FaceAuthy'", "Answer 2"),
  array("3. It is risky to interact with FaceAuthy'", "Answer 3"),
  array("4. I believe that FaceAuthy will act in my best interest", "Answer 4"),
  array("5. I believe that FaceAuthy will do its best to help me authenticate", "Answer 5"),
  array("6. I believe that FaceAuthy is interested in understanding my authentication needs and preferences", "Answer 6"),
  array("7. I think that FaceAuthy is competent and effective in detecting and authenticating face", "Answer 7"),
  array("8. I think that FaceAuthy performs its role as face authentication system very well", "Answer 8"),
  array("9. I believe that FaceAuthy has all the functionalities I would expect from it", "Answer 9"),
  array("10. If I use FaceAuthy, I think I would be able to depend on it completely", "Answer 10"),
  array("11. I can always rely on FaceAuthy for the authentication", "Answer 11"),
  array("12. I can trust the information presented to me by FaceAuthy", "Answer 12"),
//new
   array("Obstructive", "Supportive"),
  array("Complicated", "Easy"),
  array("Inefficient", "Efficient"),
  array("Confusing", "Clear"),
  array("Boring", "Exciting"),
  array("Not interesting", "Interesting"),
  array("Conventional", "Inventive"),
  array("Usual", "Leading edge")
);


$total_questions = count($questions);
$user_answers = array();

if (isset($_POST['submit'])) {
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
      $user_answers[] = $answer;
      $sql = "INSERT INTO user_answers (prolific_id, question_id, answer)
              VALUES ('$prolific_id', '$question_id', '$answer')";
      if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    // Insert results in database
    $sql = "INSERT INTO quiz_history (prolific_id, quiz_number, submitted_at) VALUES ('$prolific_id', '$quiz_number', NOW())";
    if ($conn->query($sql) !== TRUE) {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Display result message
    echo "<div class='result'>";
    echo "<p>Congratulations! You have completed the questionnaire.</p>";
    echo "<h3>Questionnaire Results:</h3>";
    echo "<ul>";
    for ($i = 0; $i < $total_questions; $i++) {
      $question_id = $i + 1;
      echo "<li>";
      echo "Question $question_id: " . $questions[$i][0];
      echo "<br>";
      echo "Your answer: " . $user_answers[$i];
      echo "<br>";
      echo "Correct answer: " . $questions[$i][1];
      echo "</li>";
    }
    echo "</ul>";
    echo "</div>";
  } else {
    //display error message
    echo "<div class='error'>";
    echo "<p>Please correct the following errors:</p>";
    echo "<ul>";
    foreach ($error_messages as $message) {
      echo "<li>$message</li>";
    }
    echo "</ul>";
    echo "</div>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Questionnaire 2.0</title>
  <style>
  
    .option {
      display: inline-block;
      margin-right: 10px;
    }



  </style>
  
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
nav img {
  display: block;
  margin: 0 auto;
  width: 330px;
  height: 53px;

}

  </style>
  <nav>


<ul>
  <img src="logo-unibw-text.svg" alt="Logo">

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
    <!--<a href="#" onMouseOver="showWalletBalance()" onMouseOut="hideWalletBalance()">
      <img src="wallet.png" alt="Wallet" style="width: 40px; height: 40px;">
      <?php echo $wallet_balance; ?>
    </a> -->
    <div id="wallet-balance" style="display:none; position:absolute; top:80px; right:0px; background-color:#f1f1f1; padding:5px;">
      Your current balance is <?php echo $wallet_balance; ?>
    </div>
  </li>
</ul>
</nav>
<h1>Questionnaire</h1>
    For the past 4 days, you have been using our facial authentication feature to sign in to Quizzle.<br>
    This study is a research project between LMU and UniBW that investigates user perception of facial biometric authentication.<br> In the following questionnaire, we ask you to provide your honest feedback and perceptions <strong>about the facial authentication part of Quizzle and NOT about the general knowledge questions</strong>.<br> To remind you here is a screenshot of the facial authentication sign in step (FaceAuthy).
    FaceAuthy is the face authentication system we were using for the registration and login.<br>
    <img src="faceauthy.png" alt="FaceAuthy Screenshot" style="width: 30%">
<br>
    <br>
  <h1><span style="color:orange;">Trust</span></h1>

  <form method="POST" action="">
    <p><?php echo $questions[0][0]; ?></p>
    <div class="options">
      <label class="option">
        <input type="radio" name="question_1" value="Option 1"> Strongly disagree
      </label>
      <label class="option">
        <input type="radio" name="question_1" value="Option 2"> Disagree
      </label>
      <label class="option">
        <input type="radio" name="question_1" value="Option 3"> Neither agree nor disagree
      </label>
      <label class="option">
        <input type="radio" name="question_1" value="Option 4"> Agree
      </label>
      <label class="option">
        <input type="radio" name="question_1" value="Option 5"> Strongly agree
      </label>




    </div>

    <?php for ($i = 1; $i < $total_questions; $i++) { ?>
      <p><?php echo $questions[$i][0]; ?></p>
      <div class="options">
        <label class="option">
          <input type="radio" name="question_<?php echo $i + 1; ?>" value="Option 1"> Strongly disagree
        </label>
        <label class="option">
          <input type="radio" name="question_<?php echo $i + 1; ?>" value="Option 2"> Disagree
        </label>
        <label class="option">
          <input type="radio" name="question_<?php echo $i + 1; ?>" value="Option 3"> Neither agree nor disagree
        </label>
        <label class="option">
          <input type="radio" name="question_<?php echo $i + 1; ?>" value="Option 4"> Agree
        </label>
        <label class="option">
          <input type="radio" name="question_<?php echo $i + 1; ?>" value="Option 5"> Strongly agree
        </label>
      </div>
    <?php } ?>

    <button type="submit" name="submit">Submit</button>
  </form>

</body>
</html>
