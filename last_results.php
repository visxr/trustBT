<?php
session_start();

require("connection.php");

$prolific_id = $_SESSION["prolific_id"];


$sql = "SELECT * FROM quiz_results WHERE prolific_id = '".$prolific_id."' ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
 
  while($row = $result->fetch_assoc()) {
    echo "<p>You answered ".$row["correct_answers"]." questions correctly out of ".$row["total_questions"]." in the last quiz.</p>";
    echo "<p>You earned ".$row["earned_money"]." in the last quiz.</p>";
  }
} else {
  echo "You have not taken any quizzes yet.";
}


$conn->close();
?>
