<?php
session_start();
$_SESSION['prolific_id'] = $_POST['prolific_id'];
$servername = "localhost";
$username = "quizvc";
$password = "password";
$dbname = "quizvc";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get responses from questions and Prolific ID
    $perceived_risk_q1 = $_POST['perceived_risk_q1'];
    $perceived_risk_q2 = $_POST['perceived_risk_q2'];
    $perceived_risk_q3 = $_POST['perceived_risk_q3'];
    $perceived_risk_q4 = $_POST['perceived_risk_q4'];
    $perceived_risk_q5 = $_POST['perceived_risk_q5'];
    $perceived_risk_q6 = $_POST['perceived_risk_q6'];
    $perceived_risk_q7 = $_POST['perceived_risk_q7'];
    $perceived_risk_q8 = $_POST['perceived_risk_q8'];
    $perceived_risk_q9 = $_POST['perceived_risk_q9'];
    
    $perceived_risk_q10 = $_POST['perceived_risk_q10'];
    $perceived_risk_q11 = $_POST['perceived_risk_q11'];
    $perceived_risk_q12 = $_POST['perceived_risk_q12'];
    $system_satisfaction = $_POST['system_satisfaction'];
    $obstructive = $_POST['obstructive'];
    $complicated = $_POST['complicated'];
    $inefficient = $_POST['inefficient'];
    $confusing = $_POST['confusing'];
    $boring = $_POST['boring'];
    $not_interesting = $_POST['not_interesting'];
    $conventional = $_POST['conventional'];
    $usual = $_POST['usual'];
    $overall_trust = $_POST['overall_trust'];
    $system_trust_reason = $_POST['system_trust_reason'];
    
      $prolific_id = $_POST['prolific_id'];
      
      // Check if any required question is unanswered
    $required_questions = [
        $perceived_risk_q1, $perceived_risk_q2, $perceived_risk_q3, $perceived_risk_q4,
        $perceived_risk_q5, $perceived_risk_q6, $perceived_risk_q7, $perceived_risk_q8,
        $perceived_risk_q9, $perceived_risk_q10, $perceived_risk_q11, $perceived_risk_q12,
        $system_satisfaction, $obstructive, $complicated, $inefficient, $confusing, $boring,
        $not_interesting];
   
    
$quiz_number = 5;
$prolific_id = $_SESSION['prolific_id'];
$sql = "SELECT * FROM quiz_history WHERE prolific_id = '".$prolific_id."' AND quiz_number = '".$quiz_number."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  
  $error_message = "Error: You have already taken this quiz. Please choose another quiz.";
  header("Location: quizztaken.php");
  exit();
}


    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('1.I believe that there could be negative consequences when using FaceAuthy', '$perceived_risk_q1', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('2.I feel I must be cautious when using FaceAuthy', '$perceived_risk_q2', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('3.It is risky to interact with FaceAuthy', '$perceived_risk_q3', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('4.I believe that FaceAuthy will act in my best interest', '$perceived_risk_q4', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('5.I believe that FaceAuthy will do its best to help me authenticate', '$perceived_risk_q5', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('6.I believe that FaceAuthy is interested in understanding my authentication needs and preferences', '$perceived_risk_q6', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('7.I think that FaceAuthy is competent and effective in detecting and authenticating face', '$perceived_risk_q7', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('8.I think that FaceAuthy performs its role as face authentication system very well', '$perceived_risk_q8', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('9.I believe that FaceAuthy has all the functionalities I would expect from it', '$perceived_risk_q9', '$prolific_id')";
    $conn->query($sql);
   
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('10.If I use FaceAuthy, I think I would be able to depend on it completely', '$perceived_risk_q10', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('11.I can always rely on FaceAuthy for the authentication', '$perceived_risk_q11', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('12.I can trust the information presented to me by FaceAuthy', '$perceived_risk_q12', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('Extra: too slow vs too fast', '$system_satisfaction', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('obstructive vs supportive', '$obstructive', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('complicated vs easy', '$complicated', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('efficiency', '$inefficient', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('confusing vs clear', '$confusing', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('boring vs interesting', '$boring', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('interesting', '$not_interesting', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('conventional vs inventive', '$conventional', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('usual vs leading edge', '$usual', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('overall_trust', '$overall_trust', '$prolific_id')";
    $conn->query($sql);
    $sql = "INSERT INTO questionnaire_responses (question, response, prolific_id) VALUES ('openanswer', '$system_trust_reason', '$prolific_id')";
    $conn->query($sql);
   

    header("Location: study-complete.php");
exit();

}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Questionnaire</title>
    <script>
        function validateForm() {
          
            var questions = document.getElementsByClassName('quiz-question');
            for (var i = 0; i < questions.length; i++) {
                var options = questions[i].getElementsByTagName('input');
                var answered = false;
                for (var j = 0; j < options.length; j++) {
                    if (options[j].checked) {
                        answered = true;
                        break;
                    }
                }
                if (!answered) {
                    alert('Please answer all questions.');
                    return false;
                }
            }

        }
    </script>
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
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <strong>Remember:</strong> These questions refer to the Face Authentication (see above):
      <h2 style="color:orange">Trust</h2>
    <form method="post" id="questionnaire-form" onsubmit="return validateForm()">

        <fieldset>
            <legend><strong>1. I believe that there could be negative consequences when using FaceAuthy</strong></legend>
            <label>
              <input type="radio" name="perceived_risk_q1" value="Strongly disagree">
              Strongly disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q1" value="Disagree">
              Disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q1" value="Neither agree nor disagree">
              Neither agree nor disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q1" value="Agree">
              Agree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q1" value="Strongly agree">
              Strongly agree
            </label>
        </fieldset>
        <br>
        <fieldset>
            <legend><strong>2. I feel I must be cautious when using FaceAuthy</strong></legend>
            <label>
              <input type="radio" name="perceived_risk_q2" value="Strongly disagree">
              Strongly disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q2" value="Disagree">
              Disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q2" value="Neither agree nor disagree">
              Neither agree nor disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q2" value="Agree">
              Agree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q2" value="Strongly agree">
              Strongly agree
            </label>
        </fieldset>
            <br>
        <fieldset>
            <legend><strong>3. It is risky to interact with FaceAuthy</strong></legend>
            <label>
              <input type="radio" name="perceived_risk_3" value="Strongly disagree">
              Strongly disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q3" value="Disagree">
              Disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q3" value="Neither agree nor disagree">
              Neither agree nor disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q3" value="Agree">
              Agree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q3" value="Strongly agree">
              Strongly agree
            </label>
        </fieldset>
            <br>
        <fieldset>
            <legend><strong>4. I believe that FaceAuthy will act in my best interest</strong></legend>
            <label>
              <input type="radio" name="perceived_risk_q4" value="Strongly disagree">
              Strongly disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q4" value="Disagree">
              Disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q4" value="Neither agree nor disagree">
              Neither agree nor disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q4" value="Agree">
              Agree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q4" value="Strongly agree">
              Strongly agree
            </label>
        </fieldset>
            <br>
        <fieldset>
            <legend><strong>5.I believe that FaceAuthy will do its best to help me authenticate</strong></legend>
            <label>
              <input type="radio" name="perceived_risk_q5" value="Strongly disagree">
              Strongly disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q5" value="Disagree">
              Disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q5" value="Neither agree nor disagree">
              Neither agree nor disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q5" value="Agree">
              Agree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q5" value="Strongly agree">
              Strongly agree
            </label>
        </fieldset>
            <br>
        <fieldset>
            <legend><strong>6. I believe that FaceAuthy is interested in understanding my authentication needs and preferences</strong></legend>
            <label>
              <input type="radio" name="perceived_risk_q6" value="Strongly disagree">
              Strongly disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q6" value="Disagree">
              Disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q6" value="Neither agree nor disagree">
              Neither agree nor disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q6" value="Agree">
              Agree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q6" value="Strongly agree">
              Strongly agree
            </label>
        </fieldset>
            <br>
        <fieldset>
            <legend><strong>7. I think that FaceAuthy is competent and effective in detecting and authenticating faces</strong></legend>
            <label>
              <input type="radio" name="perceived_risk_q7" value="Strongly disagree">
              Strongly disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q7" value="Disagree">
              Disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q7" value="Neither agree nor disagree">
              Neither agree nor disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q7" value="Agree">
              Agree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q7" value="Strongly agree">
              Strongly agree
            </label>
        </fieldset>
            <br>
        <fieldset>
            <legend><strong>8. I think that FaceAuthy performs its role as face authentication system very well</strong></legend>
            <label>
              <input type="radio" name="perceived_risk_q8" value="Strongly disagree">
              Strongly disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q8" value="Disagree">
              Disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q8" value="Neither agree nor disagree">
              Neither agree nor disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q8" value="Agree">
              Agree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q8" value="Strongly agree">
              Strongly agree
            </label>
        </fieldset>
            <br>
        <fieldset>
            <legend><strong>9. I believe that FaceAuthy has all the functionalities I would expect from it</strong></legend>
            <label>
              <input type="radio" name="perceived_risk_q9" value="Strongly disagree">
              Strongly disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q9" value="Disagree">
              Disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q9" value="Neither agree nor disagree">
              Neither agree nor disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q9" value="Agree">
              Agree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q9" value="Strongly agree">
              Strongly agree
            </label>
        </fieldset>
          
        <br>
        <fieldset>
            <legend><strong>10. If I use FaceAuthy, I think I would be able to depend on it completely</strong></legend>
            <label>
              <input type="radio" name="perceived_risk_q10" value="Strongly disagree">
              Strongly disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q10" value="Disagree">
              Disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q10" value="Neither agree nor disagree">
              Neither agree nor disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q10" value="Agree">
              Agree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q10" value="Strongly agree">
              Strongly agree
            </label>
        </fieldset>
            <br>
        <fieldset>
            <legend><strong>11. I can always rely on FaceAuthy for the authentication</strong></legend>
            <label>
              <input type="radio" name="perceived_risk_q11" value="Strongly disagree">
              Strongly disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q11" value="Disagree">
              Disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q11" value="Neither agree nor disagree">
              Neither agree nor disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q11" value="Agree">
              Agree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q11" value="Strongly agree">
              Strongly agree
            </label>
        </fieldset>
            <br>
        <fieldset>
            <legend><strong>12. I can trust the information presented to me by FaceAuthy</strong></legend>
            <label>
              <input type="radio" name="perceived_risk_q12" value="Strongly disagree">
              Strongly disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q12" value="Disagree">
              Disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q12" value="Neither agree nor disagree">
              Neither agree nor disagree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q12" value="Agree">
              Agree
            </label>
            <label>
              <input type="radio" name="perceived_risk_q12" value="Strongly agree">
              Strongly agree
            </label>
        </fieldset>
   
        <p><strong>For the past week you have been using facial biometric authentication, do you think the face authentication system was:</strong></p>
        <label for="system_satisfaction">Too slow</label>
        <input type="range" id="system_satisfaction" name="system_satisfaction" min="1" max="10">
        <label for="system_satisfaction">Too fast</label><br>


        <p><strong>How was your experience with the biometric facial authentication system?</strong></p>

        <p> For the assessment of the application, please fill out the following questionnaire. The
          the questionnaire consists of pairs of contrasting attributes that may apply to the product. The circles between the attributes represent gradations between the opposites. You can express your agreement with the attributes by ticking the circle that most closely reflects your impression. Please decide spontaneously. Dont think too long about your decision to make sure that you convey your original impression. There is no right or wrong answer!
        </p>


        <p><strong>Please choose the appropriate response for each item:</strong></p>
        <table>
          <tr>
            <th>Obstructive</th>
            <td><input type="radio" name="obstructive" value="1"></td>
            <td><input type="radio" name="obstructive" value="2"></td>
            <td><input type="radio" name="obstructive" value="3"></td>
            <td><input type="radio" name="obstructive" value="4"></td>
            <td><input type="radio" name="obstructive" value="5"></td>
            <td><input type="radio" name="obstructive" value="6"></td>
            <td><input type="radio" name="obstructive" value="7"></td>
            <th>Supportive</th>
        </tr>
        <tr>
            <th>Complicated</th>
            <td><input type="radio" name="complicated" value="1"></td>
            <td><input type="radio" name="complicated" value="2"></td>
            <td><input type="radio" name="complicated" value="3"></td>
            <td><input type="radio" name="complicated" value="4"></td>
            <td><input type="radio" name="complicated" value="5"></td>
            <td><input type="radio" name="complicated" value="6"></td>
            <td><input type="radio" name="complicated" value="7"></td>
            <th>Easy</th>
        </tr>
        <tr>
            <th>Inefficient</th>
            <td><input type="radio" name="inefficient" value="1"></td>
            <td><input type="radio" name="inefficient" value="2"></td>
            <td><input type="radio" name="inefficient" value="3"></td>
            <td><input type="radio" name="inefficient" value="4"></td>
            <td><input type="radio" name="inefficient" value="5"></td>
            <td><input type="radio" name="inefficient" value="6"></td>
            <td><input type="radio" name="inefficient" value="7"></td>
            <th>Efficient</th>
        </tr>
        <tr>
            <th>Confusing</th>
            <td><input type="radio" name="confusing" value="1"></td>
            <td><input type="radio" name="confusing" value="2"></td>
            <td><input type="radio" name="confusing" value="3"></td>
            <td><input type="radio" name="confusing" value="4"></td>
            <td><input type="radio" name="confusing" value="5"></td>
            <td><input type="radio" name="confusing" value="6"></td>
            <td><input type="radio" name="confusing" value="7"></td>
            <th>Clear</th>
        </tr>
        <tr>
            <th>Boring</th>
            <td><input type="radio" name="boring" value="1"></td>
            <td><input type="radio" name="boring" value="2"></td>
            <td><input type="radio" name="boring" value="3"></td>
            <td><input type="radio" name="boring" value="4"></td>
            <td><input type="radio" name="boring" value="5"></td>
            <td><input type="radio" name="boring" value="6"></td>
            <td><input type="radio" name="boring" value="7"></td>
            <th>Exciting</th>
        </tr>
        <tr>
            <th>Not interesting</th>
            <td><input type="radio" name="not_interesting" value="1"></td>
            <td><input type="radio" name="not_interesting" value="2"></td>
            <td><input type="radio" name="not_interesting" value="3"></td>
            <td><input type="radio" name="not_interesting" value="4"></td>
            <td><input type="radio" name="not_interesting" value="5"></td>
            <td><input type="radio" name="not_interesting" value="6"></td>
            <td><input type="radio" name="not_interesting" value="7"></td>
            <th>Interesting</th>
        </tr>
        <tr>
            <th>Conventional</th>
            <td><input type="radio" name="conventional" value="1"></td>
            <td><input type="radio" name="conventional" value="2"></td>
            <td><input type="radio" name="conventional" value="3"></td>
            <td><input type="radio" name="conventional" value="4"></td>
            <td><input type="radio" name="conventional" value="5"></td>
            <td><input type="radio" name="conventional" value="6"></td>
            <td><input type="radio" name="conventional" value="7"></td>
            <th>Inventive</th>
        </tr>
        <tr>
            <th>Usual</th>
            <td><input type="radio" name="usual" value="1"></td>
            <td><input type="radio" name="usual" value="2"></td>
            <td><input type="radio" name="usual" value="3"></td>
            <td><input type="radio" name="usual" value="4"></td>
            <td><input type="radio" name="usual" value="5"></td>
            <td><input type="radio" name="usual" value="6"></td>
            <td><input type="radio" name="usual" value="7"></td>
            <th>Leading edge</th>
        </tr>
            </table>


            <p><strong>Overall, did you rather trust or distrust the face authentication system?</strong></p>

            <div>
              I rather distrusted FaceAuthy
              <input type="radio" name="overall_trust" id="satisfaction-1" value="1">
              <label for="satisfaction-1">1</label>
              <input type="radio" name="overall_trust" id="satisfaction-2" value="2">
              <label for="satisfaction-2">2</label>
              <input type="radio" name="overall_trust" id="satisfaction-3" value="3">
              <label for="satisfaction-3">3</label>
              <input type="radio" name="overall_trust" id="satisfaction-4" value="4">
              <label for="satisfaction-4">4</label>
              <input type="radio" name="overall_trust" id="satisfaction-5" value="5">
              <label for="satisfaction-5">5</label>
              <input type="radio" name="overall_trust" id="satisfaction-6" value="6">
              <label for="satisfaction-6">6</label>
              <input type="radio" name="overall_trust" id="satisfaction-7" value="7">
              <label for="satisfaction-7">7</label>
              I rather trusted FaceAuthy
            </div>

            <p><strong>Why did you trust or distrust the face authentication system? [Open answers]</strong></p>

            <textarea name="system_trust_reason"></textarea>
            <br>
            

            
            <br>


        <label>








  Prolific ID:
  <input type="text" name="prolific_id">
</label>




        <input type="submit" value="Submit">

    </form>
   
    
</body>
</html>
