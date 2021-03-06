<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Noodle</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/ContactUs.css">
    <link rel="stylesheet" type="text/css" href="..\css\main.css">

    <?php
    include "session.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script>
        $(document).ready(function() {
          $('#contactForm').on('submit', function(e){
              $('#contactModal').modal('show');
              e.preventDefault();
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
 
    <div id="header"></div>
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <h4 class="modal-title">תודה שפנית אלינו. פנייתך תטופל בהקדם.</h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="window.location.href='home.php';">סגור</button>
          </div>
          </div>
        </div>
      </div>
    <main>
        <div class="row no-gutters">
            <div class="col-sm-8">
                <br>
                <h2>השארת פרטים ליצירת קשר</h2>
                <form id="contactForm" class="form-group">

                    <div class="form-group col-sm">
                        <label for="Name">שם</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group col-sm">
                        <label for="PhoneNumber">מספר טלפון</label>
                        <input name="PhoneNumber" id="PhoneNumber" type="text" class="form-control" value="" required/>
                    </div>
                    <div class="form-group col-sm">
                        <label for="FromEmailAddress">אימייל</label>
                        <input name="FromEmailAddress" id="Email" type="email" class="form-control" value="" required/>
                    </div>
                    <div class="form-group col-sm">
                        <label for="Comments">תגובה</label>
                        <textarea class="form-control" name="Comments" id="Comments" class="form-control" id="exampleFormControlTextarea1" rows="7" value=""></textarea>
                    </div>
                    <input id="subid" class="btn btn-primary" type="submit" value="שלח"/>
                </form>

            </div>

            <div class="col-sm-4">
                <img id="imgtest" src="../media/conus.jpeg">
            </div>
        </div>
    </main>

    <div id="footer"></div>

</body>

</html>