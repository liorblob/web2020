        function validationTextInput() {
            var val;
            val = document.getElementById('name').value;
            if ((val == "") || (val == undefined)) {
                alert('אנא הזן שם .');
            }

            val = document.getElementById('Email').value;
            if ((val == "") || (val == undefined)) {
                alert('אנא הזן אימייל.');
            }

            val = document.getElementById('Comments').value;
            if ((val == "") || (val == undefined)) {
                alert('אנא הזן נושא פנייה');
            }
			else if
			{
				window.location.href = '..\includes\home.php'
			}
        }