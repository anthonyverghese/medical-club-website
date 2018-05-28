<?php
include("includes/init.php");
?>
<!DOCTYPE html>
<html>
<?php include("includes/head.php");?>
<body>
  <?php
  echo "<div id=\"headerimg\">";

  if ($current_user) {
    include('includes/navbar_loggedin.php');
  } else{
    include('includes/navbar.php');
  }
  echo "</div>";

    //$user_was_logged_in is the boolean that says whether or not the user was
    //logged in right before clicking the logout button.
    //Default for $user_was_logged_in is false. It is only changed to true if
    //the user is currently logged in.
    $user_was_logged_in = false;
    if ($current_user){
      echo "<h1>Log Out</h1>";
      $user_was_logged_in = true;
    } else {
      //The user was not logged in when he/she clicked the logout button
      store_message_to_user("You were not logged into an account, so you cannot logout.");
    }
    log_out();
    //Only display success message if the user was logged in before clicking the
    //logout button and if $current_user is now NULL
    if (!$current_user && $user_was_logged_in) {
      header("Location: index.php?logout=1");
      store_message_to_user("You've been successfully logged out.");
    }
    display_messages_to_user();
  ?>

<?php  include('includes/footer.php'); ?>

</body>

</html>
