<?php require 'global_config.php';?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Change Password</title>
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
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      <label for="password">Old Password*</label>
      <input type="password" name="old_password" value=""/>
      <br/><br/>

      <label for="password">New Password*</label>
      <input type="password" maxlength="24" name="new_password" value=""/>
      <br/><br/>

      <label for="confirm_password">Confirm New password*</label>
      <input type="password" maxlength="24" name="confirm_new_password" value=""/>
      <br/><br/>

      <input type="submit" name="change_password" value="Change password"/>
      <input type="submit" name="cancel" value="Cancel"/>

    </form>

    <?php
      if (isset($_POST["change_password"])){

        $conn = mysqli_connect($host, $user_name, $pw, $dbname);
        $user_id = $_SESSION['user_id'];

        if (!$conn) {
          die('Could not connect: ' .mysqli_error($conn));
        }

        $old_password = $_POST["old_password"];
        $new_password = $_POST["new_password"];
        $confirm_new_password = $_POST["confirm_new_password"];

        $query = "SELECT * FROM users WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
          die('Result failed!' .mysqli_error($conn));
        }

        $row = mysqli_fetch_assoc($result);
        if (password_verify($old_password, $row['password'])) {
            if($new_password === $confirm_new_password){
              $new_password = password_hash($new_password, PASSWORD_DEFAULT);
              $change_password = "UPDATE  users SET password = '$new_password' WHERE user_id = '$user_id'";
              $query = mysqli_query($conn, $change_password);
              header("location: profile_page.php");
            }else{
              echo "New passwords doesn't match!";
            }

        }else{
          echo "Incorrect password!";
        }
        mysqli_close($conn);
      }
      if (isset($_POST["cancel"])){
        header ('location: profile_page.php');
      }
    ?>
  </body>
</html>
