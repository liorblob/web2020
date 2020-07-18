<?php
  session_start();
  session_destroy();
?>
<!DOCTYPE html>
<head>
  <title>Noodle</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<script type='text/javascript'>
  alert('התנתקת בהצלחה');
  window.location.href = "../index.php"
  // TODO: delete cookies onload="setCookie(...)"
</script>

</body>

</html>
