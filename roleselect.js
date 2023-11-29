$(document).ready(function() {
    $('select[name="role"]').change(function() {
      var selectedRole = $(this).val();
      console.log(selectedRole);
  
      $.ajax({
        type: "POST",
        url: "admin.php",
        data: {
          role: selectedRole, // send the selected role dynamically
        },
        cache: false,
        success: function(data) {
          console.log(data);
        },
        error: function(xhr, status, error) {
          console.error(xhr);
        }
      });
    });
  });