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

    <?php
    include "session.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/jquery.barrating.min.js"></script>

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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">הורדה</th>
                        <th scope="col">סוג</th>
                        <th scope="col">שם</th>
                        <th scope="col">קורס</th>
                        <th scope="col">מוסד</th>
                        <th scope="col">עדכניות</th>
                        <th scope="col">דירוג ממוצע</th>
                        <th scope="col">דרג קורס זה</th>
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
                        $sql = "SELECT DISTINCT materials.id AS material_id, materials.name AS name, UPPER(materials.file_type) AS file_type, courses.name AS course , institutions.name AS inst,
                        DATE_FORMAT(materials.date, '%d/%m/%Y') AS date, materials_rating.rating AS rating
                        FROM materials INNER JOIN courses ON courses.id= materials.course_id
                        INNER JOIN institutions ON courses.inst_id = institutions.id
                        LEFT JOIN 
                        (SELECT material_id, ROUND(AVG(user_rating),1) AS rating
						FROM materials_rating
                        WHERE status = 'Approved'
						GROUP BY material_id) AS materials_rating
                        ON materials.id = materials_rating.material_id
                        WHERE institutions.name LIKE '%".$InputSchool."%'
                        AND materials.name LIKE '%".$contentName."%'
                        AND materials.date BETWEEN '$fromDate' AND '$toDate'
                        GROUP BY materials.id
                        ORDER BY rating DESC
                        ;";          
                      }
                      else{
                        $sql = "SELECT DISTINCT materials.id AS material_id, materials.name AS name, UPPER(materials.file_type) AS file_type, courses.name AS course , institutions.name AS inst,
                        DATE_FORMAT(materials.date, '%d/%m/%Y') AS date, materials_rating.rating AS rating
                        FROM materials INNER JOIN courses ON courses.id= materials.course_id
                        INNER JOIN institutions ON courses.inst_id = institutions.id
                        LEFT JOIN 
                        (SELECT material_id, ROUND(AVG(user_rating),1) AS rating
						FROM materials_rating
						WHERE status = 'Approved'
						GROUP BY material_id) AS materials_rating
                        ON materials.id = materials_rating.material_id
                        GROUP BY materials.id
                        ORDER BY rating DESC;";  
                      }
                       
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            $linenum =1;
                            while($row = $result->fetch_assoc()) {
                                echo '<tr>
                                <th scope="row">'.$row["material_id"].'</th>
                                <td>
                                    <button type="button" class="btn btn-link"  value="Link" id="myButton">הורדה</button>
                                </td>
                                <td>
                                 <!--
                                    <img  src="..\media\pdf.png" style="width:2em; height:3em;"</img>
                                    -->
                                    '.$row["file_type"].'
                                </td>
                                <td>'.$row["name"].'</td>
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
                    <input id="nickname" name="nickname" type="text" class="form-control" placeholder="הזן שם להזדהות" aria-describedby="sizing-addon1">
                    <small id="UsernameHelpBlock" class="form-text text-muted">
                    הינך יכול להזדהות בשמך, שם המשתמש שלך או לבחור שם אנונימי לבחירתך
                    </small>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">דירוג</label>
                    <select class="custom-select custom-select-lg mb-3" id="contentRating" name="contentRating" autocomplete="off" value="">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    <p></p>
                </div>

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

    </main>
    <div id="footer"></div> 
</body>
</html>