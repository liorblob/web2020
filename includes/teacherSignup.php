<!DOCTYPE html>
<head>
  <title>Add New Teacher</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/profile.css">
  <link rel="stylesheet" type="text/css" href="../css/feedback2.css">
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">

  <?php
  include "session.php";
  ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="../javascript/validateProfile.js"></script>


</head>
<body>
<div id="header"></div>
<div id="main" class="container">
  <div class="row">
    <div class="col-sm-12">
      <form id="fedform" method="post" action="add_teacher_php.php" onsubmit="return validateForm()">
      <h2 class="pt-4">פרסום שיעורים פרטיים</h2>
        <div class="form-group">
            <label for="subject_main">מהם תחומי הלימוד אותם תרצה ללמד?</label>
            <input id="subject_main" name="subject_main" type="text" placeholder="" class="form-control" aria-describedby="sizing-addon1" required>
          </div> 
        <div class="form-group">
            <label for="lesson_time">מהו משך השיעור?</label>
            <input id="lesson_time" name="lesson_time" type="number" placeholder="בדקות" class="form-control" aria-describedby="sizing-addon1" required>
          </div> 
          <div class="form-group">
            <label for="lesson_price">מהו מחיר השיעור?</label>
            <input id="lesson_price" name="lesson_price" type="number" class="form-control" aria-describedby="sizing-addon1" required>
          </div>
          <div class="form-group">
            <label for="UsernameInput">ספר קצת על עצמך:</label>
            <textarea class="form-group" name="background" rows="4" cols="50" placeholder="ספר לגולשי האתר מי אתה ומהי ההכשרה שלך" aria-describedby="sizing-addon1" required></textarea>
          </div>
        <div class="form-group">
            <label for="telephone">טלפון ליצירת קשר</label>
            <input id="telephone" name="telephone" type="tel" class="form-control" aria-describedby="sizing-addon1" required>
          </div>
          <button type = "submit" value="Submit" id="updateButton" class="btn btn-primary">פרסום</button>
      </form>
    </div>
  </div>
</div>
<div id="footer"></div>       
</body>
</html>
