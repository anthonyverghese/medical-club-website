<?php
include("includes/init.php");
?>
<!DOCTYPE html>
<html>
<?php include('includes/head.php');?>

<body>
  <div id="headerimg">
  <?php
  if ($current_user) {
    include('includes/navbar_loggedin.php');
  } else{
    include('includes/navbar.php');
  }
  ?>
  </div>

  <div class="red">

    <?php
    //Only display login form if the user is not currently logged in. Else
    //tell them they are already logged in and must logout in order to
    //sign into a different account
    if (!$current_user){
    ?>
    <div class="text">
    <h3 class="center">LOGIN</h3>
    <p class="justify"> If you are a member of the club you can request a log in so that you can edit various features of the site! Logging in allows members to add events to the history timeline, as well as, add photos to the photo gallery. Email cornellmedicinephilanthropy@gmail.com to get your log in!  </p>
    <div class="text red login">
    <form action="login.php" method="post">
      <ul>
        <li class="log">
          <label>Username:</label>
          <input type="text" name="username" required/>

        </li>
        <li class="log">
          <label>Password:</label>
          <input type="password" name="password" required/>
        </li>
        <li class="in">
          <button name="login" type="submit">Log In</button>
        </li>
      </ul>
    </form>
  </div>
<?php } else {
  header("Location: index.php?login=1");
}
display_messages_to_user();

?>
</div>

<?php  include('includes/footer.php'); ?>
</div>

</body>

</html>
