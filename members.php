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
  </div>

<div class="red">
<div class="imgtext">
<h3 class="center">EXECUTIVE MEMBERS</h3>

<div id="memberModal" class="modal">
</div>


<div class="row">
  <div class="column">
    <div><img class = "member_image" src="uploads/members/EstherChen.jpg" alt="image of Esther Chen"/>
      <p class="center name">Esther Chen '18</p>
      <p class="center pos"><i>Executive President</i></p>

      <button class="button-link" id="EstherChen">Read More</button>
      <div id="EstherChenModal" class="modal">
        <div class="modal-content">
          <h5 class="modal_center">ESTHER CHEN</h5>
          <p class="modal_center">Executive President</p>
          <p class="modal_text">Major: Biomedical Engineering</p>
          <ul class="modal_list"><li class="modal_text">Other Activities:</li>
            <li class="modal_text">Society of Engineers in Medicine (President)</li>
            <li class="modal_text">Thorny Roses Club Ultimate Frisbee (Captain)</li>
            <li class="modal_text">Engineering Peer Advisor</li>
            <li class="modal_text">Frey Lab in HumEc Dept. of Fiber Science & Apparel Design</li>
          </ul>
          <button class="button-link insideb" id="CloseEstherChen">Close</button>
        </div>
      </div>

    </div></div>
  <div class="column">
    <div><img class = "member_image" src="uploads/members/yongjaePark.jpg" alt="image of Yongjae Park"/>
      <p class="center name">YongJae Park</p>
      <p class="center pos"><i>Executive Vice President</i></p>

      <button class="button-link" id="YongJaePark">Read More</button>
      <div id="YongJaeParkModal" class="modal">
        <div class="modal-content">
          <h5 class="modal_center">YONGJAE PARK</h5>
          <p class="modal_center">Executive Vice President</p>
          <p class="modal_text">Major: HBHS</p>
          <ul class="modal_list"><li class="modal_text">Other Activities:</li>
            <li class="modal_text">Volunteer Coordinator of Youth Outreach Undergraduates Reshaping Success (Y.O.U.R.S.)</li>
            <li class="modal_text">Community Outreach Chair of Alpha Epsilon Delta (Pre-Med Honors Society)</li>
            <li class="modal_text">Brother of Lambda Phi Epsilon </li>
            <li class="modal_text">Buchon Lab: studying the role of Mirror gene in Enteroendocrine cells of Drosophila melanogaster In response to stress </li>
          </ul>
          <button class="button-link insideb" id="CloseYongJaePark">Close</button>
        </div>
      </div>
    </div></div>
  <div class="column">
    <div><img class = "member_image" src="uploads/members/shakhzoda.jpg" alt="image of Shakhzoda"/>
      <p class="center name">Shakhzoda Alimdjanova</p>
      <p class="center pos"><i>VP of Fundraising</i></p>

      <button class="button-link" id="ShakhzodaAlimdjanova">Read More</button>
      <div id="ShakhzodaAlimdjanovaModal" class="modal">
        <div class="modal-content">
          <h5 class="modal_center">SHAKHZODA ALIMDJANOVA ‘20</h5>
          <p class="modal_center">Vice President of Fundraising</p>
          <p class="modal_text">Major: Biological Sciences</p>
          <ul class="modal_list"><li class="modal_text">Other Activities:</li>
            <li class="modal_text">Alpha Phi Omega</li>
            <li class="modal_text">Alpha Chi Sigma (Social Media Chair)</li>
            <li class="modal_text">Weill-Ithaca Network</li>
            <li class="modal_text">Cornell Pre-Health Peer Mentorship Program</li>
            <li class="modal_text">Salsa Palante</li>
          </ul>
          <button class="button-link insideb" id="CloseShakhzodaAlimdjanova">Close</button>
        </div>
      </div>
    </div></div>
  <div class="column">
    <div><img class = "member_image" src="uploads/members/phoebeIlevbare.jpg" alt="image of Phoebe"/>
      <p class="center name">Phoebe Ilevbare</p>
      <p class="center pos"><i>VP of Finance</i></p>

      <button class="button-link" id="PhoebeIlevbare">Read More</button>
      <div id="PhoebeIlevbareModal" class="modal">
        <div class="modal-content">
          <h5 class="modal_center">PHOEBE ILEVBARE '20</h5>
          <p class="modal_center">Vice President of Finance</p>
          <p class="modal_text">Major: Biological Sciences</p>
          <ul class="modal_list"><li class="modal_text">Other Activities:</li>
            <li class="modal_text">Cornell Cardiology Interest Group</li>
            <li class="modal_text">Research assistant in Christiansen Psychology lab</li>
            <li class="modal_text">Weill-Ithaca Network mentee</li>
            <li class="modal_text">Donlon RCA in Summer College</li>
          </ul>
          <button class="button-link insideb" id="ClosePhoebeIlevbare">Close</button>
        </div>
      </div>
    </div></div>
  <div class="column">
    <div><img class = "member_image" src="uploads/members/jessicaGuarnizo.jpg" alt="image of Jessica Guarnizo"/>
      <p class="center name">Jessica Guarnizo</p>
      <p class="center pos"><i>VP of Public Relations</i></p>

      <button class="button-link" id="JessicaGuarnizo">Read More</button>
      <div id="JessicaGuarnizoModal" class="modal">
        <div class="modal-content">
          <h5 class="modal_center">JESSICA GUARNIZO '19</h5>
          <p class="modal_center">Vice President of Public Relations</p>
          <p class="modal_text">Major: Biology and Society</p>
          <ul class="modal_list"><li class="modal_text">Other Activities:</li>
            <li class="modal_text">Alpha Chi Sigma (Chemistry Fraternity)</li>
            <li class="modal_text">Cornell for St. Jude’s Research Hospital</li>
            <li class="modal_text">Cru: Christian Fellowship</li>
            <li class="modal_text">Cornell Red Carpet Ambassador</li>
            <li class="modal_text">Keeton Active Citizen</li>
          </ul>
          <button class="button-link insideb" id="CloseJessicaGuarnizo">Close</button>
        </div>
      </div>
    </div></div>
  <div class="column">
    <div><img class = "member_image" src="uploads/members/islamElsaid.jpg" alt="image of Islam Elsaid"/>
      <p class="center name">Islam Elsaid</p>
      <p class="center pos"><i>VP of Academic Events</i></p>
      <button class="button-link" id="IslamElsaid">Read More</button>
      <div id="IslamElsaidModal" class="modal">
        <div class="modal-content">
          <h5 class="modal_center">ISLAM ELSAID '20</h5>
          <p class="modal_center">Vice President of Academic Events</p>
          <p class="modal_text">Major: Chemistry</p>
          <ul class="modal_list"><li class="modal_text">Other Activities:</li>
            <li class="modal_text">Aye Lab in Dept of Chemistry & Chemical Biolog</li>
            <li class="modal_text">Cornell Daily Sun</li>
            <li class="modal_text">Cornell Orientation Leader</li>
            <li class="modal_text">Muslim Educational & Cultural Association</li>
          </ul>
          <button class="button-link insideb" id="CloseIslamElsaid">Close</button>
        </div>
      </div>
    </div></div>
  <div class="column">
    <div><img class = "member_image" src="uploads/members/michaelLee.jpg" alt="image of Michael Lee"/>
      <p class="center name">Brian Lin</p>
      <p class="center pos"><i>Executive Secretary</i></p>
      <button class="button-link" id="BrianLin">Read More</button>
      <div id="BrianLinModal" class="modal">
        <div class="modal-content">
          <h5 class="modal_center">BRIAN LIN '20</h5>
          <p class="modal_center">Executive Secretary</p>
          <p class="modal_text">Major: Biology</p>
          <ul class="modal_list">
            <li class="modal_text">Other Activities:</li>
            <li class="modal_text">Undergraduate RA at Buchon Lab</li>
            <li class="modal_text">Risley RCA in Cornell’s Summer Colleg</li>
            <li class="modal_text">Medlife</li>
          </ul>
          <button class="button-link insideb" id="CloseBrianLin">Close</button>
        </div>
      </div>
    </div></div>
</div>
</div>

</div>
<script type="text/javascript" src="../scripts/popup.js"></script>
<?php  include('includes/footer.php'); ?>

</body>
</html>
