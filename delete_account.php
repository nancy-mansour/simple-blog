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
  <title>DELETE ACCOUNT!</title>
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

  <p> Are you sure you want to delete your account?</P>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      <label for="password">Password*</label>
      <input type="password" maxlength="24" name="password" value=""/>
      <br/><br/>
      <input type="submit" name="confirm" value="Confirm"/>
      <input type="submit" name="cancel" value="Cancel"/>
    </form>

    <?php
    if(isset($_POST['confirm'])){
      $conn = mysqli_connect($host, $user_name, $pw, $dbname);
      if (! $conn) {
        die('Could not connect: ' .mysqli_error($conn));
      }
      $user_id = $_SESSION['user_id'];
      $password_input = $_POST['password'];
      $password = "SELECT * FROM users WHERE user_id = '$user_id' and password = '$password_input'";
      $result = mysqli_query($conn, $password);
      if (!$result) {
        die ('Could not confirm password: ' . mysqli_error($conn));
      }
      $row = mysqli_fetch_assoc($result);
      if (mysqli_num_rows($result) >0){
        $query = "DELETE FROM users WHERE user_id = $user_id";
        $result = mysqli_query($conn, $query);
        if (!$result) {
          die ('Could not delete account: ' . mysqli_error($conn));
        }
        echo "Account deleted!";
        session_destroy();
        header("Refresh:2; url = home_page.php");
      } elseif (mysqli_num_rows($result) == 0){
        echo "Wrong password!";
      }
      mysqli_close($conn);
    } elseif (isset($_POST['cancel'])) {

      header("location: profile_page.php");
    }

    ?>
  </body>
  </html>
