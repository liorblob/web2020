function contentClick(b) {

  var value =  b.value.split("_");
  var material_id = parseInt(value[1]);
  var status = value[0];

  $.post("updateContentStatus.php",
  {
    material_id: material_id,
    status: status
  }, function(data, status){
    window.location.href = "adminApprovals.php";
  });

}

function ratingClick(b) {

  var value =  b.value.split("_");
  var rating_id = parseInt(value[1]);
  var status = value[0];

  $.post("updateContentRatingStatus.php",
  {
    rating_id: rating_id,
    status: status
  }, function(data, status){
    window.location.href = "adminApprovals.php";
  });

}