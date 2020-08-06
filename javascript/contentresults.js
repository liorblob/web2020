  function torate() {
	$(".backdrop").fadeTo(200, 1);

  }

  $(function() {
      function ratingEnable() {
          $('#example-1to10').barrating('show', {
              theme: 'bars-1to10'
          });


      }

      ratingEnable();
  });