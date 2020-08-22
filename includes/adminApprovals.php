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

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="../javascript/updateStatus.js"></script>

  <script>
    $(document).ready(function() {
      $("#updateButton").click(function() {
        $(".backdrop").fadeTo(200, 1);
      });
      $("#exitButton").click(function() {
          $(".backdrop").fadeOut(200);
      });
      
    });
</script>
</head>
<body>
<div id="header"></div>
<div id="main" class="container">
  <div class="row">
    <div class="col-sm-12">
      <h2 class="pt-4">בקשות העלאת תכנים</h2>




      <div class="scroll">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>תאריך</th>
              <th>משתמש</th>
              <th>מוסד לימודים</th>
              <th>קורס</th>
              <th>שם קובץ</th>
              <th>תיאור תוכן</th>
              <th>סוג קובץ</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>

          <?php
          
          // Check connection
          if ($conn->connect_error) {
              echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
          }
          else { 
            $id = $_SESSION["id"];

            $sql = 'SELECT m.date AS material_date, m.id AS material_id, m.name AS material_name, m.description AS material_desc, m.file_type AS material_type,  
            c.name AS course_name, 
            i.name AS inst_name,
            u.name AS user_name
            FROM `materials` AS m, `users` AS u, `courses` AS c, `institutions` AS i 
            WHERE m.status = "Pending Approval" AND m.course_id = c.id AND c.inst_id =i.id AND m.user_id = u.id';
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<tr>
                    <td>'.$row["material_date"].'</td>
                    <td>'.$row["user_name"].'</td>
                    <td>'.$row["inst_name"].'</td>
                    <td>'.$row["course_name"].'</td>
                    <td>'.$row["material_name"].'</td>
                    <td>'.$row["material_desc"].'</td>
                    <td>'.$row["material_type"].'</td>
                    <td><button value="'."Approved_".$row["material_id"].'" onclick=contentClick(this) class="btn btn-primary">אישור</button></td>
                    <td><button value="'."Declined_".$row["material_id"].'"  onclick=contentClick(this) class="btn btn-primary">דחיה</button></td>
                  </tr>';
                }
            } else {
                echo '<h4 class="card-title">לא נמצאו בקשות</h4>';
            }
          }
          ?>



          </tbody>
        </table>
      </div>
      <h2 class="pt-4">בקשות מורים פרטיים</h2>
      <h2 class="pt-4">בקשות משוב</h2>
      <div class="scroll">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>תאריך</th>
              <th>תחום</th>
              <th>קורס</th>
              <th>כותרת</th>
              <th>סוג</th>
              <th>סטטוס</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>04/03/2020</td>
              <td>מתמטיקה</td>
              <td>מתמטיקה ב'</td>
              <td>סיכום תרגולים 2020</td>
              <td>סיכום</td>
              <td class="bg-success">העלאה אושרה</td>
            </tr>
            <tr>
              <td>2</td>
              <td>01/04/2020</td>
              <td>מתמטיקה</td>
              <td>מתמטיקה ב'</td>
              <td>דף נוסחאות 2020</td>
              <td>סיכום</td>
              <td class="bg-info">ממתין לאישור</td>
            </tr>
            <tr>
              <td>3</td>
              <td>07/04/2020</td>
              <td>מתמטיקה</td>
              <td>מתמטיקה ב'</td>
              <td>מועד א' פתור 29.03.20 - ציון 96</td>
              <td>מבחן</td>
              <td class="bg-info">ממתין לאישור</td>
            </tr>
            <tr>
              <td><a href="contentUpload.html" class="card-link">העלה קובץ</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div> 
  </div>
</div>
<div id="footer"></div>       
</body>
</html>
