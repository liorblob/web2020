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
  <link rel="stylesheet" type="text/css" href="../css/contentUpload.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="../javascript/lti.js"></script>
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
      echo '<h2 class="title">חומרים רלוונטיים לקורס '.$course_name.'</h2>';
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
    echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
  }
  else {
    $sql = "SELECT DISTINCT u.name as uname, u.profile_pic as user_pic, materials.id AS material_id, materials.name AS material_name, materials.description AS material_desc, materials.file_type AS material_type, courses.name AS course_name , institutions.name AS inst_name,
                        materials_rating.material_rating AS material_rating
                        FROM materials INNER JOIN courses ON courses.id= materials.course_id
                        INNER JOIN institutions ON courses.inst_id = institutions.id
                        LEFT JOIN 
                        (SELECT material_id, ROUND(AVG(user_rating),1) AS material_rating
						FROM materials_rating
						WHERE status = 'Approved'
                        AND rating_type = 'material'
						GROUP BY material_id) AS materials_rating
                        ON materials.id = materials_rating.material_id
                        LEFT JOIN users AS u
                        ON materials.user_id = u.id
                        WHERE materials.status = 'Approved'
                        AND courses.name = ?
                        GROUP BY materials.id                        
                        ORDER BY rating DESC;";
   
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
                  <button class="btn btn-link" onclick="downloadClick(this)" value="'.$row["material_id"].'">הורדה</button>
                  <button class="btn btn-link" onclick="rateClick(this)" value="'.$row["material_id"].'">דירוג</button>
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
    <h2 class="col-sm-2 upload">העלאת תוכן</h2> 
    <div class="row">
        <div class="col-sm-8">
          <form id="contentUploadForm" method="POST" enctype="multipart/form-data" action="saveContentMoodle.php">
          <h4 class="pt-4">פרטי התוכן</h4>
            <div class="form-group">
              <label for="dateInput">תאריך עדכניות</label>
              <input type="date" class="form-control" id="dateInput" name="dateInput" placeholder="" required>
            </div>
            <div class="form-group">
              <label for="titleInput">כותרת</label>
              <input type="text" class="form-control" id="titleInput" name="titleInput" placeholder="כותרת התוכן המועלה" required>
            </div>
              <div class="form-group">
                <label for="descriptionInput">תיאור התוכן</label>
                <textarea class="form-control" id="descriptionInput" name="descriptionInput" rows="3" placeholder="תיאור התוכן המועלה" required></textarea>
              </div>
            <h4 class="pt-4">בחירת קובץ</h4>
            <input type="file" class="form-control-file" id="contentInput" name="contentInput" required>
            <br>
            <script src="../javascript/ContentUploader.js"></script>
            <button type="submit" class="btn btn-primary">העלאה</button> 
            <input type="hidden" name="course" value=<?php echo '"'.$course_name.'"'; ?> />
            <br><br>
          </form>
      </div>  
    </div>

    <div class="backdrop">
        <div id="popdiv" class="container-sm">

            <nav class="navbar navbar-dark bg-primary" id="fednav">
                <a class="navbar-brand" href="#">הזנת משוב</a>
            </nav>
            <form id="fedform" method="post" action="addContentRatingMoodle.php" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="formGroupExampleInput">שם הזדהות</label>
                    <input id="nickname" name="nickname" type="text" class="form-control" placeholder="הזן שם להזדהות" aria-describedby="sizing-addon1" required>
                    <small id="UsernameHelpBlock" class="form-text text-muted">
                    הינך יכול להזדהות בשמך, שם המשתמש שלך או לבחור שם אנונימי לבחירתך
                    </small>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">דירוג</label>
                    <br>
                    <div class="rate">
                           <input type="radio" id="star5" name="rate" value="5" />
                           <label for="star5" title="מצויין">5 stars</label>
                           <input type="radio" id="star4" name="rate" value="4" />
                           <label for="star4" title="טוב">4 stars</label>
                           <input type="radio" id="star3" name="rate" value="3" />
                           <label for="star3" title="בסדר">3 stars</label>
                           <input type="radio" id="star2" name="rate" value="2" />
                           <label for="star2" title="לא טוב">2 stars</label>
                           <input type="radio" id="star1" name="rate" value="1" />
                           <label for="star1" title="גרוע">1 star</label>
                    </div>
                    <br>
                </div>
                <br>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">תגובה</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" form="fedform"></textarea>
                    <small id="commentHelpBlock" class="form-text text-muted">התגובה תתפרסם לכל המשתמשים במערכת. אנא מכם, שמרו על שפה נאותה</small>
                    <input id="ratingValue" name="ratingValue" type="hidden"/>
                </div>
                <input id="sumbit_btn" class="btn btn-primary" type="submit" value="אישור"/>
                <input id="exitButton" class="btn btn-primary"  type="reset" value="ביטול"/>
            </form>
        </div>
    </div>
  <?php
  }
  
  ?>  

  </main>
  </body>
   
</html>