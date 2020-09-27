<!DOCTYPE html>
<head>
  <title>Noodle</title>
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


      <?php
      $material_id = $_GET["id"];

      $content_sql = "SELECT materials.name AS material_name, materials.description AS material_desc, UPPER(file_type) AS material_type, materials.date AS material_date, materials.course_id, materials.user_id, users.name AS user_uploader
      FROM materials
      LEFT JOIN users ON materials.user_id = users.id
      WHERE materials.id = '$material_id';";  
      
      $content_data = $conn->query($content_sql);
      $row = $content_data->fetch_assoc();
      $content_name = $row["material_name"];
      $content_date = $row["material_date"];
      $content_type = $row["material_type"];
      $content_desc = $row["material_desc"];
      $content_uploader = $row["user_uploader"];
      
      



      ?>


      <h2>דירוגי גולשים עבור "<?php echo $content_name ?>"</h2>
      <p><b>שם הקובץ:</b> <?php echo $content_name ?></p>
      <p><b>תיאור הקובץ:</b> <?php echo $content_desc ?></p>
      <p><b>סוג הקובץ:</b> <?php echo $content_type ?></p>
      <p><b>הועלה ע"י:</b> <?php echo $content_uploader ?></p>
      <p><b>תאריך העלאה:</b> <?php echo $content_date ?></p>

      <br><br>

      <table class="table table-striped">
      <thead>
                    <tr>
                        <th scope="col">תאריך</th>
                        <th scope="col">כינוי</th>
                        <th scope="col">תגובה</th>
                        <th scope="col">דירוג (מתוך 5)</th>
                    </tr>
                </thead>

                <tbody>
                <?php     
                    $sql = "SELECT material_id, date, user_nickname, user_comment, user_rating FROM materials_rating
                    WHERE rating_type = 'material'
                    AND material_id = '$material_id'";  
                    
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo '<tr>
                            <td>'.$row["date"].'</td>
                            <td>'.$row["user_nickname"].'</td>
                            <td>'.$row["user_comment"].'</td>
                            <td>'.$row["user_rating"].'</td>
                            </tr>';
                        }
                    }
                ?>       
                </tbody>
        </table>
</div>



<div id="footer"></div>       

</body>
</html>