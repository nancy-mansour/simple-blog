<?php require 'global_config.php';?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Login</title>
</head>
<body>
  <a href="home_page.php">Home page</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  🐘 Big Elephant 🐘
  <br/><br/>

  <p>Please login:</P>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      <label for="email">E-mail*</label>
      <input type="email" name="email" value=""/>
      <br/><br/>

      <label for="password">Password*</label>
      <input type="password" name="password" value=""/>
      <br/><br/>

      <input type="submit" name="login_user" value="Login"/>
    </form>

    <?php


    if (isset($_POST["login_user"])){

      $conn = mysqli_connect($host, $user_name, $pw, $dbname);

      if (!$conn) {
        die('Could not connect: ' .mysqli_error($conn));
      }

      $email = mysqli_real_escape_string($conn, $_POST["email"]);
      // $password = mysqli_real_escape_string($conn, $_POST["password"]);
      $query = "SELECT * FROM users WHERE email = '$email'";
      $result = mysqli_query($conn, $query);
      if (!$result) {
        die('Result failed!' .mysqli_error($conn));
      }
      if (mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        $password_from_database = $row['password'];
        $inputted_password = $_POST['password'];

        if (password_verify($inputted_password, $password_from_database)) {
          header("location: profile_page.php");
          $_SESSION['user_id'] = $row['user_id'];
        } else {
          echo "Incorrect password!";
        }
      } else {
        echo "Incorrect email!";
      }
      mysqli_close($conn);
    }
    ?>
  </body>
  </html>
