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
    /*
    $sql = "SELECT m.name AS material_name, m.description AS material_desc, m.file_type AS material_type, m.date AS material_date, m.rating AS material_rating, m.id AS material_id,
    c.name AS course_name, i.name AS inst_name, u.name AS uname, u.profile_pic as user_pic,
    mr.user_rating AS material_rating
    FROM materials AS m, courses AS c, users AS u, institutions AS i, materials_rating AS mr
    WHERE m.status = 'Approved' AND c.name = ? AND m.course_id = c.id AND c.inst_id = i.id AND u.id = m.user_id AND mr.rating_type = 'material' AND mr.material_id = m.id";
    */


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
  <?php
  }
  
  ?>  

  </main>
  </body>
   
</html>