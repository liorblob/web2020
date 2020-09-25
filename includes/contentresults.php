<!DOCTYPE html>
<html>
<head>
<title>Noodle</title>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>content results page</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="..\css\contentresults.css">
    <link rel="stylesheet" type="text/css" href="..\css\feedback.css">
    <link rel="stylesheet" type="text/css" href="..\css\rating.css">
    <link rel="stylesheet" type="text/css" href="..\css\main.css">


    <?php
    include "session.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="../javascript/contentresults.js"></script>

    <script>
    $(document).ready(function() {

      $("#exitButton").click(function() {
          $(".backdrop").fadeOut(200);
      });
    });
    </script>


</head>

<body>
    <div id="header"></div>

    <main>
    <div class="container-sm">




    <div class="container-sm">
            <h2>חיפוש חומר לימודי</h2>
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-sm">
                            <label for="school">מוסד לימודים</label>
                            <select id="InputSchool" name="InputSchool" class="form-control">
                                <option selected>הכל</option>
                                <?php
                                // Check connection
                                if ($conn->connect_error) {
                                    echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
                                }
                                else { 
                                    $sql = 'SELECT institutions.name AS inst_name FROM institutions';
                                    $result = $conn->query($sql);
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                    echo '<option>'.$row["inst_name"].'</option>';
                                    }
                                }
                                ?>  
                            </select>
                        </div>
                        <div class="form-group col-sm">
                            <label for="contentName">שם קובץ</label>
                            <input type="text" name="contentName" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm">
                            <label for="fromDate">מתאריך</label>
                            <input type="date" class="form-control" name="fromDate">
                        </div>
                        <div class="form-group col-sm">
                            <label for="toDate">עד לתאריך</label>
                            <input type="date" class="form-control" name="toDate">
                        </div>
                    </div>
                </div>
                <input type="Submit" value="חפש" class="btn btn-primary"> 
            </form>
        </div>

        <div class="table-responsive-sm">
            <h2>תוצאות חיפוש</h2>
            <table class="table table-striped" id="verticalText">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">סוג</th>
                        <th scope="col">שם</th>
                        <th scope="col">תיאור</th>
                        <th scope="col">קורס</th>
                        <th scope="col">מוסד</th>
                        <th scope="col">עדכניות</th>
                        <th scope="col">דירוג ממוצע (מתוך 5)</th>
                        <th scope="col">דרג חומר זה</th>
                    </tr>
                </thead>

                <tbody>
                    <?php     
                    
                    if($_SERVER["REQUEST_METHOD"] == "POST"){

                        //Check School
                        if($_POST["InputSchool"] == "הכל"){
                            $InputSchool = "";
                        }
                        else{
                            $InputSchool = $_POST["InputSchool"];
                        }
                        //Check "From Date"
                        if($_POST["fromDate"] == ""){
                            $fromDate = '1900-01-01';
                        }
                        else{
                            $fromDate = $_POST["fromDate"];
                        }
                        //Check "To Date"
                        if($_POST["toDate"] == ""){
                            $toDate = '2999-01-01';
                        }
                        else{
                            $toDate = $_POST["toDate"];
                        }
                        

                        $contentName = $_POST["contentName"];
                        $sql = "SELECT DISTINCT materials.id AS material_id, materials.name AS name, materials.description AS description, UPPER(materials.file_type) AS file_type, courses.name AS course , institutions.name AS inst,
                        DATE_FORMAT(materials.date, '%d/%m/%Y') AS date, materials_rating.rating AS rating
                        FROM materials INNER JOIN courses ON courses.id= materials.course_id
                        INNER JOIN institutions ON courses.inst_id = institutions.id
                        LEFT JOIN 
                        (SELECT material_id, ROUND(AVG(user_rating),1) AS rating
						FROM materials_rating
                        WHERE status = 'Approved'
                        AND rating_type = 'material'
						GROUP BY material_id) AS materials_rating
                        ON materials.id = materials_rating.material_id
                        WHERE institutions.name LIKE '%".$InputSchool."%'
                        AND materials.name LIKE '%".$contentName."%'
                        AND materials.date BETWEEN '$fromDate' AND '$toDate'
                        WHERE materials.status = 'Approved'
                        GROUP BY materials.id
                        ORDER BY rating DESC
                        ;";          
                      }
                      else{
                        $sql = "SELECT DISTINCT materials.id AS material_id, materials.name AS name, materials.description AS description, UPPER(materials.file_type) AS file_type, courses.name AS course , institutions.name AS inst,
                        DATE_FORMAT(materials.date, '%d/%m/%Y') AS date, materials_rating.rating AS rating
                        FROM materials INNER JOIN courses ON courses.id= materials.course_id
                        INNER JOIN institutions ON courses.inst_id = institutions.id
                        LEFT JOIN 
                        (SELECT material_id, ROUND(AVG(user_rating),1) AS rating
						FROM materials_rating
						WHERE status = 'Approved'
                        AND rating_type = 'material'
						GROUP BY material_id) AS materials_rating
                        ON materials.id = materials_rating.material_id
                        WHERE materials.status = 'Approved'
                        GROUP BY materials.id
                        ORDER BY rating DESC;";  
                      }
                       
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            $linenum =1;
                            while($row = $result->fetch_assoc()) {
                                switch($row["file_type"]){
                                    case "PDF":
                                      $type_icon = "pdf.svg";
                                    break;
                                    case "DOC":
                                    case "DOCX":
                                      $type_icon = "word2.svg";
                                    break;
                                    case "PPT":
                                    case "PPTX":
                                      $type_icon = "powerpoint2.svg";
                                    break;
                                    case "XLS":
                                    case "XLSX":
                                    case "CSV":
                                      $type_icon = "excel2.svg";
                                    break;
                                    case "JPEG":
                                    case "JPG":
                                    case "PNG":
                                        $type_icon = "picture.svg";
                                    break;
                                    default:
                                      $type_icon = "doc.svg";
                                  }

                                echo '<tr>
                                <td>
                                    <button type="button" class="btn btn-link" onclick="downloadClick(this)" value="'.$row["material_id"].'">הורדה</button>
                                </td>
                                <td>
                                <img class="icon" src="../media/'.$type_icon.'"/>
                                </td>
                                <td class="verticalText">'.$row["name"].'</td>
                                <td>'.$row["description"].'</td>
                                <td>'.$row["course"].'</td>
                                <td>'.$row["inst"].'</td>
                                <td>'.$row["date"].'</td>
                                <td>'.$row["rating"].'</td>
                                <td>
                                    <button value="'.$row["material_id"].'" onclick="rateClick(this)" class="btn btn-link">דרג</button>
                                </td>

                                </tr>';
                                $linenum++;
                            }
                        } else {
                            echo '<h2>לא נמצאו תוצאות</h2>';
                        }

                    ?>       
                </tbody>
            </table>
        </div>

    </div>


    <div class="backdrop">
        <div id="popdiv" class="container-sm">

            <nav class="navbar navbar-dark bg-primary" id="fednav">
                <a class="navbar-brand" href="#">הזנת משוב</a>
            </nav>
            <form id="fedform" method="post" action="addContentRating.php" onsubmit="return validateForm()">
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

                <p></p>
                <label for="formGroupExampleInput">לצפיה בכלל התגובות לחומר לימודי זה לחץ על הכפתור הבא:</label>

                <button class="btn btn-primary" onclick="viewRatings()">צפה בדירוגי גולשים</button>

        </div>
    </div>

    </main>
    <div id="footer"></div> 
</body>
</html>