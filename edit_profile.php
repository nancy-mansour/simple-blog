<?php require 'global_config.php';?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Edit Profile</title>
</head>
<body>
  <a href="home_page.php">Home page</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="create_post.php">Create post</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="profile_page.php">Profile</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="logout.php">Logout</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  🐘 Big Elephant 🐘
  <br/><br/>

  <?php
  if (!isset($_SESSION['user_id'])){
    die (header ('location:login.php'));
  }
  $conn = mysqli_connect($host, $user_name, $pw, $dbname);
  $user_id = $_SESSION['user_id'];
  $user_data = "SELECT * FROM users WHERE user_id = $user_id";
  $result = mysqli_query($conn, $user_data);
  $row = mysqli_fetch_assoc($result);
  mysqli_close($conn);

  ?>


  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="f_name">First Name*</label>
    <input type="text" name="f_name" value="<?php echo (htmlspecialchars($row['f_name'], ENT_QUOTES))?>"/>
    <br/> <br/>

    <label for="l_name">Last Name*</label>
    <input type="text" name="l_name" value="<?php echo (htmlspecialchars($row['l_name'], ENT_QUOTES))?>"/>
    <br/><br/>

    <label for="email">E-mail*</label>
    <input type="email" name="email" value="<?php echo (htmlspecialchars($row['email'], ENT_QUOTES))?>"/>
    <br/><br/>

    <label for="gender">Gender</label>
    <input type="radio" name="gender" value="female" <?php echo ($row['gender']=='female')?'checked':'' ?>/> Female &nbsp;&nbsp;&nbsp;&nbsp;&nbsp
    <input type="radio" name="gender" value="male" <?php echo ($row['gender']=='male')?'checked':'' ?>/> Male
    <br/><br/>

    <label for="b_date">Birthdate</label>
    <input type="date" name="b_date" min="1921-01-01" value="<?php echo (htmlspecialchars($row['b_date'], ENT_QUOTES))?>"/>
    <br/><br/>

    <label for="phone_num">Phone number</label>
    <input type="tel" name="phone_num" maxlength="11" value="<?php echo (htmlspecialchars($row['phone_num'], ENT_QUOTES))?>"/>
    <br/><br/>

    <input type="submit" name="edit_profile" value="Edit profile"/>

  </form>
  <p>*Required</p>

  <?php
  if (isset($_POST['edit_profile'])) {
    $conn = mysqli_connect($host, $user_name, $pw, $dbname);

    if (! $conn) {
      die('Could not connect: ' .mysqli_error($conn));
    }

    $required_fields = array($_POST['f_name'], $_POST['l_name'], $_POST['email']);
    foreach ($required_fields as $value) {
      if ($value == null || trim($value) === "") {
        die("Fill required fields!");
      }
    }

    $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']) ?? '';//Conditional Assignment
    $b_date = mysqli_real_escape_string($conn, $_POST['b_date']);
    if ($b_date == '') {
      $b_date = "NULL";
    } else {
      $b_date = "'$b_date'";
    }
    $phone_num = mysqli_real_escape_string($conn, $_POST['phone_num']);

    $query = "UPDATE users SET f_name = '$f_name', l_name = '$l_name', email = '$email', gender = '$gender', b_date = $b_date, phone_num = '$phone_num'
    WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
      die ('Could not enter data: ' . mysqli_error($conn));
    }

    header("location: profile_page.php");

    mysqli_close($conn);
  }

  ?>
</body>
</html>
