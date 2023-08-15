<?php
  session_start();

 require("connection.php");

  $prolific_id = $_SESSION["prolific_id"];

  $sql = "SELECT wallet FROM users WHERE prolific_id = '".$prolific_id."'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $balance = $row["wallet"];
  } else {
    echo "Error: User not found";
    exit;
  }

  $sql = "SELECT question_id, answer FROM user_answers WHERE prolific_id = '".$prolific_id."'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $user_answers = array();
    while ($row = $result->fetch_assoc()) {
      $user_answers[$row["question_id"]] = $row["answer"];
    }
  } else {
    echo "Error: User answers not found";
    exit;
  }

  $questions = array(
    array("In which Italian city can you find the Colosseum?", "Rome", array("Milan", "Rome", "Naples", "Venice")),
    array("Who proposed the theory of relativity?", "Albert Einstein", array("Alexander Graham Bell", "Albert Einstein", "Charles Darwin", "John Dalton")),
    array("Who is the author of the Harry Potter series?", "J.K Rowling", array("J.R.R Tolkien", "Stefanie Meyer", "Suzanne Collins", "J.K Rowling")),
    array("Which is the fastest animal on land?", "Cheetah", array("Horse", "Cheetah", "Giraffe", "Lion"))
  );
  $total_questions = count($questions);
  $correct_answers = 0;


  $correct = array();
  $incorrect = array();

  for ($i = 0; $i < $total_questions; $i++) {
    $question_id = $i + 1;
    if ($user_answers[$question_id] == $questions[$i][1]) {
      $correct_answers++;
      $correct[] = $question_id;
    } else {
      $incorrect[] = $question_id;
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Quiz <span style="color: orange">Results</span></title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }
    h1 {
      text-align: center;
      margin-bottom: 30px;
    }
    .result {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }
    .result span {
      font-size: 18px;
      font-weight: bold;

    }
    .result .user-answer {
      color: blue;
    }
    .result .correct-answer {
      color: green;
    }
    .result .incorrect-answer {
      color: red;
    }
    .score {
      text-align: center;
      margin-top: 50px;
      font-size: 24px;
      font-weight: bold;
    }
    .balance {
      text-align: center;
      margin-top: 20px;
      font-size: 18px;
    }
    .button {
      display: block;
      margin: 0 auto;
      margin-top: 50px;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 18px;
      cursor: pointer;
    }
    .button:hover {
      background-color: #3e8e41;
    }
    .orange-button {
      background-color: orange;
  }

  </style>
</head>
<body>
  <div class="container">
    <h1>Quiz Results</h1>
    <?php
      
      for ($i = 0; $i < $total_questions; $i++) {
        $question_id = $i + 1;
        $question = $questions[$i][0];
        $user_answer = $user_answers[$question_id];
        $correct_answer = $questions[$i][1];
        $options = $questions[$i][2];
        $result_class = in_array($question_id, $correct) ? "correct-answer" : "incorrect-answer";
    ?>
      <div class="result">
        <span><?php echo $question; ?></span>
        <span class="<?php echo ($user_answer == $correct_answer) ? "user-answer correct-answer" : "user-answer incorrect-answer"; ?>"><?php echo $user_answer; ?></span>
        <span class="<?php echo $result_class; ?>"><?php echo $correct_answer; ?></span>
      </div>
    <?php } ?>
    <div class="score">Score: <?php echo $correct_answers."/".$total_questions; ?></div>
    <div class="balance">Wallet Balance: $<?php echo $balance; ?> Cents</div>
    <button class="button orange-button" onclick="location.href='home.php'">Back to Homepage</button>

  </div>
</body>
</html>
