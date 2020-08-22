<?php
require_once 'ims-blti/blti.php';
include '../includes/dbconn.php';

$lti = new BLTI("secret", false, false);

session_start();
header('Content-Type: text/html; charset=utf-8');  
?>
 
<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <title>Noodle LTI</title>
  </head>
   
  <body>
  <main id="main">
    <?php
    if ($lti->valid) {
    ?>
        <h2>Noodle</h2>
        <p>כאן תוכלו למצוא חומרים רלוונטיים לקורס ולהעלות חומרים משלכם.</p>  
    <?php
      $course_name = $_POST["context_title"];
      echo "<h2>חומרים רלוונטיים לקורס: ".$course_name."</h2>"
    ?>
    <?php
    } else {
  ?>
    <h2>שגיאה בהפעלת LTI.</h2>
    <p>פרטים: <?= $lti->message ?></p>
  <?php
      die();
    }
  ?>
  <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
           <!-- <th>תאריך</th> -->
            <!-- <th>תיאור</th> -->
            <th>שם</th>
             <!--<th>סוג</th>-->
             <!--<th>סטטוס</th>-->
          </tr>
        </thead>
        <tbody>
  <?php
   // Check connection
   if ($conn->connect_error) {
    echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
  }
  else { 
    $sql = 'SELECT * FROM material';
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<tr>
            <td>'.$row["id"].'</td>
            <td>'.$row["name"].'</td>
          </tr>';
        }
    } else {
        echo '<h4 class="card-title">לא נמצאו בקשות</h4>';
    }
  }
  ?>  
</tbody>
</table>
  </main>
  </body>
   
</html>