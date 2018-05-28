<?php
$messages = array();

//Stores message to user. Not yet displayed in browser
function store_message_to_user($message) {
  global $messages;
  array_push($messages, $message);
}

// Display messages ot the user in the browser
function display_messages_to_user() {
  global $messages;
  foreach ($messages as $message) {
    echo "<p><strong>" . htmlspecialchars($message) . "</strong></p>\n";
  }
}
function exec_sql_query($db, $sql, $params = array()) {
  $query = $db->prepare($sql);
  if ($query and $query->execute($params)) {
    return $query;
  }
  return NULL;
}

// YOU MAY COPY & PASTE THIS FUNCTION WITHOUT ATTRIBUTION.
// open connection to database
function open_or_init_sqlite_db($db_filename, $init_sql_filename) {
  if (!file_exists($db_filename)) {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db_init_sql = file_get_contents($init_sql_filename);
    if ($db_init_sql) {
      try {
        $result = $db->exec($db_init_sql);
        if ($result) {
          return $db;
        }
      } catch (PDOException $exception) {
        // If we had an error, then the DB did not initialize properly,
        // so let's delete it!
        unlink($db_filename);
        throw $exception;
      }
    }
  } else {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  }
  return NULL;
}

// open connection to database
$db = open_or_init_sqlite_db("photos_db.sqlite", "init/init.sql");

// function check_login() {
//   global $db;
//
//   if (isset($_COOKIE["session"])) {
//     $session = $_COOKIE["session"];
//
//     $sql = "SELECT * FROM accounts WHERE session = :session";
//     $params = array(
//       ':session' => $session
//     );
//     $records = exec_sql_query($db, $sql, $params)->fetchAll();
//     if ($records) {
//       // Username is UNIQUE, so there should only be 1 record.
//       $account = $records[0];
//       return $account['username'];
//     }
//   }
//   return NULL;
// }

function check_login() {
  if (isset($_SESSION['current_user'])) {
    return $_SESSION['current_user'];
  }
  return NULL;
}

// function log_in($username, $password) {
//   global $db;
//
//   if ($username && $password) {
//     $sql = "SELECT * FROM accounts WHERE username = :username;";
//     $params = array(
//       ':username' => $username
//     );
//     $records = exec_sql_query($db, $sql, $params)->fetchAll();
//     if ($records) {
//       // Username is UNIQUE, so there should only be 1 record.
//       $account = $records[0];
//
//       // Check password against hash in DB
//       if ( password_verify($password, $account['password']) ) {
//
//         // Generate session
//         // Warning! Not a secure method for generating session IDs!
//         // TODO: secure session
//         $session = uniqid();
//         $sql = "UPDATE accounts SET session = :session WHERE id = :user_id;";
//         $params = array(
//           ':user_id' => $account['id'],
//           ':session' => $session
//         );
//         $result = exec_sql_query($db, $sql, $params);
//         if ($result) {
//           // Success, we are logged in.
//
//           // Send this back to the user.
//           setcookie("session", $session, time()+3600);  /* expire in 1 hour */
//
//           store_message_to_user("Logged in as $username.");
//           return $username;
//         } else {
//           store_message_to_user("Log in failed.");
//         }
//       } else {
//         store_message_to_user("Invalid username or password.");
//       }
//     } else {
//       store_message_to_user("Invalid username or password.");
//     }
//   } else {
//     store_message_to_user("No username or password given.");
//   }
//   return NULL;
// }

function log_in($username, $password) {
  global $db;
  if ($username && $password) {
    $sql = "SELECT * FROM accounts WHERE username = :username;";
    $params = array(
      ':username' => $username
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      $account = $records[0];
      if (password_verify($password, $account['password'])) {

        session_regenerate_id();
        $_SESSION['current_user'] = $username;
        store_message_to_user("Logged in as $username.");
        return $username;
      } else {
        store_message_to_user("Invalid username or password.");
      }
    } else {
      store_message_to_user("Invalid username or password.");
    }
  } else {
    store_message_to_user("No username or password given.");
  }
  return NULL;
}

// function log_out() {
//   global $current_user;
//   global $db;
//
//   if ($current_user) {
//     $sql = "UPDATE accounts SET session = :session WHERE username = :username;";
//     $params = array(
//       ':username' => $current_user,
//       ':session' => NULL
//     );
//     if (!exec_sql_query($db, $sql, $params)) {
//       store_message_to_user("Log out failed.");
//     }
//   }
//
//   // Remove the session from the cookie and force it to expire.
//   setcookie("session", "", time()-3600);
//   $current_user = NULL;
// }

function log_out() {
  global $current_user;
  $current_user = NULL;
  // destroy PHP session
  unset($_SESSION['current_user']);
  session_destroy();
}

session_start();
// Check if we should login the user
if (isset($_POST['login'])) {
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $username = trim($username);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

  $current_user = log_in($username, $password);
} else {

// check if logged in
  $current_user = check_login();
}
?>
