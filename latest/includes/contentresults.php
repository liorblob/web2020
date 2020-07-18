﻿<?php
 include 'dbconn.php';
 session_start();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
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
        <script type="text/javascript" charset="utf-8">
            function myFunction() {

                var btn = document.getElementById("example-1to10");

                if (btn.value == "") {
                    btn.value = "דרג";
                    btn.innerHTML = "דרג";
                } else {
                    btn.value = "Link";
                    btn.innerHTML = "Link";
                }

            }
        </script>
        <script type="text/javascript" charset="utf-8">
            function enablebut() {
                $('#but1').removeAttr('hidden');
                $('#but3').removeAttr('hidden');

            }
        </script>
        <script>
            $(document).ready(function() {
                $("#but1").click(function() {
                    $(".backdrop").fadeTo(200, 1);
                });


            });
        </script>
        <script>
            $(function() {
                function ratingEnable() {
                    $('#example-1to10').barrating('show', {
                        theme: 'bars-1to10'
                    });


                }

                ratingEnable();
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

        <nav id="mainnav" class="navbar navbar-expand-sm bg-dark navbar-dark">
            <a class="navbar-brand" href="#">Noodle</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a id="active" class="nav-link active" href="#">חיפוש</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">שיתוף</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">קהילה</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">שיעורים פרטיים</a>
                    </li>
                </ul>
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="text" placeholder="חיפוש...">
                    <button class="btn btn-success" type="submit">חפש</button>
                </form>
            </div>
        </nav>

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
                            <th scope="col">הועלה ע"י</th>
                            <th scope="col">לדרג</th>
                            <th scope="col">מועדפים</th>
                        </tr>
                    </thead>

                    <tbody>
                        // Check connection if ($conn->connect_error) { echo '
                        <h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>'; } else { $InputSchool = $_SESSION["InputSchool"]; $inputtitle=$_SESSION["inputtitle"]; $inputfromdate=$_SESSION["inputfromdate"]; $inputtodate=$_SESSION["inputtodate"];
                        $inputfromdate2=$_SESSION["inputfromdate2"]; $inputtodate2=$_SESSION["inputtodate2"]; $inputdoner=$_SESSION["inputdoner"]; $InputCourse=$_SESSION["InputCourse"]; $formControlRange=$_SESSION["formControlRange"]; $sql=''

                        <tr>
                            <th scope="row">1</th>
                            <td>
                                <button type="button" class="btn btn-link" onclick="enablebut()" value="Link" id="myButton">Link</button>
                            </td>
                            <td>סוג</td>
                            <td>שם</td>
                            <td>קורס</td>
                            <td>מוסד</td>
                            <td>עדכניות</td>
                            <td>דירוג</td>
                            <td>הועלה על ידי</td>
                            <td>
                                <button id="but1" class="btn btn-link" value="" hidden>דרג</button>
                            </td>
                            <td>
                                <button id="but3" class="btn btn-link" value="" hidden>הוספה</button>
                            </td>

                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>הורדה</td>
                            <td>סוג</td>
                            <td>שם</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
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







    </body>

    </html>