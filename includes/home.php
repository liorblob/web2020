<!DOCTYPE html>
<head>
  <title>Noodle</title>
  <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/calendar.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="../javascript/cookies.js"></script>
  <script src="../javascript/tooltip.js"></script>
  <script src="../javascript/loader.js"></script>

  <?php
  include "session.php";
  ?>


</head>
<body>
<div id="header"></div>
      
<div class="text-center">
  <h2>שלום <?php echo $_SESSION["name"] ?></h2> 
</div>

<main id="main" class="container">
  <div class="row">
    <section class="col-sm-6">
      <h2>לוח זמנים</h2>
       <!-- Calendar -->
      <div class="calendar shadow bg-white p-2">
        <div class="d-flex align-items-center">
          <h2 class="month font-weight-bold text-uppercase">יולי 2020</h2>
        </div>
        <p class="font-italic text-muted mb-5">אין לך אירועים היום.</p>
        <ol class="day-names list-unstyled">
          <li class="font-weight-bold text-uppercase">א</li>
          <li class="font-weight-bold text-uppercase">ב</li>
          <li class="font-weight-bold text-uppercase">ג</li>
          <li class="font-weight-bold text-uppercase">ד</li>
          <li class="font-weight-bold text-uppercase">ה</li>
          <li class="font-weight-bold text-uppercase">ו</li>
          <li class="font-weight-bold text-uppercase">ש</li>
        </ol>

        <ol class="days list-unstyled">
          <li>
            <div class="date">1</div>
            <div class="event bg-success">הגשת מטלה במתמטיקה ב'</div>
          </li>
          <li>
            <div class="date">2</div>
          </li>
          <li>
            <div class="date">3</div>
          </li>
          <li>
            <div class="date">4</div>
          </li>
          <li>
            <div class="date">5</div>
          </li>
          <li>
            <div class="date">6</div>
          </li>
          <li>
            <div class="date">7</div>
          </li>
          <li>
            <div class="date">8</div>
          </li>
          <li>
            <div class="date">9</div>
          </li>
          <li>
            <div class="date">10</div>
          </li>
          <li>
            <div class="date">11</div>
          </li>
          <li>
            <div class="date">12</div>
          </li>
          <li>
            <div class="date">13</div>
            <div class="event all-day begin span-2 bg-warning">ביצוע מטלה</div>
          </li>
          <li>
            <div class="date">14</div>
          </li>
          <li>
            <div class="date">15</div>
            <div class="event all-day end bg-success">הגשת מטלה</div>
          </li>
          <li>
            <div class="date">16</div>
          </li>
          <li class="bg-info">
            <div class="date">17</div>
          </li>
          <li>
            <div class="date">18</div>
          </li>
          <li>
            <div class="date">19</div>
          </li>
          <li>
            <div class="date">20</div>
          </li>
          <li>
            <div class="date">21</div>
          </li>
          <li>
            <div class="date">22</div>
            <div class="event bg-primary">מבחן במתמטיקה ב'</div>
          </li>
          <li>
            <div class="date">23</div>
          </li>
          <li>
            <div class="date">24</div>
          </li>
          <li>
            <div class="date">25</div>
          </li>
          <li>
            <div class="date">26</div>
          </li>
          <li>
            <div class="date">27</div>
          </li>
          <li>
            <div class="date">28</div>
          </li>
          <li>
            <div class="date">29</div>
          </li>
          <li>
            <div class="date">30</div>
          </li>
          <li>
            <div class="date">31</div>
          </li>
          <li class="outside">
            <div class="date">1</div>
          </li>
          <li class="outside">
            <div class="date">2</div>
          </li>
          <li class="outside">
            <div class="date">3</div>
          </li>
          <li class="outside">
            <div class="date">4</div>
          </li>
        </ol>
      </div>
      <h3>אירועים קרובים</h3>
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link">מבחן במתמטיקה ב'</a>
        </li>
        <li class="nav-item">
          <a class="nav-link">הגשת מטלה בניהול פרויקטים</a>
        </li>
        <li class="nav-item">
          <a class="nav-link">הגשת מטלה בממשקי אדם מחשב</a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </section>
    <section class="col-sm-6">
      <h2>הבקשות שלי</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>תאריך</th>
            <th>תיאור</th>
            <th>קורס</th>
            <th>סוג</th>
            <th>סטטוס</th>
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

            $sql = 'SELECT r.id AS request_id, r.description AS request_desc, r.type AS request_type, r.status AS request_status, r.date AS request_date, c.name AS course_name FROM `requests` AS r, `courses` AS c WHERE c.id = r.course_id AND r.user_id ='.$id;
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  switch ($row["request_status"]) {
                    case "נענה":
                      $cell_class = "bg-success";
                      break;
                    default:
                      $cell_class = "bg-info";
                    }
                    echo '<tr>
                    <td>'.$row["request_id"].'</td>
                    <td>'.$row["request_date"].'</td>
                    <td>'.$row["request_desc"].'</td>
                    <td>'.$row["course_name"].'</td>
                    <td>'.$row["request_type"].'</td>
                    <td class="'.$cell_class.'">'.$row["request_status"].'</td>
                  </tr>';
                }
            } else {
                echo '<h4 class="card-title">לא נמצאו בקשות</h4>';
            }
          }
          ?>  
        </tbody>
      </table>
      <br>
    </section>
      <section class="col-sm-12">
        <h2>הקורסים שלי</h2>
        <ul class="nav flex-column">
          <?php
          // Check connection
          if ($conn->connect_error) {
            echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
          } 
          else {
            $sql = "SELECT c.name AS course_name, c.date AS course_date, p.name AS prof_name, i.name AS inst_name FROM `courses` AS c, `institutions` AS i, `professors` AS p WHERE c.prof_id = p.id AND c.inst_id = i.id";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<li class="nav-item">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">'.$row["course_name"].' - '.$row["course_date"].'</h4>
                        <p class="card-text">קורס המועבר ע"י '.$row["prof_name"].' במוסד '.$row["inst_name"].'</p>
                        <a data-toggle="tooltip" title="בקרוב..." data-placement="top" href="" class="card-link">חומרי לימוד</a>
                      </div>
                    </div>
                    </li>';
                }
            } else {
                echo '<h4 class="card-title">לא נמצאו קורסים</h4>';
            }
            
            $conn->close();
          }
          ?>  
        </ul>
        <br>
        </section>
      <section class="col-sm-12" id="recommended">
        <h2>המלצות מערכת</h2>
        <p>המלצות בעקבות <strong>מבחן במתמטיקה ב'</strong> בתאריך <strong>22.05.2020</strong></p>
        <div class="card-group">
          <div class="card">
            <div class="card-body text-center">
              <img src="../media/word.png">
              <a data-toggle="tooltip" title="בקרוב..." data-placement="top" href="" class="card-link">סיכום מתמטיקה ב' 2017</a>
              <p>דירוג: <strong>7.8</strong></p>
            </div>
          </div>
          <div class="card">
            <div class="card-body text-center">
              <img src="../media/pdf.png">
              <a data-toggle="tooltip" title="בקרוב..." data-placement="top" href="" class="card-link">מבחן במתמטיקה ב' ציון 92</a>
              <p>דירוג: <strong>9.1</strong></p>
            </div>
          </div>
          <div class="card">
            <div class="card-body text-center">
              <img src="../media/pdf.png">
              <a data-toggle="tooltip" title="בקרוב..." data-placement="top" href="" class="card-link">שיעור מסכם אינטגרלים</a>
              <p>דירוג: <strong>6.3</strong></p>
            </div>
          </div>
        </div>
        </section>
      <section class="col-sm-12">
        <h2>מועדפים</h2>
        <p>אין לך מועדפים עדיין.</p>
        <br>
        </section>
    </div>
</main>

<div id="footer"></div> 

</body>
</html>
