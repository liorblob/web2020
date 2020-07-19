<?php
  session_start();
  session_destroy();
  echo "<script type='text/javascript' src='../javascript/cookies.js'></script>";
  echo "<script type='text/javascript'>setCookie('user', " . '""'. ")</script>";
?>
<!DOCTYPE html>
<head>
  <title>Noodle</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type='text/javascript' src='javascript/cookies.js'></script>
</head>

<body>
<script type='text/javascript'>
  alert('התנתקת בהצלחה'); 
</script>

</body>

</html>
