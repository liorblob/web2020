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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/lti.css">
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
        <div class="title"> 
          <h2>Noodle</h2>
          <p>כאן תוכלו למצוא חומרים רלוונטיים לקורס ולהעלות חומרים משלכם.</p>  
        </div>
    <?php
      $course_name = $lti->getCourseName();
      echo "<h2>חומרים רלוונטיים לקורס ".$course_name."</h2>";
    } else {
  ?>
    <h2>שגיאה בהפעלת LTI.</h2>
    <p>פרטים: <?= $lti->message ?></p>
  <?php
      die();
    }
  ?>
  <div class="row">
  <?php
   // Check connection
   if ($conn->connect_error) { 
    echo $lti->message;
    echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
  }
  else {
    $_SESSION["moodle"] = true;
    $sql = "SELECT m.name AS material_name, m.description AS material_desc, m.file_type AS material_type, m.date AS material_date, m.rating AS material_rating, m.id AS material_id,
    c.name AS course_name, i.name AS inst_name, u.name AS uname, u.profile_pic as user_pic
    FROM materials AS m, courses AS c, users AS u, institutions AS i
    WHERE m.status = 'Approved' AND c.name = ? AND m.course_id = c.id AND c.inst_id = i.id AND u.id = m.user_id";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $course_name);
    $stmt->execute();
    $result = $stmt->get_result();
    if(!$result){
      echo $sql;
    }
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            switch($row["material_type"]){
              case "pdf":
                $type_icon = "pdf1.png";
              break;
              case "doc":
              case "docx":
                $type_icon = "word.svg";
              break;
              case "ppt":
              case "pptx":
                $type_icon = "ppoint.svg";
              break;
              case "xls":
              case "xlsx":
              case "csv":
                $type_icon = "excel.svg";
              break;
              default:
                $type_icon = "doc.svg";
            }

            $rating_class = 'text-success';
            if($row["material_rating"] < 5){
              $rating_class = 'text-danger';
            } else if($row["material_rating"] < 8){
              $rating_class = 'text-warning';
            }
            
            $rating = '';
            for($i = 0; $i < 5 - $row["material_rating"]; $i++){
              $rating .= '<span class="fa fa-star"></span>';
            }
            for($j = $i; $j < 5; $j++){
              $rating .= '<span class="fa fa-star checked"></span>';
            }

            echo '
            <div class="col-md-3 card">
              <div class="card-body">
                <h4 class="card-title">'.$row["material_name"].' <img class="icon" src="../media/'.$type_icon.'"/></h4>'
                .$rating.'
                <p class="card-text">'.$row["material_desc"].'</p>             
                <img class="card-img-bottom" src="data:image/jpeg;base64,'.base64_encode($row['user_pic']).'"/>
                <p class="card-text">'.$row["uname"].'</p>
                <div class="btn-group">
                  <button class="btn btn-link" onclick="download(this)" value="'.$row["material_id"].'">הורדה</button>
                  <button class="btn btn-link" onclick="rate(this)" value="'.$row["material_id"].'">דירוג</button>
                </div>
             </div>
            </div>';
        }
    } else {
        echo '<h4 class="card-title">לא נמצאו תכנים רלוונטיים</h4>';
    }
    $stmt->close();
    $conn->close();
    ?>
    </div>
    <div class="row">
      <a class="upload col-sm-4 btn btn-primary" href="../includes/contentUpload.php">העלאת תוכן</a>
    </div>
  <?php
  }
  
  ?>  

  </main>
  </body>
   
</html>