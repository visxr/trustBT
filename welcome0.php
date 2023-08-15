<?php
  session_start();

require("connection.php");

  $prolific_id = $_SESSION["prolific_id"];
  $questions = array(
    array("In which Italian city can you find the Colosseum?", "Rome", array("Milan", "Rome", "Naples", "Venice")),
    array("Who proposed the theory of relativity?", "Albert Einstein", array("Alexander Graham Bell", "Albert Einstein", "Charles Darwin", "John Dalton")),
    array("Who is the author of the Harry Potter series?", "J.K Rowling", array("J.R.R Tolkien", "Stefanie Meyer", "Suzanne Collins", "J.K Rowling")),
    array("Which is the fastest animal on land?", "Cheetah", array("Horse", "Cheetah", "Giraffe", "Lion"))
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
        if ($answer == $questions[$i][1]) {
          $correct_answers++;
          $balance += 20;
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
      // Update balance 
      $balance = $conn->query("SELECT wallet FROM users WHERE prolific_id = '".$prolific_id."'")->fetch_assoc()["wallet"];
    } else {
      
      foreach ($error_messages as $message) {
        echo "<p style='color:red'>".$message."</p>";
      }
    }
  }

?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Quizzle Day 1</title>
  </head>
  <body>
    <h2 style="text-align: center; color: orange">Quizzle - Day 1</h2>
    <div class="wallet" style="position: absolute; top:10px; right:10px; background-color: green; color: white; display: inline-block; padding: 10px; border-radius:10px">
        Wallet: $<span id="wallet"><?php echo $balance; ?></span> Cents
      </div>
      <div id="prolific-id" style="position: absolute; top:60px; right:10px; background-color: lightgray; color: white; display: inline-block; padding: 10px; border-radius:10px">
    <p>Prolific Id: <?php echo $prolific_id; ?></p>
  </div>

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
    <input type="button" onclick="location.href='home.php'" value="Back to Homepage" style="width: 100%;
    padding: 12px;
    font-size: 15px;
    background-color: lightgray;
    color: white;
    border: none;
    border-radius: 5px;
    margin-top: 5px;
    cursor: pointer;">
  </form>
 <script>
  // Disable radio buttons 
  var answerOptions = document.getElementsByClassName('answer-option');
  for (var i = 0; i < answerOptions.length; i++) {
    answerOptions[i].disabled = true;
  }
</script>

</body>
</html>
