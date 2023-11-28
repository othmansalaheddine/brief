



$(document).ready(function() {
    $('#roleSelect').change(function() {
      var selectedRole = $(this).val();
      
      // Send the selected role to a PHP script using AJAX
      $.ajax({
        url: 'process.php',
        method: 'POST',
        data: { role: selectedRole },
        success: function(response) {
          // Handle the response from the PHP script
          console.log(response);
        }
      });
    });
  });