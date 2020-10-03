<!DOCTYPE html>
<head>
  <title>Noodle</title>
  <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/calendar.css">

  <?php
  include "session.php";
  ?>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="../javascript/cookies.js"></script>
  <script src="../javascript/tooltip.js"></script>

</head>
<body>
<div id="header"></div>
      
<div class="text-center">
  <br>
  <h2>שלום <?php echo $_SESSION["name"] ?></h2> 
</div>

<main id="main_homepage" class="container">

  <h2>תפריט ניווט</h2>
  <div class="row">
  
    <section class="col-sm-3">
      <div class="container">
        <div class="card" style="width:300px;height:550px">
        <img class="card-img-top" src="../media/search.jpg" alt="Card image" style="width:100%">
        <div class="card-body">
          <h4 class="card-title">חיפוש חומרי לימוד</h4>
          <p class="card-text">באתר Noodle תוכלו למצוא מגוון רחב מאוד של חומרי לימוד, בקלות ובנוחות</p>
          <a href="contentresults.php" class="btn btn-primary" style="margin-top:29%">חיפוש חומרים</a>
        </div>
      </div>
      <br>
    </section>
    <section class="col-sm-3">
          <div class="container">
            <div class="card" style="width:300px;height:550px">
            <img class="card-img-top" src="../media/sharing.png" alt="Card image" style="width:100%">
            <div class="card-body">
              <h4 class="card-title">שיתוף חומרי לימוד</h4>
              <p class="card-text">יש ברשותך חומרי לימוד שלא קיימים ב-Noodle? <br> באפשרותך להעלות חומרי לימוד חדשים ולעזור לקהילה שלנו!</p>
              <a href="contentUpload.php" class="btn btn-primary" style="margin-top:10.5%">שיתוף חומרים</a>
            </div>
          </div>
          <br>


    </section>
    <section class="col-sm-3">
          <div class="container">
            <div class="card" style="width:300px;height:550px">
            <img class="card-img-top" src="../media/teacher2.png" alt="Card image" style="width:100%">
            <div class="card-body">
              <h4 class="card-title">שיעורים פרטיים</h4>
              <p class="card-text">באתר Noodle תוכלו למצוא מגוון מורים פרטיים מתחומים שונים שמציעים שיעורים פרטיים, לקרוא ביקורות ואפילו להירשם כמורה בעצמך</p>
              <a href="private_lessons.php" class="btn btn-primary" style="margin-top:1%">צפיה במורים</a>
            </div>
          </div>
          <br>         
    </section>
    <section class="col-sm-3">
    <div class="container">
        <div class="card" style="width:300px;height:550px">
          <img class="card-img-top" src="../media/profilepage.png" alt="Card image" style="width:100%">
          <div class="card-body">
            <h4 class="card-title">צפיה בפרופיל האישי</h4>
            <p class="card-text">צפה ועדכן פרטים אישיים</p>
            <a href="profile.php" class="btn btn-primary" style="margin-top:38.5%">פרופיל אישי</a>
          </div>
      </div>         
    </section>

  </div>
</main>

<div id="footer"></div> 

</body>
</html>
