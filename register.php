<?php require 'global_config.php';?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Register</title>
</head>
<body>

  <a href="home_page.php">Home page</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="profile_page.php">Profile</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="all_posts.php">Posts</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="login.php">Login</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  🐘 Big Elephant 🐘
  <br/><br/>

  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="f_name">First Name*</label>
    <input type="text" name="f_name" value="<?php if(isset($_POST['f_name'])){echo $_POST['f_name'];} ?>" />
    <br/> <br/>

    <label for="l_name">Last Name*</label>
    <input type="text" name="l_name" value="<?php if(isset($_POST['l_name'])){echo $_POST['l_name'];} ?>"/>
    <br/><br/>

    <label for="email">E-mail*</label>
    <input type="email" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>"/>
    <br/><br/>

    <label for="gender">Gender</label>
    <input type="radio" name="gender" value="female" <?php if(isset($_POST['gender'])){echo ($_POST['gender']=='female')?'checked':'';} ?>/> Female &nbsp;&nbsp;&nbsp;&nbsp;&nbsp
      <input type="radio" name="gender" value="male" <?php if(isset($_POST['gender'])){echo ($_POST['gender']=='male')?'checked':'';} ?>/> Male
        <br/><br/>

        <label for="b_date">Birthdate</label>
        <input type="date" name="b_date" min="1921-01-01" value="<?php if(isset($_POST['b_date'])){echo $_POST['b_date'];} ?>"/>
        <br/><br/>

        <label for="phone_num">Phone number</label>
        <input type="tel" maxlength="11" name="phone_num" value="<?php if(isset($_POST['phone_num'])){echo $_POST['phone_num'];} ?>"/>
        <br/><br/>

        <label for="password">Password*</label>
        <input type="password" maxlength="24" name="password" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>"/>
        <br/><br/>

        <label for="confirm_password">Confirm password*</label>
        <input type="password" maxlength="24" name="confirm_password" value=""/>
        <br/><br/>

        <input type="submit" name="submit_user" value="Submit"/>

      </form>

      <p>*Required</p>


      <?php
      if (isset($_POST['submit_user'])) {
        $conn = mysqli_connect($host, $user_name, $pw, $dbname);

        if (! $conn) {
          die('Could not connect: ' .mysqli_error($conn));
        }

        $required_fields = array($_POST['f_name'], $_POST['l_name'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);
        foreach ($required_fields as $value) {
          if ($value == null || trim($value) === "") {
            die("Fill required fields!");
          }
        }
        if ($_POST['password'] !== $_POST['confirm_password']) {
          die("Password doesn't match!");
        }

        $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
        $l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender'] ?? '');//Conditional Assignment
        $b_date = mysqli_real_escape_string($conn, $_POST['b_date']);
        if ($b_date == '') {
          $b_date = "NULL";
        } else {
          $b_date = "'$b_date'";
        }
        $phone_num = mysqli_real_escape_string($conn, $_POST['phone_num']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $query = "INSERT INTO users (f_name, l_name, email, gender, b_date, phone_num, password)
        VALUES ('$f_name', '$l_name', '$email', '$gender', $b_date, '$phone_num', '$password');";
        $result = mysqli_query($conn, $query);

        if (!$result) {
          die ('Could not enter data: ' . mysqli_error($conn));
        }
        echo "Registration complete!";
        header("Refresh:2; url = login.php");

        mysqli_close($conn);
      }

      ?>

    </body>
    </html>
