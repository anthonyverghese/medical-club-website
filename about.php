<?php include('includes/init.php'); ?>
<!DOCTYPE html>
<html>

<?php include('includes/head.php'); ?>

<body>

<div id="headerimg">
<?php
  if ($current_user) {
    include('includes/navbar_loggedin.php');
  } else{
    include('includes/navbar.php');
  }
?>

<?php
  if (isset($_REQUEST["submit"])){
    $insert_query = "INSERT INTO timeline (event_year, event_month, event_title) VALUES (:year, :month, :title);";
    $year = filter_input(INPUT_POST, "year", FILTER_VALIDATE_INT);
    $month = filter_input(INPUT_POST, "month", FILTER_VALIDATE_INT);
    $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);

    $params = array(
      ":year" => $year,
      ":month" => $month,
      ":title" => $title
    );
    $res = exec_sql_query($db, $insert_query, $params);

  }
?>
</div>

<div class="red">

<div class="text">
<h3 class="center">ABOUT CAMP</h3>
<p class="justify center">Cornell Association of Medicine and Philanthropy (CAMP) was founded in summer of 2015 by president Zhun Che. CAMP was established to provide pre-health students opportunities to participate in humanitarian aid and philanthropy projects, to build a strong network with other pre- health students, and to receive academic and professional support to advance one’s development as a future healthcare provider. Since its beginning, CAMP has been a partner of Action Against Hunger, a non- profit humanitarian organization that promotes awareness on issues of malnutrition in developing parts of the world and provides aid to such areas of need. CAMP has pledged its support for Action Against Hunger through its annual Hunger Awareness Week, consisting of photo campaigns that are hosted on the Action Against Hunger website and fundraisers with proceeds going to Action Against Hunger. In addition, CAMP hosts an annual Action Against Hunger Benefit Gala in partnership with Action Against Hunger as well as other organizations on-campus. CAMP strives to foster passion for service, leadership, and dedication in its members through host of philanthropy and academic support events throughout the year. CAMP hosts philanthropy events related to health and medicine that are planned and executed by small sub-group of members every month, establishing itself as the organization most dedicated to service.<p>
</div>


<div class="full">
<div class="fullrow">
<div class="halfimg">
  <img class="wholeimg" src="images/char.jpg" alt="charecter dev">
</div>
<div class="halfimg black">
  <div class="text">
    <h4> charecter development </h4>
      <p>  CAMP allows for character development of its members through these projects,
        instilling a sense of responsibility, commitment, and leadership. To further critical
        thinking in realm of health and medicine among its members, CAMP hosts debates and current
         event presentations. </p>
    </div>
</div>
</div>
<div class="fullrow">
<div class="halfimg white">
  <div class="text">
    <h4> develop professionally</h4>
      <p> CAMP offers vast opportunities for its members to develop professionally
         through academic support events such as resume workshop, summer internship panels,
         study groups, and mentor- mentee program. Finally, CAMP provides a tight-knit social network,
         in which one can interact with other students with similar academic and professional goals. </p>
    </div>
</div>
<div class="halfimg">
    <img class="wholeimg" src="images/develop.jpg" alt="social">
</div>
</div>
</div>


<div class="text">

<h3 class="center">CAMP's HISTORY</h3>
  <?php
    $months = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun",
                    7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec");

    $db = open_or_init_sqlite_db('photos_db.sqlite', "init/init.sql");
    $timeline_query = "SELECT * FROM timeline ORDER BY event_year ASC, event_month ASC;";
    $params = array();

    $records = exec_sql_query($db, $timeline_query, $params)->fetchAll();

    echo "<ul class=\"timeline_list\">";
    foreach ($records as $record){
      $event_month = $record["event_month"];
      $event_year = $record["event_year"];
      $event_title = $record["event_title"];

      echo "<li class=\"timeline_item\">".$months[htmlspecialchars($event_month)]." ".htmlspecialchars($event_year).": ".htmlspecialchars($event_title)."</li>";
    }
    echo "</ul>";

  ?>

  <?php
  echo "<h5 class=\"center\">WANT TO ENTER A NEW EVENT?</h5>";
  if ($current_user){
    echo "<form id = \"timeline_form\" action = \"about.php\" method = \"post\">";
    echo "<input type = \"number\" name = \"month\" class = \"month\" placeholder = \"Month\" min = \"1\" max = \"12\" required />";
    echo "<input type = \"number\" name = \"year\" class = \"year\" placeholder = \"Year\" required />";
    echo "<input type = \"text\" name = \"title\" class = \"title\" placeholder = \"Title\" required />";
    echo "<input type=\"submit\" name=\"submit\" class=\"submit_event\" value=\"Submit\" />";
    echo "</form>";
  }
  else{
    echo "<p class=\"center\">Please log into an admin account in order to add new events to the CAMP timeline.</p>";
  }
  ?>

    <img class="fourthimg" src="images/about1.png" alt="red circle">
    <img class="fourthimg" src="images/about2.png" alt="red circle">
    <img class="fourthimg" src="images/about3.png" alt="red circle">
    <img class="fourthimg" src="images/about4.png" alt="red circle">
</div>
</div>



<?php  include('includes/footer.php'); ?>

</body>
</html>
