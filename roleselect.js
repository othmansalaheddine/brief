$(document).ready(function() {
    $('select[name="role"]').change(function() {
      var selectedRole = $(this).val();
      var userId = $(this).data('user-id');
      console.log(selectedRole);
  
      $.ajax({
        type: "POST",
        url: "admin.php",
        data: {
          role: selectedRole, // send the selected role dynamically
          userId: userId
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