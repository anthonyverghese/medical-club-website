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
<div class="text">
<h3 class="center">GALLERY</h3>

  <?php
    // include('includes/navbar.php');

    //Check if user has submitted a new tag to an image
    if (isset($_POST['submit_tag'])){
      //Filter input
      $tag_name = filter_input(INPUT_POST, 'tag_name', FILTER_SANITIZE_STRING);
      //sql statement that adds the tag to the the tags table
      $sql_add_tag_to_table = "INSERT INTO tags (tag_name) VALUES (:tag_name);";
      //Have a sql statement that checks if the tag already exists. If so, there is no need to add the
      //tag to the tags table
      $sql_check_for_tag = "SELECT * FROM tags WHERE tag_name = :tag_name;";
      $params = array(
        ':tag_name' => $tag_name
      );
      //If the tag does not exist, then execute $sql_add_tag_to_table statement (adds tag to tags table)
      if (!exec_sql_query($db, $sql_check_for_tag, $params)->fetchAll()){
        $result = exec_sql_query($db, $sql_add_tag_to_table, $params);
      }
      //sql statement that gets the tag id associated with the tag name
      $sql_get_tag_id = "SELECT tag_id FROM tags WHERE tag_name = :tag_name;";
      $params2 = array(
        ':tag_name' => $tag_name
      );
      $result2 = exec_sql_query($db,$sql_get_tag_id,$params2)->fetchAll();
      $tag_id_value = NULL;
      foreach($result2 as $res2){
        $tag_id_value = $res2["tag_id"];
      }
      $sql_insert_into_photos_in_tags = "INSERT INTO photos_in_tags (photo_id,tag_id) VALUES (:photo_id,:tag_id);";
      $params3 = array(
        ':photo_id' => $_GET["id"],':tag_id' => $tag_id_value
      );
      $sql_check_for_tag_in_other_table = "SELECT * FROM photos_in_tags INNER JOIN tags ON photos_in_tags.tag_id = tags.tag_id WHERE (tags.tag_name = :tag_name AND photos_in_tags.photo_id = :photo_id);";
      $params4 = array(
        ':tag_name' => $tag_name, ':photo_id' => $_GET["id"]
      );
      //Only insert into photos_in_tags table if the tag is not already associated with the image
      if (!exec_sql_query($db,$sql_check_for_tag_in_other_table,$params4)->fetchAll()){
        $result3 = exec_sql_query($db,$sql_insert_into_photos_in_tags,$params3);
      } else {
          echo "<p>Sorry, that tag already exists</p>";
      }
    }



    //If the user clicked the delete tag button, do the following
    if (isset($_POST['delete_tag_dropdown'])){
      //Filter input
      $tag_name_delete = filter_input(INPUT_POST, 'category_delete', FILTER_SANITIZE_STRING);
      //sql statement finds the tag in the tags table that the user wants
      $sql_get_tag = "SELECT * FROM tags INNER JOIN photos_in_tags ON tags.tag_id = photos_in_tags.tag_id WHERE (photos_in_tags.photo_id = :photo_id AND tags.tag_name = :tag_name_delete);";
      $params = array(
        ':photo_id' => $_GET["id"],
        ':tag_name_delete' => $tag_name_delete
      );
      //Will make $records NULL if the tag was not found
      $records = exec_sql_query($db,$sql_get_tag,$params)->fetchAll();
      $tag_id = NULL;
      foreach ($records as $record){
        $tag_id = $record["tag_id"];
      }
      //Only delete from the photos_in_tags table if the tag actually exists
      if ($records){
        $sql_delete = "DELETE FROM photos_in_tags WHERE (photo_id = :photo_id AND tag_id = :tag_id);";
        $params2 = array(
          ':photo_id' => $_GET["id"],
          ':tag_id' => $tag_id
        );
        exec_sql_query($db,$sql_delete,$params2);
      } else {
        echo "<p>Sorry, you cannot delete a tag if it is not associated with the image";
      }
    }

    if (isset($_POST["attach_tag"])){
      $tag_name = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
      //sql statement that adds the tag to the the tags table
      $sql_add_tag_to_table = "INSERT INTO tags (tag_name) VALUES (:tag_name);";
      //Have a sql statement that checks if the tag already exists. If so, there is no need to add the
      //tag to the tags table
      $sql_check_for_tag = "SELECT * FROM tags WHERE tag_name = :tag_name;";
      $params = array(
        ':tag_name' => $tag_name
      );
      //If the tag does not exist, then execute $sql_add_tag_to_table statement (adds tag to tags table)
      if (!exec_sql_query($db, $sql_check_for_tag, $params)->fetchAll()){
        $result = exec_sql_query($db, $sql_add_tag_to_table, $params);
      }
      //sql statement that gets the tag id associated with the tag name
      $sql_get_tag_id = "SELECT tag_id FROM tags WHERE tag_name = :tag_name;";
      $params2 = array(
        ':tag_name' => $tag_name
      );
      $result2 = exec_sql_query($db,$sql_get_tag_id,$params2)->fetchAll();
      $tag_id_value = NULL;
      foreach($result2 as $res2){
        $tag_id_value = $res2["tag_id"];
      }
      $sql_insert_into_photos_in_tags = "INSERT INTO photos_in_tags (photo_id,tag_id) VALUES (:photo_id,:tag_id);";
      $params3 = array(
        ':photo_id' => $_GET["id"],':tag_id' => $tag_id_value
      );
      $sql_check_for_tag_in_other_table = "SELECT * FROM photos_in_tags INNER JOIN tags ON photos_in_tags.tag_id = tags.tag_id WHERE (tags.tag_name = :tag_name AND photos_in_tags.photo_id = :photo_id);";
      $params4 = array(
        ':tag_name' => $tag_name, ':photo_id' => $_GET["id"]
      );
      //Only insert into photos_in_tags table if the tag is not already associated with the image
      if (!exec_sql_query($db,$sql_check_for_tag_in_other_table,$params4)->fetchAll()){
        $result3 = exec_sql_query($db,$sql_insert_into_photos_in_tags,$params3);
      } else {
        echo "<p>Sorry, that tag already exists</p>";
      }
    }

    const BOX_UPLOADS_PATH = "uploads/photo_gallery/";

    //The id should be in the url, so this checks for the id and only displays the image associated with that photo id
    if (isset($_GET["id"])){
      //Gets photo with the specified id
      $sql_get_photo_with_id = "SELECT * FROM photo_gallery WHERE photo_id = :photo_id;";
      $params = array(
        ':photo_id' => $_GET["id"]
      );
      $records = exec_sql_query($db, $sql_get_photo_with_id, $params)->fetchAll();
      //Gets tags associated with the photo
      $sql_get_tags = "SELECT * FROM tags INNER JOIN photos_in_tags ON tags.tag_id = photos_in_tags.tag_id WHERE photos_in_tags.photo_id = :photo_id;";
      $records2 = exec_sql_query($db, $sql_get_tags, $params)->fetchAll();
      //Display information about the photo
      foreach($records as $record){
        echo "<form action=\"edit_photo.php?id=" . $_GET["id"] . "\" method=\"post\">";
        echo "<div class = \"left_image\"><img class=\"singleimg\" alt=\"display_one_image\" src=" . BOX_UPLOADS_PATH . htmlspecialchars($record["photo_id"]) . "." . htmlspecialchars($record["file_ext"]) . "></div>";
        echo "<p class=\"center\">Photo Name: " . htmlspecialchars($record["photo_name"]) . "</p>";
        echo "<p class=\"center\">Photographer: " . htmlspecialchars($record["photographer"]) . "</p>";
        echo "<p class=\"center\">Event Names: ";
        foreach($records2 as $record2){
          echo htmlspecialchars($record2["tag_name"]) . ",";
        }
        echo "</p></form>";
        //Only give user the option to delete a tag or the image if the user is logged in
        if ($current_user){
          echo "<form class=\"epform\" action=\"gallery.php?id=" . $_GET["id"] . "\" method=\"post\">";
          echo "<button class=\"button-link deleteb\" type=\"submit\" name =\"delete\">Delete Photo</button></form>";
          echo "<form class=\"epform\" method =\"post\">";
          echo "<select class=\"select_box\" name=\"category_delete\">";
          $sql_get_all_tags = "SELECT * FROM tags";
          $params = array();
          $records = exec_sql_query($db,$sql_get_all_tags,$params);
          foreach($records as $record){
            echo "<option value = \"" . htmlspecialchars($record["tag_name"]) . "\">" . htmlspecialchars($record["tag_name"])  . "</option>";
          }
          echo "</select>";
          echo "<button class=\"button-link picedit\" name=\"delete_tag_dropdown\" type =\"submit\">Delete Event Name</button></form><br/>";


          //User does NOT need to be logged in in order to add a tag to an image
          echo "<form class=\"epform\" method =\"post\">";
          echo "<select class=\"select_box\" name=\"category\">";
          $sql_get_all_tags = "SELECT * FROM tags";
          $params = array();
          $records = exec_sql_query($db,$sql_get_all_tags,$params);
          foreach($records as $record){
            echo "<option value = \"" . htmlspecialchars($record["tag_name"]) . "\">" . htmlspecialchars($record["tag_name"])  . "</option>";
          }
          echo "</select>";
          echo "<button class=\"button-link picedit\" name=\"attach_tag\" type =\"submit\">Attach Event Name</button></form><br/>";
          echo "<form class=\"epform\" method=\"post\"><input type=\"text\" size=35 name=\"tag_name\"/>";
          echo "<button class=\"button-link picedit\" name=\"submit_tag\" type=\"submit\">Add Event Name</button></form>";

      }
      echo "<form action=\"gallery.php\">";
      echo "<button class=\"button-link\">Go back to Gallery</button>";
      echo "</form>";
      // echo "<a href=\"gallery.php\">Go back to Gallery</a>";
    }

    }
    ?>

</div>
</div>

<?php  include('includes/footer.php'); ?>

</body>

</html>
