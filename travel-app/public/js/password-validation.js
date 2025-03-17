$(document).ready(function() {
    function validatePassword() {
        let password = $("#password").val();
        let confirmPassword = $("#confirm_password").val();
        let passwordMessage = $("#password-length-message");
        let matchMessage = $("#password-match-message");
        let submitBtn = $("#submit-btn");

        // Cek panjang password
        if (password.length < 8) {
            passwordMessage.text("Password minimal 8 karakter!!").css("color", "red");
        } else {
            passwordMessage.text("✅ Password cukup kuat").css("color", "green");
        }

        // Cek apakah password & konfirmasi cocok
        if (password !== confirmPassword) {
            matchMessage.text("Password tidak cocok!!").css("color", "red");
            submitBtn.prop("disabled", true).addClass("bg-gray-400").removeClass("bg-blue-500");
        } else {
            matchMessage.text("✅ Password sesuai").css("color", "green");
            submitBtn.prop("disabled", false).addClass("bg-blue-500").removeClass("bg-gray-400");
        }
    }

    $("#password, #confirm_password").on("keyup", validatePassword);

        $("#registerForm").on("submit", function(event) {
        event.preventDefault();
        let formData = $(this).serialize();
        let registerUrl = $(this).data("route");

          $.ajax({
              url: registerUrl,
              type: "POST",
              data: formData,
              success: function(response) {
                  alert("Akun berhasil dibuat!");
                  window.location.href = dashboardUrl;
              },
              error: function(xhr) {
                  let errors = xhr.responseJSON.errors;
                  let errorMessage = "";

                  for (let key in errors) {
                      errorMessage += errors[key][0] + "\n";
                  }

                  alert("Gagal mendaftar, isi form dengan benar:\n" + errorMessage);
              }
          });
        });

    });
    