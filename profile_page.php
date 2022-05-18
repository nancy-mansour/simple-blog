<?php
require 'global_config.php';
if (!isset($_SESSION['user_id'])){
  die (header ('location:login.php'));
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Your Profile</title>
</head>
<body>

  <a href="home_page.php">Home page</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="all_posts.php">Posts</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="create_post.php">Create post</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <a href="logout.php">Logout</a>
  &nbsp;&nbsp;&nbsp;&nbsp;
  <p> YOUR PROFILE</p>
  <br/>

  <?php
  $conn = mysqli_connect($host, $user_name, $pw, $dbname);

  $user_id = $_SESSION['user_id'];
  $user_data = "SELECT * FROM users WHERE user_id = $user_id";
  $result = mysqli_query($conn, $user_data);

  if(!$result){
    die('Could not fetch user: ' .mysqli_error($conn));
  }

  $row = mysqli_fetch_assoc($result);
  $f_name = $row['f_name'];
  $l_name = $row['l_name'];
  $email = $row['email'];
  $gender = $row['gender'];
  $b_date = $row['b_date'];
  $phone_num = $row['phone_num'];
  $password = $row['password'];

  echo "First name: " . $f_name . "<br/>
  Last name: " . $l_name . "<br/>
  E-mail: " . $email . "<br/>
  Gender: " . $gender . "<br/>
  Birthdate: " . $b_date . "<br/>
  Phone number: " . $phone_num . "<br/>
  Password: ****** <br/><br/>";

  echo "&nbsp;&nbsp; <a href= 'edit_profile.php'> Edit profile </a>
  &nbsp;&nbsp; <a href= 'change_password.php'> Change password </a>
  &nbsp;&nbsp; <a href= 'delete_account.php'> Delete account</a>
  &nbsp;&nbsp; <a href= 'logout.php'> logout</a>";
  mysqli_close($conn);
  ?>

</body>
</html>
