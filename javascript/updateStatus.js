function contentClick(b) {

  var value =  b.value.split("_");
  var material_id = parseInt(value[1]);
  var status = value[0];

  alert(material_id)
  alert(status)

  $.post("updateStatus.php",
  {
    material_id,
    status,
  }, function(data, status){
    window.location.href = "adminApprovals.php";
  });

}