<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $prolific_id = $_POST["prolific_id"];
  $age = $_POST["age"];
  $gender = $_POST["gender"];
  $groups = array(
    "group1" => 60,
    "group2" => 60,
    "group3" => 60,
  );
  
  $group_keys = array_keys($groups);
  $group_key = $group_keys[array_rand($group_keys)];
  $duration = $groups[$group_key];

  // check if prolific ID is provided
  if (!empty($prolific_id)) {
    if (is_numeric($age) && intval($age) == $age && $age >= 18 && $age <= 99) {
      // check if age is a valid integer
      if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE prolific_id = '$prolific_id'")) == 0) {
        $sql = "INSERT INTO users (prolific_id, age, gender, group_key, duration)
                VALUES ('$prolific_id', '$age', '$gender', '$group_key', '$duration')";

        if (mysqli_query($conn, $sql)) {
          header('Location: /facerec/indexreg.html');
          exit;
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      } else {
        echo '<p class="error-message">Error: Prolific ID already exists!</p>';
      }
    } else {
      echo '<p class="error-message">Error: Invalid age! Age must be a number between 18 and 99.</p>';
    }
  } else {
    echo '<p class="error-message">Error: Prolific ID is required!</p>';
  }
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Register to Quizzle</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
   
    

    .error-message {
      color: red;
      font-size: 20px;
      text-align: center;
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
    body {
      background-color: #F5F5F5;
    }

    h1 {
      text-align: center;
      margin-top: 50px;
    }

    form {
      width: 500px;
      margin: 50px auto;
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    input[type="text"], select {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;
      font-size: 16px;
      box-sizing: border-box;
      margin-top: 6px;
      margin-bottom: 16px;
    }

    input[type="submit"] {
      background-color: #F5A623;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    input[type="submit"]:hover {
      background-color: #D3871F;
    }

    nav {
      background-color: #333;
      overflow: hidden;

    }

    nav ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
    }

    nav li {
      float: right;
    }

    nav li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    nav li a:hover {
      background-color: #111;
    }
  </style>

  <nav>
    <ul>
  

      <li><a href="Login.php"><img src="icons8-sign-in-50.png" alt="Logout" style="width: 40px; height: 40px;">
          Login
      </a></li>

    </ul>
  </nav>
  

</head>

<body>
  
  <h1>Register to Quizzle</h1>

  <form action="" method="post">
    Prolific ID: <input type="text" name="prolific_id"><br><br>
    Age: <input type="text" name="age"><br><br>
    Gender:
    <select name="gender">
      <option value="m">Male</option>
      <option value="f">Female</option>
      <option value="d">Diverse</option>
    </select><br><br>
    <input type="submit" value="Register with FaceAuthy">
  </form>
</body>
</html>
