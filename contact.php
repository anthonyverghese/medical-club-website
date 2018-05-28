<?php
include('includes/init.php');

$message = "";

/* Delete comment from database upon submission */
if(isset($_POST["delete_comment"])) {
  $id = filter_input(INPUT_POST, 'comment_id', FILTER_SANITIZE_NUMBER_INT);
  $sql = "DELETE FROM comments WHERE id = :id";
  $params = array(
    ':id' => $id
  );
  $result = exec_sql_query($db, $sql, $params);
}

// Populate table
$params = array();
$sql = "SELECT * FROM comments";
$comments = exec_sql_query($db, $sql, $params) -> fetchAll();

/* Add comment to database upon submission */
if(isset($_POST["submit_comment"])) {
  $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
  $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
  $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

  $sql = "INSERT INTO comments (first_name, last_name, email, type, comment) VALUES (:first_name, :last_name, :email, :type, :comment)";
  $params = array(
    ':first_name' => $first_name,
    ':last_name' => $last_name,
    ':email' => $email,
    ':type' => $type,
    ':comment' => $comment
  );

  $result = exec_sql_query($db, $sql, $params);
  if ($result) {
    $message = "Your response has been recorded!";
  }
}

?>

<!DOCTYPE html>
<html>
  <?php include('includes/head.php'); ?>
  <body id="contact_page">
    <div id="headerimg">
    <?php
    if ($current_user) {
      include('includes/navbar_loggedin.php');
    } else{
      include('includes/navbar.php');
    }
    ?>
    </div>

    <div class="red text">
      <?php if(!$current_user){ ?>

        <h3 class="center">CONTACT</h3>
        <p class="justify"> Questions? Comments? Interested in joining? Fill out the form below with any inquiries! Also feel free to contact us at our email: cornellmedicinephilanthropy@gmail.com. We will get back to you as soon as possible! <p>

        <section>
          <?php echo($message); ?>
          <form action="contact.php" method="post">
            <input name="first_name" class="input_name" type="text" pattern="^[a-zA-Z .'-]+$" placeholder="First Name *" required/>
            <input name="last_name" class="input_name" type="text" pattern="^[a-zA-Z .'-]+$" placeholder="Last Name *" required/>
            <input name="email" type="email" placeholder="Email *" required/>

            <select name="type" required>
              <option value="" disabled selected>Who are you? *</option>
              <option value="student">Student</option>
              <option value="faculty">Faculty/Staff</option>
              <option value="alumni">Alumni</option>
              <option value="local business">Local Business</option>
              <option value="other">Other</option>
            </select>

            <textarea name="comment"></textarea>
            <button class="commentb" name="submit_comment" type="submit">Submit</button>
          </form>
        </section>

      <?php } else { ?>
        <section>
          <div class="text2">

            <?php if(isset($comments) and !empty($comments)){ ?>
              <h3 class="center">COMMENTS</h3>
              <table>
                <tr>
                  <th>first name</th>
                  <th>last name</th>
                  <th>email</th>
                  <th>type</th>
                  <th>comment</th>
                  <th>delete</th>
                </tr>
                <?php foreach($comments as $comment): ?>
                  <tr>
                    <td><?php echo(htmlspecialchars($comment["first_name"])); ?></td>
                    <td><?php echo(htmlspecialchars($comment["last_name"])); ?></td>
                    <td><?php echo(htmlspecialchars($comment["email"])); ?></td>
                    <td><?php echo(htmlspecialchars($comment["type"])); ?></td>
                    <td><?php echo(htmlspecialchars($comment["comment"])); ?></td>
                    <td>
                      <form method="post">
                        <input type="hidden" name="comment_id" value=<?php echo(htmlspecialchars($comment["id"]));?>/>
                        <button type="submit" name="delete_comment">X</button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </table>
            <?php } else { echo("<h3 class='center'>No Comments Returned</h3>");}; ?>
          </div>
        </section>
      <?php }; ?>
    </div>

    <?php  include('includes/footer.php'); ?>
  </body>
</html>
