<?php
 include 'dbconn.php';
 session_start();
?>

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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="../javascript/loader.js"></script>
        <script src="../javascript/contentresults.js"></script>

 
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
                            <th scope="col">דירוג</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                        // Check connection
                         if ($conn->connect_error) { 
                             echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
                             } 
                             else { 
                                 
                                  $InputCourse=$_POST["InputCourse"]; 
                                 
                      $sql = "SELECT materials.name AS mn, materials.file_type AS mft, courses.name AS cn , institutions.name AS inn ,materials.date AS md ,materials.rating AS mr
                      FROM ((materials INNER JOIN courses ON courses.id= materials.course_id) INNER JOIN institutions ON courses.inst_id= institutions.id) 
                      WHERE ( courses.name = '$InputCourse' )";
                            $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                        // output data of each row
                        $linenum =1;
                       while($row = $result->fetch_assoc()) {
                       
                        echo '<tr>
                            <th scope="row">'.$linenum.'</th>
                            <td>
                                <button type="button" class="btn btn-link"  value="Link" id="myButton">הורדה</button>
                            </td>
                            <td>
                            <img  src="..\media\pdf.png" style="width:2em; height:3em;"</img>
                            </td>
                            <td>'.$row["mn"].'</td>
                            <td>'.$row["cn"].'</td>
                            <td>'.$row["inn"].'</td>
                            <td>'.$row["md"].'</td>
                            <td>'.$row["mr"].'</td>
                            <td>
                                  <button id="but1" class="btn btn-link" value="" >דרג</button>
                            </td>

                        </tr>';
                        $linenum++;
                       }

            }
			                       else
                       echo '<h4 class="card-title">לא נמצאו תוצאות</h4>';
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

                <form id="fedform">
                    <div class="form-group">
                        <label for="formGroupExampleInput">שם משתמש</label>
                        <input id="Username" type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon1" required>
                        <small id="UsernameHelpBlock" class="form-text text-muted">
                        הינך יכול להזדהות בשמך או לבחור שם אנונימי לבחירתך
                    </small>
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput2">דירוג</label>
                        <select class="custom-select custom-select-lg mb-3" id="example-1to10" name="rating" autocomplete="off" value="">
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
                        <p> </p>
                    </div>

                    <div class="form-group">

                        <label for="exampleFormControlTextarea1">תגובה</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <small id="commentHelpBlock" class="form-text text-muted">
                        התגובה תתפרסם לכל המשתמשים במערכת. אנא מכם, שמרו על שפה נאותה
                    </small>
                    </div>

                    <button id="sumbit_btn" class="btn btn-primary" type="submit" onsubmit="enablebut()">שלח</button>


                </form>
            </div>
        </div>

        </main>
        <div id="footer"></div> 





    </body>

    </html>