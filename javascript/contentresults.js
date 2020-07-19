  function enablebut(id) {
      $(document.getElementById(id)).removeAttr('hidden');

  }

  $(document).ready(function() {
      $("#but1").click(function() {
          $(".backdrop").fadeTo(200, 1);
      });


  });

  $(function() {
      function ratingEnable() {
          $('#example-1to10').barrating('show', {
              theme: 'bars-1to10'
          });


      }

      ratingEnable();
  });