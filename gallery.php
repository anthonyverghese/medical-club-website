<?php
include("includes/init.php");
?>
<!DOCTYPE html>
<html>
<?php include('includes/head.php');?>
<?php
echo "<body>";
echo "<div id=\"headerimg\">";

if ($current_user) {
  include('includes/navbar_loggedin.php');
} else{
  include('includes/navbar.php');
}
echo "</div>";
echo "<div class=\"red\">";


  // $db = open_or_init_sqlite_db('photos_db.sqlite', "init/init.sql");
  const BOX_UPLOADS_PATH = "uploads/photo_gallery/";
  echo "<div class=\"text\">";
  echo "<h3 class=\"center\">GALLERY</h3>";
  echo "<p class=\"justify\"> CAMP takes part in a load of different events. All fun and all following our philanthropic mission. These events include our Annual Action Against Hunger Benefit Gal and our Annual Hunger Awareness Week. Photos of these events are featured in our gallery. You can explore by event or view all. If you click on a picture you can read more about it! </p>";

  //Check if delete photo button was clicked for an image
  if (isset($_POST['delete'])){
    //This sql statement deletes the photo from the photo gallery
    $sql_delete_from_photo_gallery = "DELETE FROM photo_gallery WHERE photo_id= :id;";
    //This sql statement deletes all instances of the photo's id from the photos_in_tags table
    $sql_delete_tags = "DELETE FROM photos_in_tags WHERE (photo_id = :photo_id);";
    $sql_get_photo = "SELECT * FROM photo_gallery WHERE photo_id = :photo_id;";
    $params = array(
      ':id' => $_GET["id"]
    );
    $params2 = array(
      ':photo_id' => $_GET["id"]
    );
    $records = exec_sql_query($db, $sql_get_photo, $params2)->fetchAll();
    $result2 = exec_sql_query($db,$sql_delete_tags,$params2);
    $result = exec_sql_query($db, $sql_delete_from_photo_gallery, $params);

    foreach($records as $record){
      $file = "./uploads/photo_gallery/" . $record["photo_id"] . "." . $record["file_ext"];
      if (!unlink($file))
      {
        echo ("Error deleting your photo");
      }
      else
      {
        echo ("Your photo was successfully deleted");
      }
    }
  }

  //Check if user has submitted a new image. User can only submit a new image
  //if they are logged in.
  if ($current_user && isset($_POST["submit_button"])) {
    $upload_info = $_FILES["gallery_file"];
    //Filter inputs
    $photo_name = filter_input(INPUT_POST, 'photo_name', FILTER_SANITIZE_STRING);
    $photographer = filter_input(INPUT_POST, 'photographer', FILTER_SANITIZE_STRING);

    //Check if the file was uploaded properly before getting the extension and name
    if ($upload_info['error'] == UPLOAD_ERR_OK) {
      $name_without_extension = basename($upload_info["name"]);
      $extension = strtolower(pathinfo($name_without_extension, PATHINFO_EXTENSION));
      $sql = "INSERT INTO photo_gallery (file_name, file_ext, photo_name, photographer, account_username) VALUES (:name_without_extension, :extension, :photo_name, :photographer, :username)";
      $params = array(
        ':extension' => $extension,
        ':name_without_extension' => $name_without_extension,
        ':photo_name' => $photo_name,
        ':photographer' => $photographer,
        ':username' => $current_user,
      );
      //Make sure the file is a valid image file, so check that the extension is jpg, png, gif, or jpeg.
      //If not, tell user that we couldn't upload the file.
      if ($extension == "jpg" || $extension == "png" || $extension == "gif" || $extension == "jpeg"){
        $result = exec_sql_query($db, $sql, $params);
          if ($result) {
            $id_of_file = $db->lastInsertId("id");
            if (move_uploaded_file($upload_info["tmp_name"], BOX_UPLOADS_PATH . "$id_of_file.$extension")){
              store_message_to_user("Your photo has been uploaded");
            }
          } else {
            store_message_to_user("Couldn't upload your file");
          }
       } else {
         store_message_to_user("Sorry, your file did not have a proper image extension. It should be jpg, png, gif, or jpeg");
       }
    } else {
      store_message_to_user("Error uploading your file");
    }
    display_messages_to_user();
  }
  //Top of the gallery page. This is a form that allows the user to search the gallery by tag name.
  echo "<form class=\"search\" method =\"post\">";
  echo "<div class=\"select_and_button\"><select class=\"select_box\" name=\"category\">";
  $sql_get_all_tags = "SELECT * FROM tags";
  $params = array();
  $records = exec_sql_query($db,$sql_get_all_tags,$params);
  foreach($records as $record){
    echo "<option value = \"" . htmlspecialchars($record["tag_name"]) . "\">" . htmlspecialchars($record["tag_name"])  . "</option>";
  }
  echo "</select></div>";
  echo "<button class=\"button-link searchb\" name=\"submit_dropdown_search\" type =\"submit\">Search by Event</button></form>";
  echo "</div>";

  //Only display the form to add a photo to the gallery if the user is logged in
  if ($current_user){?>
  <!--Form to add a photo to the gallery-->
  <form class="form-style-1" action="gallery.php" method="post" enctype="multipart/form-data">
        <ul>
          <li>
            <label>Upload File:</label>
            <input type="file" name="gallery_file" required>
          </li>
          <li>
            <textarea placeholder= "Photo Name: e.g Sitara Night Performance" name="photo_name" cols="80" rows="4" required></textarea>
          </li>
          <li>
            <textarea placeholder = "Photographer: e.g John Doe" name="photographer" cols="80" rows="4" required></textarea>
          </li>
          <li>
            <button class="button-link picform" name="submit_button" type="submit">Upload</button>
          </li>
        </ul>
      </form>
    <?php }

  //Only displays images with a certain tag name if the user searched for images with
  //a certian tag. If the user did not search, then the else case is carried out, and
  //all the images in the gallery are displayed.
  if (isset($_POST["submit_dropdown_search"])){
    $tag_search = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
    $sql = "SELECT * FROM photo_gallery INNER JOIN photos_in_tags ON photo_gallery.photo_id = photos_in_tags.photo_id
    INNER JOIN tags ON photos_in_tags.tag_id = tags.tag_id WHERE tags.tag_name = :tag_search;";
    $params = array(':tag_search' => $tag_search);
    $records = exec_sql_query($db,$sql,$params)->fetchAll();

    if ($records){
      echo "<div class=\"all_images\">";
      foreach($records as $record){
        $url = BOX_UPLOADS_PATH . htmlspecialchars($record["photo_id"]) . "." . htmlspecialchars(strtolower($record["file_ext"]));
        echo "<a href= \"edit_photo.php?id=" . htmlspecialchars($record["photo_id"]) ."\"><img class=\"gallery_image\" alt=\"image\" src='$url'></a>";
      }
    } else {
      store_message_to_user("Sorry, couldn't find any images with that tag");
      display_messages_to_user();
    }
    echo "</div>";
  //If the user did not search, then simply display the whole gallery. This is the default action.
  } else {
    $records = exec_sql_query($db, "SELECT * FROM photo_gallery")->fetchAll(PDO::FETCH_ASSOC);
    echo "<div class=\"all_images\">";
      foreach($records as $record){
        $url = BOX_UPLOADS_PATH . htmlspecialchars($record["photo_id"]) . "." . htmlspecialchars(strtolower($record["file_ext"]));
        echo "<a href= \"edit_photo.php?id=" . htmlspecialchars($record["photo_id"]) ."\"><img class=\"gallery_image\" alt=\"image\" src='$url'></a>";
        }
    echo "</div>";
  }

echo "</div>";

  include('includes/footer.php'); ?>

</body>
</html>
