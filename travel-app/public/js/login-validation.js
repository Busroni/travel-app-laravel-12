$(document).ready(function() {
    function validatePassword() {
        let password = $("#password").val();
        let passwordMessage = $("#password-length-message");
        let submitBtn = $("#submit-btn");

        // Cek panjang password
        if (password.length < 8) {
            passwordMessage.text("Password minimal 8 karakter!!").css("color", "red");
            submitBtn.prop("disabled", true).addClass("bg-gray-400").removeClass("bg-blue-500");
        } else {
            passwordMessage.text("Password sesuai minimal ✅").css("color", "green");
            submitBtn.prop("disabled", false).addClass("bg-blue-500").removeClass("bg-gray-400");
        }
    }
    $("#password").on("keyup", validatePassword);


    });
    