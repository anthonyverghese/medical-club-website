<?php include('includes/init.php'); ?>
<!DOCTYPE html>
<html>

<?php include('includes/head.php'); ?>

<body>

<?php
if (isset($_GET["logout"])){
  echo "<p class=\"logoutbanner\">You've been successfully logged out!</p>";
}
if (isset($_GET["login"])){
  echo "<p class=\"logoutbanner\">You've been successfully logged in! <br/> Want to add photos? Go to the gallery page! <br/> Want to add events? go to the about page! <br/> Want to read comments? Go to the contact page!</p>";
}
?>

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
<h3 class="left">MEDICINE + PHILANTHROPY </h3>
<p class="justify center whiteline">CAMP, or Cornell Association of Medicine and Philanthropy, is a STEM and
           Pre-health focused organization on campus.  Our purpose is to
           broaden perspectives on areas of medical work other than a single
           pre-medical purpose as well as to raise awareness and give back
           through philanthropic events to underrepresented causes.
           We admit all students who demonstrate a genuine interest in the
           organization with our purpose and support and encourage all STEM
          students’ interests. CAMP has weekly meetings for members of Wednesdays
          from 5-6 in Malott 203 or Goldwin Smith Hall G64 on Cornell's campus. Explore our
           website to see how you can get involved!</p>
</div>

<div class="full">
<div class="fullrow">
<div class="halfimg">
  <img class="wholeimg" src="images/involved.jpg" alt="members">
</div>
<div class="halfimg black">
  <div class="text">
    <h4> who are we? </h4>
      <p> Expore our members page to learn about all of our awesome members! Our members
        come from a wide variety of backgrounds and majors. All of them have a wide variety
      of passions and interests, however they all have one thing in common-- their love
    for both medicie and philanthropy.<a href="members.php" class="click2"> EXPLORE</a></p>
    </div>
</div>
</div>
<div class="fullrow">
<div class="halfimg white">
  <div class="text">
    <h4> fun events </h4>
      <p> In order to raise money for amazing causes our club participates in a number
        of fun events each semester. During these events members get to know each other
        better. Some events that we have participated in the past inlcude our annual gala and
        hunger awarness week. Visit our gallery page to explore pictures from these events!
        <a href="gallery.php" class="click"> EXPLORE</a></p>
    </div>
</div>
<div class="halfimg">
    <img class="wholeimg" src="images/picture.jpg" alt="members">
</div>
</div>
</div>

<div class="text">
<h3 class="center">want to get involved?</h3>
<p class="center"> Visit our contact page and email or submit the form. Everyone is welcome! </p>
<div id="redcont">
    <img class="redimg" src="images/red1.png" alt="red circle">
    <img class="redimg" src="images/red2.png" alt="red circle">
    <img class="redimg" src="images/red3.png" alt="red circle">
</div>
</div>

</div>

<?php  include('includes/footer.php'); ?>

</body>
</html>
