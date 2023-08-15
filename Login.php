
<style>
.button, .aa{
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
  <!--  <li><a href="#" style="padding: 14px 0; margin-right: 300px; color: orange"><strong>Quizzle</strong></a></li> -->

    <li><a href="register.php"><img src="icons8-sign-in-50.png" alt="Logout" style="width: 40px; height: 40px;">
        Sign in
    </a></li>

  </ul>
</nav>

<?php
  session_start();
  require 'connection.php';

  //if (isset($_SESSION['prolific_id'])) {
    //header('Location: home.php');
  //  exit;
  //}

  if (isset($_POST['prolific_id'])) {
  $prolific_id = $_POST['prolific_id'];
  $query = "SELECT * FROM users WHERE prolific_id='$prolific_id'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) >= 1) {
    $_SESSION['prolific_id'] = $prolific_id;
    header('Location: /facerec/index.html');
    exit;
  } else {
    $error = 'Invalid prolific_id';
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login to Quizzle</title>
    <style>
      body {
        font-size: 16px;
        line-height: 1.5;
        background-color: #f2f2f2;
      }
      h1 {
        text-align: center;
        color: #333;
        margin-top: 50px;
      }
      form {
        max-width: 500px;
        margin: 0 auto;
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0px 0px 20px rgba(0,0,0,0.2);
      }
      label {
        display: block;
        margin-bottom: 10px;
        color: #333;
        font-weight: bold;
      }
      input[type=text] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: none;
        box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
      }
      .camera-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
      }
      #my_camera {
        width: 500px;
        height: 360px;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
      }
      input[type=submit] {
        background-color: orange;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.2s ease;
      }
      input[type=submit]:hover {
        background-color: #ff6600;
      }
      footer {
        text-align: center;
        margin-top: 30px;
        color: #999;
      }
    </style>
  <!--  <script type="text/javascript" src="Webcam/assets/webcam.min.js"></script>
    <script type="text/javascript">
      function configureCamera() {
        Webcam.set({
          width: 500,
          height: 360,
          image_format: 'jpeg',
        });
        Webcam.attach('#my_camera');
      }
    </script> -->
  </head>
  <body onload="configureCamera();">
    <h1>Login to Quizzle</h1>
    <form action="" method="post">
      <?php if (isset($error)) { ?>
        <div style="color: red;">
          <?php echo $error; ?>
        </div>
      <?php } ?>
      <label for="prolific_id">Enter your prolific_id:</label>
      <input type="text" name="prolific_id" id="prolific_id" required>
      <!-- <div class="camera-container">
        <div id="my_camera"></div>
      </div> -->
      <input type="submit" value="Login with FaceAuthy">
    </form>
    <br>
      <br>
        <br>
          <br>
            <br>
              <br>
                <br>
                  <br>
                    <br>
                      <br>
                        <br>
                          <br>
                            <br>
                              <br>
                                <br>
                                  <br>

    <footer>
      &copy; Quizzle 2023 | Designed by Visar Curraj
    </footer>
  </body>
</html>
